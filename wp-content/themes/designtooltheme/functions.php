 <?php
/**
 * designtooltheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package designtooltheme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function designtooltheme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on designtooltheme, use a find and replace
		* to change 'designtooltheme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'designtooltheme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'designtooltheme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'designtooltheme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'designtooltheme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function designtooltheme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'designtooltheme_content_width', 640 );
}
add_action( 'after_setup_theme', 'designtooltheme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function designtooltheme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'designtooltheme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'designtooltheme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'designtooltheme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function designtooltheme_scripts() {
	wp_enqueue_style( 'designtooltheme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'designtooltheme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'designtooltheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'designtool-script', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), _S_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'designtooltheme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


function designtools_post_type() {
  
	register_post_type( 'designtool',
		array(
			'labels' => array(
				'name' => __( 'Design Tools' ),
				'singular_name' => __( 'Design Tool' )
			),
			'public' => true,
			'has_archive' => true,
			'menu_icon' => 'dashicons-admin-tools',
			'supports' => array('title','editor','thumbnail','excerpt'),
			'rewrite'   => array( 'slug' => 'designtool' ),
			'show_in_rest' => true,
			'taxonomies' => ['designtool_categories'],
		)
	);
  }
  add_action( 'init', 'designtools_post_type' );


// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'designtool_taxonomy', 0 );
//create a custom taxonomy name it "type" for your posts
function designtool_taxonomy() {
  $labels = array(
    'name' => _x( 'Designtools category', 'taxonomy general name'),  //for title bar
    'singular_name' => _x( 'Designtool Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Designtools category' ),
    'all_items' => __( 'All Designtool categories' ),
    'parent_item' => __( 'Parent Designtool Category' ),
    'parent_item_colon' => __( 'Parent Designtool Category:' ),
    'edit_item' => __( 'Edit Designtool' ), 
    'update_item' => __( 'Update Designtool' ),
    'add_new_item' => __( 'Add New Designtool' ),
    'new_item_name' => __( 'New Designtool Name' ),
    'menu_name' => __( 'Designtool Category' ), //Dashboard menu column title
  );     

  register_taxonomy('designtools_category',array('designtool'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categories' ),
  ));
}	


function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml'; 
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types'); 

define('ALLOW_UNFILTERED_UPLOADS', true);

function list_parent_categories_shortcode() { 
    // Retrieve parent categories
    $parent_categories = get_terms( array(
        'taxonomy' => 'designtools_category', 
        'parent' => 0, // Retrieve only parent categories
		'orderby' => 'term_id', // Order by term ID
    	'order' => 'DESC',
    ) );

    // Initialize output variable
    $output = '';

    // Check if parent categories are found
    if ( ! empty( $parent_categories ) && ! is_wp_error( $parent_categories ) ) {

		
        // Start output
        $output .= '<div class="list-parent-categories">';

        // Loop through parent categories
        foreach ( $parent_categories as $category ) {

			$design_field_color = get_field('design_field_color', 'category_' . $category->term_id);
			$design_tool_image = get_field('design_tool_image', 'category_' . $category->term_id);
			$category_title_color = get_field('category_text_color', 'category_' . $category->term_id);
			$category_name = esc_html( $category->name );
					
            $output .= '<div class="icon-box parent-category" style="background-color:' . esc_attr($design_field_color) . ';"><a href='. esc_url( get_term_link( $category ) ) .'>';

				$output .= '<img src="' . esc_url($design_tool_image) . '" alt="' . esc_attr($design_tool_image) . '">';
				$output .= '<h5 style="color:' . esc_attr($category_title_color) . ';">' . esc_attr($category_name) . '</h5>';
            
            $output .= '</a></div>';
        }

		

        // End output
        $output .= '</div>';
    } else {
        // Return message if no parent categories found
        $output = '<div class="list-parent-categories">No parent categories found.</div>';
    }

    // Return escaped output
    return $output;
}
add_shortcode( 'list_parent_categories_function', 'list_parent_categories_shortcode' );

function list_parent_categories_shortcode_list() { 
    $parent_category = get_queried_object();
    $category_list = ''; // For category list
    $post_output = ''; // For post list
	$output = '';

    $children_categories = get_terms( array(
        'taxonomy' => 'designtools_category', 
        'parent' => $parent_category-> term_id, 
		
    ) );

    
    if ( ! empty( $children_categories ) && ! is_wp_error( $children_categories ) ) {
        
		$category_list .= '<div class="category-list-wrapper">';
		$post_output .= '<div class="child-posts-container">';
		$category_list .= '<h1 class="parent-category-title"> ' . esc_html($parent_category->name) . ' Websites</h1>';
		$category_list .= '<div class="categorylist-wrap">';
		$category_list .= '<ul class="parent-category-list">';
        foreach ($children_categories as $child_category) {
			$category_list .= '<li><a data-slug="'.esc_attr($child_category->slug).'" href="#' .esc_attr($child_category->slug) .'">' . esc_html($child_category->name) . '</a></li>';	

			$child_posts = get_posts(array(
				'posts_per_page' => -1, 
				'post_type' => 'designtool',
				'tax_query' => array(
					array(
						'taxonomy' => 'designtools_category',
						'field' => 'term_id',
						'terms' => $child_category->term_id,
					),
				),
			));
		
			// Display list of posts for current child category
			if (!empty($child_posts)) {
				$post_output .= '<div class="child-posts-wrapper" data-slug="'.esc_attr($child_category->slug).'">';
				$post_output .= '<h2 id="' .esc_attr($child_category->slug) .'">' . esc_html($child_category->name) . '</h2>'; // child category name 
				$post_output .= '<ul class="child-posts-list">';
				
				foreach ($child_posts as $post) {
					$third_party_url = get_field('third_party_url', $post->ID); // Third-party URL custom field
					$category_post_icon = get_field('category_post_icon', $post->ID); // ACF image field
					$post_output .= '<li class="single-post-item"><a href="' . esc_url($third_party_url) . '" target="_blank">';
					
					$post_output .= '<div class="post-img"><img src="' . esc_url(get_the_post_thumbnail_url($post, 'full')) . '" alt="' . esc_attr($post->post_title) . '"></div>'; // Featured image
					$post_output .= '<div class="content">';
					$post_output .= '<h3>' . esc_html($post->post_title) . '</h3>';
					$post_output .= '<p>' . esc_html(get_the_excerpt($post)) . '</p>'; // Post excerpt
					$plan_values = get_field('designtool_categoryplan', $post->ID); // ACF field value
					
					
					if ($plan_values || $category_post_icon) {
						$post_output .= '<div class="d-flex">';
						$post_output .= '<img src="' . esc_url($category_post_icon['url']) . '" alt="' . esc_attr($category_post_icon['alt']) . '" style="margin-right: 8px;">';
						if (!empty($plan_values)) {
							$post_output .= '<span class="category-plan">' . esc_html($plan_values) . '</span>';
						}
						$post_output .= '</div>';
					}
					$post_output .= '</div>';
					
					$post_output .= '</a></li>';
				}
				$post_output .= '</ul>';
				$post_output .= '</div>';
				$post_output .= '</div>';
			}
		}	
		$category_list .= '</ul>';	// category-title
		$post_output .= '</div>'; // child-posts-container
		$category_list .= '</div>';	 // category-list-wrapper
		
    } else {
        $category_list .= '<div class="parent-category">';
        $category_list .= '<h1 class="parent-category-title"> ' . esc_html($parent_category->name) . ' Websites</h1>';
        $category_list .= '<p class="not-found">Not found any categories!</p>';
        $category_list .= '</div>';
    }

	$output .='<div class="main-container">'; // Main page container
    $output .= $category_list . $post_output;
	$output .='</div>';

    return $output;
}

add_shortcode( 'design_tools_categories_list', 'list_parent_categories_shortcode_list' );


add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
    
    foreach( $items as &$item ) {
        
        $menu_image = get_field('menu_icon', $item);
		$url = $menu_image['url'];
		$alt = $menu_image['alt'];
        
        // append icon
        if( $menu_image ) {

            $image_html = '<img src="' . esc_url($url) . '" alt="' . esc_attr($alt) . '" />';

            $item->title = $image_html . $item->title;
            
        }
        
    }
    
    return $items;
    
}


function filter_categories_shortcode() { 
	
    // Retrieve parent categories

}
add_shortcode( 'filter_categories_list', 'filter_categories_shortcode' );


function enqueue_custom_scripts() {

    // Localize the script with the AJAX URL and nonce
    wp_localize_script('designtool-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('filter_posts_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


add_action('wp_ajax_filter_posts_by_category', 'filter_posts_by_category');
add_action('wp_ajax_nopriv_filter_posts_by_category', 'filter_posts_by_category');

function filter_posts_by_category() {
    // Verify the nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'filter_posts_nonce')) {
        die('Permission denied');
    }

    // Get the category IDs from the AJAX request
    $category_ids = isset($_POST['category_id']) ? $_POST['category_id'] : array();
	$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0; // Get the offset value from the POST data

    // Query posts based on the provided category IDs or retrieve default posts
    if (!empty($category_ids)) {
        $category_posts = new WP_Query(array(
            'post_type' => 'designtool', // Adjust post type if needed
            'posts_per_page' => -1,
			'offset' => $offset,
            'tax_query' => array(
                array(
                    'taxonomy' => 'designtools_category',
                    'field' => 'term_id',
                    'terms' => $category_ids,
                    'operator' => 'IN' // Retrieve posts that belong to any of the provided categories
                )
            )
        ));
    } else {
        // No category selected, retrieve default posts of the parent category
        $category_posts = new WP_Query(array(
            'post_type' => 'designtool', // Adjust post type if needed
            'posts_per_page' => 12, // Default number of posts to retrieve,
			'offset' => $offset
        ));
    }

    // Output the posts
    $output = ''; // Initialize the output variable
    if ($category_posts->have_posts()) {
        while ($category_posts->have_posts()) {
            $category_posts->the_post();
			$plan_values = get_field('designtool_categoryplan', $category_posts->ID); // ACF field value
			$slug = preg_replace('/[^A-Za-z0-9\s]/', '', $plan_values);
			$title =  $slug;
			$attr_plan = strtolower(str_replace(' ', '', $title));

            // Concatenate the HTML structure for each post to the $output variable
            $output .= '<li class="single-post-item">';
            $output .= '<a href="' . esc_url(get_permalink()) . '" target="_blank">';
            $output .= '<div class="post-img">';

			
            
            // Check if the post has a featured image
            if (has_post_thumbnail()) {
                $output .= get_the_post_thumbnail(null, 'full');
				$category_post_icon = get_field('category_post_icon', $category_posts->ID); // ACF image field
				
            } else {
                // Output a placeholder image if no featured image is found
                $output .= '<img src="' . esc_url(get_template_directory_uri() . '/images/placeholder.jpg') . '" alt="Placeholder Image">';
            }

            $output .= '</div>';
            $output .= '<div class="content">';
            $output .= '<h3>' . esc_html(get_the_title()) . '</h3>';
            $output .= '<p>' . esc_html(get_the_excerpt()) . '</p>';
            $output .= '<div class="d-flex">';
            $output .= '<img src="' . esc_url($category_post_icon['url']) . '" alt="' . esc_attr($category_post_icon['alt']) . '" style="margin-right: 8px;">';
            $output .= '<span class="category-plan ' . esc_attr($attr_plan) . '">' . esc_html($plan_values) . '</span>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</a>';
            $output .= '</li>';
        }
        wp_reset_postdata(); // Reset posdatat 
    } else {
        // No posts found
        $output = '<li>No posts found</li>';
    }

    // Output the concatenated HTML
    echo $output;

    // Always die after echoing JSON data
    wp_die();
}

?>



