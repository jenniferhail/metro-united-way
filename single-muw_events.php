<?php get_header(); ?>

<?php
    $template_url = get_template_directory_uri();
    $url = get_permalink();

    // Getting the CTA position
    $position = get_field('position');

	$start = get_field('start_date');
	$event_start = date('F j, Y g:i a', strtotime($start));
	$end = get_field('end_date');

    // Getting event details
    $category = get_the_category();
    $event_end = get_field('end_date');
    $details = get_field('details');
    $location = get_field('location');
    $event_content = get_field('event_content');
?>

<?php if( has_post_thumbnail() || have_rows('slider') ): ?>
    <div class="layout event cta cta-slider <?php echo $position; ?>">
        <div class="content">
            <div class="slick-it">
				<?php if( have_rows('slider') ): ?>
					<?php while( have_rows('slider') ): the_row(); ?>
						<?php
							// Grabbing the video field
							$slide_type = get_sub_field('slide_type');
							$cta_video = get_sub_field('cta_video');
							$cta_cover_image = get_sub_field('image');
							if ($cta_cover_image != NULL) {
								$cta_video_image = $cta_cover_image['sizes']['large'];
							} else {
								$cta_video_image = urlToThumbnail($cta_video);
							}
						 ?>
						 <?php if ($slide_type == 'video'): ?> <!-- If slide is a video -->
							<div class="slide">
								<div class="wrapper">
									<div class="col col-text">
										<h1 class="h2"><?php the_title(); ?></h1>
			                            <?php if ( $category ) : ?>
			                                <p class="p"><?php echo $category[0]->cat_name; ?></p>
			                            <?php endif; ?>
										<?php if ( $event_start ): ?>
											<p><span class="date"><?php echo $event_start; ?></span>
												<?php if ( $end ): ?>
													<span class="date">— <?php echo $end; ?></span>
												<?php endif; ?>
											</p>
										<?php endif; ?>
			                            <p class="details"><?php echo $details; ?></p>
			                            <?php if ( $location ) : ?>
			                                <p><span class="location"><?php echo $location; ?></span></p>
			                            <?php endif; ?>
									</div>
								</div>
								<div class="video-slide">
									<div class="video-slide-inner">
										<a class="video-slide-item iframe" data-fancybox href="<?php the_sub_field('cta_video', false, false); ?>" style="background-image: url(<?php echo $cta_video_image; ?>);">
											 <div class="play-btn-outer">
												 <div class="play-btn-inner">
													 <div class="play-btn">
													 </div>
												 </div>
											 </div>
										 </a>
									 </div>
								</div>
							</div>
						<?php else: ?>
							<div class="slide">
								<div class="wrapper">
									<div class="col col-text">
										<h1 class="h2"><?php the_title(); ?></h1>
			                            <?php if ( $category ) : ?>
			                                <p class="p"><?php echo $category[0]->cat_name; ?></p>
			                            <?php endif; ?>
										<?php if ( $event_start ): ?>
											<p><span class="date"><?php echo $event_start; ?></span>
												<?php if ( $end ): ?>
													<span class="date">— <?php echo $end; ?></span>
												<?php endif; ?>
											</p>
										<?php endif; ?>
			                            <p class="details"><?php echo $details; ?></p>
			                            <?php if ( $location ) : ?>
			                                <p><span class="location"><?php echo $location; ?></span></p>
			                            <?php endif; ?>
									</div>
								</div>
								<div class="image" style="background-image: url(<?php echo get_sub_field('image')['sizes']['large']; ?>)">
								</div>
							</div>
						<?php endif; ?>
					<?php endwhile; ?>
				<?php else: ?>
					<div class="slide">
	                    <div class="wrapper">
	                        <div class="col col-text">
								<h1 class="h2"><?php the_title(); ?></h1>
	                            <?php if ( $category ) : ?>
	                                <p class="p"><?php echo $category[0]->cat_name; ?></p>
	                            <?php endif; ?>
								<?php if ( $event_start ): ?>
									<p><span class="date"><?php echo $event_start; ?></span>
										<?php if ( $end ): ?>
											<span class="date">— <?php echo $end; ?></span>
										<?php endif; ?>
									</p>
								<?php endif; ?>
	                            <p class="details"><?php echo $details; ?></p>
	                            <?php if ( $location ) : ?>
	                                <p><span class="location"><?php echo $location; ?></span></p>
	                            <?php endif; ?>
	                        </div>
	                    </div>
	                    <div class="image" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>)">
	                    </div>
	                </div>
				<?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
	<section class="layout article basic-content">
        <div class="intro-updated">
            <div class="wrapper">
				<h1 class="h2"><?php the_title(); ?></h1>
				<?php if ( $category ) : ?>
					<p class="p"><?php echo $category[0]->cat_name; ?></p>
				<?php endif; ?>
				<?php if ( $event_start ): ?>
					<p><span class="date"><?php echo $event_start; ?></span>
						<?php if ( $end ): ?>
							<span class="date">— <?php echo $end; ?></span>
						<?php endif; ?>
					</p>
				<?php endif; ?>
				<p class="details"><?php echo $details; ?></p>
				<?php if ( $location ) : ?>
					<p><span class="location"><?php echo $location; ?></span></p>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endif; ?>

<?php
	$basic_content = get_field('basic_content');
	$layout_view = 'basic-content';
	$intro = get_field('display_intro');
	$intro_title = get_field('intro_title');
	$intro_subtitle = get_field('intro_subtitle');
?>

<section class="layout basic-content">
	<?php if ($intro): ?>
		<div class="intro-updated">
			<div class="wrapper">
				<?php if ($intro_title): ?>
					<h1 class="h2"><?php echo $intro_title; ?></h1>
				<?php endif; ?>
				<?php if ($intro_subtitle): ?>
					<p><?php echo $intro_subtitle; ?></p>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php if ($basic_content) : ?>
		<div class="wrapper">
			<div class="content">
				<?php echo $basic_content; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php include(locate_template('layouts/component-button.php')); ?>
</section>

<section class="layout basic-content">
	<div class="wrapper">
		<div class="article-footer">
			<ul class="pagination">
				<li class="pagination-section pagination-left"><?php previous_post_link('%link', 'Previous Event'); ?></li>
				<li class="pagination-section share-links">
					<ul class="share-list social-links">
						<li class="share-link">
							<a class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank"><i class="fab fa-facebook-f"></i>
							</a>
						</li>
						<li class="share-link">
							<a href="https://twitter.com/share?url=<?php echo $url; ?>&text=<?php the_title(); ?>" onclick="window.open(this.href, 'twitterwindow','left=20,top=20,width=600,height=300,toolbar=0,resizable=1'); return false;" class="twitter" alt="Share on Twitter"><i class="fab fa-twitter"></i></a>
						</li>
					</ul>
					<span class="h4">Share</span>
				</li>
				<li class="pagination-section pagination-right"><?php next_post_link('%link', 'Next Event'); ?></li>
			</ul>
			<div class="buttons">
				<a href="/events" class="btn">See All Events</a>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
