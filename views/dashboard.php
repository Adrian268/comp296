<?php
$page = "dashboard";
require_once 'util/Session.php';
require_once 'util/View.php';
//if(!Session::started()) {
//    $_SESSION['error_message'] = "Access denied. Please Log In to view this page";
//    View::render('index.php');
//}

if(isset($_SESSION['confirm_message'])){
    $cf_msg = $_SESSION['confirm_message'];
    $_SESSION['confirm_message'] = null;
}

require_once 'templates/html_head.php';
?>

    <div class="site-wrapper">
        <nav class="main-navigation">
            <ul>
                <li><a href="#" class="sub-nav-tgl">My Account</a>
                    <ul class="sub-nav">
                        <li><a href="#">Change Email</a></li>
                        <li><a href="#">Change Password</a></li>
                        <li><a href="#">Delete Account</a></li>
                    </ul>
                </li>
                <li><a href="#">Contacts</a></li>
                <li><a href="#" class="sub-nav-tgl">Edit Lists</a>
                    <ul class="sub-nav">

                        <?php
                        foreach($data as $list){
                            echo  "<li><a href='#'>".$list['list_name']."</a></li>";
                        }
                        ?>

                    </ul>
                </li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>

        <div class="top-heading">
            <div id="logo-link-container">
                <div id="logo">
                    <p>List App</p>
                </div>
                <div id="new-shopping-list">
                    <form action="controllers/ListController.php" method="POST">
                    <input type="text" placeholder="New Shopping List" name="new_shopping_list" class="text-input">
                    <input type="submit" value="" name="add_new_list" id="new_list_btn">
                    </form>
                </div>
                <div id="top-right">
                    <p class="contact-name"><?php echo $_SESSION['name']?></p>
                    <a href="controllers/LoginController.php?log_out=true">Log Out</a>
                </div>
            </div>
            <div id="menu"><img src="assets/img/menu-icon.png" id="nav-toggle" ></div>
        </div>

        <section id="#section">
            <?php if(isset($cf_msg)) {
                echo "<div class='flash-message confirm remove'>{$cf_msg}</div>";
            }?>
            <?php if(isset($_SESSION['error_message'])) {
                echo "<div class='flash-message error remove'>{$_SESSION['error_message']}</div>";
                $_SESSION['error_message'] = null;
            }?>



            <div class="lists-container">
                <?php
//                echo "<pre>", print_r($data), "</pre>";

                foreach($data as $list){
                    echo "<div class='list-wrapper'>
                            <div class='list-heading'>
                                <h4 class='list-name'>".$list['list_name']."</h4>
                                <input type='text' placeholder='Add Item...' name='add_item'>
                                <div class='created-info'>
                                    <p class='small date-created'>".date("m/d/y h:i:s",strtotime($list['created_at']))."</p>
                                    <p class='small created-by'>by: Me</p>
                                </div>
                            </div>
                          </div>";
                }
                ?>
<!--                <div class="list-wrapper">-->
<!--                    <div class="list-heading">-->
<!--                        <h4 class="list-name">Grocery List</h4>-->
<!--                        <input type="text" placeholder="Add Item..." name="add_item">-->
<!--                        <div class="created-info">-->
<!--                            <p class="small date-created">12/12/12 12:00pm</p>-->
<!--                            <p class="small created-by">by: Me</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="list-wrapper">-->
<!--                    <div class="list-heading">-->
<!--                        <h4 class="list-name">School List</h4>-->
<!--                        <input type="text" placeholder="Add Item..." name="add_item">-->
<!--                        <div class="created-info">-->
<!--                            <p class="small date-created">12/12/12 12:00pm</p>-->
<!--                            <p class="small created-by">by: Me</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="list-wrapper">-->
<!--                    <div class="list-heading">-->
<!--                        <h4 class="list-name">Car Project</h4>-->
<!--                        <input type="text" placeholder="Add Item..." name="add_item">-->
<!--                        <div class="created-info">-->
<!--                            <p class="small date-created">12/12/12 12:00pm</p>-->
<!--                            <p class="small created-by">by: Bob</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="list-wrapper">-->
<!--                    <div class="list-heading">-->
<!--                        <h4 class="list-name">Party List</h4>-->
<!--                        <input type="text" placeholder="Add Item..." name="add_item">-->
<!--                        <div class="created-info">-->
<!--                            <p class="small date-created">12/12/12 12:00pm</p>-->
<!--                            <p class="small created-by">by: Me</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="list-body">-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="container">-->
<!--                                <input type="checkbox">-->
<!--                                <p class="item-name">Item 1</p>-->
<!--                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                            </div>-->
<!--                            <div class="notes">-->
<!--                                <p>this is a note</p>-->
<!--                                <p>this is another note</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="container">-->
<!--                                <input type="checkbox">-->
<!--                                <p class="item-name">Item 2 <span class="quantity">(3)</span></p>-->
<!--                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                            </div>-->
<!--                            <div class="notes">-->
<!--                                <p>hey its a note</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="container">-->
<!--                                <input type="checkbox">-->
<!--                                <p class="item-name">Item 3</p>-->
<!--                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                            </div>-->
<!--                            <div class="notes">-->
<!--                                <p>this is a note</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="container">-->
<!--                                <input type="checkbox" checked readonly>-->
<!--                                <p class="item-name bought-item">Item 4</p>-->
<!--                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                            </div>-->
<!--                            <div class="notes">-->
<!--                                <p>this is a note</p>-->
<!--                                <p>this is another note</p>-->
<!--                                <p>this is another note</p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="list-footer">-->
<!--                        <div class="container">-->
<!--                            <p class="shared-with">Shared With:</p>-->
<!--                            <p class="shared-with-names">Bob, Jess, Michael</p>-->
<!--                        </div>-->
<!--                        <input type="submit" value="Share List" name="share_list" class="share-list-btn">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

        </section>



    <script>

        $(function(){

            var $nav = $('.main-navigation');
            var $header = $('.top-heading');
            var $section = $('section');
            var $footer = $('footer');
            var $sub_nav_tgl = $('.sub-nav-tgl');
            var $sub_navs = $('.sub-nav');

            var $list = $('.list-heading');

            $('#nav-toggle').on('click', function(){
                $nav.toggleClass('active');
                $header.toggleClass('active');
                $section.toggleClass('active');
                $footer.toggleClass('active');

            });

            $($list).on('click', function(){
                var $list_body = $(this).next('.list-body');
                var $list_footer = $list_body.next('.list-footer');
                $list_body.slideToggle();
                $list_footer.slideToggle();
            });

            $($sub_nav_tgl).on('click', function(){
                var $sub_nav = $(this).next('.sub-nav');
                $sub_nav.slideToggle();
            });


            $(window).load(function(){
                var $list_body = $('.list-body');
                var $list_footer = $('.list-footer');
                $list_body.hide();
                $list_footer.hide();
                $sub_navs.hide();
            });

        });

    </script>


        <footer>
            <p>&copy;2015 ListApp</p>
        </footer>
    </div>
</body>
</html>