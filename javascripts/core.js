define([
    "jquery",
	"underscore",
    "utils",
    "settings",
    "extension-manager",
    "storage",
    "config",
    "lib/bootstrap",
    "lib/Markdown.Editor"
], function($, _, utils, settings, extensionMgr) {
	
	var core = {};
	
	// Used for periodic tasks
	var intervalId = undefined;
	var periodicCallbacks = [];
	core.addPeriodicCallback = function(callback) {
		periodicCallbacks.push(callback);
	};
	
	// Used to detect user activity
	var userReal = false;
	var userActive = false;
	var windowUnique = true;
	var userLastActivity = 0;
	function setUserActive() {
		userReal = true;
		userActive = true;
		userLastActivity = utils.currentTime;
	};
	function isUserActive() {

		return userActive && windowUnique;
	}
	
	// Used to only have 1 window of the application in the same browser
	var windowId = undefined;
	function checkWindowUnique() {
		if(userReal === false || windowUnique === false) {
			return;
		}
		if(windowId === undefined) {
			windowId = utils.randomString();
			localStorage["frontWindowId"] = windowId;
		}
		var frontWindowId = localStorage["frontWindowId"];
		if(frontWindowId != windowId) {
			windowUnique = false;
			if(intervalId !== undefined) {
				clearInterval(intervalId);
			}
			$(".modal").modal("hide");
			$('#modal-non-unique').modal({
				backdrop: "static",
				keyboard: false
			});
		}
	}
	
	// Offline management
	core.isOffline = false;
	var offlineTime = utils.currentTime;
	core.setOffline = function() {
		offlineTime = utils.currentTime;
		if(core.isOffline === false) {
			core.isOffline = true;
			extensionMgr.onOfflineChanged(true);
		}
	};
	function setOnline() {
		if(core.isOffline === true) {
			core.isOffline = false;
			extensionMgr.onOfflineChanged(false);
		}
	}
	function checkOnline() {
		// Try to reconnect if we are offline but we have some network
		if (core.isOffline === true && navigator.onLine === true
			&& offlineTime + CHECK_ONLINE_PERIOD < utils.currentTime) {
			offlineTime = utils.currentTime;
			// Try to download anything to test the connection
			$.ajax({ 
				url : "//www.google.com/jsapi",
				timeout : AJAX_TIMEOUT, dataType : "script"
			}).done(function() {
				setOnline();
			});
		}
	}
	function checkLogin() {
		$.ajax({ 
			url : "session",
			timeout : 1000, dataType : "json"
		}).done(function(value) {
			window.user = value;
		});	
	}	
	// Load settings in settings dialog
	function loadSettings() {
		
		// Layout orientation
		utils.setInputRadio("radio-layout-orientation", settings.layoutOrientation);
		// Theme
		utils.setInputValue("#input-settings-theme", localStorage.theme);
		// Lazy rendering
		utils.setInputChecked("#input-settings-lazy-rendering", settings.lazyRendering);
		// Editor font size
		utils.setInputValue("#input-settings-editor-font-size", settings.editorFontSize);
		// Default content
		utils.setInputValue("#textarea-settings-default-content", settings.defaultContent);
		// Commit message
		utils.setInputValue("#input-settings-publish-commit-msg", settings.commitMsg);
		// Template
		utils.setInputValue("#textarea-settings-publish-template", settings.template);
		// SSH proxy
		utils.setInputValue("#input-settings-ssh-proxy", settings.sshProxy);
		
		// Load extension settings
		extensionMgr.onLoadSettings();
	}

	// Save settings from settings dialog
	function saveSettings(event) {
		var newSettings = {};
		
		// Layout orientation
		newSettings.layoutOrientation = utils.getInputRadio("radio-layout-orientation");
		// Theme
		var theme = utils.getInputValue("#input-settings-theme");
		// Lazy Rendering
		newSettings.lazyRendering = utils.getInputChecked("#input-settings-lazy-rendering");
		// Editor font size
		newSettings.editorFontSize = utils.getInputIntValue("#input-settings-editor-font-size", event, 1, 99);
		// Default content
		newSettings.defaultContent = utils.getInputValue("#textarea-settings-default-content");
		// Commit message
		newSettings.commitMsg = utils.getInputTextValue("#input-settings-publish-commit-msg", event);
		// Template
		newSettings.template = utils.getInputTextValue("#textarea-settings-publish-template", event);
		// SSH proxy
		newSettings.sshProxy = utils.checkUrl(utils.getInputTextValue("#input-settings-ssh-proxy", event), true);
		
		// Save extension settings
		newSettings.extensionSettings = {};
		extensionMgr.onSaveSettings(newSettings.extensionSettings, event);
		
		if(!event.isPropagationStopped()) {
			$.extend(settings, newSettings);
			localStorage.settings = JSON.stringify(settings);
			localStorage.theme = theme;
		}
	}
	
	// Create the layout
	var layout = undefined;
	core.createLayout = function() {
		
		extensionMgr.onLayoutCreated(layout);
	};
	
	// Create the PageDown editor
	var insertLinkCallback = undefined;
	core.createEditor = function(onTextChange) {
		var converter = new Markdown.Converter();
		var editor = new Markdown.Editor(converter);
		// Custom insert link dialog
		editor.hooks.set("insertLinkDialog", function (callback) {
			insertLinkCallback = callback;
			utils.resetModalInputs();
			$("#modal-insert-link").modal();
			_.defer(function() {
				$("#input-insert-link").focus();
			});
			return true;
	    });
		// Custom insert image dialog
		editor.hooks.set("insertImageDialog", function (callback) {
			insertLinkCallback = callback;
			utils.resetModalInputs();
			$("#modal-insert-image").modal();
			_.defer(function() {
				$("#input-insert-image").focus();
			});
			return true;
		});
		
		var documentContent = undefined;
		function checkDocumentChanges() {
			var newDocumentContent = $("#wmd-input").val();
			if(documentContent !== undefined && documentContent != newDocumentContent) {
				onTextChange();
			}
			documentContent = newDocumentContent;
		}
		var previewWrapper = undefined;
		if(settings.lazyRendering === true) {
			previewWrapper = function(makePreview) {
				var debouncedMakePreview = _.debounce(makePreview, 500); 
				return function() {
					if(documentContent === undefined) {
						makePreview();
					}
					else {
						debouncedMakePreview();
					}
					checkDocumentChanges();
				};
			};
		}
		else {
			previewWrapper = function(makePreview) {
				return function() {
					checkDocumentChanges();
					makePreview();
				};
			};
		}
		editor.hooks.chain("onPreviewRefresh", extensionMgr.onAsyncPreview);
		extensionMgr.onEditorConfigure(editor);
		
		$("#wmd-input, #wmd-preview").scrollTop(0);
		$("#wmd-button-bar").empty();
		editor.run(previewWrapper);
		firstChange = false;

		// Hide default buttons
		$(".wmd-button-row").addClass("btn-group").find("li:not(.wmd-spacer)")
			.addClass("btn").css("left", 0).find("span").hide();
		
		// Add customized buttons
		$("#wmd-bold-button").append($("<i>").addClass("icon-bold"));
		$("#wmd-italic-button").append($("<i>").addClass("icon-italic"));
		$("#wmd-link-button").append($("<i>").addClass("icon-globe"));
		$("#wmd-quote-button").append($("<i>").addClass("icon-indent-left"));
		$("#wmd-code-button").append($("<i>").addClass("icon-code"));
		$("#wmd-image-button").append($("<i>").addClass("icon-picture"));
		$("#wmd-olist-button").append($("<i>").addClass("icon-numbered-list"));
		$("#wmd-ulist-button").append($("<i>").addClass("icon-list"));
		$("#wmd-heading-button").append($("<i>").addClass("icon-text-height"));
		$("#wmd-hr-button").append($("<i>").addClass("icon-hr"));
		$("#wmd-undo-button").append($("<i>").addClass("icon-undo"));
		$("#wmd-redo-button").append($("<i>").addClass("icon-share-alt"));
	};

	// onReady event callbacks
	var readyCallbacks = [];
	core.onReady = function(callback) {
		readyCallbacks.push(callback);
		runReadyCallbacks();
	};
	var ready = false;
	core.setReady = function() {
		ready = true;
		runReadyCallbacks();
	};
	function runReadyCallbacks() {
		if(ready === true) {
			_.each(readyCallbacks, function(callback) {
				callback();
			});
			readyCallbacks = [];
		}
	}
	
	core.onReady(extensionMgr.onReady);
	core.onReady(function() {
				
		// Load theme list
		
		// listen to online/offline events
		$(window).on('offline', core.setOffline);
		$(window).on('online', setOnline);
		if (navigator.onLine === false) {
			core.setOffline();
		}
		
		checkLogin();
		// Detect user activity
		$(document).mousemove(setUserActive).keypress(setUserActive);
		
		// Avoid dropdown to close when clicking on submenu
		$(".dropdown-submenu > a").click(function(e) {
			e.stopPropagation();
		});
		
		// Click events on "insert link" and "insert image" dialog buttons
		$(".action-insert-link").click(function(e) {
			var value = utils.getInputTextValue($("#input-insert-link"), e);
			if(value !== undefined) {
				insertLinkCallback(value);
			}
		});
		$(".action-insert-image").click(function(e) {
			var value = utils.getInputTextValue($("#input-insert-image"), e);
			if(value !== undefined) {
				insertLinkCallback(value);
			}
		});
		$(".action-close-insert-link").click(function(e) {
			insertLinkCallback(null);
		});

		// Settings loading/saving
		$(".action-load-settings").click(function() {
			loadSettings();
		});
		$(".action-apply-settings").click(function(e) {
			saveSettings(e);
			if(!e.isPropagationStopped()) {
				window.location.reload();
			}
		});
		
		$(".action-default-settings").click(function() {
			localStorage.removeItem("settings");
			localStorage.removeItem("theme");
			window.location.reload();
		});
		
		$(".action-app-reset").click(function() {
			localStorage.clear();
			window.location.reload();
		});
		
		// UI layout
		$("#menu-bar, .ui-layout-center, .ui-layout-east, .ui-layout-south").removeClass("hide");
		core.createLayout();

		// Editor's textarea
		$("#wmd-input, #md-section-helper").css({
			// Apply editor font size
			"font-size": settings.editorFontSize + "px",
			"line-height": Math.round(settings.editorFontSize * (20/14)) + "px"
		});
		
		// Manage tab key
		$("#wmd-input").keydown(function(e) {
		    if(e.keyCode === 9) {
		        var value = $(this).val();
		        var start = this.selectionStart;
		        var end = this.selectionEnd;
		        // IE8 does not support selection attributes
		        if(start === undefined || end === undefined) {
		        	return;
		        }
		        $(this).val(value.substring(0, start) + "\t" + value.substring(end));
		        this.selectionStart = this.selectionEnd = start + 1;
		        e.preventDefault();
		    }
		});

		
		
		$(document).click(function(e) {
			$(".tooltip-template").tooltip('hide');
		});

		// Reset inputs
		$(".action-reset-input").click(function() {
			utils.resetModalInputs();
		});
		
		// Do periodic tasks
		intervalId = window.setInterval(function() {
			utils.updateCurrentTime();
			checkWindowUnique();
			if(isUserActive() === true || viewerMode === true) {
				_.each(periodicCallbacks, function(callback) {
					callback();
				});
				checkOnline();
			}
		}, 1000);
	});

	return core;
});

