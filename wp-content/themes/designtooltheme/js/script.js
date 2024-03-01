jQuery(function(){

    jQuery('ul.parent-category-list li a').click(function(e){
        e.preventDefault();
        jQuery('ul.parent-category-list li a').removeClass('active');
        jQuery(this).toggleClass('active');
        var anchorval = jQuery(this).attr('data-slug');
        
        jQuery('html, body').animate({
            scrollTop: jQuery( '#' + anchorval).offset().top - 170
        }, 1000);
    });


    jQuery('.category-plan a').each(function() {
        var plan_val = jQuery(this).find('span.elementor-button-text').text().toLowerCase();
        jQuery(this).addClass(plan_val);
    });


     jQuery('span.category-plan').each(function() {
        var plan_val = jQuery(this).text().toLowerCase();
        jQuery(this).addClass(plan_val);
    });

    jQuery(window).scroll(function(){
        var scroll = jQuery(window).scrollTop();   

        if (scroll >= 200) {
            jQuery('.categorylist-wrap').addClass('sticky');
        } else {
            jQuery('.categorylist-wrap').removeClass('sticky');
        }

        if (scroll >= 200) {
            jQuery(".site-header").addClass('active');
        } else {
            jQuery(".site-header").removeClass('active');
        }

    });
   
});


jQuery(document).ready(function($) {
    
    
    // Define the button and parent div selectors
    var loadMoreButton = '.e-loop__load-more a';
    var parentDiv = '.latest-posts .elementor-widget-container .elementor-grid';

    $.event.special.lengthchange = {
        setup: function() {
            var elem = this,
                prevLength = $(parentDiv).find('.designtool').length;
            $(elem).data('prevLength', prevLength);
            setInterval(function() {
                var length = $(parentDiv).find('.designtool').length;
                if (length !== prevLength) {
                    prevLength = length;
                    $.event.dispatch.call(elem, {type: 'lengthchange'});
                }
            }, 100); 
        }
    };

    // Add a length change event listener
    $(parentDiv).on('lengthchange', function() {
        jQuery('.category-plan a').each(function() {
            var plan_val = jQuery(this).find('span.elementor-button-text').text().toLowerCase();
            jQuery(this).addClass(plan_val);
        });

        $(parentDiv).find('.elementor-grid-item:not(.loaded)').addClass('loaded');
    });

    $(document).on('click', loadMoreButton, function() {
        
        $(parentDiv).trigger('lengthchange');
    });

    function category_posts(){
        var checkedValues = []; // Initialize an empty array to store checked values
        $('ul.category-items .cat-checkbox:checked').each(function() {
            // Push the value of checked checkbox into the array
            checkedValues.push($(this).parents('li').data('id'));
        });
    
        console.log("Checked Values:", checkedValues); // Log the array of checked values
    
        var data = {
            'action': 'filter_posts_by_category',
            'category_id': checkedValues,
            'nonce': ajax_object.nonce
        };
    
        $.post(ajax_object.ajax_url, data, function(response) {
            $('.child-posts-list').html(response); 
        });
    };

    $('ul.category-items .cat-checkbox').change(function() {
        category_posts();
    });

    if ($('.child-posts-list-latest-resource').length > 0) {
        category_posts();
    }

    jQuery('.load-more').click(function(){

        var checkedValues = []; // Initialize an empty array to store checked values
        $('ul.category-items .cat-checkbox:checked').each(function() {
            // Push the value of checked checkbox into the array
            checkedValues.push($(this).parents('li').data('id'));
        });

        var post_offset = jQuery('.child-posts-list-latest-resource').children().length;

        var data = {
            'action': 'filter_posts_by_category',
            'category_id': checkedValues, // Use the already collected category IDs
            'nonce': ajax_object.nonce,
            'offset': post_offset // Send the offset to the backend to fetch more posts
        };
    
        $.post(ajax_object.ajax_url, data, function(response) {
            $('.child-posts-list').append(response); // Append the new posts to the existing list
        });       

    });

});

