<?php

/* Template Name: Latest Resources Template */
/**
 * The template for displaying taxonomy items
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();

?>

<div class="banner-top banner-bg">
    <div class="container">
        <div class="page-title">
            <h1>
                <?php echo get_the_title(); ?>
            </h1>
        </div>

        <div class="filter-categories">
            
            <p>Filter by Category</p>
            <ul class="category-items">
            <?php 
                    $parent_categories = get_terms( array(
                        'taxonomy' => 'designtools_category', 
                        'parent' => 0, // Retrieve only parent categories
                        'orderby' => 'term_id', // Order by term ID
                        'order' => 'DESC',
                    ) );

                    if ( ! empty( $parent_categories ) && ! is_wp_error( $parent_categories ) ) {
                       
                        foreach ($parent_categories as $category) {
                            $category_name = esc_html($category->name);
                        ?>
                            <li data-id="<?php echo $category->term_id ?>">
                                <input class="cat-checkbox" type="checkbox" id="<?php echo esc_attr($category->slug) ?>">
                                <label class="cat-label" for="<?php echo esc_attr($category->slug) ?>"><?php echo esc_html($category_name) ?></label>
                            </li>
                        <?php
                        }
                        
                    } 

                ?>
            
            </ul>
        </div>
    </div>
</div>

<div class="category-posts">
    <div class="container">
        <div class="posts-wrapper">
            <ul class="child-posts-list child-posts-list-latest-resource">
                   
            </ul>
        </div>
        <button class="load-more text-center">Show More</button>
    </div>
</div>


<?php
get_footer();

?>