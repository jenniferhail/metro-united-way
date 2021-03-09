<?php if ( $layout_view == 'basic-content' || $layout_view == 'cta-slider' || $layout_view == 'cards_tall' || $layout_view == 'cards_small' || $layout_view == 'highlight_logos' || $layout_view == 'highlight_resources' || $layout_view == 'highlight_allies' || $layout_view == 'highlight_partners' ): ?>

    <?php if (get_sub_field('display_button')): ?>

        <?php $display_button = get_sub_field('display_button'); ?>

    <?php else: ?>

        <?php $display_button = get_field('display_button'); ?>

    <?php endif; ?>

    <?php if ( $display_button ) : ?>

        <?php if ( have_rows('button') ) : ?>

            <div class="buttons">

                <?php while( have_rows('button') ) : the_row(); ?>

                <?php
                    $link = get_sub_field('link');

                    if ($link) {

                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'];

                        if ($link_target == NULL) {

                            $link_target = '_self';

                        }

                        echo '<a href="' . $link_url . '" target="' . $link_target . '" class="btn">' . $link_title . '</a>';

                    }

                ?>

                <?php endwhile; ?>

            </div>

        <?php endif; ?>

    <?php endif; ?>

<?php else: ?>

    <?php if (isset($content) && is_array($content) && $content['display_button']): ?>

        <div class="buttons">

            <?php foreach ($buttons as $button): ?>

            <?php
                if ($button['link']) {
                    $button_target = $button['link']['target'];

                    if ($button_target == NULL) {
                        $button_target = '_self';
                    }
                    echo '<a href="' . $button['link']['url'] . '" target="' . $button_target . '" class="btn">' . $button['link']['title'] . '</a>';
                }
            ?>

            <?php endforeach; ?>
            <?php $buttons = ''; ?>
            <?php $content = ''; ?>

        </div>

    <?php endif; ?>

<?php endif; ?>
