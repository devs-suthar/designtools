jQuery(function(){

    jQuery(window).scroll(function(){
        var scroll = jQuery(window).scrollTop();   
        if (scroll >= 200) {
            jQuery(".site-header").addClass('active');
        } else {
            jQuery(".site-header").removeClass('active');
        }

    });

    var lastScrollTop = 200;
    jQuery(window).scroll(function(event){
        var st = jQuery(this).scrollTop();
           if (st > lastScrollTop){
            jQuery('.site-header').addClass('sc_down');
            jQuery('.site-header').removeClass('sc_up');
           } else {
                jQuery('.site-header').addClass('sc_up');
                jQuery('.site-header').removeClass('sc_down');
           }
           lastScrollTop = st;
       
   });	
    

});