define([
  "jquery",
  "underscore"
], function ($, _) {
  var category = window.Category;
  var $ul = $('.top-bar-section ul.left');

  var categoryName = '.' + category.toLowerCase();

  $ul.find(categoryName).addClass('active');

  if ($.inArray(category, ['Index', 'Write']) == -1) {
    $('li.actions').hide();
  };


  var $templates = $('.template');
  var templates = {};

  _.each($templates, function (template) {
    var $key = $(template).attr('data-template');
    var context = $(template).find('script');
    console.log(context);
    templates[$key] = {
      dom: $(template),
      template: $(context).html()
    }
  });

  var _t = function (name, data) {
    console.log('t');
    var compile = _.template(templates[name].template);
    templates[name].dom.html(compile(data));
    templates[name].dom.removeClass('template');
  };
  $('.avatar').click(function (e) {
      $('.action-dropdown').fadeToggle(100);
      e.stopPropagation();
    });

    $('.action-dropdown').click(function (e) {
      e.stopPropagation();
    });

    $(document).click(function () {
      $('.action-dropdown').hide();
    });
    
  var app = {
    onCheckUser: function (user) {
      if (user === 0) {
        _t('logined', {
          "login": false
        });
        $('.avatar').attr('href', 'login');

      } else {
        _t('logined', {
          "login": true
        });
        _t('logined-drop')
      }
    }
  };

  return app;

});