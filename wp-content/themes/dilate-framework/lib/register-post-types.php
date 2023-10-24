<?php
function cptui_register_my_cpts() {

	/**
	 * Post Type: Projects.
	 */

	$labels = [
		"name" => esc_html__( "Projects", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Project", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Projects", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => true,
		"rewrite" => [ "slug" => "project", "with_front" => false ],
		"query_var" => true,
		"menu_icon" => "dashicons-admin-multisite",
		"supports" => [ "title", "thumbnail", "excerpt", "page-attributes" ],
		"taxonomies" => [ "range" ],
		"show_in_graphql" => false,
	];

	register_post_type( "project", $args );

	/**
	 * Post Type: Timber Products.
	 */

	$labels = [
		"name" => esc_html__( "Timber Products", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Timber Product", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Timber Products", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => true,
		"rewrite" => [ "slug" => "timber-product", "with_front" => false ],
		"query_var" => true,
		"menu_icon" => "dashicons-layout",
		"supports" => [ "title", "thumbnail", "excerpt", "revisions", "page-attributes" ],
		"show_in_graphql" => false,
	];

	register_post_type( "timber-product", $args );

	/**
	 * Post Type: Cork Products.
	 */

	 $labels = [
		"name" => esc_html__( "Cork Products", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Cork Product", "custom-post-type-ui" ),
	];

	$args = [
		"label" => esc_html__( "Cork Products", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"can_export" => true,
		"rewrite" => [ "slug" => "cork-product", "with_front" => false ],
		"query_var" => true,
		"menu_icon" => "dashicons-layout",
		"supports" => [ "title", "thumbnail", "excerpt", "revisions", "page-attributes" ],
		"show_in_graphql" => false,
	];

	register_post_type( "cork-product", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


// function posts_order_wpse_91866() {
// 	add_post_type_support( 'project', 'page-attributes' );
// }
// add_action( 'admin_init', 'posts_order_wpse_91866' );


?>