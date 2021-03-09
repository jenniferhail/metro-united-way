<?php get_header(); ?>

<?php $cat_id = $wp_query->get_queried_object_id() ?>

<section class="layout blog cards">

	<div class="intro-updated">

        <div class="wrapper">

			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works.?>

			<?php /* If this is a category archive */ if (is_category()) {
    ?>
				<h1><?php single_cat_title(); ?></h1>

			<?php /* If this is a tag archive */
} elseif (is_tag()) {
    ?>
				<h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>

			<?php /* If this is a daily archive */
} elseif (is_day()) {
    ?>
				<h1>Archive for <?php the_time('F jS, Y'); ?></h1>

			<?php /* If this is a monthly archive */
} elseif (is_month()) {
    ?>
				<h1>Archive for <?php the_time('F, Y'); ?></h1>

			<?php /* If this is a yearly archive */
} elseif (is_year()) {
    ?>
				<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>

			<?php /* If this is an author archive */
} elseif (is_author()) {
    ?>
				<h1 class="pagetitle">Author Archive</h1>

			<?php /* If this is a paged archive */
} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
    ?>
				<h1 class="pagetitle">Blog Archives</h1>

			<?php
} ?>

        </div>

    </div>

	<div class="wrapper">

		<div class="content">

			<ul class="filters acc-item">

				<li class="open-dropdown title"><span>Categories +</span></li>

				<div class="dropdown acc-content">

					<li class="cat-item cat-item-21"><a href="/stories">All</a></li>

					<?php wp_list_categories(array('taxonomy' => 'category', 'title_li' => '')); ?>

				</div>

			</ul>

			<?php if (have_posts()) : ?>

				<ul class="card-list">

					<?php while (have_posts()) : the_post(); ?>

					<?php $excerpt = get_field('excerpt'); ?>

					<li class="card has-btn">

						<div class="card-content">

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

						</div>

					</li>

					<?php endwhile; ?>

				</ul>

			<?php endif; ?>

			<ul class="pagination">

				<?php
                    echo paginate_links(array(
                        'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'total'        => $wp_query->max_num_pages,
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

<?php get_footer(); ?>
