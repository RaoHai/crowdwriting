/*global $, document, window, markdown*/
$(function () {
	var fnMain, docId;
	fnMain = function () {
		docId = 0;
		var fnResizeEditor, timer, editor, previewer, mainEditor;
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
	$('#action-save').click(function () {
		$.ajax({
			type: "post",
			url: 'Chapter',
			data: {
				'id' : docId,
				'ChapterTitle' : $('#ChapterTitle').val(),
				'ChapterContent': $('#wmd-input').val()
			},
			success: function (value) {
				if (value.Status === 'OK') {
					docId = value.Id;
					window.setId(docId);
				};
			}
		});
	});
	fnMain();


});