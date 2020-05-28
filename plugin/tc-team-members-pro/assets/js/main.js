jQuery( document ).ready(function() {

jQuery(function(){

	jQuery('.tc_pu_box').magnificPopup({

type:'inline',
midClick: true,
gallery:{
	enabled:true
},
delegate: 'a.tc_pu_views',
removalDelay: 500, //delay removal by X to allow out-animation
callbacks: {
    beforeOpen: function() {
       this.st.mainClass = this.st.el.attr('data-effect');
    }
},
  closeOnContentClick: false,

	});

});

}); // end document.ready
