<?php if(have_rows('layouts')) : $i = 0; ?>

    <?php while (have_rows('layouts')) : the_row(); $i++; ?>

        <?php $layout_type = get_row_layout(); ?>
        <?php include(locate_template('layouts/layout-' . $layout_type . '.php')); ?>

    <?php endwhile; ?>

<?php endif; ?>
