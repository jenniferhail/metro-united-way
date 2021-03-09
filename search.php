<?php get_header();

global $wp_query;
$total_results = $wp_query->found_posts;

?>

<section class="layout search-results">
	<div class="wrapper">
		<div class="content">

			<div class="intro">
				<?php if ( get_field('search_headline', 'option') ): ?>
					<h2><?php the_field('search_headline', 'option'); ?></h2>
				<?php else: ?>
					<h2>We're here to help.</h2>
				<?php endif; ?>
			</div>

			<div class="search-wrapper">
				<?php get_template_part('inc/search-advanced'); ?>
			</div>

			<div class="query">
				<?php if (have_posts()) : ?>
					<?php get_template_part('nav'); ?>
					<?php while (have_posts()) : the_post(); ?>

						<div id="post-<?php the_ID(); ?>" class="story">
							<article>
								<h2 class="title h4"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<?php get_template_part('meta'); ?>
								<div class="excerpt">
									<?php if ( the_excerpt() ): ?>
										<?php the_excerpt(); ?>
									<?php elseif ( get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc', true ) ): ?>
										<?php echo get_post_meta( get_the_ID(), '_yoast_wpseo_metadesc', true ); ?>
									<?php endif; ?>
								</div>
							</article>
						</div>

					<?php endwhile; ?>
						<?php echo facetwp_display( 'pager' ); ?>
					<!-- <div class="search-nav">
						<p>Total page results: <?php // echo $total_results; ?></p>
						<?php // numeric_posts_nav(); ?>
					</div> -->
				<?php else : ?>
					<h1>No results found.</h1>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
