<?php get_header(); ?>

<?php
    // Getting the main title and content
    $spotlight = get_field('spotlight');
    $email = get_field('email');
    $job_title = get_field('job_title');
    $company = get_field('company');
    $headline = get_field('headline');
    if (get_the_post_thumbnail_url()) {
        $image_url = get_the_post_thumbnail_url($post->ID, 'large');
    }
    // Getting the intro
    $intro = get_field('display_intro');
    $intro_title = get_field('intro_title');
    $intro_subtitle = get_field('intro_subtitle');
?>

<?php if ( $spotlight ): ?>
    <?php if( has_post_thumbnail() ): ?>
        <section class="layout cta cta-image blue left">
            <div class="content">
                <div class="wrapper">
                    <div class="col col-text">
                        <h1 class="h3"><?php echo $headline; ?></h1>
                        <h2 class="h3"><?php the_title(); ?></h2>
                        <p><?php echo $job_title; ?><br /><?php echo $company; ?></p>
                    </div>
                </div>
                <div class="image" style="background-image: url(<?php echo $image_url; ?>);"></div>
            </div>
        </section>
    <?php endif; ?>
    <section class="layout basic-content">
        <?php if ($intro): ?>
            <div class="intro-updated">
                <div class="wrapper">
                    <h1 class="h2"><?php echo $intro_title; ?></h1>
                    <?php if ($intro_subtitle): ?>
                        <p><?php echo $intro_subtitle; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="wrapper">
            <div class="content">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <!-- Pagination / Link to next spotlight -->
<?php endif; ?>
<?php get_footer(); ?>
