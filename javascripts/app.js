/*global $, document*/
$(function () {
	$(document).foundation();
	$('.avatar').click(function (e) {
		$('.action-dropdown').fadeIn(100);
		e.stopPropagation();

	});
	$('.action-dropdown').click(function (e) {
		e.stopPropagation();
	});
	$(document).click(function () {
		$('.action-dropdown').hide();
	});

});