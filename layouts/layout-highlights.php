<?php
    $layout_view = get_sub_field('layout_view');
	$hover = get_sub_field('hover_effect');
	if ($hover) {
		$hoverClass = 'class="hover"';
	} else {
		$hoverClass = NULL;
    }
    $spacing_classes = get_spacing_classes(get_sub_field('spacing'));
?>

<?php if ($layout_view == 'highlight_logos'): ?>
    <section class="layout highlights logo-list slider <?php echo $spacing_classes; ?>">

        <?php //Display the intro if selected ?>
        <?php include(locate_template('layouts/component-intro.php')); ?>

        <div class="wrapper slide-wrapper">
            <div class="content">
                <ul class="logos logos-slider">
                    <?php if( have_rows('logo') ): ?>

                        <?php while( have_rows('logo') ): the_row(); ?>

                            <?php
                                $link = get_sub_field('link');
                                $image = get_sub_field('image');

                            ?>

                            <?php if ( $image ) : ?>

                                <li class="logo">
									<?php if ($link): ?>
										<a href="<?php echo $link; ?>" target="_blank">
									<?php else: ?>
										<div class="logo-wrapper">
									<?php endif; ?>
											<img <?php echo $hoverClass; ?> src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
									<?php if ($link): ?>
										</a>
									<?php else: ?>
										</div>
									<?php endif; ?>

								</li>

                            <?php endif; ?>

                        <?php endwhile; ?>

                    <?php endif; ?>

                </ul>

                <?php include(locate_template('layouts/component-button.php')); ?>

                <!-- <a href="#" class="btn">See All Allies</a> -->
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($layout_view == 'highlight_resources'): ?>
    <section class="layout resources <?php echo $spacing_classes; ?>">

        <?php //Display the intro if selected ?>
        <?php include(locate_template('layouts/component-intro.php')); ?>

        <div class="wrapper">
            <div class="content">

                <?php
                    $resourceLink = get_sub_field('2-1-1_link');
                    $resourceLogo = get_sub_field('2-1-1_logo')['sizes']['medium'];
                    $resourceLogoAlt = get_sub_field('2-1-1_logo')['alt'];
                ?>

                <?php if ($resourceLink): ?>
                    <a href="<?php echo $resourceLink['url']; ?>" target="<?php echo $resourceLink['target']; ?>">
                <?php endif; ?>
                    <img class="logo-211" src="<?php echo $resourceLogo; ?>" alt="<?php echo $resourceLogoAlt; ?>">
                <?php if ($resourceLink): ?>
                    </a>
                <?php endif; ?>

                <ul class="resource-list">

                    <?php $posts = get_sub_field('resources'); ?>

                    <?php if( $posts ): ?>
                        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                            <?php setup_postdata($post); ?>

                            <?php $icon = get_field('icon'); ?>

                            <?php if ( $icon ) : ?>

                                <li class="resource">

                                    <a href="<?php the_field('link'); ?>" target="_blank">

                                        <div class="icon">

                                            <?php include(locate_template('inc/icons/' . $icon . '.svg')); ?>

                                        </div>

                                        <h3 class="h4"><?php the_title(); ?></h3>
                                    </a>

                                </li>

                            <?php endif; ?>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    <?php endif; ?>

                </ul>

                <?php include(locate_template('layouts/component-button.php')); ?>

                <!-- <a href="#" class="btn">See All Resources</a> -->
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($layout_view == 'highlight_allies'): ?>
    <section class="layout highlights logo-list slider <?php echo $spacing_classes; ?>">

        <?php //Display the intro if selected ?>
        <?php include(locate_template('layouts/component-intro.php')); ?>

        <div class="wrapper slide-wrapper">
            <div class="content">
                <ul class="logos logos-slider">

                    <?php $posts = get_sub_field('allies'); ?>
                    <?php if( $posts ): ?>
                        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                            <?php setup_postdata($post); ?>

                            <?php
                                $logo = get_field('logo');
                                $link = get_field('link');
                            ?>

                            <?php if ( $logo ) : ?>

                                <li class="logo"><a href="<?php echo $link['url']; ?>" target="_blank"><img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"></a></li>

                            <?php endif; ?>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    <?php endif; ?>

                </ul>

                <?php include(locate_template('layouts/component-button.php')); ?>

            </div>

        </div>

    </section>

<?php endif; ?>

<?php if ($layout_view == 'highlight_partners'): ?>
    <section class="layout highlights logo-list slider <?php echo $spacing_classes; ?>">

        <?php //Display the intro if selected ?>
        <?php include(locate_template('layouts/component-intro.php')); ?>

        <div class="wrapper slide-wrapper">
            <div class="content">
                <ul class="logos logos-slider">

                    <?php $posts = get_sub_field('partners'); ?>
                    <?php if( $posts ): ?>
                        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                            <?php setup_postdata($post); ?>

                            <?php
                                $logo = get_field('logo');
                                $link = get_field('link');
                            ?>

                            <?php if ( $logo ) : ?>

                                <li class="logo"><a href="<?php the_field('link'); ?>" target="_blank"><img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"></a></li>

                            <?php endif; ?>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    <?php endif; ?>

                </ul>

                <?php include(locate_template('layouts/component-button.php')); ?>

            </div>

        </div>

    </section>

<?php endif; ?>
