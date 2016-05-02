<?php
/**********************************************

	Filename: admin.php
	-------------------


**********************************************/

if (!defined('ABSPATH')) exit(0);

if (!current_user_can('manage_options'))  {
	wp_die(__('You do not have sufficient permissions to access this page.'));
} ?>

<div class="wrap">
<h2>Bootstrap Carousel Sliders</h2>
<p class="description">Select the Post Types, Pages, Taxonomies, and other settings where you want to allow for custom Bootstrap Carousel Sliders.</p>

<form method="post" action="options.php">
<?php
	$archive_posttypes = $taxonomies = array();
	settings_fields('bs-settings-group');
	do_settings_sections('bs-settings-group');

	$selected_posttypes = get_option('bs_posttypes');
	$selected_pages = get_option('bs_pages');
	$selected_pages = !empty($selected_pages) ? $selected_pages : array();
	$selected_archives = get_option('bs_archives');
	$selected_archives = !empty($selected_archives) ? $selected_archives : array();
	$selected_featured_image = get_option('bs_featured_image', 0);
	$selected_pages_all = get_option('bs_pages_all', 0);
	$selected_taxonomies_all = get_option('bs_taxonomies_all');
	$selected_taxonomies_all = !empty($selected_taxonomies_all) ? $selected_taxonomies_all : array();
	$selected_taxonomies = get_option('bs_taxonomies');
	$selected_taxonomies = !empty($selected_taxonomies) ? $selected_taxonomies : array();

	$posttypes = get_post_types(array('publicly_queryable' => true), 'objects');
	// $taxonomies = get_taxonomies(array('public' => true), 'objects');

	if (isset($posttypes['attachment']))
		unset($posttypes['attachment']);

	// Get all post types that have archives, using get_post_type_archive_link to determine if has_archive!
	foreach($posttypes as $slug => $post_type)
	{
		$archive_link = get_post_type_archive_link($slug);
		if (!empty($archive_link))
			$archive_posttypes[$slug] = $post_type->labels->name;

		if (!isset($taxonomies[$slug]))
			$taxonomies[$slug] = array(
				'post_name' => $post_type->labels->name,
				'taxonomies' => get_object_taxonomies($slug, 'objects')
			);
	}
	echo '<h2>bs_posttypes</h2><pre>', var_dump($selected_posttypes), '</pre>';
	echo '<h2>bs_archives</h2><pre>', var_dump($selected_archives), '</pre>';
	echo '<h2>bs_pages_all</h2><pre>', var_dump($selected_pages_all), '</pre>';
	echo '<h2>bs_pages</h2><pre>', var_dump($selected_pages), '</pre>';
	echo '<h2>bs_taxonomies_all</h2><pre>', var_dump($selected_taxonomies_all), '</pre>';
	echo '<h2>bs_taxonomies</h2><pre>', var_dump($selected_taxonomies), '</pre>';
	echo '<h2>bs_featured_image</h2><pre>', var_dump($selected_featured_image), '</pre>';
	echo '<h2>bs_acf_field_slug</h2><pre>', var_dump(get_option('bs_acf_field_slug', '')), '</pre>';
?>

	<table class="form-table">
	    <tr valign="top">
	    	<th scope="row">Post Types</th>
		    <td>
		    	<?php
		    	$i = 0;
		    	foreach($posttypes as $slug => $post_type): ?>
		    	<p>
			    	<input id="bs_posttypes<?php echo $i; ?>" type="checkbox" name="bs_posttypes[]" value="<?php echo $slug; ?>" <?php checked(in_array($slug, $selected_posttypes), 1, true); ?>/>
			    	<label for="bs_posttypes<?php echo $i; ?>"><?php echo $post_type->labels->name; ?></label>
			    </p>
				<?php $i++; endforeach; ?>
		    </td>
	    </tr>
	    <tr valign="top">
	    	<th scope="row">Post Type Archives</th>
	    	<td>
	    		<?php $i = 0;
	    		foreach($archive_posttypes as $slug => $post_type_name): ?>
	    		<p>
			    	<input id="bs_archives<?php echo $i; ?>" type="checkbox" name="bs_archives[]" value="<?php echo $slug; ?>" <?php checked(in_array($slug, $selected_archives), 1, true); ?>/>
			    	<label for="bs_archives<?php echo $i; ?>"><?php echo $post_type_name ?></label>
			    </p>
	    		<?php $i++; endforeach; ?>
	    	</td>
	    </tr>
	    <tr valign="top">
	    	<th scope="row">Pages</th>
	    	<td>
	    		<p>
			    	<input id="bs_pages_all" type="checkbox" name="bs_pages_all" value="1" <?php checked($selected_pages_all, 1, true); ?>/>
			    	<label for="bs_pages_all"><strong>All Pages</strong></label>
			    </p>
			    <?php 
			    	$pages = get_pages();
			    	foreach($pages as $key => $page): ?>
			    	<p>
				    	<input id="bs_pages<?php echo $key; ?>" type="checkbox" name="bs_pages[]" value="<?php echo $page->post_name; ?>" <?php checked(in_array($page->post_name, $selected_pages), 1, true); ?>/>
				    	<label for="bs_pages<?php echo $key; ?>"><?php echo $page->post_title; ?></label>
				    </p>
			    <?php endforeach; ?>
	    	</td>
	    </tr>
	    <tr valign="top">
	    	<th scope="row">Taxonomies</th>
	    	<td>
	    		<?php $i = 0;
	    			foreach($taxonomies as $post_slug => $taxonomy_post_type): ?>
	    			<p><strong><?php echo $taxonomy_post_type['post_name']; ?></strong></p>
		    		<p>
				    	<input id="bs_taxonomies_all<?php echo $i; ?>" type="checkbox" name="bs_taxonomies_all[]" value="<?php echo $post_slug; ?>" <?php checked(in_array($post_slug, $selected_taxonomies_all), 1, true); ?>/>
				    	<label for="bs_taxonomies_all<?php echo $i; ?>"><strong>All Taxonomies</strong></label>
				    </p>
				    <?php 
				    	$k = 0;
				    	foreach($taxonomy_post_type['taxonomies'] as $tax_slug => $taxonomy): ?>
				    	<p>
					    	<input id="bs_taxonomies<?php echo $i . '_' . $k; ?>" type="checkbox" name="bs_taxonomies[<?php echo $post_slug; ?>][]" value="<?php echo $tax_slug; ?>" <?php checked(in_array($tax_slug, $selected_taxonomies[$post_slug]), 1, true); ?>/>
					    	<label for="bs_pages<?php echo $i . '_' . $k; ?>"><?php echo $taxonomy->labels->name; ?></label>
				    	</p>
				    <?php $k++; endforeach; ?>

				<?php $i++; endforeach; ?>
	    	</td>
	    </tr>

	    <tr valign="top">
	    	<th scope="row">Allow Featured Images?</th>
	    	<td>
	    		<p>
			    	<input type="checkbox" name="bs_featured_image" value="1" <?php checked($selected_featured_image, 1, true); ?>/>
			    </p>
	    	</td>
	    </tr>
	    <?php if (class_exists('acf')): ?>
	    <tr valign="top">
	    	<th scope="row">ACF Field:</th>
	    	<td>
	    		<input type="text" name="bs_acf_field_slug" class="regular-text" value="<?php echo get_option('bs_acf_field_slug', ''); ?>" size="20" />
	    		<p class="description">Input the ACF Field slug for the repeater field or image field that will store the images.</p>
	    	</td>
	    </tr>
		<?php endif; ?>
	</table>



<?php submit_button(); ?>
</form>
</div>