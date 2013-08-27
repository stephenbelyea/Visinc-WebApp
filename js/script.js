$(document).ready(function(){
	$imgInfo = $('.img-info');
	$btnLink = $('.img-btns .btn-info a');
	open = 'open';
	$btnLink.click(function(e){		
		if( $imgInfo.hasClass(open) ){
			$imgInfo.removeClass(open);
		}
		else{
			$imgInfo.addClass(open);
		}
		e.preventDefault();
	});
});