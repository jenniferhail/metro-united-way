<?php
/* Template Name: Search Results */
get_header();
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
			<div id="search-results" class="results">
				<?php
					$query = new WP_Query(
		                array(
		                    'post_type'         => array('post', 'muw_program', 'page', 'muw_events', 'attachment'),
		                    'posts_per_page'    => 20,
							'post__not_in'		=> array(10584),
		                    'facetwp'           => true,
		                    'order'             => 'DESC',
							'orderby'           => 'publish_date',
							'post_status'		=> array('publish', 'inherit'),
		                )
		            );
				?>
				<?php if ($query->have_posts()) : ?>
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<div id="post-<?php the_ID(); ?>" class="result">
							<?php if ( has_post_thumbnail() ): ?>
								<div class="image-wrapper">
									<a href="<?php the_permalink(); ?>">
										<img <?php acf_responsive_image(get_post_thumbnail_id(), 'thumbnail', '150px'); ?> alt="<?php echo get_the_post_thumbnail_caption(); ?>">
									</a>
								</div>
							<?php endif; ?>
							<article>
								<?php
									$post_type = get_post_type();
									$permalink = get_permalink();
									// if the result is a PDF, link directly to the file not the attachment page
									if ( $post_type == 'attachment' ) {
										$permalink = wp_get_attachment_url( $post->ID );
									}
								?>
								<h2 class="title h4"><a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a></h2>
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
				<?php else: ?>
					<h3 class="h4 align-text-center">No results found.</h3>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<div class="loading-search">
    <div class="loading-wrapper">
        <p>Loading search <i class="fal fa-spinner fa-spin"></i></p>
    </div>
</div>

<?php get_footer(); ?>
