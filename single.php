<?php get_header(); ?>

<?php
    $template_url = get_template_directory_uri();
    $url = get_permalink();
    // Getting the CTA position
    $position = get_field('position');
    // Display title fallback
    if ( have_rows('layouts') || have_rows('slider') ) {
        $show_title = false;
    } else {
        $show_title = true;
    }
    
?>

<?php if (have_rows('slider')): ?>
    <div class="layout cta cta-slider half-slider blue right">
        <div class="content">
            <div class="wrapper">
                <div class="col col-text">
                    <h2><?php the_title(); ?></h2>
                </div>
            </div>
            <div class="col col-slider">
                <div class="slick-it">
                    	<?php while (have_rows('slider')): the_row(); ?>

                            <?php
                                // Grabbing the video field
                                $slide_type = get_sub_field('slide_type');
                                $cta_video = get_sub_field('cta_video');
                                $cta_cover_image = get_sub_field('image');

                                if ($cta_cover_image != null) {
                                    $cta_video_image = $cta_cover_image['sizes']['large'];
                                } else {
                                    $cta_video_image = urlToThumbnail($cta_video);
                                }
                            ?>

                            <?php if ($slide_type == 'video'): ?>
                                <div class="slide">
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
                                    <div class="image" style="background-image: url(<?php echo get_sub_field('image')['sizes']['large']; ?>)">
                                    </div>
                                </div>
                            <?php endif; ?>
                    	<?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php include(locate_template('loops/loop-interior.php')); ?>
<?php while (have_posts()) : the_post(); ?>
    <section class="layout article basic-content">
        <!-- <div class="intro-updated">
            <div class="wrapper">
                <h2><?php // the_title(); ?></h2>
            </div>
        </div> -->
        <div class="wrapper">
            <div class="content">
                <?php if ($old_style) : ?>
                    <div class="article-content">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
                <div class="article-footer">
                    <ul class="pagination">
                        <li class="pagination-section pagination-left"><?php previous_post_link('%link', 'Previous Post'); ?></li>
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
                        <li class="pagination-section pagination-right"><?php next_post_link('%link', 'Next Post'); ?></li>
                    </ul>
                    <div class="buttons">
                        <a href="/stories" class="btn">See All Stories</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; ?>
<?php get_footer(); ?>
