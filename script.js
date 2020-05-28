(function($) {
    

/* Once page is loaded  */
window.addEventListener("DOMContentLoaded", function(){
   
    $('.none-magic-line').html
    
    $('.related-projects-grid .vc_gitem-animated-block').removeClass('vc_gitem-animate-none');
    $('.related-projects-grid .vc_gitem-animated-block').addClass('vc_gitem-animate-slideTop');
});

/* Prevent click on news single pretty photo / lightbox */
$(document).ready(function() {
	$('.blog-inner .entry-thumbnail_overlay').on('click', function (e) {
    	event.preventDefault();
  	});
});


})( jQuery );