/*global $, document, window, markdown*/
$(function () {
	var fnMain, EditorPrototype, _l;
	_l = function (what) {
		console.log(arguments.callee);
	};
	EditorPrototype  = function (editor, previewer) {
		var $_editor, $_previewer, $_previewerInner, _init, fnResizeEditor, timer;
		$_editor = editor;
		$_previewer = previewer;
		$_previewerInner = $_previewer.children('.inner');

		_init = function () {
			$_previewerInner.html(markdown.toHTML($_editor.val()));

			$_editor.bind('keyup', function () {
				$_previewerInner.html(markdown.toHTML($_editor.val()));
			});

			$_editor.scroll(function () {
				var fullDocumentHeight, scrollTop, scrollPercent, previewHeight, lineheightStr, lineheight, editorCurline;
				lineheightStr = $_editor.css('line-height');
				lineheight = parseInt(lineheightStr.substr(0, lineheightStr.length - 2));

				fullDocumentHeight = $(this)[0].scrollHeight;
				scrollTop  = $(this).scrollTop();
				scrollPercent = scrollTop / fullDocumentHeight;
				previewHeight = $_previewerInner.height();

				editorCurline = Math.ceil(scrollTop / lineheight);
				console.log('editorCurline', editorCurline);

				//$_previewer[0].scrollTop = previewHeight * scrollPercent;
			});

		};

		fnResizeEditor = function () {
			var height, editorHeight;
			height = $(window).height();
			editorHeight = height - 150;
			$('#editor').css({'height' : editorHeight});
			$('#preview').css({'height' : editorHeight + 50});
		};

		$(window).resize(function () {
			if (timer) {
				clearTimeout(timer);
			}
			timer = setTimeout(fnResizeEditor, 200);
		});

		fnResizeEditor();
		_init();
		$.extend(this, {


		});
	};
	fnMain = function () {
		var resizeEditor, timer, editor, previewer, mainEditor;
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

		editor = $('#editor');
		previewer = $('#preview');
		mainEditor = new EditorPrototype(editor, previewer);

	};
	fnMain();


});