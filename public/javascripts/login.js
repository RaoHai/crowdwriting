$(function(){
	
	$(window).resize(function () {
		var height = $(window).height();
		if (height < 600) {
			height = 600;
		}
		$(document.body).height(height);
	}).trigger('resize');
	
	function shake(o){
		var $panel = o;
		for(var i=1; 4>=i; i++){
			$panel.animate({'margin-left':-(20-5*i)},50);
			$panel.animate({'margin-left':2*(20-5*i)},50);
		}
	}
	if ($('.login-panel').attr('data-error')!== null) {
		shake($('.login-panel'));
	};

});