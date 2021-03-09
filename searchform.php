<form method="get" id="header-search" class="header-search center" action="<?php echo esc_url( home_url( '/search-results/' ) ); ?>">
	<label for="fwp_search" class="text visually-hide-label assistive-text"><?php _e( 'Search' ); ?></label>
	<input type="text" class="search-field" name="fwp_search" id="fwp_search" placeholder="<?php esc_attr_e( 'Search' ); ?>" />
	<input type="submit" class="search-submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search' ); ?>" />
</form>
