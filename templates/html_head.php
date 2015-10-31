<?php require_once 'cons.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>List App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--    <link rel="stylesheet" href="Assets/bower_components/bootstrap/dist/css/bootstrap.min.css">-->
    <script src="<?php echo DIR_PATH?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo DIR_PATH?>assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="<?php echo DIR_PATH?>assets/bower_components/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="<?php echo DIR_PATH?>assets/js/init.js"></script>
    <script src="<?php echo DIR_PATH?>assets/js/message_animation.js"></script>
    <link rel="stylesheet" href="<?php echo DIR_PATH?>assets/css/style.css">
    <?php if(isset($page) && $page === 'dashboard') echo '<link rel="stylesheet" href="'.DIR_PATH.'assets/css/dashboard.css">' ?>

</head>
<body>