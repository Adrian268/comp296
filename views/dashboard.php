<?php
$page = "dashboard";
require_once 'util/Session.php';
require_once 'util/View.php';

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
                <li><a href="#" class="sub-nav-tgl" id="edit_lists">Edit Lists</a>

                    <ul class="sub-nav" id="list-sub-nav">

                        <?php
                        foreach($data as $list){
                            echo  "<li rel='".$list['list_id']."'><a href='#'>".$list['list_name']."</a></li>";
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
                    <input type="text" placeholder="New Shopping List" name="new_shopping_list" class="text-input"/>
                    <input type="submit" value="" name="add_new_list" id="new_list_btn"/>
                    </form>
                </div>
                <div id="top-right">
                    <p class="contact-name"><?=$_SESSION['name']?></p>
                    <a href="controllers/LoginController.php?log_out=true">Log Out</a>
                </div>
            </div>
            <div id="menu-tgl">
                <div class="menu-icon-wrapper" id="nav-toggle">
                    <div id="div1" class="menu-icon-bar">&nbsp;</div>
                    <div id="div2" class="menu-icon-bar">&nbsp;</div>
                    <div id="div3" class="menu-icon-bar">&nbsp;</div>
                </div>
            </div>
<!--            <img src="assets/img/menu-icon.png" id="nav-toggle" >-->
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
                foreach($data as $list){

            echo "    <div class='list-wrapper'>
                            <div class='list-heading'>
                                <h4 class='list-name'>".$list['list_name']."</h4>
                                <input type='text' placeholder='Add Item...' name='add_item'/>
                                <div class='created-info'>
                                    <p class='small date-created'>".date("m/d/y h:i:s",strtotime($list['created_at']))."</p>
                                    <p class='small created-by'>by: Me</p>
                                </div>
                            </div>
                            <div class='list-body'>";
//            echo "
//                                <div class='item-wrapper'>
//                                    <div class='container'>
//                                        <input type='checkbox'>
//                                        <p class='item-name'></p>
//                                        <div class='item-settings-wrapper'><img src='assets/img/item-settings-icon.png' class='item-settings'></div>
//                                    </div>
//                                    <div class='notes'>
//                                        <p>this is a note</p>
//                                        <p>this is another note</p>
//                                    </div>
//                                </div>
//                            </div>";

            echo "          </div>
                            <div class='list-footer'>
                                <div class='container'>
                                    <p class='shared-with'>Shared With:</p>
                                    <p class='shared-with-names'></p>
                                </div>
                                <input type='submit' value='Share List' name='share_list' class='share-list-btn'>
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
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox">
                                    <p class="item-name">Item 1</p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>Donec luctus ex risus</p>
                                    <p>Sed placerat dui odio</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox">
                                    <p class="item-name">Item 2 <span class="quantity">(3)</span></p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>Ut consequat, metus</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox">
                                    <p class="item-name">Item 3</p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>Maecenas orci magna</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox" checked disabled>
                                    <p class="item-name bought-item">Item 4</p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>At euismod diam lacinia molestie.</p>
                                    <p>Integer et venenatis nunc</p>
                                    <p>Commodo, congue nisl.</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
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
            </div> <!--            end list container-->



<!--        edit list pop up -->

        </section>

        <div class="pop-up-wrapper">
            <div class="edit-list-pop-up">
                <div class="close-btn"><img src="assets/img/close-icon.png" width="25px" height="25px" alt=""/></div>
                <form action="controllers/listcontroller.php" method="post">
                    <p>Edit Name:</p>
                    <input type="text" name="list_name" id="list_name"/>
                    <input type="hidden" name="list_id" id="id_hidden"/>
                    <input type="submit" name="save_list" class="save-btn" value="Save"/>
                    <input type="submit" name="delete_list" class="delete-btn" value="Delete List"/>
                </form>
            </div>
        </div>

    <script>

        $(function(){

            var $nav = $('.main-navigation');
            var $header = $('.top-heading');
            var $section = $('section');
            var $footer = $('footer');
            var $nav_tgl = $('#nav-toggle');
            var $sub_nav_tgl = $('.sub-nav-tgl');
            var $sub_nav = $('.sub-nav');
            var $sub_nav_op = $('#list-sub-nav li');

            //            modal selectors
            var $modal = $('.pop-up-wrapper');
            var $edit_list_modal = $('.edit-list-pop-up');
            var $close_btn = $modal.find('.close-btn');

            //            list selectors
            var $list = $('.list-name');
            var $list_body = $('.list-body');
            var $list_footer = $('.list-footer');

            //            item settings selectors
            var $item_container = $('.item-container');
            var $item_settings = $item_container.find('.item-settings-wrapper');

            //          menu toggle selectors
            var $menu_icon = $nav_tgl.find('.menu-icon-bar');

            function showNav(){
                $nav.toggleClass('active');
                $header.toggleClass('active');
                $section.toggleClass('active');
                $footer.toggleClass('active');
            }

            function closeModal(){
                $modal.css({
                    'transition':'none',
                    'visibility':'hidden',
                    'opacity':'0'});
            }

            function openModal(){
                $modal.css({
                    'transition': 'all .6s ease',
                    'visibility':'visible',
                    'opacity' : '1'});
            }

            $nav_tgl.on('click', function(){
                showNav();
                $menu_icon.toggleClass('active');
            });

            $($list).on('click', function(){
                var $list_body = $(this).parent('div').next('.list-body');

                $list_body.next('.list-footer').slideToggle();
                $list_body.slideToggle();


            });

            $($sub_nav_tgl).on('click', function(){
                var $sub_nav = $(this).next($sub_nav);
                $sub_nav.slideToggle();
            });

            $($sub_nav_op).on('click', function(){
                var $value = $(this).text();
                var $id = $(this).attr('rel');
                $('#id_hidden').val($id);
                $('#list_name').val($value);
                openModal()
            });

            $($close_btn).on('click', function(){
                closeModal();
            });

            $($item_settings).on('click', function(){
                $(this).closest($item_container).toggleClass('active');
            });


            $(window).load(function(){
                var $list_body = $('.list-body');
                var $list_footer = $('.list-footer');
                $list_body.hide();
                $list_footer.hide();
                $sub_nav.hide();
            });

        });

    </script>


        <footer>
            <p>&copy;2015 ListApp</p>
        </footer>
    </div>
</body>
</html>