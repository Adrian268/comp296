<!DOCTYPE html>
<html lang="en">
<head>
    <title>List App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo DIR_PATH?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo DIR_PATH?>assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo DIR_PATH?>assets/bower_components/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?php echo DIR_PATH?>assets/js/init.js"></script>
    <script src="<?php echo DIR_PATH?>assets/js/message_animation.js"></script>
    <link rel="stylesheet" href="<?php echo DIR_PATH?>assets/css/style.css">
    <?php if(isset($page) && $page === 'dashboard') echo '<link rel="stylesheet" href="'.DIR_PATH.'assets/css/dashboard.css">' ?>
    <?php if(isset($page) && $page === 'dashboard') echo '<script src="'.DIR_PATH.'assets/js/nav_and_modal.js"></script>' ?>
</head>
<body>
<noscript class="noscript">
    <div id="div100">
        <p>Please enable javascript in your browser to access this page.</p>
    </div>
</noscript>