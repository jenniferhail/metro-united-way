<?php

    // Getting the intro setting and title
    $intro = get_sub_field('display_intro');
    $title_color = get_sub_field('title_color');
    $intro_title = get_sub_field('intro_title');
    $intro_subtitle = get_sub_field('intro_subtitle');

?>

<?php if ($intro): ?>

    <div class="intro-updated">

        <div class="wrapper">

            <!-- <div class="content"> -->

                <h1 class="<?php echo $title_color; ?>"><?php echo $intro_title; ?></h1>

                <?php if ($intro_subtitle): ?>

                    <p><?php echo $intro_subtitle; ?></p>

                <?php endif; ?>

            <!-- </div> -->

        </div>

    </div>

<?php endif; ?>

