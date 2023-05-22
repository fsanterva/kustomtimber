<?php
function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Colours.
	 */

	$labels = [
		"name" => esc_html__( "Colours", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Colour", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Colours", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'colour', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "colour",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "colour", [ "kt-product" ], $args );

	/**
	 * Taxonomy: Grades.
	 */

	$labels = [
		"name" => esc_html__( "Grades", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Grade", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Grades", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'grade', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "grade",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "grade", [ "kt-product" ], $args );

	/**
	 * Taxonomy: Ranges.
	 */

	$labels = [
		"name" => esc_html__( "Ranges", "custom-post-type-ui" ),
		"singular_name" => esc_html__( "Range", "custom-post-type-ui" ),
	];

	
	$args = [
		"label" => esc_html__( "Ranges", "custom-post-type-ui" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'range', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "range",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => true,
		"sort" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "range", [ "post", "kt-product" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
?>