// RequireJS configuration
requirejs.config({
	waitSeconds: 0,
	urlArgs: "bust=" + (new Date()).getTime(),
	paths: {
		"jquery": "lib/jquery",
		"underscore": "lib/underscore",
		"jgrowl": "lib/jgrowl",
    },
    shim: {
    	'underscore': {
            exports: '_'
        },
        'lib/Markdown.Extra': ['lib/Markdown.Converter', 'lib/prettify'],
        'lib/Markdown.Editor': ['lib/Markdown.Converter']
    }
});

// Defines the logger object
var logger = {
	debug: function() {},
	log: function() {},
	info: function() {},
	warn: function() {},
	error: function() {}
};
// Use http://.../?console to print logs in the console 
if (location.search.indexOf("console") !== -1) {
	logger = console;
}

// RequireJS entry point. By requiring synchronizer and publisher, we are actually loading all the modules
require([
	"jquery",
	"core",
	"synchronizer",
], function($, core) {
	core.setReady();
});
