$(function(){

  //SLIDESHOW (PAGINA INICIAL)
	if($('.slideshow').length) {
		$('.slideshow').cycle({
			fx: 'carousel',
			speed: 1000,
			timeout: 1000,
			width: 1000
		});
	}
  
});
