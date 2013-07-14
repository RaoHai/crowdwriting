/*global $, document, window, markdown*/
$(function () {
	var fnMain, docId;
	//fileMgr = window.fileMgr;
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
		var $Id, $type;
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
				console.log(value);
				//if (value.Status === 'OK') {
					docId = value.Id;
					fileMgr.setUpdateTime(value.UpdateTime);
					fileMgr.setId(docId);
					$('#wmd-input').attr('data-id', docId);
				//};
			}
		});
	});
	fnMain();


});