<?php
    $images = get_sub_field('gallery');
    $size = 'full'; // (thumbnail, medium, large, full or custom size)
    // $view = Add a view setting
    $spacing_classes = get_spacing_classes(get_sub_field('spacing'));
?>

<div class="layout gallery <?php echo $spacing_classes; ?>">
	<?php //Display the intro if selected?>
    <?php include(locate_template('layouts/component-intro.php')); ?>
    <div class="wrapper">
        <div class="content">
            <?php if ($images): ?>
                <ul class="gallery-list">
                    <?php foreach ($images as $image): ?>
                        <li class="gallery-item" data-id="<?php echo $image['ID']; ?>" data-url="<?php echo $image['url']; ?>">
                        	<?php echo wp_get_attachment_image($image['ID'], $size); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
