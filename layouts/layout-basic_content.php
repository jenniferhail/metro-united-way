<?php
    $basic_content = get_sub_field('basic_content');
    $layout_view = 'basic-content';
    $spacing_classes = get_spacing_classes(get_sub_field('spacing'));
?>

<section class="layout basic-content <?php echo $spacing_classes; ?>">
    <?php //Display the intro if selected ?>
    <?php include(locate_template('layouts/component-intro.php')); ?>
    <?php if ($basic_content) : ?>
        <div class="wrapper">
            <div class="content">
                <?php echo $basic_content; ?>
				<?php include(locate_template('layouts/component-share.php')); ?>
                <?php include(locate_template('layouts/component-button.php')); ?>
            </div>
        </div>
	<?php else: ?>
		<div class="wrapper">
            <div class="content">
				<?php include(locate_template('layouts/component-share.php')); ?>
                <?php include(locate_template('layouts/component-button.php')); ?>
            </div>
        </div>
    <?php endif; ?>
</section>
