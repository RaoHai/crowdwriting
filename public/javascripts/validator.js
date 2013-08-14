/*global window*/
(function (exports) {

  var Validator = exports.Validator = function () {};

  Validator.prototype.check = function (str) {
    this.str = str;
    this.errors = [];
    return this;
  };

  Validator.prototype.error = function (error) {
    this.errors.unshift(error);
  };

  Validator.prototype.getErrors = function () {
    return this.errors;
  };


  //validators
  Validator.prototype.isEmail = function () {
    if (!this.str.match(/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/)) {
      return this.error(this.msg || 'Invalid email');
    }
    return this;
  }

  Validator.prototype.notNull = function () {
    if (this.str === '') {
      return this.error(this.msg || 'String is empty');
    }
    return this;
  };



})(typeof (exports) === 'undefined' ? window : exports);