<?php
    $template_url = get_template_directory_uri();

    // Getting the type of CTA and the background color
    $layout_view = get_sub_field('layout_view');
    $content_type = get_sub_field('content_type');
    $slider_options = get_sub_field('slider_options');
    $show_images = get_sub_field('show_images');
    $spacing_classes = get_spacing_classes(get_sub_field('spacing'));

    // Bundling the classes together adding to layout
    $classes = $layout_view . ' ' . $content_type . ' ' . $slider_options . ' ' . $spacing_classes;
?>

<?php if ($layout_view == 'cards_tall'): ?>

    <section class="layout selectors <?php echo $classes; ?> <?php echo(is_front_page()) ? 'home' : ''; ?>">

        <?php //Display the intro if selected?>
        <?php include(locate_template('layouts/component-intro.php')); ?>

        <div class="wrapper">

            <div class="content">

                <ul class="cards">

                    <?php if ($content_type == 'custom_content'): ?>

                        <?php if (have_rows($content_type)): ?>

                            <?php while (have_rows($content_type)): the_row(); ?>

                                <?php
                                    $link = get_sub_field('link');

                                    $image = get_sub_field('image');
                                    $image_url = $image['sizes']['large'];
                                ?>

                                <li class="selector">

									<?php if ($link): ?>
										<a class="card" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>" style="background-image: url(<?php echo $image_url; ?>);">
									<?php else: ?>
										<div class="card" style="background-image: url(<?php echo $image_url; ?>);">
									<?php endif; ?>

                                        <div class="card-center">

                                            <h2 class="h3"><?php the_sub_field('title'); ?></h2>

                                            <div class="card-hover">

                                                <p><?php the_sub_field('copy'); ?></p>

												<?php if ($link): ?>
													<span class="btn"><?php echo $link['title']; ?></span>
												<?php endif; ?>

                                            </div>

                                        </div>

									<?php if ($link): ?>
										</a>
									<?php else: ?>
										</div>
									<?php endif; ?>

                                </li>

                            <?php endwhile; ?>


                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if ($content_type == 'available_content'): ?>

                        <?php $posts = get_sub_field($content_type); ?>

                        <?php if ($posts): ?>

                            <?php foreach ($posts as $post): // variable must be called $post (IMPORTANT)?>

                                <?php setup_postdata($post); ?>

                                <?php
                                    $job_title = get_field('job_title');
                                    $email = get_field('email');
                                    $excerpt = get_field('excerpt');
                                ?>

                                <li class="selector">

                                    <a class="card" href="<?php the_permalink(); ?>" style="background-image: url(<?php the_post_thumbnail_url('large'); ?>);">

                                        <div class="card-center">

                                            <h2 class="h3"><?php the_title(); ?></h2>

                                            <div class="card-hover">

                                                <?php if ($excerpt): ?>

                                                    <p><?php echo $excerpt; ?></p>

                                                <?php else: ?>

                                                    <p><?php the_excerpt_max_charlength(100); ?></p>

                                                <?php endif; ?>

                                                <span class="btn">Learn More</span>

                                            </div>

                                        </div>

                                    </a>

                                </li>

                            <?php endforeach; ?>

                            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly?>

                        <?php endif; ?>

                    <?php endif; ?>

                </ul>

                <?php include(locate_template('layouts/component-button.php')); ?>

            </div>

        </div>

    </section>

<?php endif; ?>

<?php if ($layout_view == 'cards_small'): ?>

    <section class="layout blog cards <?php echo $classes; ?>">

        <?php //Display the intro if selected?>
        <?php include(locate_template('layouts/component-intro.php')); ?>

        <div class="wrapper">

            <div class="content">

                <ul class="card-slider">

                    <?php if ($content_type == 'custom_content'): ?>
                        <?php if (have_rows($content_type)): ?>

                            <?php while (have_rows($content_type)): the_row(); ?>

                                <?php
                                    $link = get_sub_field('link');

                                    // if ( $link['url'] ) {
                                    //     $link_class = 'has-btn';
                                    // }

                                    $image = get_sub_field('image');
                                    $image_url = $image['sizes']['large'];
                                ?>

                                <?php if ($link): ?>
                                    <li class="card has-btn">
                                <?php else: ?>
                                    <li class="card">
                                <?php endif; ?>

                                    <div class="card-content">

                                        <?php if ($show_images): ?>

											<?php if ($link): ?>
												<a class="card-link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
											<?php else: ?>
												<div class="card-link">
											<?php endif; ?>

												<div class="card-image" style="background-image: url(<?php echo $image_url; ?>);"></div>

											<?php if ($link): ?>
												</a>
											<?php else: ?>
												</div>
											<?php endif; ?>

                                        <?php endif; ?>

                                        <div class="card-text">

                                            <h2 class="h3"><?php the_sub_field('title'); ?></h2>

                                            <p class="p"><?php the_sub_field('copy'); ?></p>

                                            <?php if ($link): ?>

                                                <a class="btn" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a>

                                            <?php endif; ?>

                                        </div>

                                    </div>

                                </li>

                            <?php endwhile; ?>

                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if ($content_type == 'available_content'): ?>

                        <?php $posts = get_sub_field($content_type); ?>

                        <?php if ($posts): ?>

                            <?php foreach ($posts as $post): // variable must be called $post (IMPORTANT)?>

                                <?php setup_postdata($post); ?>

                                <?php
                                    $excerpt = get_field('excerpt');
                                    $job_title = get_field('job_title');
                                    $company = get_field('company');
                                    $email = get_field('email');
                                    $spotlight = get_field('spotlight');

                                    if (get_the_post_thumbnail_url()) {
                                        $image_url = get_the_post_thumbnail_url($post->ID, 'large');
                                    } else {
                                        $image = get_field('image');
                                        $image_url = $image['sizes']['large'];
                                    }
                                ?>

                                <?php if ($post->post_type == 'muw_people') : ?>

                                    <li class="card card-person">

                                        <div class="card-content">

                                            <?php if ($show_images): ?>

                                                <div class="card-image" style="background-image: url(<?php echo $image_url; ?>);"></div>

                                            <?php endif; ?>

                                            <div class="card-text">

                                                <div class="card-text-top">

                                                    <h2 class="h3"><?php the_title(); ?></h2>

                                                    <?php if ($job_title): ?>

                                                        <p class="p"><?php echo $job_title; ?></p>

                                                    <?php endif; ?>

                                                    <?php if ($company): ?>

                                                        <p class="p"><?php echo $company; ?></p>

                                                    <?php endif; ?>

                                                </div>

                                                <?php if ($email or $spotlight): ?>

                                                    <div class="buttons">

                                                        <?php if ($email): ?>

                                                            <a class="card-button" href="mailto:<?php echo $email; ?>" alt="Send a message to <?php echo the_title(); ?>"><i class="fal fa-envelope"></i></a>

                                                        <?php endif; ?>

                                                        <?php if ($spotlight): ?>

                                                            <a class="card-button" href="<?php the_permalink(); ?>" alt="Read about our featured employee <?php echo the_title(); ?>">

                                                                <?php include(locate_template('inc/icons/employee-spotlight.svg')); ?>

                                                            </a>

                                                        <?php endif; ?>

                                                    </div>

                                                <?php endif; ?>

                                            </div>

                                        </div>

                                    </li>

                                <?php else: ?>

                                    <li class="card has-btn">

                                        <div class="card-content">

                                            <?php if ($show_images): ?>

                                                <a class="card-link" href="<?php the_permalink(); ?>"><div class="card-image" style="background-image: url(<?php echo $image_url; ?>);"></div></a>

                                            <?php endif; ?>

                                            <div class="card-text">

                                                <h2 class="h3"><?php the_title(); ?></h2>

                                                <?php if ($excerpt): ?>

        											<p class="p"><?php echo $excerpt; ?></p>

        										<?php else : ?>

        											<p class="p"><?php the_excerpt_max_charlength(100); ?></p>

                                                <?php endif; ?>

                                                <a class="btn" href="<?php the_permalink(); ?>">Learn More</a>

                                            </div>

                                        </div>

                                    </li>

                                <?php endif; ?>

                            <?php endforeach; ?>

                            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly?>

                        <?php endif; ?>

                    <?php endif; ?>

                </ul>

                <?php include(locate_template('layouts/component-button.php')); ?>

            </div>

        </div>

    </section>

<?php endif; ?>
