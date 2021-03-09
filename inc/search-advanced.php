<div class="search">

	<?php echo facetwp_display( 'facet', 'search' ); ?>

	<div class="fieldset filter-by-content">

		<div class="search-options">
			<div class="post-type">
				<div class="view-all">
					<div class="facetwp-radio checked" data-value="all">
						All
					</div>
				</div>
				<?php echo facetwp_display( 'facet', 'post_type' ); ?>
			</div>
			<?php echo facetwp_display( 'sort' ); ?>
		</div>

		<div class="advanced-filters">
			<?php echo facetwp_display( 'facet', 'story_categories' ); ?>
			<?php echo facetwp_display( 'facet', 'program_types' ); ?>
		</div>

	</div>

</div>
