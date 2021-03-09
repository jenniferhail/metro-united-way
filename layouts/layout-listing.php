<?php

$post_type = get_sub_field('post_type');
$category_filter = get_sub_field('filter_by_category');

// The separate category filter fields
$partner_cat = get_sub_field('partner_filter');
$ally_cat = get_sub_field('ally_filter');
$program_cat = get_sub_field('program_filter');
$event_cat = get_sub_field('event_filter');
$story_cat = get_sub_field('story_filter');

$layout_view = get_sub_field('layout_view');
$url = get_permalink();
$spacing_classes = get_spacing_classes(get_sub_field('spacing'));

$args = array(
    'post_type'			=> $post_type,
    'posts_per_page'	=> 8,
    'paged'				=> $paged
);

// Partners Post Type
if($post_type == 'muw_partners'){
	if ($category_filter && $partner_cat) {
		$partner_args = array(
			'post_type'			=> 'muw_partners',
			'tax_query' => array(
				array(
					'taxonomy' => 'muw_partner_types',
					'field' => 'id',
					'terms' => $partner_cat
				)
			),
			'posts_per_page'	=> -1,
			'meta_key'			=> 'amount',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC'
		);
	} else {
		$partner_args = array(
			'post_type'			=> 'muw_partners',
			'posts_per_page'	=> -1,
			'meta_key'			=> 'amount',
			'orderby'			=> 'meta_value_num',
			'order'				=> 'DESC'
		);
	}
}

// Ally Post Type
if($post_type == 'muw_allies'){
	if ($category_filter && $ally_cat) {
		$ally_args = array(
			'post_type'			=> 'muw_allies',
			'tax_query' => array(
				array(
					'taxonomy' => 'muw_ally_types',
					'field' => 'id',
					'terms' => $ally_cat
				)
			),
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'ASC'
		);
	} else {
		$ally_args = array(
			'post_type'			=> 'muw_allies',
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'ASC'
		);
	}
}

// Program Post Type
if($post_type == 'muw_program'){
	if ($category_filter && $program_cat) {
		$program_args = array(
			'post_type'			=> 'muw_program',
			'tax_query' => array(
				array(
					'taxonomy' => 'muw_program_types',
					'field' => 'id',
					'terms' => $program_cat
				)
			),
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'ASC'
		);
	} else {
		$program_args = array(
			'post_type'			=> 'muw_program',
			'posts_per_page'	=> -1,
			'orderby'			=> 'title',
			'order'				=> 'ASC'
		);
	}
}

// Event Post Type
if($post_type == 'muw_events'){
	if ($category_filter && $event_cat) {
		$event_args = array(
			'post_type'			=> 'muw_events',
			'tax_query' => array(
				array(
					'taxonomy' => 'muw_event_types',
					'field' => 'id',
					'terms' => $event_cat
				)
			),			
			'posts_per_page'	=> -1,
			'paged'				=> $paged,
			'meta_key'			=> 'start_date',
			// compare meta value to todays date. needs to match format returned by acf
			'meta_value'        => date("Y-m-d H:i:s"),
			'meta_compare'      => '>',
			'orderby'			=> 'meta_value',
			'order'				=> 'ASC'
		);
	} else {
		$event_args = array(
			'post_type'			=> 'muw_events',
			'posts_per_page'	=> -1,
			'paged'				=> $paged,
			'meta_key'			=> 'start_date',
			// compare meta value to todays date. needs to match format returned by acf
			'meta_value'        => date("Y-m-d H:i:s"),
			'meta_compare'      => '>',
			'orderby'			=> 'meta_value',
			'order'				=> 'ASC'
		);
	}
}

// Standar Post Type
if($post_type == 'post'){
	if ($category_filter && $story_cat) {
		$post_args = array(
			'post_type'			=> 'post',
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'id',
					'terms' => $story_cat
				)
			),			
			'posts_per_page'	=> 8,
			'paged'				=> $paged
		);
	} else {
		$post_args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> 8,
			'paged'				=> $paged
		);
	}
}


// change the query if this is an event list
if ($post_type == 'muw_events' && $layout_view == 'list') {
    $args = $event_args;
    // create an array we will use to determine when months change
    $event_posts_array = [];
} elseif ($post_type == 'muw_allies' && $layout_view == 'list') {
    $args = $ally_args;
} elseif ($post_type == 'muw_partners' && $layout_view == 'list') {
    $args = $partner_args;
} elseif ($post_type == 'muw_program' && $layout_view == 'list') {
    $args = $program_args;
} elseif (($post_type == 'post' && $layout_view == 'list') || ($post_type == 'post' && $layout_view == 'grid')) {
    $args = $post_args;
}

// the query
$the_query = new WP_Query($args); ?>
<?php if ($the_query->have_posts()) : ?>
	<?php if ($layout_view == 'grid'): ?>

		<section class="layout blog cards <?php echo $spacing_classes; ?>">

	        <?php //Display the intro if selected?>
	        <?php include(locate_template('layouts/component-intro.php')); ?>

	        <div class="wrapper">

				<div class="content">

					<?php if ($post_type == 'post') : ?>

						<ul class="filters acc-item">

							<li class="open-dropdown title"><span>Categories +</span></li>

							<div class="dropdown acc-content">

								<li class="cat-item current-cat"><a href="/stories">All</a></li>

								<?php wp_list_categories(array('taxonomy' => 'category', 'title_li' => '')); ?>

							</div>

						</ul>

					<?php endif; ?>

	                <ul class="card-list">

		            	<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

							<?php
                                $excerpt = get_field('excerpt');
                                $ally_description = get_field('description');
                                $ally_phone = get_field('phone_number');
                            ?>

							<li class="card card-<?php echo $post_type; ?>">

		                        <div class="card-content">

									<?php if ($post_type == 'muw_allies'): ?>

										<?php
                                            $logo = get_field('logo');
                                            $link = get_field('link');
                                        ?>

										<div class="card-text">

											<?php if ($link): ?>

												<?php if ($logo): ?>

													<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">

														<img class="allies-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">

													</a>

												<?php endif; ?>

												<h2 class="h3"><a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php the_title(); ?></a></h2>

											<?php else: ?>

												<?php if ($logo): ?>

													<img class="allies-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">

												<?php endif; ?>

												<h2 class="h3"><?php the_title(); ?></h2>

											<?php endif; ?>

											<?php if ($ally_description): ?>
												<p class="p"><?php echo $ally_description; ?></p>
											<?php endif; ?>

											<?php if ($ally_phone): ?>
												<p class="p ally-phone"><?php echo $ally_phone; ?></p>
											<?php endif; ?>

											<a class="btn" href="<?php echo $link['url']; ?>">Learn More</a>

										</div>

									<?php elseif ($post_type == 'muw_partners'): ?>

										<?php
                                            $logo = get_field('logo');
                                            $link = get_field('link');
                                        ?>

										<div class="card-text">

											<?php if ($link): ?>

												<?php if ($logo): ?>

													<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">

														<img class="partners-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">

													</a>

												<?php endif; ?>

												<h2 class="h3"><a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php the_title(); ?></a></h2>

											<?php else: ?>

												<?php if ($logo): ?>

													<img class="partners-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">

												<?php endif; ?>

												<h2 class="h3"><?php the_title(); ?></h2>

											<?php endif; ?>

											<?php if ($partner_description): ?>
												<p class="p"><?php echo $partner_description; ?></p>
											<?php endif; ?>

											<?php if ($partner_amount): ?>
												<p class="p partner-amount"><?php echo $partner_amount; ?></p>
											<?php endif; ?>

											<a class="btn" href="<?php echo $link['url']; ?>">Learn More</a>

										</div>

									<?php else: ?>

										<a class="card-link" href="<?php the_permalink(); ?>">

											<div class="card-image" style="background-image: url(<?php the_post_thumbnail_url($post->ID, 'large'); ?>);"></div>

										</a>

										<div class="card-text">

											<h2 class="h3"><?php the_title(); ?></h2>

											<?php if ($excerpt): ?>
												<p class="p"><?php echo $excerpt; ?></p>
											<?php else: ?>
												<p class="p"><?php the_excerpt_max_charlength(100); ?></p>
											<?php endif; ?>

											<a class="btn" href="<?php the_permalink(); ?>">Learn More</a>

										</div>

									<?php endif; ?>

		                        </div>

		                    </li>

		            	<?php endwhile; ?>


	                </ul>

					<ul class="pagination">

						<?php
                            echo paginate_links(array(
                                'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                'total'        => $the_query->max_num_pages,
                                'current'      => max(1, get_query_var('paged')),
                                'format'       => '?paged=%#%',
                                'show_all'     => false,
                                'type'         => 'plain',
                                'end_size'     => 2,
                                'mid_size'     => 1,
                                'prev_next'    => true,
                                'prev_text'    => sprintf('<i class="fal fa-angle-left">%1$s</i>', __('', 'text-domain')),
                                'next_text'    => sprintf('<i class="fal fa-angle-right"">%1$s</i>', __('', 'text-domain')),
                                'add_args'     => false,
                                'add_fragment' => '',
                            ));
                        ?>

					</ul>

		        </div>

		    </div>

		</section>

	<?php endif; ?>
	<?php if ($layout_view == 'list'): ?>
		<?php if ($post_type == 'muw_events'): ?>
			<section class="layout listing <?php echo $spacing_classes; ?>">
				<?php //Display the intro if selected?>
				<?php include(locate_template('layouts/component-intro.php')); ?>
				<div class="wrapper">
					<div class="content">
						<div class="events-table">
							<?php
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    $event_posts_array[] = get_the_ID();
                                endwhile;
                            ?>
							<?php $event_counter = 0; while ($the_query->have_posts()) : $the_query->the_post(); ?>
								<?php
									//print_r(the_post());
                                    $url = get_permalink();
                                    //$post = get_post(the_post()->ID);
                                    // get raw date
                                    $date = get_field('start_date', false, false);
									//print_r($date);
                                    // make date object
                                    $date = new DateTime($date);
                                    // get this events month name
                                    $month = $date->format('F');
                                    $location = get_field('location');
                                    // prev event month
                                    $prev_count = $event_counter-1;
                                    // if there is no previous post, set to false, else set to post month
                                    if ($prev_count == -1) {
                                        $prev_post_month = false;
                                    } else {
                                        $prev_post_id = $event_posts_array[$event_counter-1];
                                        $prev_date = get_field('start_date', $prev_post_id, false);
                                        $prev_post_month = new DateTime($prev_date);
                                        $prev_post_month = $prev_post_month->format('F');
                                    }

                                    // next event month
                                    $next_count = $event_counter+1;

                                    // if there is no next post, set to false, else set to post month
                                    if ($next_count == $the_query->post_count) {
                                        $next_post_month = false;
                                    } else {
                                        $next_post_id = $event_posts_array[$event_counter+1];
                                        $next_date = get_field('start_date', $next_post_id, false);
                                        $next_post_month = new DateTime($next_date);
                                        $next_post_month = $next_post_month->format('F');
                                    }
                                    // if this is the first post, add an h2 with event month and open the ul.
                                    if (!$prev_post_month) {
                                        echo '<h2 class="h3 event-month">'.$month.'</h2>';
                                        echo '<ul class="month-section">';
                                    } else {
                                        // if this is not the first post then determine if the previous post is in the same month as this post
                                        if ($prev_post_month != $month) {
                                            echo '</ul>';
                                            echo '<h2 class="h3 event-month">'.$month.'</h2>';
                                            echo '<ul class="month-section">';
                                        }
                                    }
                                ?>
								<li class="event-row">
									<div class="left">
										<span class="h3 event-date"><?php echo $date->format('j'); ?></span>
									</div>
									<div class="right">
										<div class="event-title">
											<h3 class="p"><?php the_title(); ?></h3>
										</div>
										<?php if ($location) : ?>
											<div class="event-location"><span><?php echo $location ?></span></div>
										<?php endif; ?>
										<div class="event-category">
											<span><?php the_terms(get_the_ID(), 'muw_event_types'); ?> </span>
										</div>
										<div class="event-links">
											<a class="event-link" href="<?php the_permalink(); ?>">Details</a><span class="sep">|</span><a href="#share-event-<?php the_ID(); ?>" data-fancybox class="event-link">Share</a>
										</div>
										<div id="share-event-<?php the_ID(); ?>" class="share-event hide center">
											<span class="h4">Share</span>
				                            <ul class="share-list social-links">
				                                <li class="share-link"><a href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php the_title(); ?>&amp;p[summary]=<?php the_excerpt_max_charlength(100); ?>&amp;p[url]=<?php print(urlencode($url)); ?>&amp;p[images[0]=<?php the_post_thumbnail_url('large'); ?>" onclick="window.open(this.href, 'facebookwindow','left=20,top=20,width=600,height=700,toolbar=0,resizable=1'); return false;" class="facebook" alt="Share on Facebook"><i class="fab fa-facebook-f"></i></a></li>
				                                <li class="share-link"><a href="http://twitter.com/intent/tweet?text=<?php print(urlencode($url)); ?>" onclick="window.open(this.href, 'twitterwindow','left=20,top=20,width=600,height=300,toolbar=0,resizable=1'); return false;" class="twitter" alt="Share on Twitter"><i class="fab fa-twitter"></i></a></li>
				                            </ul>
										</div>
									</div>
								</li>
								<?php
                                    // if this is the last post, close the ul.
                                    if (!$next_post_month) {
                                        echo '</ul>';
                                    }
                                ?>
							<?php $event_counter++; endwhile; ?>
						</div>
						<!-- <button class="btn btn-orange" type="button" name="button">More Results</button> -->
					</div>
				</div>
			</section>
		<?php elseif ($post_type == 'muw_allies'): ?>
			<section class="layout listing <?php echo $spacing_classes; ?>">
				<?php //Display the intro if selected?>
				<?php include(locate_template('layouts/component-intro.php')); ?>
				<div class="wrapper">
					<div class="content">
						<div class="allies-table">
							<ul class="month-section">
								<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<?php
                                        $logo = get_field('logo');
                                        $link = get_field('link');
                                        $ally_description = get_field('description');
                                        $ally_phone = get_field('phone_number');
                                    ?>
									<li class="table-row">
										<div class="table-col ally-logo">
											<?php if ($logo): ?>
												<?php if ($link): ?>
													<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
														<img class="allies-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
													</a>
												<?php else: ?>
													<img class="allies-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
												<?php endif; ?>
											<?php endif; ?>
											<?php if ($link): ?>
												<h3 class="h6"><a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php the_title(); ?></a></h3>
											<?php else: ?>
												<h3 class="h6"><?php the_title(); ?></h3>
											<?php endif; ?>
										</div>
										<div class="table-col ally-phone">
											<?php echo $ally_phone; ?>
										</div>
										<div class="table-col ally-description">
											<?php echo $ally_description; ?>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
				</div>
			</section>
		<?php elseif ($post_type == 'muw_partners'): ?>
			<section class="layout listing <?php echo $spacing_classes; ?>">
				<?php //Display the intro if selected?>
				<?php include(locate_template('layouts/component-intro.php')); ?>
				<div class="wrapper">
					<div class="content">
						<div class="partner-table">
							<ul class="month-section">
								<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<?php
                                        $logo = get_field('logo');
                                        $link = get_field('link');
                                        $partner_description = get_field('description');
                                        $partner_amount = get_field('amount');
                                        setlocale(LC_MONETARY, "en_US");

                                    ?>
									<li class="table-row">
										<div class="table-col partner-logo">
											<?php if ($logo): ?>
												<?php if ($link): ?>
													<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
														<img class="partners-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
													</a>
												<?php else: ?>
													<img class="partners-logo" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
												<?php endif; ?>
											<?php endif; ?>
											<?php if ($link): ?>
												<h3 class="h6"><a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php the_title(); ?></a></h3>
											<?php else: ?>
												<h3 class="h6"><?php the_title(); ?></h3>
											<?php endif; ?>
										</div>
										<div class="table-col partner-amount">
											<!-- <?php echo $partner_amount; ?> -->
											<?php echo money_format("%.0n", $partner_amount); ?>
										</div>
										<div class="table-col partner-description">
											<?php echo $partner_description; ?>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
					</div>
				</div>
			</section>
		<?php else: ?>
			<section class="layout listing <?php echo $spacing_classes; ?>">
				<?php //Display the intro if selected?>
				<?php include(locate_template('layouts/component-intro.php')); ?>
				<div class="wrapper">
					<div class="content">
						<!-- <ul class="table-filters">
							<li class="table-filter active-filter"><a class="table-filter-link" href="#">Upcoming</a></li>
							<li class="table-filter"><a class="table-filter-link" href="#">Location</a></li>
							<li class="table-filter"><a class="table-filter-link" href="#">Category</a></li>
						</ul> -->
						<div class="events-table">
							<ul class="month-section">
								<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<?php
                                        // get raw date
                                        $date = get_field('start_date', false, false);
                                        // make date object
                                        $date = new DateTime($date);
                                    ?>
									<li class="event-row">
										<div class="event-title">
											<h3 class="p"><?php the_title(); ?></h3>
										</div>
										<div class="event-category">
											<span><?php the_terms(get_the_ID(), 'muw_event_types'); ?> </span>
										</div>
										<div class="event-links">
											<a class="event-link" href="<?php the_permalink(); ?>">Details</a><span class="sep">|</span><a class="event-link" href="#">Share</a>
										</div>
									</li>
								<?php endwhile; ?>
							</ul>
						</div>
						<!-- <button class="btn btn-orange" type="button" name="button">More Results</button> -->
					</div>
				</div>
			</section>
		<?php endif; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
<?php else : ?>

	<section class="layout listing <?php echo $spacing_classes; ?>">
		<?php //Display the intro if selected?>
		<?php include(locate_template('layouts/component-intro.php')); ?>
		<div class="wrapper">
			<div class="content">
				<p style="text-align: center;"><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
			</div>
		</div>
	</section>

<?php endif; ?>
