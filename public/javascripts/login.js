$(function(){
	
	$(window).resize(function () {
		var height = $(window).height();
		if (height < 600) {
			height = 600;
		}
		$(document.body).height(height);
	}).trigger('resize');
	
});