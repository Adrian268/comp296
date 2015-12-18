<?php
require_once 'templates/html_head.php';

// check for profile picture
file_exists($profile_pic_path)?
    $profile_pic = "<div class='contact-img-pic-lrg profile-pic' rel='".$user_data['name']."'><img src='".$profile_pic_path."'></div>" :
    $profile_pic = "<div class='contact-img-lrg profile-pic' rel='".$user_data['name']."'>".$user_data['name'][0]."</div>";

// get number fo contacts
$number_of_contacts = count($contacts);

// get names of list for the edit list sub nav
$list_sub_nav = "";
foreach($list_data as $list)
    $list_sub_nav .=  "<li data-editable='".$list['editable']."' rel='".$list['list_id']."'><a href='#' onclick='return false;' class='".$list['list_id']."'>".$list['list_name']."</a></li>";

$confirm_flash_message = isset($cf_msg) ? "<div class='flash-message confirm remove'>{$cf_msg}</div>" : "";

$error_flash_message = isset($_SESSION['error_message']) ? "<div class='flash-message error remove'>{$_SESSION['error_message']}</div>" : "";
$_SESSION['error_message'] = null


?>

<div class="site-wrapper">

    <!--  BEGIN PAGE HEADER -->
    <div class="top-heading">

        <div id="logo-link-container">
            <div id="logo">
                <p>List App</p>
            </div>
            <div id="new-shopping-list">
                <form action="controllers/ListController.php" method="POST" id="new-list-form">
                    <input type="text" placeholder="New List" name="new_list_name" id="new-list-name" class="text-input"/>
                    <input type="submit" value="ADD LIST" name="add_new_list" id="new_list_btn"/>
                </form>
            </div>
            <div id="top-right">
                <ul>
                    <li><a href="controllers/LoginController.php?log_out">Log Out</a></li>
                </ul>
            </div>
        </div>

        <div id="menu-icon-wrapper">
            <div id="nav-toggle">
                <div id="div1" class="menu-icon-bar"></div>
                <div id="div2" class="menu-icon-bar"></div>
                <div id="div3" class="menu-icon-bar"></div>
            </div>
        </div>

        <div id="choose-list">
            <ul>
                <li rel="mylists" id="my-lists">My Lists</li>
                <li rel="sharedlists" id="shared-lists">Shared Lists</li>
            </ul>
        </div>
    </div>
    <!--    END PAGE HEADER-->

    <section>

<!--        FLASH MESSAGES-->
        <?=$error_flash_message?>
        <?=$confirm_flash_message?>

        <?php require_once 'views/includes/lists.php'?>

    </section>

    <?php require_once 'views/includes/left_navigation.php' ?>
    <?php require_once 'views/includes/contacts.php' ?>

<!--    MODAL WINDOWS-->
    <?php require_once 'views/includes/edit_list_modal.html' ?>
    <?php require_once 'views/includes/new_list_modal.html' ?>
    <?php require_once 'views/includes/edit_account_modal.html' ?>
    <?php require_once 'views/includes/delete_account_modal.html' ?>
    <?php require_once 'views/includes/profile_pic_modal.html' ?>

    <footer>
        <p>&copy;2015 ListApp</p>
    </footer>

</div>  <!--    SITE WRAPPER END DIV -->

<script  type="text/javascript" src="assets/js/dashboard.js"></script>

</body>
</html>


