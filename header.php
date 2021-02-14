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

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>

        <title><?php echo get_option('name'); ?></title>
    </head>
    <body>
