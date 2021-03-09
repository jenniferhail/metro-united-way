<?php
    $template_url = get_template_directory_uri();

    // Getting the type of CTA and the background color
    $headline_size = get_sub_field('headline_size');
    $layout_view = get_sub_field('layout_view');
    $position = get_sub_field('position');
    $bg_color = get_sub_field('bg_color');

    // Determine whether stories will be displayed manually or automatically
    $stories_feed = get_sub_field('display_stories');

    // Getting the main title and content
    $content = get_sub_field('content');
    $subtitle = $content['subtitle'];
    $title = $content['title'];
    $copy = $content['copy'];
    $image = $content['image'];
    $buttons = $content['button'];

    // Getting the first slide title for the stats slider
    $stats = get_sub_field('stats');
    $stats_title = $stats[0]['title'];

    $spacing_classes = get_spacing_classes(get_sub_field('spacing'));

    // Bundling the classes together adding to layout
    $classes = $layout_view . ' ' . $bg_color . ' ' . $position . ' ' . $spacing_classes;

?>

<div class="layout cta <?php echo $classes; ?>">

    <?php //Display the intro if selected ?>
    <?php include(locate_template('layouts/component-intro.php')); ?>

    <div class="content">

        <?php if ($layout_view == 'cta-slider'): ?>

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

                                        <?php
                                            $title_class = 'h1';

                                            if ($intro and $intro_title) {
                                                $title_class = 'h2';
                                            }
                                        ?>

                                        <p class="subtitle"><?php the_sub_field('subtitle'); ?></p>

                                        <h1 class="<?php echo $headline_size; ?>"><?php the_sub_field('title'); ?></h1>

                                        <?php the_sub_field('copy'); ?>

                                        <?php include(locate_template('layouts/component-button.php')); ?>

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

                        <?php else: ?> <!-- If slide is an image -->

                            <div class="slide">

                                <div class="wrapper">

                                    <div class="col col-text">

                                        <?php
                                            $title_class = 'h1';

                                            if ($intro and $intro_title) {
                                                $title_class = 'h2';
                                            }
                                        ?>

                                        <p class="subtitle"><?php the_sub_field('subtitle'); ?></p>

                                        <h1 class="<?php echo $headline_size; ?>"><?php the_sub_field('title'); ?></h1>

                                        <?php the_sub_field('copy'); ?>

                                        <?php include(locate_template('layouts/component-button.php')); ?>

                                    </div>

                                </div>

                                <div class="image" style="background-image: url(<?php echo get_sub_field('image')['sizes']['large']; ?>)">
                                </div>

                            </div>

                        <?php endif; ?>

                	<?php endwhile; ?>

                <?php endif; ?>

            </div>

        <?php endif; ?>

        <?php if ($layout_view == 'cta-stats'): ?>
            <div class="wrapper">

                <div class="col col-text">

                    <?php
                        $title_class = 'h1';

                        if ($intro and $intro_title) {
                            $title_class = 'h2';
                        }
                    ?>

                    <h1 class="<?php echo $headline_size; ?>"><?php echo $title; ?></h1>

                    <p><?php echo $copy; ?></p>
                    <?php include(locate_template('layouts/component-button.php')); ?>

                    <?php if( have_rows('stats') ): ?>

                        <?php $stats_count = 0; ?>

                        <h4 id="dot-label"><?php echo $stats_title; ?></h4>

                        <ul class="dot-control-list">

                            <?php while( have_rows('stats') ): the_row(); ?>

                                <?php $stats_count++; ?>

                                <li class="dot-control<?php if($stats_count === 1){ echo ' active'; } ?>" data-dot-value="<?php echo $stats_count; ?>" data-dot-label="<?php the_sub_field('title'); ?>"></li>

                            <?php endwhile; ?>

                        </ul>

                    <?php endif; ?>

                </div>

                <?php //Display the cta-numbers if the cta numbers layout is choosen ?>

                <div class="col col-dots">

                    <div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle xsm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle sm" aria-hidden="true"></div>
    				<div class="circle md" aria-hidden="true"></div>
    				<div class="circle md" aria-hidden="true"></div>
    				<div class="circle md" aria-hidden="true"></div>
    				<div class="circle md" aria-hidden="true"></div>

                    <?php if( have_rows('stats') ): ?>

                        <?php $stats_count = 0; ?>

                        <?php while( have_rows('stats') ): the_row(); ?>

                            <?php $stats_count++; ?>

                            <div class="circle lg live main-dot<?php if($stats_count === 1){ echo ' active'; } ?>" data-dot-value="<?php echo $stats_count; ?>">
                                <div class="circle-data">
                                    <p class="h4"><?php the_sub_field('line_one'); ?> <span class="number"><?php the_sub_field('line_two'); ?></span> <?php the_sub_field('line_three'); ?></p>
                                </div>
                            </div>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </div>

            </div>

        <?php endif; ?>

        <?php if ($layout_view == 'cta-image' || $layout_view == 'cta-slider half-slider' || $layout_view == 'cta-videos' || $layout_view == 'cta-stories'): ?>

            <div class="wrapper">

                <div class="col col-text">

                    <?php
                        $title_class = 'h1';

                        if ($intro and $intro_title) {
                            $title_class = 'h2';
                        }
                    ?>

                    <?php if ( $subtitle ): ?>

                        <p class="subtitle"><?php echo $subtitle; ?></p>

                    <?php endif; ?>

                    <h1 class="<?php echo $headline_size; ?>"><?php echo $title; ?></h1>

                    <?php echo $copy; ?>

                    <?php include(locate_template('layouts/component-button.php')); ?>

                </div>

                <?php //Display the cta-videos if layout is choosen ?>
                <?php if ( $layout_view == 'cta-videos' ) : ?>

                    <div class="col">

                        <div class="video-slider">

                            <?php if( have_rows('videos') ): ?>

                            	<?php while( have_rows('videos') ): the_row(); ?>

                                    <?php
                                        // Grabbing the video field
                                        $video = get_sub_field('video');
                                        $cover_image = get_sub_field('cover_image');

                                        if ($cover_image != NULL) {

                                            $video_image = $cover_image['sizes']['large'];

                                        } else {

                                            $video_image = urlToThumbnail($video);

                                        }

                                    ?>

                                    <div class="video-slide" data-label="<?php the_sub_field('title'); ?>">

                                        <div class="video-slide-inner">

                                            <a class="video-slide-item iframe" data-fancybox href="<?php the_sub_field('video', false, false); ?>" style="background-image: url(<?php echo $video_image; ?>);">

                                                <div class="play-btn-outer">

                                                    <div class="play-btn-inner">

                                                        <div class="play-btn">
                                                        </div>

                                                    </div>

                                                </div>

                                            </a>

                                        </div>

                                    </div>

                            	<?php endwhile; ?>

                            <?php endif; ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if ( $layout_view == 'cta-stories' ): ?>

                    <div class="col">

                        <ul class="stories-list">
							<?php // echo $stories_feed; ?>

                            <!-- Stories will be automatically updated here -->
							<?php if ( $stories_feed == 'manual' ): ?>

								<?php $posts = get_sub_field('stories'); ?>
                                <?php $i = 0; ?>
                                <?php if( $posts ): ?>
                                    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                                        <?php setup_postdata($post); ?>

                                        <?php if ( has_post_thumbnail() ): ?>

                                            <?php if ($i === 0 || $i === 2): ?>
                                                <li>
                                            <?php endif; ?>

                                                <a href="<?php the_permalink(); ?>" class="card" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">

                                                    <div class="story-content">

                                                        <h2 class="h4"><?php the_title(); ?></h2>

                                                    </div>

                                                </a>

                                            <?php if ($i === 1 || $i === 3): ?>
                                                </li>
                                            <?php endif; ?>

                                            <?php $i++; ?>

                                        <?php endif; // Post must have a thumbnail to display ?>

                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                                <?php endif; ?>

                            <?php else: ?>

                                <?php
                                    $post_category = get_sub_field('stories_category');
                                    $storyTerm = $post_category->term_id;

                                    // WP_Query arguments
                                    $args = array(
                                        'post_type'			=> 'post',
                                        'cat'               => $storyTerm,
                                    	'posts_per_page'	=> 4,
                                    	'orderby'			=> $stories_feed
                                    );

                                    // The Query
                                    $auto_stories_query = new WP_Query( $args );
                                    $i = 0;
                                 ?>

                                <?php while( $auto_stories_query->have_posts() ) : $auto_stories_query->the_post(); ?>

                                    <?php setup_postdata($auto_stories_query); ?>

                                    <?php if ( has_post_thumbnail() ): ?>

                                        <?php if ($i === 0 || $i === 2): ?>
                                            <li>
                                        <?php endif; ?>

                                            <a href="<?php the_permalink(); ?>" class="card" style="background-image: url(<?php the_post_thumbnail_url(); ?>);">

                                                <div class="story-content">

                                                    <h2 class="h4"><?php the_title(); ?></h2>

                                                </div>

                                            </a>

                                        <?php if ($i === 1 || $i === 3): ?>
                                            </li>
                                        <?php endif; ?>

                                        <?php $i++; ?>

                                    <?php endif; ?>

                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>

                            <?php endif; ?>

                        </ul>
                    </div>

                <?php endif; ?>

            </div>

            <?php if ($layout_view == 'cta-slider half-slider'): ?>

                <div class="col col-slider">

                    <div class="slick-it">

                        <!-- <?php // if( has_post_thumbnail() ): ?>

                            <div class="slide">

                                <div class="image" style="background-image: url(<?php // the_post_thumbnail_url('large'); ?>)">
                                </div>

                            </div>

                        <?php // endif; ?> -->

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

                        <?php endif; ?>

                    </div>

                </div>

            <?php endif; ?>

            <?php //Display the image if the cta-image layout is choosen ?>
            <?php if ($layout_view == 'cta-image'): ?>
                <div class="image" style="background-image: url(<?php echo $image['sizes']['large']; ?>);"></div>
            <?php endif; ?>
        <?php endif; ?>

    </div>

</div>
