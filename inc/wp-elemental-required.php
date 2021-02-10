<?php

if ( ! defined( 'ABSPATH' ) ) {
    return; // silence is golden
}

/**
 * Register the required plugins for the WP Elemental ecosystem
 * @author Martin Sheeks <martin.sheeks@gmail.com>
 * @version pr-1
 * @since pr-1
 */
if( !function_exists( 'wpelm_register_required_plugins' ) ) {
     function wpelm_register_required_plugins() {
         $plugins = [
             [
                 'name'             => 'WP Elements',
                 'slug'             => 'wp-elements',
                 'source'           => get_stylesheet_directory() . '/lib/wp-elements.zip',
                 'required'         => true,
                 'force_activation' => true,
                 'is_callable'      => '',
             ],
         ];
     }
    add_action( 'tgmpa_register', 'wpelm_register_required_plugins' );
}

/**
 * Activate carbon fields and register the required theme fields.
 * @author Martin Sheeks <martin.sheeks@gmail.com>
 * @version pr-1
 * @since pr-1
 */
if( !function_exists( 'wpelm_register_carbonfields' ) ) {
    function wpelm_register_carbonfields() {
        Container::make( 'theme_options', __( 'Theme Options' ) )
            ->add_fields( [
                Field::make( 'text', 'google_analytics_id', 'Google Analytics ID' ),
            ]);
    }
    add_action( 'carbon_fields_register_fields', 'wpelm_register_carbonfields' );
}

if( !function_exists( 'wpelm_crb_load' ) ) {
    function wpelm_crb_load() {
        \Carbon_Fields\Carbon_Fields::boot();
    }
    add_action( 'after_setup_theme', 'wpelm_crb_load' );
}
