<?php
	$enable_notification = get_field('notification_enable', 'option');
	$notification_id = get_field('notification_id', 'option');
	$notification_content = get_field('notification_content', 'option');
	$notification_link = get_field('notification_link', 'option');
	$notification_image = get_field('notification_image', 'option');

	if ($notification_image) {
		$notification_image_id = $notification_image['id'];
		$enable_drawer = ' drawer';
	} else {
		$enable_drawer = NULL;
	}

	if (isset($_COOKIE['notification'])) {
		$notification_cookie = $_COOKIE['notification'];
	} else {
		$notification_cookie = NULL;
	}
?>

<?php if (is_front_page() && $enable_notification == TRUE && $notification_cookie != $notification_id): ?>
	<div id="notification" class="option notification" data-notification-id="<?php echo $notification_id; ?>">
		<button class="close"><i class="fal fa-times"></i></button>
		<div class="wrapper<?php echo $enable_drawer; ?>">
			<div class="content">
				<?php if ($notification_link && $enable_drawer == NULL): ?>
					<a href="<?php echo $notification_link['url']; ?>"><span><?php echo $notification_content; ?></span></a>
				<?php else: ?>
					<span><?php echo $notification_content; ?></span>
				<?php endif; ?>
			</div>
			<?php if ($notification_image): ?>
				<div class="container">
					<?php if ($notification_link): ?>
						<a class="notification-link" href="<?php echo $notification_link['url']; ?>">
							<img class="notification-img" <?php acf_responsive_image($notification_image_id, 'full', 1600); ?>>
						</a>
					<?php else: ?>
						<img class="notification-img" <?php acf_responsive_image($notification_image_id, 'full', 1600); ?>>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php elseif ($enable_notification == FALSE): ?>
	<?php unset($_COOKIE['notification']); ?>
<?php endif; ?>
