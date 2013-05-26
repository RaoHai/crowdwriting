/*global $, document, window, markdown*/
$(function () {
	var fnMain, EditorPrototype, _l;

	EditorPrototype  = function (editor, previewer) {
		var $_editor, $_previewer, $_previewerInner, _init, fnResizeEditor, fnParser, fnScrollPreviwer, fnScrollEditor;
		var timer, timerScroll, timerScroll2, lineMapper, domMapper;
		lineMapper = {};
		domMapper = {};
		$_editor = editor;
		$_previewer = previewer;
		$_previewerInner = $_previewer.children('.inner');
		fnParser = function (html) {
			var blocks, block, lineNumber, domToAdd;
			lineMapper = {};
			lineNumber = 0;
			blocks = markdown.split_blocks($_editor.val());
			while (blocks.length) {
				block = blocks.shift();//.toString();
				lineNumber = block.lineNumber;
				domToAdd = markdown.toHTML(block.toString());
				//$_previewerInner.append($(domToAdd);
					var $dom = $(domToAdd);
					$_previewerInner.append($dom);
					if ($dom[0] !== undefined) {
						var pos = $dom[0].offsetTop + $dom.height();
						domMapper[lineNumber] = pos;
						lineMapper[lineNumber] = $dom;
					}
				//console.log(markdown.toHTML(b));
			}

		};
		fnScrollPreviwer = function (obj) {
			var fullDocumentHeight, scrollTop, scrollPercent, previewHeight, lineheightStr, lineheight, editorCurline;
			if ($_previewer.locked) {
				return;
			}
			lineheightStr = $_editor.css('line-height');
			lineheight = parseInt(lineheightStr.substr(0, lineheightStr.length - 2));

			fullDocumentHeight = obj[0].scrollHeight;
			scrollTop  = obj.scrollTop();

			editorCurline = Math.round(scrollTop / lineheight);
			while (lineMapper[editorCurline] === undefined) {
				editorCurline++;
			}
			var e = lineMapper[editorCurline];
			$_previewer[0].scrollTop = e[0].offsetTop;
		};
		fnScrollEditor = function (obj) {
			var fullDocumentHeight, scrollTop, scrollPercent, editorHeight, editorCurline, lineheight, lineheightStr;
			var key;
			if ($_editor.locked) {
				return;
			}
			scrollTop = obj.scrollTop();
			lineheightStr = $_editor.css('line-height');
			lineheight = parseInt(lineheightStr.substr(0, lineheightStr.length - 2));

			for(key in domMapper){
				if (domMapper.hasOwnProperty(key)) {
					if(domMapper[key] >= scrollTop){
						break;
					}
				};
			}
			key = key == 0 ? 1 : key;
			$_editor[0].scrollTop = (key - 1) * lineheight;
		};
		_init = function () {
			fnParser($_editor.val());
			$_editor.scroll(function () {
				fnScrollPreviwer($(this));
				$_editor.locked = true;
				if (timerScroll) {
					clearTimeout(timerScroll);
				}
				timerScroll = setTimeout(function () {
					$_editor.locked = false;
				}, 200);
			});

			$_previewer.scroll(function () {
				fnScrollEditor($(this));
				$_previewer.locked = true;
				if (timerScroll2) {
					clearTimeout(timerScroll2);
				}
				timerScroll2 = setTimeout(function () {
					$_previewer.locked = false;
				}, 200);
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