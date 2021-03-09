<?php
    $table_orientation = get_sub_field('table_orientation');

    $i = '0';
    $x = '0';

    while( have_rows('dataset') ): the_row();
        $x++;
    endwhile;

    $spacing_classes = get_spacing_classes(get_sub_field('spacing'));
    
?>

<div class="layout tables <?php echo $spacing_classes; ?>">
    <div class="wrapper">
        <div class="content">
            <!-- <?php echo $table_orientation; ?> oriented table -->
            <div class="Rtable Rtable--<?php echo $x; ?>cols Rtable--collapse">

            <?php if( have_rows('dataset') ) : while( have_rows('dataset') ): the_row(); ?>

                <div class="Rtable-cell"><h5 class="heading"><?php the_sub_field('heading'); ?></h5></div>
                <?php if( have_rows('data') ) : while( have_rows('data') ): the_row(); ?>
                    <?php if ($table_orientation == 'columns') {
                        $i++;
                        $order = ' style="order: ' . $i . ';"';
                    } ?>
                    <div class="Rtable-cell"<?php echo $order; ?>><?php the_sub_field('item'); ?></div>

                <?php endwhile; $i = '0'; endif; ?>

            <?php endwhile; endif; ?>

            </div>
        </div>
    </div>
</div>
