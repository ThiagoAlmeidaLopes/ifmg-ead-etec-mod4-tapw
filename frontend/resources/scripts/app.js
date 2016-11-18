(function ($) {
	
	$( document ).ready(function() {

		$('#menu-top').load('menu-top/menu-top.php');
		
		var path =  window.location.pathname.slice(1);
		
		if (!path) {
			path = 'home';
		}

		path = path.split('/')[0];

		$('#content').load(path + '/' + path + '.php');
	});

})(jQuery);