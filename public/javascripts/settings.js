define([
    "underscore",
    "config"
], function(_) { 
	
	var settings = {
		layoutOrientation : "horizontal",
		lazyRendering : true,
		editorFontSize : 14,
		defaultContent: "--<",
		commitMsg : ">--",
		template : [
            '<!DOCTYPE html>\n',
			'<html>\n',
			'<head>\n',
			'<title><%= documentTitle %></title>\n',
			'</head>\n',
			'<body><%= documentHTML %></body>\n',
			'</html>'].join(""),
		extensionSettings: {}
	};
	
	if (_.has(localStorage, "settings")) {
		_.extend(settings, JSON.parse(localStorage.settings));
	}
	
	return settings;
});