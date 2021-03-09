<?php
    $display_intro = get_sub_field('display_intro');
    $title = get_sub_field('title');
    $subtitle = get_sub_field('subtitle');
    $spacing_classes = get_spacing_classes(get_sub_field('spacing'));
?>

<div class="layout accordion <?php echo $spacing_classes; ?>">
    <div class="wrapper">
        <div class="content">

            <?php if ($display_intro): ?>
                <div class="intro">
                    <h2 class="title"><?php echo $title; ?></h2>
                    <?php if ($subtitle): ?>
                        <p class="subtitle"><?php echo $subtitle; ?></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if( have_rows('acc_item') ): ?>
            	<ul class="acc-list">
            	<?php while( have_rows('acc_item') ): the_row(); ?>

            		<li class="acc-item">
                        <h3 class="title"><?php the_sub_field('title'); ?></h3>
                        <div class="acc-content">
                            <div class="acc-content-wrapper">
                                <?php the_sub_field('content'); ?>
                                <?php include(locate_template('layouts/component-button.php')); ?>
                            </div>
                        </div>
            		</li>

            	<?php endwhile; ?>
            	</ul>
            <?php endif; ?>

        </div>
    </div>
</div>
