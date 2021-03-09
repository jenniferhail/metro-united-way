<?php get_header(); ?>

<?php $page_404 = get_field('page_404', 'option'); ?>

    <section class="layout basic-content">

        <div class="intro-updated">

            <div class="wrapper">

                <h1><?php echo $page_404['headline']; ?></h1>

                <p><?php echo $page_404['copy']; ?></p>

            </div>

        </div>

        <?php if ( $page_404['link'] ): ?>

            <div class="wrapper">

                <div class="content">

                    <div class="buttons">

                        <a href="<?php echo $page_404['link']['url']; ?>" target="<?php echo $page_404['link']['target']; ?>" class="btn"><?php echo $page_404['link']['title']; ?></a>

                    </div>

                </div>

            </div>

        <?php endif; ?>

    </section>

<?php get_footer(); ?>
