<?php if( !defined('ABSPATH') ) {
    return; // silence is golden
} ?>

<!doctype HTML>
<html lang="en">
    <head>
        <!-- These meta tags are required for Bootstrap -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php wp_head() ?>
        <title><?php echo get_option('name'); ?></title>
    </head>
    <body>
