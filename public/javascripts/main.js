// RequireJS configuration
requirejs.config({
	waitSeconds: 0,
	urlArgs: "bust=" + (new Date()).getTime(),
	paths: {
		"jquery": "lib/jquery",
		"underscore": "lib/underscore",
    },
    shim: {
    	'underscore': {
            exports: '_'
        }
    }
});

// Defines the logger object
var logger = {
  debug: function () {},
  log: function () {},
  info: function () {},
  warn: function () {},
  error: function () {}
};
// Use http://.../?console to print logs in the console 
if (location.search.indexOf("console") !== -1) {
  logger = console;
}

// RequireJS entry point. By requiring synchronizer and publisher, we are actually loading all the modules
require([
  "jquery",
  "app"
], function ($, app) {
  function checkLogin() {
    $.ajax({ 
      url : "session",
      timeout : 1000, dataType : "json"
    }).done(function(value) {
      app.onCheckUser(value);
    }); 
  } 

  checkLogin();
});
