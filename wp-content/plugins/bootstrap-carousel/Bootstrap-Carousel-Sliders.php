<?php
/**
 * Plugin Name: Bootstrap Carousel Sliders
 * Description: Provides ability for Specific Bootstrap Carousel Sliders on post types, archives, tags, and/or taxonomies.  Pull images in from ACF field(s), and/or media attachments.  Adds filters for editing these images manually.
 * Plugin URI: http://thinkitfirst.com
 * Author:     Solomon Closson
 * Author URI: http://thinkitfirst.com
 * Version:     0.1.0
 */

load_plugin_textdomain('bssliders', false, basename( dirname( __FILE__ ) ) . '/languages' );

// plugin_dir_url( __FILE__ ).'icons/my_icon.png'

if (is_admin())
{
	add_action('admin_menu', 'bs_carousel_menu');
	add_action('admin_init', 'bs_register_settings');
}

function bs_carousel_menu() {
    add_menu_page (
        'Bootstrap Carousel Sliders Settings',
        'BS Carousel Sliders',
        'manage_options',
        'bootstrap-carousel/admin.php',
        '',
        'dashicons-format-gallery',
        '10'
    );
}

function bs_register_settings() {
	register_setting('bs-settings-group', 'bs_posttypes');
	register_setting('bs-settings-group', 'bs_pages_all');
	register_setting('bs-settings-group', 'bs_pages');
	register_setting('bs-settings-group', 'bs_archives');
	register_setting('bs-settings-group', 'bs_taxonomies_all');
	register_setting('bs-settings-group', 'bs_taxonomies');
	register_setting('bs-settings-group', 'bs_featured_image');

	if (class_exists('acf'))
		register_setting('bs-settings-group', 'bs_acf_field_slug');
}

// Make sure to include Bootstrap, js, and/or css plugin files with wp_enqueue_script and wp_enqueue_styles respectively!



// We'll want to output a list of all post types, taxonomies, 

// We need to build this array as a wp-option:

/*
array(
	'post_types' => array('gelest_application', 'team_member', 'press_release'), // post types
	'taxonomies' => array(
		'press_release' => array('press_release_years') // post types and taxonomies/terms
	),
	'pages' => array('all'), // all page slugs
	'archives' => array('gelest_application'), post types that have archives ability
	'use_featured_image' => true // if use_featured_image, checkbox setting!
);
*/

// Than we'll want to use the template file and pass the array into it, will need to use wp_parse_args perhaps.
/*
tif_get_template('inc/gelest-slider.php')
*/




