<?php
$page = "dashboard";
require_once 'Util/Session.php';
require_once 'Util/View.php';


if(!Session::started()) {
    $_SESSION['error_message'] = "Access denied. Please Log In to view this page";
    View::render('index.php');
}

if(isset($_SESSION['confirm_message'])){
    $cf_msg = $_SESSION['confirm_message'];
    $_SESSION['confirm_message'] = null;
}

require_once 'Templates/html_head.php';
?>

    <div class="site-wrapper">
        <nav class="main-navigation">
            <ul>
                <li><a href="#">My Account</a></li>
                <li><a href="#">Contacts</a></li>
                <li><a href="#">Edit Lists</a></li>
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
                echo "<div class='flash-message confirm'>{$cf_msg}</div>";
            }?>

            <div class="lists-container">
                <div class="list-wrapper">
                    <div class="list-heading">
                        <h4 class="list-name">Grocery List</h4>
                        <input type="text" placeholder="Add Item..." name="add_item">
                        <div class="created-info">
                            <p class="small date-created">12/12/12 12:00pm</p>
                            <p class="small created-by">by: Me</p>
                        </div>
                    </div>
                </div>
                <div class="list-wrapper">
                    <div class="list-heading">
                        <h4 class="list-name">School List</h4>
                        <input type="text" placeholder="Add Item..." name="add_item">
                        <div class="created-info">
                            <p class="small date-created">12/12/12 12:00pm</p>
                            <p class="small created-by">by: Me</p>
                        </div>
                    </div>
                </div>
                <div class="list-wrapper">
                    <div class="list-heading">
                        <h4 class="list-name">Car Project</h4>
                        <input type="text" placeholder="Add Item..." name="add_item">
                        <div class="created-info">
                            <p class="small date-created">12/12/12 12:00pm</p>
                            <p class="small created-by">by: Bob</p>
                        </div>
                    </div>
                </div>
                <div class="list-wrapper">
                    <div class="list-heading">
                        <h4 class="list-name">Party List</h4>
                        <input type="text" placeholder="Add Item..." name="add_item">
                        <div class="created-info">
                            <p class="small date-created">12/12/12 12:00pm</p>
                            <p class="small created-by">by: Me</p>
                        </div>
                    </div>
                    <div class="list-body">
                        <div class="item-wrapper">
                            <div class="container">
                                <input type="checkbox">
                                <p class="item-name">Item 1</p>
                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>
                            </div>
                            <div class="notes">
                                <p>this is a note</p>
                                <p>this is another note</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="container">
                                <input type="checkbox">
                                <p class="item-name">Item 2 <span class="quantity">(3)</span></p>
                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>
                            </div>
                            <div class="notes">
                                <p>hey its a note</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="container">
                                <input type="checkbox">
                                <p class="item-name">Item 3</p>
                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>
                            </div>
                            <div class="notes">
                                <p>this is a note</p>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="container">
                                <input type="checkbox" checked readonly>
                                <p class="item-name bought-item">Item 4</p>
                                <div class="item-settings-wrapper"><img src="Assets/img/item-settings-icon.png" class="item-settings"></div>
                            </div>
                            <div class="notes">
                                <p>this is a note</p>
                                <p>this is another note</p>
                                <p>this is another note</p>
                            </div>
                        </div>
                    </div>

                    <div class="list-footer">
                        <div class="container">
                            <p class="shared-with">Shared With:</p>
                            <p class="shared-with-names">Bob, Jess, Michael</p>
                        </div>
                        <input type="submit" value="Share List" name="share_list" class="share-list-btn">
                    </div>
                </div>
            </div>
        </section>



    <script>

        $(function(){

            var $nav = $('.main-navigation');
            var $header = $('.top-heading');
            var $section = $('section');
            var $footer = $('footer');

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

            $(window).load(function(){
                var $list_body = $('.list-body');
                var $list_footer = $('.list-footer');
                $list_body.hide();
                $list_footer.hide();
            });

        });

    </script>


        <footer>
            <p>&copy;2015 ListApp</p>
        </footer>
    </div>
</body>
</html>