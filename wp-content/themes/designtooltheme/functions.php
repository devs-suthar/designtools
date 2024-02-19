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
    'rewrite' => array( 'slug' => 'designtools_category' ),
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

?>



