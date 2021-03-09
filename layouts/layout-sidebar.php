<?php
    // $basic_content = get_sub_field('basic_content');
    $layout_view = 'sidebar';
	$dropdownTitle = get_sub_field('dropdown_title');
	$spacing_classes = get_spacing_classes(get_sub_field('spacing'));
?>

<section class="layout sidebar <?php echo $spacing_classes; ?>">

    <?php //Display the intro if selected?>
    <?php include(locate_template('layouts/component-intro.php')); ?>

    <?php // if ($basic_content) :?>

	<?php if (have_rows('sidebar_item')): ?>

		<div class="wrapper">

            <div class="content grid">

				<ul class="col sidebar-nav dropdown-item">

					<li class="open-dropdown title"><span><?php echo $dropdownTitle; ?> +</span></li>

					<ul class="dropdown dropdown-content">

                        <?php $i = 1; ?>

						<?php while (have_rows('sidebar_item')): the_row(); ?>

							<?php $sidebar_link = get_sub_field('title'); ?>

                            <li class="sidebar-nav-item<?php if ($i == 1): ?> active<?php endif; ?>" data-sidebar="<?php echo $i; ?>">
								<a class="sidebar-nav-link" href="#<?php echo sanitize_title_with_dashes($sidebar_link); ?>"><h5 class="title"><?php echo $sidebar_link; ?></h5></a>
							</li>

                            <?php $i++; ?>

						<?php endwhile; ?>

					</ul>

				</ul>

				<ul class="col sidebar-content">

                    <?php $i = 1; ?>

					<?php while (have_rows('sidebar_item')): the_row(); ?>

						<?php
                            $sidebar_link = get_sub_field('title');
                        ?>

						<li class="sidebar-content-item<?php if ($i == 1): ?> active<?php endif; ?>" data-sidebar="<?php echo $i; ?>">

							<h5 class="title"><?php echo $sidebar_link; ?></h5>

							<?php the_sub_field('content'); ?>

						</li>

                        <?php $i++; ?>

					<?php endwhile; ?>

				</ul>

			</div>

		</div>

	<?php endif; ?>

</section>
