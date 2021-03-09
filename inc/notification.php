<?php
	$popup_display = get_field('popup_display', 'option');
	$popup_id = get_field('popup_id', 'option');
	$popup_link = get_field('popup_link', 'option');
	$popup_image = get_field('popup_image', 'option');
	$popup_headline = get_field('popup_headline', 'option');
	$popup_copy = get_field('popup_copy', 'option');
	$popup_button = get_field('popup_button', 'option');
	if ($popup_headline != NULL) {
		$has_content = 'has-content';
	} else {
		$has_content = NULL;
	}

	if (isset($_COOKIE['notification'])) {
		$popup_cookie = $_COOKIE['notification'];
	} else {
		$popup_cookie = NULL;
	}

	if ($popup_image) {
		// var_dump($popup_image);
		$popup_image_id = $popup_image['id'];
	}

	$popup_background_image = get_field('popup_background_image', 'option');
	if ($popup_background_image == FALSE) {
		$background_image = NULL;
	} elseif ($popup_background_image == TRUE) {
		$background_image = 'background-img';
	}

	$popup_headline_color = get_field('popup_headline_color', 'option');
	if ($popup_headline_color == 'blue') {
		$headline_color = NULL;
	} elseif ($popup_headline_color == 'white') {
		$headline_color = 'reversed-text';
	}

	$popup_classes = $headline_color . ' ' . $background_image . ' ' . $has_content;
?>

<?php if ($popup_display == TRUE): ?>
	<div id="notification" class="hidden" data-notification-id="<?php echo $popup_id; ?>">
		<div class="notification <?php echo $popup_classes; ?>">
			<div class="content" <?php if ($popup_background_image == TRUE): ?>style="background-image: url('<?php echo $popup_image['url']; ?>');"<?php endif; ?>>
				<a class="notification-close" href="#"><i class="fal fa-times"></i></a>
				<?php if ($popup_background_image == FALSE): ?>
					<img class="notification-img" src="<?php echo $popup_image['url']; ?>" alt="">
				<?php endif; ?>
				<?php if ($popup_headline or $popup_copy or $popup_button): ?>
					<div class="wrapper">
						<div class="wrapper-inner">
							<?php if ($popup_headline): ?>
								<h1 class="h3"><?php echo $popup_headline; ?></h1>
							<?php endif; ?>
							<?php if ($popup_copy): ?>
								<p class="text"><?php echo $popup_copy; ?></p>
							<?php endif; ?>
							<?php if ($popup_button): ?>
								<div class="buttons">
									<span class="btn"><?php echo $popup_button; ?></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php
				if ($popup_link) {
					$popup_link_url = $popup_link['url'];
					$popup_link_title = $popup_link['title'];
					$popup_link_target = $popup_link['target'];
					if ($popup_link_target == NULL) {
						$popup_link_target = '_self';
					}
					echo '<a class="notification-link" href="' . $popup_link_url . '" target="' . $popup_link_target . '" alt="' . $popup_link_title . '"></a>';
				}
				?>
			</div>
		</div>
	</div>
<?php endif; ?>
