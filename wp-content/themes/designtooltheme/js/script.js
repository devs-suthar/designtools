jQuery(function(){

    jQuery('ul.parent-category-list li a').click(function(e){
        e.preventDefault();
        jQuery('ul.parent-category-list li a').removeClass('active');
        jQuery(this).toggleClass('active');
        var anchorval = jQuery(this).attr('data-slug');
        
        jQuery('html, body').animate({
            scrollTop: jQuery( '#' + anchorval).offset().top - 40
        }, 1000);
    });

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