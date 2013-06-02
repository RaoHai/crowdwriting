/*global $, document, window, markdown*/

$(function () {
	var fnMain, Storage;
	Storage = function () {
		var storages, storageCategory;
		if (window.localStorage) {
			storages = window.localStorage;
			storageCategory = "localStorage";
		} else {
			sotrage = document.cookie;
		}


		$.extend(this,{
			save : function (key, value) {

			},
			load : function (key) {

			}
		});
	};
	fnMain = function () {
		var resizeEditor, timer, editor, previewer, mainEditor;
		fnResizeEditor = function () {
			var height, editorHeight;
			height = $(window).height();
			editorHeight = height - 160;
			$('#wmd-input').css({'height' : editorHeight});
			$('#wmd-preview').css({'height' : editorHeight + 46});
		};

		$(window).resize(function () {
			if (timer) {
				clearTimeout(timer);
			}
			timer = setTimeout(fnResizeEditor, 200);
		});

		fnResizeEditor();
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
	fnMain();


});