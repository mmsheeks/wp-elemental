<?php

namespace WPelm\Core;

use \Carbon_Fields\Container;
use \Carbon_Fields\Field;
use \League\Flysystem\Local\LocalFilesystemAdapter;
use \League\Flysystem\Filesystem;


class WPelmCore extends WPelmBase {

    public function __construct() {
        //$this->load_filesystem();
        $this->register_hooks();
    }

    /**
     * Load the filesystem utility
     * @author Martin Sheeks <martin.sheeks@gmail.com>
     * @version pr-1
     * @since pr-1
     */
    public function load_filesystem() {
        $adapter = new LocalFilesystemAdapter( get_stylesheet_directory() );
        $this->files = new Filesystem( $adapter );
    }

    /**
     * Tell wordpress what we want to happen
     * @author Martin Sheeks <martin.sheeks@gmail.com>
     * @version pr-1
     * @since pr-1
     */
    public function register_hooks() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        // add_action( 'tgmpa_register', [ $this, 'install_required_plugins' ] );
        // add_action( 'carbon_fields_register_fields', [ $this, 'theme_options' ] );
        // add_action( 'after_setup_theme', [ $this, 'init_carbonfields' ] );
    }

    /**
     * Tell Wordpress what scripts and styles to load
     * @author Martin Sheeks <martin.sheeks@gmail.com>
     * @version pr-1
     * @since pr-1
     */
    public function enqueue_assets() {
        wp_enqueue_style( '_wpelemental-stylesheet', get_template_directory_uri() . '/public/css/bundle.css');
        wp_enqueue_script( '_wpelemental-scripts', get_template_directory_uri() . '/public/js/bundle.js');
    }

    /**
     * Register the required plugins for the WP Elemental ecosystem
     * @author Martin Sheeks <martin.sheeks@gmail.com>
     * @version pr-1
     * @since pr-1
     */
    public function install_required_plugins() {
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

    /**
     * Register the custom fields for theme options
     * @author Martin Sheeks <martin.sheeks@gmail.com>
     * @version pr-1
     * @since pr-1
     */
    public function theme_options() {
        $this->options_available = [ 'wpelm_google_analytics_id', 'wpelm_styles_mode' ];
        Container::make( 'theme_options', __( 'Theme Options' ) )
            ->add_fields( [
                Field::make( 'text', 'wpelm_google_analytics_id', 'Google Analytics ID' ),
                Field::make( 'select', 'wpelm_styles_mode', __( 'WP Elemental Theme Mode' ) )
                    ->set_options( [
                        'Minimal' => 'skeleton',
                        'Full'    => 'full'
                    ]),
            ]);

        // loads the values of the fields above into the WPElm core class.
        $this->load_options();
    }

    /**
     * Activate carbon fields
     * @author Martin Sheeks <martin.sheeks@gmail.com>
     * @version pr-1
     * @since pr-1
     */
    public function init_carbonfields() {
        \Carbon_Fields\Carbon_Fields::boot();
    }




}
