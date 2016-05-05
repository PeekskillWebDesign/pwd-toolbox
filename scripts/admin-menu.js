jQuery(document).ready(function(){
	jQuery('.menu-link').on('click', function(e){
		e.preventDefault();
		nav_this = jQuery(this);
		if(!nav_this.hasClass('.is-active')){
			jQuery('.is-active').removeClass('is-active');
			nav_this.addClass('is-active');
			var tar = nav_this.attr('name');
			jQuery('.is-visible').fadeOut().removeClass('is-visible');
			jQuery('#' + tar).fadeIn().addClass('is-visible');
		}

	});

});