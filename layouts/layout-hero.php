<?php
    $bg_settings = get_sub_field('bg_settings');
    $logo_settings = get_sub_field('show_logo');
    $logo_image = get_sub_field('logo');
    $image = get_sub_field('image');
    $video = get_sub_field('video');

    $title = get_sub_field('title');
    $subtitle = get_sub_field('subtitle');
    $link = get_sub_field('link');

    if ($bg_settings == 'image') {
        $background = '<div class="background" style="background-image: url(' . $image['url'] . ');"></div>';
    } elseif ($bg_settings == 'video') {
        $background = '<video autoplay loop class="video-background" muted plays-inline> <source src="https://player.vimeo.com/external/158148793.hd.mp4?s=8e8741dbee251d5c35a759718d4b0976fbf38b6f&profile_id=119&oauth2_token_id=57447761" type="video/mp4"> </video>';
    } else {
        exit;
    }

    if($logo_settings == 'yes'){
        $logo = '<img src="'.$logo_image['url'].'" alt="'.$title.'"/>';
    } else {
        $logo = '';
	}
	
	$spacing_classes = get_spacing_classes(get_sub_field('spacing'));

?>

<section class="layout hero fragment <?php echo $spacing_classes; ?>">
    <div class="slide">
        <?php echo $background; ?>
		<div class="content">
		<?php if(isset($i) && $i === 1 && is_front_page()) : ?>
			<div class="hero-first">
				<h1 class="fade-in"><?php echo $title; ?></h1>
				<ul class="hero-links">
					<?php
						$center_args = array(
							'menu' => 'center-menu',
							'container' => false,
							'items_wrap' => '%3$s',
							'depth' => '1'
						);
					 ?>
					<?php wp_nav_menu($center_args); ?>
				</ul>
				<a id="start-united" class="start-slider" href="#"><i class="fal fa-angle-down"></i></a>
			</div>
		<?php else : ?>
			<div class="hero-top">
				<?php echo $logo; ?>
				<h1><?php echo $title; ?></h1>
			</div>
			<div class="hero-bottom">
				<?php if ($link): ?>
					<a href="<?php echo $link['url']; ?>" class="btn"><?php echo $link['title']; ?></a>
				<?php endif; ?>
				<?php if ($subtitle): ?>
					<strong><?php echo $subtitle; ?></strong>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		</div>
    </div>
</section>
