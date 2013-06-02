define([
    "jquery",
    "underscore",
    "core",
    "utils",
    "settings",
    "extension-manager",
    "file-system",
    "file-manager",
    "sharing",
    "blogger-provider",
    "dropbox-provider",
    "gist-provider",
    "github-provider",
    "gdrive-provider",
    "ssh-provider",
    "tumblr-provider",
    "wordpress-provider"
], function($, _, core, utils, settings, extensionMgr, fileSystem, fileMgr, sharing) {

	var publisher = {};
	
	// Create a map with providerId: providerModule
	var providerMap = _.chain(
		arguments
	).map(function(argument) {
		return argument && argument.providerId && [argument.providerId, argument];
	}).compact().object().value();
	
	// Retrieve publish locations from localStorage
	_.each(fileSystem, function(fileDesc) {
		_.chain(
			localStorage[fileDesc.fileIndex + ".publish"].split(";")
		).compact().each(function(publishIndex) {
			var publishAttributes = JSON.parse(localStorage[publishIndex]);
			// Store publishIndex
			publishAttributes.publishIndex = publishIndex;
			// Replace provider ID by provider module in attributes
			publishAttributes.provider = providerMap[publishAttributes.provider];
			fileDesc.publishLocations[publishIndex] = publishAttributes;
		});
	});

	// Apply template to the current document
	publisher.applyTemplate = function(publishAttributes) {
		var fileDesc = fileMgr.getCurrentFile();
		try {
			return _.template(settings.template, {
				documentTitle: fileDesc.title,
				documentMarkdown: $("#wmd-input").val(),
				documentHTML: $("#wmd-preview").html(),
				publishAttributes: publishAttributes
			});
		} catch(e) {
			extensionMgr.onError(e);
			throw e;
		}
	};
	
	// Used to get content to publish
	function getPublishContent(publishAttributes) {
		if(publishAttributes.format === undefined) {
			publishAttributes.format = $("input:radio[name=radio-publish-format]:checked").prop("value");			
		}
		if(publishAttributes.format == "markdown") {
			return $("#wmd-input").val();
		}
		else if(publishAttributes.format == "html") {
			return $("#wmd-preview").html();
		}
		else {
			return publisher.applyTemplate(publishAttributes);
		}
	}
	
	// Recursive function to publish a file on multiple locations
	var publishAttributesList = [];
	var publishTitle = undefined;
	function publishLocation(callback, errorFlag) {
		
		// No more publish location for this document
		if (publishAttributesList.length === 0) {
			callback(errorFlag);
			return;
		}
		
		// Dequeue a synchronized location
		var publishAttributes = publishAttributesList.pop();
		var content = getPublishContent(publishAttributes);
		
		// Call the provider
		publishAttributes.provider.publish(publishAttributes, publishTitle, content, function(error) {
			if(error !== undefined) {
				var errorMsg = error.toString();
				if(errorMsg.indexOf("|removePublish") !== -1) {
					fileMgr.removePublish(publishAttributes);
				}
				if(errorMsg.indexOf("|stopPublish") !== -1) {
					callback(error);
					return;
				}
			}
			publishLocation(callback, errorFlag || error );
		});
	}
	
	var publishRunning = false;
	publisher.publish = function() {
		// If publish is running or offline
		if(publishRunning === true || core.isOffline) {
			return;
		}
		
		publishRunning = true;
		extensionMgr.onPublishRunning(true);
		var fileDesc = fileMgr.getCurrentFile();
		publishTitle = fileDesc.title;
		publishAttributesList = _.values(fileDesc.publishLocations);
		publishLocation(function(errorFlag) {
			publishRunning = false;
			extensionMgr.onPublishRunning(false);
			if(errorFlag === undefined) {
				extensionMgr.onPublishSuccess(fileDesc);
			}
		});
	};
	
	// Generate a publishIndex associated to a file and store publishAttributes
	function createPublishIndex(fileDesc, publishAttributes) {
		var publishIndex = undefined;
		do {
			publishIndex = "publish." + utils.randomString();
		} while(_.has(localStorage, publishIndex));
		publishAttributes.publishIndex = publishIndex;
		utils.storeAttributes(publishAttributes);
		fileMgr.addPublish(fileDesc, publishAttributes);
	}
	
	// Initialize the "New publication" dialog
	var newLocationProvider = undefined;
	function initNewLocation(provider) {
		var defaultPublishFormat = provider.defaultPublishFormat || "markdown";
		newLocationProvider = provider;
		$(".publish-provider-name").text(provider.providerName);
		
		// Show/hide controls depending on provider
		$('div[class*=" modal-publish-"]').hide().filter(".modal-publish-" + provider.providerId).show();
		
		// Reset fields
		utils.resetModalInputs();
		$("input:radio[name=radio-publish-format][value=" + defaultPublishFormat + "]").prop("checked", true);
		
		// Load preferences
		var serializedPreferences = localStorage[provider.providerId + ".publishPreferences"];
		if(serializedPreferences) {
			var publishPreferences = JSON.parse(serializedPreferences);
			_.each(provider.publishPreferencesInputIds, function(inputId) {
				utils.setInputValue("#input-publish-" + inputId, publishPreferences[inputId]);
			});
			utils.setInputRadio("radio-publish-format", publishPreferences.format);
		}
		
		// Open dialog box
		$("#modal-publish").modal();
	}
	
	// Add a new publish location to a local document
	function performNewLocation(event) {
		var provider = newLocationProvider;
		var publishAttributes = provider.newPublishAttributes(event);
		if(publishAttributes === undefined) {
			return;
		}
		
		// Perform provider's publishing
		var fileDesc = fileMgr.getCurrentFile();
		var title = fileDesc.title;
		var content = getPublishContent(publishAttributes);
		provider.publish(publishAttributes, title, content, function(error) {
			if(error === undefined) {
				publishAttributes.provider = provider.providerId;
				sharing.createLink(publishAttributes, function() {
					createPublishIndex(fileDesc, publishAttributes);
				});
			}
		});
		
		// Store input values as preferences for next time we open the publish dialog
		var publishPreferences = {};
		_.each(provider.publishPreferencesInputIds, function(inputId) {
			publishPreferences[inputId] = $("#input-publish-" + inputId).val();
		});
		publishPreferences.format = publishAttributes.format;
		localStorage[provider.providerId + ".publishPreferences"] = JSON.stringify(publishPreferences);
	}
	
	// Retrieve file's publish locations from localStorage
	publisher.populatePublishLocations = function(fileDesc) {
		_.chain(
			localStorage[fileDesc.fileIndex + ".publish"].split(";")
		).compact().each(function(publishIndex) {
			var publishAttributes = JSON.parse(localStorage[publishIndex]);
			// Store publishIndex
			publishAttributes.publishIndex = publishIndex;
			// Replace provider ID by provider module in attributes
			publishAttributes.provider = providerMap[publishAttributes.provider];
			fileDesc.publishLocations[publishIndex] = publishAttributes;
		});
	};
	
	core.onReady(function() {
		// Add every provider
		var publishMenu = $("#publish-menu");
		_.each(providerMap, function(provider) {
			// Provider's publish button
			publishMenu.append(
				$("<li>").append(
					$('<a href="#"><i class="icon-' + provider.providerId + '"></i> ' + provider.providerName + '</a>')
						.click(function() {
							initNewLocation(provider);
						}
					)
				)
			);
			// Action links (if any)
			$(".action-publish-" + provider.providerId).click(function() {
				initNewLocation(provider);
			});
		});
		
		$(".action-process-publish").click(performNewLocation);
		
		// Save As menu items
		$(".action-download-md").click(function() {
			var content = $("#wmd-input").val();
			var title = fileMgr.getCurrentFile().title;
			utils.saveAs(content, title + ".md");
		});
		$(".action-download-html").click(function() {
			var content = $("#wmd-preview").html();
			var title = fileMgr.getCurrentFile().title;
			utils.saveAs(content, title + ".html");
		});		
		$(".action-download-template").click(function() {
			var content = publisher.applyTemplate();
			var title = fileMgr.getCurrentFile().title;
			utils.saveAs(content, title + ".txt");
		});
	});
	
	extensionMgr.onPublisherCreated(publisher);
	return publisher;
});