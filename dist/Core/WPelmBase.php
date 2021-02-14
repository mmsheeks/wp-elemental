<?php

namespace WPelm\Core;

class WPelmBase {

    protected $files;
    protected $options_values;
    protected $options_available;

    public function __construct() {
    }

    protected function option( $name ) {
        return isset( $this->option_values[ $name ] ) ? $this->option_values[ $name ] : false;
    }

    protected function load_options() {
        foreach( $this->options_available as $field ) {
            $option_name = str_replace( 'wpelm_', '', $field );
            $this->options_values[ $field ] = \carbon_get_theme_option( $field );
        }
    }

}
