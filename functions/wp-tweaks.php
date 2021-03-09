<?php

    //======================================================================
	// Gravity Forms Custom Loading Spinner
    //======================================================================
    add_filter( 'gform_ajax_spinner_url', 'spinner_url', 10, 2 );
    function spinner_url( $image_src, $form ) {
        return get_template_directory_uri() . '/app/assets/img/loading.gif';
    }

	//======================================================================
	// ADDING FACETWP SUPPORT FOR WP QUERY
	//======================================================================
	add_filter( 'facetwp_is_main_query', function( $bool, $query ) {
		return ( true === $query->get( 'facetwp' ) ) ? true : $bool;
    }, 10, 2 );
    
	//======================================================================
	// ADDING FACETWP SUPPORT FOR ACF RELATIONSHIP FIELDS
	//======================================================================
    function my_searchwp_acf_relationship_processor( $customFieldValue, $customFieldName, $thePost ){
        // The following indexes all content for the listing layout
        // Because content is selected by button, not the relationship ACF field
        $content_to_index = '';
        if ( 'partner_filter' == $customFieldName ) {
            $partner_filter = $customFieldValue[0];
        }
        preg_match( '/^layouts_\d+_post_type/i', $customFieldName, $matches );
        if( 'post_type' == $customFieldName || ( ! empty( $matches ) && is_array( $customFieldValue ) && ! empty( $customFieldValue ) ) ){
            $post_type = $customFieldValue[0];
        
            if ($post_type == 'post') {
                // define the query here
                $args = array(
                    'post_type'	=> 'post',
                    'nopaging' => true,
                );
            } else if ($post_type == 'muw_program') {
                // define the query here
                $args = array(
                    'post_type'	=> 'muw_program',
                    'nopaging' => true,
                );
            } else if ($post_type == 'muw_events') {
                // define the query here
                $args = array(
                    'post_type'	=> 'muw_events',
                    'nopaging' => true,
                );
            } else if ($post_type == 'muw_allies') {
                // define the query here
                $args = array(
                    'post_type'	=> 'muw_allies',
                    'nopaging' => true,
                );
            } else if ($post_type == 'muw_partners') {
                // define the query here
                // has option to filter by taxonomy, muw_partner_types
                // otherwise, display all
                if ( $partner_filter != '' ) {
                    $args = array(
                        'post_type'	=> 'muw_partners',
                        'nopaging' => true,
                        'tax_query' => array(
                        	array(
                        		'taxonomy' => 'muw_partner_types',
                        		'field' => 'id',
                        		'terms' => $partner_filter
                        	)
                        )
                    );
                } else {
                    $args = array(
                        'post_type'	=> 'muw_partners',
                        'nopaging' => true,
                    );
                }
            }
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $listing_title = get_the_title();
                    $content_to_index .= $listing_title . ' ';
                endwhile;
            endif; 
            return $content_to_index;
            wp_reset_postdata();
        }
        
        // This part indexes the relationship fields for SearchWP
        preg_match( '/^layouts_\d+_available_content/i', $customFieldName, $matches );
        if( ! empty( $matches ) && is_array( $customFieldValue ) && ! empty( $customFieldValue ) ){
            // We want to index Titles not IDs
            foreach( $customFieldValue[0] as $post_id ){
                $post_title = get_the_title( absint( $post_id ) );
                $content_to_index .= $post_title . ' ';
            }
            return $content_to_index;
        }
        return $customFieldValue;
    }
    add_filter( 'searchwp_custom_fields', 'my_searchwp_acf_relationship_processor', 10, 3 );

	//======================================================================
	// ADDING SUPPORT FOR ACCESSIBLITY
	//======================================================================
	function facet_stuff() {
		return TRUE;
	}
	add_filter('facetwp_load_a11y', 'facet_stuff');

	//======================================================================
	// CUSTOMIZING VALUES IN THE POST TYPE FACET ON THE SEARCH PAGE
	//======================================================================
	add_filter( 'facetwp_index_row', function( $params, $class ) {
	    if ( 'post_type' == $params['facet_name'] ) {
			$excluded_terms = array( 'muw_people', 'muw_events', 'muw_resources', 'muw_allies', 'muw_partners', 'page' );
			if ( in_array( $params['facet_value'], $excluded_terms ) ) {
				return false;
			}
	    }
	    return $params;
	}, 10, 2 );

	//======================================================================
    // ADDING LABELS TO FACETWP
    //======================================================================
    function fwp_add_facet_labels() {
    ?>
    <script>
    (function($) {
        $(document).on('facetwp-loaded', function() {
            $('.facetwp-facet').each(function() {
                var $facet = $(this);
                var facet_name = $facet.attr('data-name');
                var facet_label = FWP.settings.labels[facet_name];

                if ($facet.closest('.facet-wrap').length < 1 && $facet.closest('.facetwp-flyout').length < 1) {
                    $facet.wrap('<div class="facet-wrap"></div>');
                    $facet.before('<h3 class="h6 facet-label">' + facet_label + '</h3>');
                }
            });
        });
    })(jQuery);
    </script>
    <?php
    }
    add_action( 'wp_footer', 'fwp_add_facet_labels', 100 );

	//======================================================================
	// FACETWP - ADDING SUBMIT BUTTON TO FACETWP
	//======================================================================
	add_action('wp_footer', 'add_facetwp_submit', 100);

	function add_facetwp_submit() {
	?>
	<script>(function($) {
	$(document).on('facetwp-loaded', function() {
	   $('.facetwp-search-wrap').each(function() {
		   if ($(this).find('.facetwp-search-submit').length < 1) {
			   $(this).find('.facetwp-search').after('<button onclick="FWP.reset()">Reset</button>');
			   $(this).find('.facetwp-search').after('<button class="facetwp-search-submit" onclick="FWP.refresh()">Submit</button>');
		   }
	   });
	});
	})(jQuery);
	</script>
	<?php
	}

    //======================================================================
    // NUMERIC SEARCH NAVIGATION
    //======================================================================
    function numeric_posts_nav() {

        if( is_singular() )
            return;

        global $wp_query;

        /** Stop execution if there's only 1 page */
        if( $wp_query->max_num_pages <= 1 )
            return;

        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $max   = intval( $wp_query->max_num_pages );

        /** Add current page to the array */
        if ( $paged >= 1 )
            $links[] = $paged;

        /** Add the pages around the current page to the array */
        if ( $paged >= 3 ) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if ( ( $paged + 2 ) <= $max ) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        }

        echo '<div class="navigation"><ul>' . "\n";

        /** Previous Post Link */
        if ( get_previous_posts_link() )
            printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

        /** Link to first page, plus ellipses if necessary */
        if ( ! in_array( 1, $links ) ) {
            $class = 1 == $paged ? ' class="active"' : '';

            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

            if ( ! in_array( 2, $links ) )
                echo '<li>…</li>';
        }

        /** Link to current page, plus 2 pages in either direction if necessary */
        sort( $links );
        foreach ( (array) $links as $link ) {
            $class = $paged == $link ? ' class="active"' : '';
            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
        }

        /** Link to last page, plus ellipses if necessary */
        if ( ! in_array( $max, $links ) ) {
            if ( ! in_array( $max - 1, $links ) )
                echo '<li>…</li>' . "\n";

            $class = $paged == $max ? ' class="active"' : '';
            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
        }

        /** Next Post Link */
        if ( get_next_posts_link() )
            printf( '<li>%s</li>' . "\n", get_next_posts_link() );

        echo '</ul></div>' . "\n";

    }

    //======================================================================
    // ADDING SVG SUPPORT TO MEDIA LIBRARY
    //======================================================================
    add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

      global $wp_version;
      if ( $wp_version !== '4.7.1' ) {
         return $data;
      }

      $filetype = wp_check_filetype( $filename, $mimes );

      return [
          'ext'             => $filetype['ext'],
          'type'            => $filetype['type'],
          'proper_filename' => $data['proper_filename']
      ];

    }, 10, 4 );

    function cc_mime_types( $mimes ){
      $mimes['svg'] = 'image/svg+xml';
      return $mimes;
    }
    add_filter( 'upload_mimes', 'cc_mime_types' );

    function fix_svg() {
      echo '<style type="text/css">
            .attachment-266x266, .thumbnail img {
                 width: 100% !important;
                 height: auto !important;
            }
            </style>';
    }
    add_action( 'admin_head', 'fix_svg' );

    //======================================================================
    // CUSTOM EXCERPT
    //======================================================================
    function the_excerpt_max_charlength($charlength) {
    	$excerpt = get_the_excerpt();
    	$charlength++;

    	if ( mb_strlen( $excerpt ) > $charlength ) {
    		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
    		$exwords = explode( ' ', $subex );
    		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
    		if ( $excut < 0 ) {
    			echo mb_substr( $subex, 0, $excut );
    		} else {
    			echo $subex;
    		}
    		echo '[...]';
    	} else {
    		echo $excerpt;
    	}
    }

    //======================================================================
    // ACF GOOGLE MAPS SUPPORT
    //======================================================================
    function my_acf_init() {
    	acf_update_setting('google_api_key', 'AIzaSyAhDvWLmsXmje_TGx9_18vma26r8avbjqk');
    }

    add_action('acf/init', 'my_acf_init');

    // function custom_excerpt_length( $length ) {
    //     return 20;
    // }
    // add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

    //======================================================================
    // REPLACE EXCERPT
    //======================================================================
    // Replaces the excerpt "Read More" text with a link
    // function new_excerpt_more($more) {
    //        global $post;
    // 	return '<a class="moretag" href="'. get_permalink($post->ID) . '"> ...read more.</a>';
    // }
    // add_filter('excerpt_more', 'new_excerpt_more');

    //======================================================================
    // SPEED UP ACF
    //======================================================================
    // Drastically speed up the load times of the post edit page!
    add_filter('acf/settings/remove_wp_meta_box', '__return_true');

    // =========================================================================
    // ADD RSS LINKS TO HEAD SECTION
    // =========================================================================
    add_theme_support('automatic-feed-links');

    // =========================================================================
    // REMOVE JUNK FROM HEAD AND STUFF
    // =========================================================================
    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_generator'); // remove wordpress version

    remove_action('wp_head', 'feed_links', 2); // remove rss feed links
    remove_action('wp_head', 'feed_links_extra', 3); // remove all extra rss feed links

    remove_action('wp_head', 'index_rel_link'); // remove link to index page
    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

    remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
    remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
    remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

    remove_action('wp_head', 'rest_output_link_wp_head'); // remove JSON link from head
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

    // =========================================================================
    // REGISTERING SIDEBAR
    // =========================================================================
    // if (function_exists('register_sidebar')) {
    //     register_sidebar(array(
    //         'name' => 'Sidebar Widgets',
    //         'id'   => 'sidebar-widgets',
    //         'description'   => 'These are widgets for the sidebar.',
    //         'before_widget' => '<div id="%1$s" class="widget %2$s">',
    //         'after_widget'  => '</div>',
    //         'before_title'  => '<h2>',
    //         'after_title'   => '</h2>'
    //     ));
    // }

    // =========================================================================
    // HIDE ADMIN BAR ON FRONTEND
    // =========================================================================
    // This is not recommended by default
    ## add_filter('show_admin_bar', '__return_false');

    // =========================================================================
    // ENABLES FEATURED IMAGES FOR PAGES AND POSTS
    // =========================================================================
    // This enables post thumbnails for all post types,
    // if you want to enable this feature for specific post types,
    // use the array to include the type of post
    ## add_theme_support('post-thumbnails', array('post', 'page'));
    add_theme_support('post-thumbnails');

    // =========================================================================
    // ENABLES 100% JPEG QUALITY
    // =========================================================================
    // Wordpress will compress uploads to 90% of their original size
    add_filter( 'jpg_quality', 'high_jpg_quality' );
        function high_jpg_quality() {
        return 100;
    }

    // =========================================================================
    // TITLE TAG - RECOMMENDED
    // =========================================================================
    // Since Version 4.1, themes should use add_theme_support() in the functions.php
    // file in order to support title tag
    function theme_slug_setup() {
       add_theme_support( 'title-tag' );
    }
    add_action( 'after_setup_theme', 'theme_slug_setup' );

    // =========================================================================
    // WORDPRESS CONTENT WIDTH - REQUIRED
    // =========================================================================
    // Since Version 2.6, themes need to specify the $content_width variable

    // Using this feature you can set the maximum allowed width for any content
    // in the theme, like oEmbeds and images added to posts.

    // Using this theme feature, WordPress can scale oEmbed code to a specific
    // size (width) in the front-end, and insert large images without breaking the
    // main content area. Also, using this feature you lay the ground for other
    // plugins to perfectly integrate with any theme, since plugins can access the
    // value stored in $content_width.
    if ( ! isset( $content_width ) ) {
        $content_width = 900;
    }


    // =========================================================================
    // GET VIDEO THUMBNAIL FROM URL
    // =========================================================================
    function urlToThumbnail($video) {

        // Stripping down to URL
        preg_match('/src="(.+?)"/', $video, $matches_url );
        $src = $matches_url[1];

        // Attempting to get Youtube
        preg_match('/embed(.*?)?feature/', $src, $matches_id );
        if ($matches_id != NULL) {
            $id = $matches_id[1];
            $id = str_replace( str_split( '?/' ), '', $id );

             return 'http://img.youtube.com/vi/' . $id . '/maxresdefault.jpg';
             // return 'http://img.youtube.com/vi/' . $id . '/sddefault.jpg';
        } else {
            // Attempting to get Vimeo
            preg_match('/video(.*?)?app_id/', $src, $matches_id );

            $id = $matches_id[1];
            $id = str_replace( str_split( '?/' ), '', $id );

            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));

            return $hash[0]['thumbnail_large'];
        }

    }


    // =========================================================================
    // GET MENU TITLE
    // =========================================================================
    // function getMenuName( $theme_location ) {
    // 	if( ! $theme_location ) return false;
    //
    // 	$menu_obj = getMenuName( $theme_location );
    // 	if( ! $menu_obj ) return false;
    //
    // 	if( ! isset( $menu_obj->name ) ) return false;
    //
    // 	return $menu_obj->name;
    // }

    function getMenuName( $theme_location ) {
    	if( ! $theme_location ) return false;

    	$theme_locations = get_nav_menu_locations();
    	if( ! isset( $theme_locations[$theme_location] ) ) return false;

    	$menu_obj = get_term( $theme_locations[$theme_location], $theme_location );
    	if( ! $menu_obj ) $menu_obj = false;
    	if( ! isset( $menu_obj->name ) ) return false;

    	return $menu_obj->name;
    }


    // =========================================================================
    // REMOVE EMOJI SCRIPTS AND STYLES
    // =========================================================================
	// function wp_disable_emojis() {
	// 	remove_action('wp_head', 'print_emoji_detection_script', 7);
	// 	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	// 	remove_action('wp_print_styles', 'print_emoji_styles');
	// 	remove_action('admin_print_styles', 'print_emoji_styles');
	// 	remove_filter('the_content_feed', 'wp_staticize_emoji');
	// 	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	// 	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	// 	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	// 	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
	// }
	// add_action('init', 'wp_disable_emojis');

	// =========================================================================
	// ADD CUSTOM POST TYPES TO SEARCH RESULTS
	// =========================================================================
	function custom_post_type_search( $query ) {
		if (!is_admin()) {
			$post_types = get_post_types(array('public' => true, 'exclude_from_search' => false), 'objects');
			$searchable_types = array();
			if($post_types) {
				foreach( $post_types as $type) {
					$searchable_types[] = $type->name;
				}
			}
			if ( $query->is_search ) {
				$query->set( 'post_type', $searchable_types );
			}

			return $query;
		}
	}

	add_filter( 'pre_get_posts', 'custom_post_type_search' );

?>
