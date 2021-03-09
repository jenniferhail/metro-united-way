<?php
/* Template Name: Events Roll */
get_header(); ?>

<div class="interior-page">

	<?php include(locate_template('loops/loop-interior.php')); ?>

	<!-- <section class="layout featured-programs">
		<div class="wrapper">
			<div class="content">
				<div class="intro">
					<h1>Events Headline</h1>
					<p class="text">Subtitle about Metro United Way events</p>
				</div>
			</div>
		</div>
	</section> -->

	<?php
	$args = array(
		'post_type'     => 'muw_events',
	    'post_per_page' => 8,
	);

	// the query
	$the_query = new WP_Query( $args ); ?>

	<?php if ( $the_query->have_posts() ) : ?>

		<section class="layout events">
			<div class="wrapper">
				<div class="content">
					<!-- <ul class="table-filters">
						<li class="table-filter active-filter"><a class="table-filter-link" href="#">Upcoming</a></li>
						<li class="table-filter"><a class="table-filter-link" href="#">Location</a></li>
						<li class="table-filter"><a class="table-filter-link" href="#">Category</a></li>
					</ul> -->
					<div class="events-table">
					<h2 class="h3 event-month">May</h2>
					<ul class="month-section">

	            	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<?php
							// get raw date
							$date = get_field('start_date', false, false);

							// make date object
							$date = new DateTime($date);
						?>

						<li class="event-row">
							<div class="left">
								<span class="h3 event-date"><?php echo $date->format('j'); ?></span>
							</div>
							<div class="right">
								<div class="event-title">
									<h3 class="p"><?php the_title(); ?></h3>
								</div>
								<div class="event-location">
									<span><?php the_field('location'); ?></span>
								</div>
								<div class="event-category">
									<span><?php the_terms(get_the_ID(), 'muw_event_types'); ?> </span>
								</div>
								<div class="event-links">
									<a class="event-link" href="<?php the_permalink(); ?>">Event Details</a><span class="sep">|</span><a class="event-link" href="#">Share Event</a>
								</div>
							</div>
						</li>

	            	<?php endwhile; ?>

				</ul>
			</div>
			<button class="btn btn-orange" type="button" name="button">More Results</button>
		</div>
	</div>
	</section>

	<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>

</div>

<?php get_footer(); ?>
