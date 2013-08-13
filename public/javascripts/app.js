/*global $, document, window, markdown*/
define([
	"jquery",
	"underscore"
], function ($, _) {
	var fnMain, fnInitNotice, docId, fnEvents;

	var $templates = $('.template');
	var templates = {};

	_.each($templates, function(template) {
		var $key = $(template).attr('data-template');
		var context = $(template).find('script');
		console.log(context);
		templates[$key] = {
			dom : $(template),
			template : $(context).html()
		}
	});
	var _t = function (name, data) {
		var compile =  _.template(templates[name].template);
		templates[name].dom.html(compile(data));
		templates[name].dom.removeClass('template');
	};

	var app = {
		onCheckUser : function (user) {
			if (user === 0) {
				_t('logined', {"login" : false});	
				$('.avatar').attr('href','login');

			} else {
				_t('logined', {"login" : true});	
				_t('logined-drop')
			}
		}
	};

	var notice = function (msg, className) {
		className = className ? className : 'normal';
		$('<li />').addClass(className).html(msg).appendTo($('.notice ul'));
	};

	//localStorage.clear();

	//fileMgr = window.fileMgr;
	fnMain = function () {
		docId = 0;
		var fnResizeEditor, timer, editor, previewer, mainEditor, saveAction;
		fnResizeEditor = function () {
			var height, editorHeight;
			height = $(window).height();
			editorHeight = height - 160;
			$('#wmd-input').css({
				'height': editorHeight
			});
			$('#wmd-preview').css({
				'height': editorHeight + 46
			});
		};
		$(window).resize(function () {
			if (timer) {
				clearTimeout(timer);
			}
			timer = setTimeout(fnResizeEditor, 200);
		});

		fnResizeEditor();
		fnEvents();
		$(document).foundation();
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

	};
	fnEvents = function () {
		$(document).bind('keydown', function(e) {
  			if(e.ctrlKey && (e.which == 83)) {
			    saveAction($('#action-save'));
			    event.preventDefault();
			    return false;
			}
		});
	};
	$('#action-style').click(function () {
		$(document.body).toggleClass('fullwidth');
	});
	$('#action-new').click(function () {
		
	});
	$('#action-save').click(function() {
		saveAction($(this));
	});
	saveAction = function ($this) {
		var $Id, $type;
		$this.html('<i class="icon-spinner icon-spin" />');
		if ($('#wmd-input').attr('data-id')) {
			$Id = $('#wmd-input').attr('data-id');
			$type = "put";
		} else {
			$Id = 0;
			$type = "post";
		}

		$.ajax({
			type: $type,
			url: 'Chapter',
			data: {
				'id' : $Id,
				'ChapterTitle' : $('#ChapterTitle').val(),
				'ChapterContent': $('#wmd-input').val(),
			},
			success: function (value) {
					docId = value.id;
					fileMgr.setUpdateTime(value.UpdateTime);
					fileMgr.setId(docId);
					$('#wmd-input').attr('data-id', docId);
					$this.html('<i class="icon-ok"></i>');
			}
		});
	};

	fnMain();

	return app;

});