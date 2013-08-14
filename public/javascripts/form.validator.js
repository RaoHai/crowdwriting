/*global $*/
$(function () {

  var error = function (input, errorArray) {
    if (errorArray.length > 0) {
      input.addClass('error invalid');
    } else {
      input.removeClass('error invalid');
    }
  };

  var check = function (input) {

    var _this = input;

    return function () {
      var value, fnc, errorArray, i, fn, patt;
      var validator = new Validator();

      patt = /\w+(\(.*\))?/g;
      fnc = _this.attr('data-validator').match(patt);

      if (_this.val() !== _this.attr('data-default-value')) {
        _this.addClass('dirty');
      } else {
        _this.removeClass('dirty');
      }
      value = _this.val();
      for (i = fnc.length - 1; i >= 0; i--) {
        var fnName, fnParam;
        fn = fnc[i];
        fnName = fn;
        fnParam = null;
        if (fn.indexOf("(") > 0) {
          fnName = fn.substr(0, fn.indexOf("("));
          fnParam = fn.substring(fn.indexOf("(") + 1, fn.lastIndexOf(")")).split(",");
        }

        var _callee = validator.check(value);
        var func = _callee[fnName];
        var args = fnParam;
        if (args) {
          func.apply(_callee, Array.prototype.slice.call(fnParam));
        } else {
          validator.check(value)[fnName]();
        }
      }

      errorArray = validator.getErrors();
      error(_this, errorArray);
      if (errorArray.length > 0) {
        return false;
      } else {
        return true;
      }

    };
  };


  $.each($('form.validate'), function (idx, form) {
    $.each($(form).find('input'), function (idx, item) {

      var _this = $(this);

      if (_this.attr('data-validator') !== null) {
        _this.attr('data-default-value', _this.val());
        _this.addClass('invalid');
        _this.on('change', check(_this));
      }


    });
    $(form).submit(function () {
      var inputs = $(this).find('input');
      inputs.each(function (i, item) {
        if ($(this).attr('data-validator') !== null) {
          var fn = check($(this));
          fn();
        }
      });
      if ($(this).find('.invalid').length === 0) {
        $('#password').val(Base64.encode($('#password').val()));
        return true;
      }
      $('form .invalid').first()[0].scrollIntoView();
      return false;

    });
  });

});