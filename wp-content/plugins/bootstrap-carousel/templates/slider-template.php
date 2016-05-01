<?php
/************************************************************
	Filename: slider-template.php

	Description:
	---------------------------------------------------------
	Default Base Slider Carousel Template for all Sliders!
	This will get used if no other templates exist.
	Templates are based on your post type names.
************************************************************/

if (!defined('ABSPATH')) exit(0);

$random_slides = array();

foreach($carousel->sliders as $key => $slider)
{
	if (!empty($slider['randomize']))
		$random_slides[] = $slider;
	else
		$sliders[] = $slider;
}

// Shuffle the slides...
if (!empty($random_slides))
	shuffle($random_slides);

if ($carousel->is_front_page)
{
	$slide_count = count($sliders);
	if ($slide_count < 4)
		$sliders = array_merge($sliders, array_slice($random_slides, 0, (4 - $slide_count)));
	else if ($slide_count > 4)
		$sliders = array_slice($sliders, 0, 4);
}
else
	$sliders = array_merge($sliders, $random_slides);

if (empty($carousel)) return; ?>

<div class="<?php echo $carousel->wrapper_class_output; ?>">
	<div class="row">
		<div class="<?php echo implode(' ', $carousel->slideClasses); ?> carousel slide carousel-fade" data-ride="carousel">
			<div class="tifco-box-wrapper">


				<!--// Caption Wrapper Element //-->
				<div class="tifco-box-inner container no-pad">
					<div class="tifco-box <?php if ($carousel->is_front_page) { echo'home-caption'; } else { echo 'page-caption'; } ?>">
						<?php foreach($sliders as $key => $slider):
								$html = array(
									'headline' => !empty($slider['header']) ? '<h2>' . $slider['header'] . '</h2>' : '',
									'caption' => !empty($slider['caption']) ? wpautop($slider['caption']) : '',
									'link' => !empty($slider['link_text']) && !empty($slider['link']) ? '<p class="link"><a href="' . $slider['link'] . '">' . $slider['link_text'] . '</a></p>' : ''
								);

								$has_body = !empty($html['headline']) || !empty($html['caption']) || !empty($html['link']);

								// We'll want to apply class if $is_archive = true, so we can manipulate elements in css!
								if ($has_body): ?>
								<div class="slider-caption test cc-<?php echo $key . (!empty($key) ? ' cap-hidden' : ''); ?>">
									<?php echo $html['headline']; ?>
									<?php echo $html['caption']; ?>
									<?php echo $html['link']; ?>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>




						<!--// Carousel Wrapper Template //-->
						<?php if ($carousel->sliderCount > 1): ?>
							<!-- Indicators -->
							<ol class="carousel-indicators">
							<?php foreach($sliders as $key => $slider): ?>
								<li data-target=".tif-slider" data-slide-to="<?php echo $key; ?>"<?php if (empty($key)): ?> class="active"<?php endif; ?>></li>
							<?php endforeach; ?>
							</ol>
						<?php endif; ?>




						<?php if ($carousel->is_front_page || in_array('slider-homepage', $carousel->templates)): ?>
							<div class="arrow-side arrow-home"></div>
							<?php // else: ?>
							<!--// <div class="arrow-side arrow-other"></div> //-->
							<?php // endif; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>




			<!-- Image Wrapper Template -->
			<div class="carousel-inner <?php if ($carousel->is_front_page) { echo'home-image'; } else { echo 'page-image'; } ?>" role="listbox">
				<?php foreach($sliders as $key => $slider):
					// Should take into account all possible values of ACF being returned!
					$int_val = intval($slider['image']);
					if (!empty($int_val)):
						$slider_image_array = wp_get_attachment_image_src($slider['image'], $carousel->image_size); 
						$slider_image = $slider_image_array[0];
					else:
						$slider_image = $slider['image'];
					endif; ?>
					<div class="item<?php if (empty($key)): ?> active<?php endif; ?>" style="width: 100%; background-image: url(<?php echo $slider_image; ?>); background-repeat: no-repeat; background-position: center center; background-size: cover;">
<!-- 						<img src="<?php echo $slider_image; ?>" alt="" /> -->
					</div>
				<?php endforeach; ?>
			</div>



			<!--// Arrows Wrapper Template -->

			<!--//
			<a class="left carousel-control" href="#tif-slider" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#tif-slider" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
			//-->
			
		</div>
	</div>
</div>