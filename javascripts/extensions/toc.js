define([
    "jquery",
    "underscore",
    "utils"
], function($, _, utils) {
	
	var toc = {
		extensionId: "toc",
		extensionName: "Table of content",
        optional: true,
		settingsBloc: '<p>Generates a table of content when a [TOC] marker is found.</p>'
	};
	
	// TOC element description
	function TocElement(tagName, anchor, text) {
		this.tagName = tagName;
		this.anchor = anchor;
		this.text = text;
		this.children = [];
	}
	TocElement.prototype.childrenToString = function() {
		if(this.children.length === 0) {
			return "";
		}
		var result = "<ul>";
		_.each(this.children, function(child) {
			result += child.toString();
		});
		result += "</ul>";
		return result;
	};
	TocElement.prototype.toString = function() {
		var result = "<li>";
		if(this.anchor && this.text) {
			result += '<a href="#' + this.anchor + '">' + this.text + '</a>';
		}
		result += this.childrenToString() + "</li>";
		return result;
	};
	
	// Transform flat list of TocElement into a tree
	function groupTags(array, level) {
		level = level || 1;
		var tagName = "H" + level;
		var result = [];
		
		var currentElement = undefined;
		function pushCurrentElement() {
			if(currentElement !== undefined) {
				if(currentElement.children.length > 0) {
					currentElement.children = groupTags(currentElement.children, level + 1);
				}
				result.push(currentElement);
			}
		}
		
		_.each(array, function(element, index) {
			if(element.tagName != tagName) {
				if(currentElement === undefined) {
					currentElement = new TocElement();
				}
				currentElement.children.push(element);
			}
			else {
				pushCurrentElement();
				currentElement = element;
			}
		});
		pushCurrentElement();
		return result;
	}
	
	// Build the TOC
	function buildToc() {
		var anchorList = {};
		function createAnchor(element) {
			var id = element.prop("id") || utils.slugify(element.text());
			var anchor = id;
			var index = 0;
			while(_.has(anchorList, anchor)) {
				anchor = id + "-" + (++index);
			}
			anchorList[anchor] = true;
			// Update the id of the element
			element.prop("id", anchor);
			return anchor;
		}
			
		var elementList = [];
		$("#wmd-preview > h1," +
				"#wmd-preview > h2," +
				"#wmd-preview > h3," +
				"#wmd-preview > h4," +
				"#wmd-preview > h5," +
				"#wmd-preview > h6").each(function() {
			elementList.push(new TocElement(
				$(this).prop("tagName"),
				createAnchor($(this)),
				$(this).text()
			));
		});
		elementList = groupTags(elementList);
		return '<div class="toc"><ul>' + elementList.toString() + '</ul></div>';
	}
	
	toc.onEditorConfigure = function(editor) {
		// Run TOC generation when conversion is finished directly on HTML
		editor.hooks.chain("onPreviewRefresh", function() {
			var toc = buildToc();
			var html = $("#wmd-preview").html();
			html = html.replace(/<p>\[TOC\]<\/p>/g, toc);
			$("#wmd-preview").html(html);
		});
	};
	
	return toc;
});
	
