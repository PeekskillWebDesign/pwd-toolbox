jQuery(document).ready(function(){
	active = jQuery('.menu-link.is-active').attr('name');
	loc = getURLParameter('loc');
	if(getURLParameter('loc') != active && getURLParameter('loc')) {
		jQuery('.is-active').removeClass('is-active');
		jQuery('.menu-link[name="'+loc+'"').addClass('is-active');
		jQuery('.is-visible').fadeOut().removeClass('is-visible');
		jQuery('#' + loc).fadeIn().addClass('is-visible');
	}

	jQuery('.menu-link').on('click', function(e){
		e.preventDefault();
		nav_this = jQuery(this);
		if(!nav_this.hasClass('.is-active')){
			jQuery('.is-active').removeClass('is-active');
			nav_this.addClass('is-active');
			var tar = nav_this.attr('name');
			jQuery('.is-visible').fadeOut().removeClass('is-visible');
			jQuery('#' + tar).fadeIn().addClass('is-visible');
			changeUrlParam('loc' , tar);
		}

	});
	function getURLParameter(name) {
        return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null;
    }

function changeUrlParam (param, value) {
        var currentURL = window.location.href+'&';
        var change = new RegExp('('+param+')=(.*)&', 'g');
        var newURL = currentURL.replace(change, '$1='+value+'&');

        if (getURLParameter(param) !== null){
            try {
                window.history.replaceState('', '', newURL.slice(0, - 1) );
            } catch (e) {
                console.log(e);
            }
        } else {
            var currURL = window.location.href;
            if (currURL.indexOf("?") !== -1){
                window.history.replaceState('', '', currentURL.slice(0, - 1) + '&' + param + '=' + value);
            } else {
                window.history.replaceState('', '', currentURL.slice(0, - 1) + '?' + param + '=' + value);
            }
        }
    }

});