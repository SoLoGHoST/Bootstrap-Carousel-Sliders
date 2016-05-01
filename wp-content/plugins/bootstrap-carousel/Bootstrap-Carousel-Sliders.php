<?php
/**
 * Plugin Name: Bootstrap Carousel Sliders
 * Description: Provides ability for Specific Bootstrap Carousel Sliders on post types, archives, tags, and/or taxonomies.  Pull images in from ACF field(s), and/or media attachments.  Adds filters for editing these images manually.
 * Plugin URI: http://gelest.com 
 * Author:      Think it First
 * Author URI: http://thinkitfirst.com
 * Version:     0.0.1
 */




// We'll want to output a list of all post types, taxonomies, 

// We need to build this array as a wp-option:

/*
array(
	'post_types' => array('gelest_application', 'team_member', 'press_release'),
	'taxonomies' => array(
		'press_release' => array('press_release_years')
	),
	'pages' => array('all'),
	'archives' => array('gelest_application'),
	'use_featured_image' => true
);
*/

// Than we'll want to use the template file and pass the array into it, will need to use wp_parse_args perhaps.
/*
tif_get_template('inc/gelest-slider.php')
*/




