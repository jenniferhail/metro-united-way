<?php

// =========================================================================
// REGISTER A NEW CUSTOM POST TYPE
// =========================================================================

// Change dashboard Posts to News
function muw_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'Stories';
        $labels->singular_name = 'Story';
        $labels->add_new = 'Add Story';
        $labels->add_new_item = 'Add Story';
        $labels->edit_item = 'Edit Story';
        $labels->new_item = 'Story';
        $labels->view_item = 'View Story';
        $labels->search_items = 'Search Stories';
        $labels->not_found = 'No Stories found';
        $labels->not_found_in_trash = 'No Stories found in Trash';
        $labels->all_items = 'All Stories';
        $labels->menu_name = 'Stories';
        $labels->name_admin_bar = 'Stories';
}
add_action( 'init', 'muw_change_post_object' );

// Register Custom Post Type
function muw_programs() {

	$labels = array(
		'name'                  => _x( 'Programs', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Program', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Programs', 'text_domain' ),
		'name_admin_bar'        => __( 'Program', 'text_domain' ),
		'archives'              => __( 'Program Archives', 'text_domain' ),
		'attributes'            => __( 'Program Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Program Item:', 'text_domain' ),
		'all_items'             => __( 'All Programs', 'text_domain' ),
		'add_new_item'          => __( 'Add New Program', 'text_domain' ),
		'add_new'               => __( 'Add Program', 'text_domain' ),
		'new_item'              => __( 'New Program', 'text_domain' ),
		'edit_item'             => __( 'Edit Program', 'text_domain' ),
		'update_item'           => __( 'Update Program', 'text_domain' ),
		'view_item'             => __( 'View Program', 'text_domain' ),
		'view_items'            => __( 'View Programs', 'text_domain' ),
		'search_items'          => __( 'Search Programs', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'program',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Program', 'text_domain' ),
		'description'           => __( 'Easy to manage programs for Metro United Way', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( 'muw_program_types' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-star-filled',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);
	register_post_type( 'muw_program', $args );

}
add_action( 'init', 'muw_programs', 0 );

// Register Custom Taxonomy
function muw_program_types() {

	$labels = array(
		'name'                       => _x( 'Program Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Program Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Program Types', 'text_domain' ),
		'all_items'                  => __( 'All Program Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Program Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Program Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'program-types',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'muw_program_types', array( 'muw_program' ), $args );

}
add_action( 'init', 'muw_program_types', 0 );

// Register Custom Post Type
function muw_people() {

	$labels = array(
		'name'                  => _x( 'People', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'People', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'People', 'text_domain' ),
		'name_admin_bar'        => __( 'People', 'text_domain' ),
		'archives'              => __( 'People Archives', 'text_domain' ),
		'attributes'            => __( 'People Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'People Item:', 'text_domain' ),
		'all_items'             => __( 'All People', 'text_domain' ),
		'add_new_item'          => __( 'Add New People', 'text_domain' ),
		'add_new'               => __( 'Add People', 'text_domain' ),
		'new_item'              => __( 'New People', 'text_domain' ),
		'edit_item'             => __( 'Edit People', 'text_domain' ),
		'update_item'           => __( 'Update People', 'text_domain' ),
		'view_item'             => __( 'View People', 'text_domain' ),
		'view_items'            => __( 'View People', 'text_domain' ),
		'search_items'          => __( 'Search People', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'people',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'People', 'text_domain' ),
		'description'           => __( 'Easy to manage people for Metro United Way', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor', 'revisions' ),
		'taxonomies'            => array( 'muw_departments', 'muw_roles', 'muw_committees' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-id-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => false,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
		'query_var'				=> true
	);
	register_post_type( 'muw_people', $args );

}
add_action( 'init', 'muw_people', 0 );

// Register Custom Taxonomy
function muw_departments() {

	$labels = array(
		'name'                       => _x( 'Departments', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Department', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Departments', 'text_domain' ),
		'all_items'                  => __( 'All Departments', 'text_domain' ),
		'parent_item'                => __( 'Parent Department', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Department:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'departments',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'muw_departments', array( 'muw_people' ), $args );

}
add_action( 'init', 'muw_departments', 0 );

// Register Custom Taxonomy
function muw_roles() {

	$labels = array(
		'name'                       => _x( 'Roles', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Role', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Roles', 'text_domain' ),
		'all_items'                  => __( 'All Roles', 'text_domain' ),
		'parent_item'                => __( 'Parent Role', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Role:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'roles',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'muw_roles', array( 'muw_people' ), $args );

}
add_action( 'init', 'muw_roles', 0 );

// Register Custom Taxonomy
function muw_committees() {

	$labels = array(
		'name'                       => _x( 'Committees', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Committee', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Committees', 'text_domain' ),
		'all_items'                  => __( 'All Committees', 'text_domain' ),
		'parent_item'                => __( 'Parent Committee', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Committee:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'committees',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'muw_committees', array( 'muw_people' ), $args );

}
add_action( 'init', 'muw_committees', 0 );

// Register Custom Post Type
function muw_events() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Events', 'text_domain' ),
		'name_admin_bar'        => __( 'Event', 'text_domain' ),
		'archives'              => __( 'Event Archives', 'text_domain' ),
		'attributes'            => __( 'Event Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Event Item:', 'text_domain' ),
		'all_items'             => __( 'All Events', 'text_domain' ),
		'add_new_item'          => __( 'Add New Event', 'text_domain' ),
		'add_new'               => __( 'Add Event', 'text_domain' ),
		'new_item'              => __( 'New Event', 'text_domain' ),
		'edit_item'             => __( 'Edit Event', 'text_domain' ),
		'update_item'           => __( 'Update Event', 'text_domain' ),
		'view_item'             => __( 'View Event', 'text_domain' ),
		'view_items'            => __( 'View Events', 'text_domain' ),
		'search_items'          => __( 'Search Events', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'event',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Event', 'text_domain' ),
		'description'           => __( 'Easy to manage events for Metro United Way', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'taxonomies'            => array( 'muw_events' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'muw_events', $args );

}
add_action( 'init', 'muw_events', 0 );

// Register Custom Taxonomy
function muw_event_types() {

	$labels = array(
		'name'                       => _x( 'Event Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Event Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Event Types', 'text_domain' ),
		'all_items'                  => __( 'All Event Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Event Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Event Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'event-types',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'muw_event_types', array( 'muw_events' ), $args );

}
add_action( 'init', 'muw_event_types', 0 );

// Register Custom Post Type
function muw_resources() {

	$labels = array(
		'name'                  => _x( 'Resources', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Resource', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Resources', 'text_domain' ),
		'name_admin_bar'        => __( 'Resource', 'text_domain' ),
		'archives'              => __( 'Resource Archives', 'text_domain' ),
		'attributes'            => __( 'Resource Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Resource Item:', 'text_domain' ),
		'all_items'             => __( 'All Resources', 'text_domain' ),
		'add_new_item'          => __( 'Add New Resource', 'text_domain' ),
		'add_new'               => __( 'Add Resource', 'text_domain' ),
		'new_item'              => __( 'New Resource', 'text_domain' ),
		'edit_item'             => __( 'Edit Resource', 'text_domain' ),
		'update_item'           => __( 'Update Resource', 'text_domain' ),
		'view_item'             => __( 'View Resource', 'text_domain' ),
		'view_items'            => __( 'View Resources', 'text_domain' ),
		'search_items'          => __( 'Search Resources', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'resource',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Resource', 'text_domain' ),
		'description'           => __( 'Easy to manage resources for Metro United Way', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'muw_resources' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-flag',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'muw_resources', $args );

}
add_action( 'init', 'muw_resources', 0 );

// Register Custom Post Type
function muw_allies() {

	$labels = array(
		'name'                  => _x( 'Allies', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Ally', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Allies', 'text_domain' ),
		'name_admin_bar'        => __( 'Ally', 'text_domain' ),
		'archives'              => __( 'Ally Archives', 'text_domain' ),
		'attributes'            => __( 'Ally Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Ally Item:', 'text_domain' ),
		'all_items'             => __( 'All Allies', 'text_domain' ),
		'add_new_item'          => __( 'Add New Ally', 'text_domain' ),
		'add_new'               => __( 'Add Ally', 'text_domain' ),
		'new_item'              => __( 'New Ally', 'text_domain' ),
		'edit_item'             => __( 'Edit Ally', 'text_domain' ),
		'update_item'           => __( 'Update Ally', 'text_domain' ),
		'view_item'             => __( 'View Ally', 'text_domain' ),
		'view_items'            => __( 'View Allies', 'text_domain' ),
		'search_items'          => __( 'Search Allies', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'ally',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Ally', 'text_domain' ),
		'description'           => __( 'Easy to manage allies for Metro United Way', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'muw_allies' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-flag',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'muw_allies', $args );

}
add_action( 'init', 'muw_allies', 0 );

// Register Custom Taxonomy
function muw_ally_types() {

	$labels = array(
		'name'                       => _x( 'Ally Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Ally Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Ally Types', 'text_domain' ),
		'all_items'                  => __( 'All Ally Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Ally Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Ally Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Ally Name', 'text_domain' ),
		'add_new_item'               => __( 'Add Ally Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Ally', 'text_domain' ),
		'update_item'                => __( 'Update Ally', 'text_domain' ),
		'view_item'                  => __( 'View Ally', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate allies with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove allies', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Allies', 'text_domain' ),
		'search_items'               => __( 'Search Allies', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No allies', 'text_domain' ),
		'items_list'                 => __( 'Allies list', 'text_domain' ),
		'items_list_navigation'      => __( 'Allies list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'ally-types',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'muw_ally_types', array( 'muw_allies' ), $args );

}
add_action( 'init', 'muw_ally_types', 0 );

// Register Custom Post Type
function muw_partners() {

	$labels = array(
		'name'                  => _x( 'Partners', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Partner', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Partners', 'text_domain' ),
		'name_admin_bar'        => __( 'Partner', 'text_domain' ),
		'archives'              => __( 'Partner Archives', 'text_domain' ),
		'attributes'            => __( 'Partner Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Partner Item:', 'text_domain' ),
		'all_items'             => __( 'All Partners', 'text_domain' ),
		'add_new_item'          => __( 'Add New Partner', 'text_domain' ),
		'add_new'               => __( 'Add Partner', 'text_domain' ),
		'new_item'              => __( 'New Partner', 'text_domain' ),
		'edit_item'             => __( 'Edit Partner', 'text_domain' ),
		'update_item'           => __( 'Update Partner', 'text_domain' ),
		'view_item'             => __( 'View Partner', 'text_domain' ),
		'view_items'            => __( 'View Partners', 'text_domain' ),
		'search_items'          => __( 'Search Partners', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'partner',
		'with_front'            => true,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Partner', 'text_domain' ),
		'description'           => __( 'Easy to manage Partners for Metro United Way', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'taxonomies'            => array( 'muw_partners' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-flag',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'muw_partners', $args );

}
add_action( 'init', 'muw_partners', 0 );

// Register Custom Taxonomy
function muw_partner_types() {

	$labels = array(
		'name'                       => _x( 'Partner Types', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Partner Type', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Partner Types', 'text_domain' ),
		'all_items'                  => __( 'All Partner Types', 'text_domain' ),
		'parent_item'                => __( 'Parent Partner Type', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Partner Type:', 'text_domain' ),
		'new_item_name'              => __( 'New Partner Name', 'text_domain' ),
		'add_new_item'               => __( 'Add Partner Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Partner', 'text_domain' ),
		'update_item'                => __( 'Update Partner', 'text_domain' ),
		'view_item'                  => __( 'View Partner', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate Partners with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove Partners', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Partners', 'text_domain' ),
		'search_items'               => __( 'Search Partners', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Partners', 'text_domain' ),
		'items_list'                 => __( 'Partners list', 'text_domain' ),
		'items_list_navigation'      => __( 'Partners list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'partner-types',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'muw_partner_types', array( 'muw_partners' ), $args );

}
add_action( 'init', 'muw_partner_types', 0 );

?>
