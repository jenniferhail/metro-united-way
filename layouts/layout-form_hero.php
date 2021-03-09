<?php
    $style = get_sub_field('style'); // Echo a value
    $position = get_sub_field('form_position');
    $bgImg = get_sub_field('bg_image'); // Make required
    $form = get_sub_field('form_code');
    $content = get_sub_field('content');
    $margin = get_sub_field('content_margin');
    if ($margin) {
        $margin = 'style="' . $margin['side'] . ': ' . $margin['amount'] . 'px"';
    } else {
        $margin = NULL;
    }
?>

<section class="layout form-hero <?php echo $style; ?> <?php echo $position; ?>" style="background-image: url('<?php echo esc_url($bgImg['url']); ?>')">
    <div class="wrapper">
        <div class="form-wrapper">
            <?php echo $form; ?>
        </div>
        <?php if ($content) : ?>
            <div class="content-wrapper" <?php echo $margin; ?>>
                <div class="content">
                    <?php echo $content; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>