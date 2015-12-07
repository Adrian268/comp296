<?php
$page = "dashboard";
require_once 'templates/html_head.php';
?>

<div class="site-wrapper">
    <nav class="main-navigation">
        <div id="user-info">
            <ul>
                <li><p id="user-name"><?=$user_data[0]['name']?></p></li>
                <li><p id="user-email"><?=$user_data[0]['email']?></p></li>
            </ul>
        </div>
        <ul>

            <li><img src="assets/img/account.png" alt=""/><a href="#" class="sub-nav-tgl" >My Account</a>
                <ul class="sub-nav">
                    <li><a href="#" id="edit-account-tgl">Edit Account Info</a></li>
                    <li><a href="#" id="delete-account-tgl">Delete Account</a></li>
                </ul>
            </li>
            <li><img src="assets/img/contacts.png" alt=""/><a href="#" class="sub-nav-tgl" id="view-contacts">Contacts</a>

                <!--                    <ul class="sub-nav">-->
                <!--                        <li><a href="#" id="add-contacts-op">Add Contacts</a></li>-->
                <!---->
                <!--                    </ul>-->
            </li>
            <li><img src="assets/img/gears.png" alt=""/><a href="#" class="sub-nav-tgl" id="edit_lists">Edit Lists <?php
                    if($user_data[0]['number_of_lists'] > 0)
                        echo "<div class='badge'>" . $user_data[0]['number_of_lists'] . "</div>";
                    ?>
                </a>

                <ul class="sub-nav" id="list-sub-nav">

                    <?php
                    foreach($list_data as $list){
                        echo  "<li data-editable='".$list['editable']."' rel='".$list['list_id']."'><a href='#' class='".$list['list_id']."'>".$list['list_name']."</a></li>";
                    }
                    ?>

                </ul>

            </li>
            <!--                <li><a href="#">Settings</a></li>-->
        </ul>
    </nav>

    <!--    BEGIN PAGE HEADER -->
    <div class="top-heading">
        <div id="logo-link-container">
            <div id="logo">
                <p>List App</p>
            </div>
            <div id="new-shopping-list">
                <form action="controllers/ListController.php" method="POST" id="new-list-form">
                    <input type="text" placeholder="New List" name="new_list_name" id="new-list-name" class="text-input"/>
                    <input type="submit" value="" name="add_new_list" id="new_list_btn"/>
                </form>
            </div>
            <div id="top-right">
                <ul>
                    <li><a href="controllers/LoginController.php?log_out=true">Log Out</a></li>
                </ul>
            </div>
        </div>
        <div id="menu-tgl">
            <div class="menu-icon-wrapper" id="nav-toggle">
                <div id="div1" class="menu-icon-bar">&nbsp;</div>
                <div id="div2" class="menu-icon-bar">&nbsp;</div>
                <div id="div3" class="menu-icon-bar">&nbsp;</div>
            </div>
        </div>

        <div id="choose-list">
            <ul>
                <li rel="mylists" class="active" id="my_lists">My Lists</li>
                <li rel="sharedlists" id="shared_lists">Shared Lists</li>
            </ul>
        </div>
    </div>
    <!--    END PAGE HEADER-->

    <section id="#section">

<?php if(isset($cf_msg)) {
    echo "<div class='flash-message confirm remove'>{$cf_msg}</div>";
}?>
<?php if(isset($_SESSION['error_message'])) {
    echo "<div class='flash-message error remove'>{$_SESSION['error_message']}</div>";
    $_SESSION['error_message'] = null;
}?>

<!--                --><?php //echo "<pre>", print_r($shared_with_names), "</pre>"?>



        <?php require_once 'views/templates/'.$page_body.'.php'?>



    </section>

    <?php require_once 'views/templates/edit_list_modal.php' ?>
    <?php require_once 'views/templates/new_list_modal.php' ?>
    <?php require_once 'views/templates/edit_account_modal.php' ?>
    <?php require_once 'views/templates/delete_account_modal.php' ?>
    <?php require_once 'views/templates/contactstemplate.php' ?>

    <footer>
        <p>&copy;2015 ListApp</p>
    </footer>
</div>  <!--    site wrapper end div-->

<script  type="text/javascript" src="assets/js/nav_and_modal.js"></script>
<script  type="text/javascript" src="assets/js/lists.js"></script>

</body>
</html>


