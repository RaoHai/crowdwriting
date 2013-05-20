/*global $, document*/
$(function () {
	var resizeEditor, timer;
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
	resizeEditor = function () {
		var height, editorHeight;
		height = $(window).height();
		editorHeight = height - 150;
		$('#editor').css({'height' : editorHeight});
	};
	$(document).ready(function () {
		resizeEditor()
	});
	$(window).resize(function () {
		console.log(timer);
		if (timer) {
			clearTimeout(timer);
		}
			timer = setTimeout(resizeEditor,200);
	});

});