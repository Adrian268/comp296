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

                <li><a href="#" class="sub-nav-tgl">My Account</a>
                    <ul class="sub-nav">
                        <li><a href="#" id="edit-account-tgl">Edit Account Info</a></li>
                        <li><a href="#" id="delete-account-tgl">Delete Account</a></li>
                    </ul>
                </li>
                <li><a href="#" class="sub-nav-tgl" id="view-contacts">Contacts</a>

<!--                    <ul class="sub-nav">-->
<!--                        <li><a href="#" id="add-contacts-op">Add Contacts</a></li>-->
<!---->
<!--                    </ul>-->
                </li>
                <li><a href="#" class="sub-nav-tgl" id="edit_lists">Edit Lists <?php
                    if($user_data[0]['number_of_lists'] > 0)
                        echo "<div class='badge'>" . $user_data[0]['number_of_lists'] . "</div>";
                    ?>
                   </a>

                    <ul class="sub-nav" id="list-sub-nav">

                        <?php
                        foreach($list_data as $list){
                            echo  "<li rel='".$list['list_id']."'><a href='#' class='".$list['list_id']."'>".$list['list_name']."</a></li>";
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

<!--            --><?php //echo "<pre>", print_r($user_data), "</pre>"?>

            <div class="lists-container">

                <?php
                foreach($list_data as $list){

                echo "<div class='list-wrapper'>
                            <div class='list-heading'>
                                <h4 class='list-name ".$list['list_id']."'>".$list['list_name']."</h4>
                                <div class='created-info'>
                                    <p class='small date-created'>".date("m/d/y h:i a",strtotime($list['created_at']))."</p>
                                    <p class='small created-by'>by: ";
                                        if($list['user_id'] === $_SESSION['id'])
                                            echo $_SESSION['name'];
                              echo "</p>
                                </div>
                            </div>
                            <div class='list-body'>";

                foreach($item_data as $item){

                    if($item['list_id'] === $list['list_id']){

                    echo "
                            <div class='item-wrapper' rel='".$item['item_id']."'>
                                <div class='item-container'>
                                    <div class='container'>
                                        <input type='checkbox'>
                                        <div class='item-name-container'>
                                        <form class='edit-item-name-form'>
                                            <p class='item-name-edit edit'><input class='item-name-edit-input' type='text'></p>
                                            <input type='text' class='edit-item-quantity edit'>
                                            <input type='submit' class='save-edit-name-btn edit' value='save'>
                                        </form>
                                        <p class='item-name item".$item['item_id']." no-edit'>".$item['item_name']."</p>
                                        <span class='quantity no-edit' rel='".$item['quantity']."'>";

                                         if($item['quantity'] > 1){
                                             echo "(".$item['quantity'].")";
                                         }

                                  echo "</span>
                                        </div>
                                        <div class='item-settings-wrapper' rel='".$item['item_id']."'><img src='assets/img/item-settings-icon.png' class='item-settings'></div>
                                    </div>
                                    <div class='notes'>";

                                    foreach($note_data as $note){

                                        if($note['item_id'] === $item['item_id']){

                                            echo "<p>".$note['content']."</p>";

                                        }
                                    }

                        echo "    <form class='add-new-note-form'>
                                    <input type='text' class='new-note-input edit'/>
                                    <input type='submit' value='Save' class='save-note-btn edit'/>
                                  </form>
                          </div>
                                </div>
                                <div class='item-settings-nav' id='item-settings".$item['item_id']."'>
                                    <ul>
                                        <li class='edit_item_name'>Edit Item</li>
                                        <li class='delete-item-click'>Delete Item</li>
                                        <li class='add-note-click'>Add Note</li>
                                    </ul>
                                </div>
                            </div>";

                    } // end if item

                } // end item loop


            echo "
                            <form class='new-item-form'>
                                <table>
                                    <tr>
                                        <td>Item Name</td>
                                        <td>Quantity</td>
                                        <td>Note</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' name='new_item_name' class='new_item_name'/></td>
                                        <td><input type='text' name='new_item_quantity' class='new_item_quantity item-quantity' value='1'/></td>
                                        <td><input type='text' name='new_item_note' class='new_item_note'/></td>
                                        <td><input type='submit' name='add_item_btn' value='add item'/></td>
                                    </tr>
                                    <tr><td><input type='hidden' name='list_id' class='list_id' value='".$list['list_id']."'/></td></tr>
                                </table>
                            </form>
                        </div>
                            <div class='list-footer'>
                                <div class='container'>
                                    <p class='shared-with'>Shared With:</p>
                                    <p class='shared-with-names'></p>
                                </div>
                                <input type='submit' value='Share List' name='share_list' class='share-list-btn'>
                            </div>

                   </div>";

                } // end list loop

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
<!--                    <div class="list-body">-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="item-container">-->
<!--                                <div class="container">-->
<!--                                    <input type="checkbox">-->
<!--                                    <p class="item-name">Item 1</p>-->
<!--                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                                </div>-->
<!--                                <div class="notes">-->
<!--                                    <p>Donec luctus ex risus</p>-->
<!--                                    <p>Sed placerat dui odio</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="item-settings-nav">-->
<!--                                <ul>-->
<!--                                    <li>Edit Name</li>-->
<!--                                    <li>Delete Item</li>-->
<!--                                    <li>Add Note</li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="item-container">-->
<!--                                <div class="container">-->
<!--                                    <input type="checkbox">-->
<!--                                    <p class="item-name">Item 2 <span class="quantity">(3)</span></p>-->
<!--                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                                </div>-->
<!--                                <div class="notes">-->
<!--                                    <p>Ut consequat, metus</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="item-settings-nav">-->
<!--                                <ul>-->
<!--                                    <li>Edit Name</li>-->
<!--                                    <li>Delete Item</li>-->
<!--                                    <li>Add Note</li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="item-container">-->
<!--                                <div class="container">-->
<!--                                    <input type="checkbox">-->
<!--                                    <p class="item-name">Item 3</p>-->
<!--                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                                </div>-->
<!--                                <div class="notes">-->
<!--                                    <p>Maecenas orci magna</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="item-settings-nav">-->
<!--                                <ul>-->
<!--                                    <li>Edit Name</li>-->
<!--                                    <li>Delete Item</li>-->
<!--                                    <li>Add Note</li>-->
<!--                                </ul>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="item-wrapper">-->
<!--                            <div class="item-container">-->
<!--                                <div class="container">-->
<!--                                    <input type="checkbox" checked disabled>-->
<!--                                    <p class="item-name bought-item">Item 4</p>-->
<!--                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>-->
<!--                                </div>-->
<!--                                <div class="notes">-->
<!--                                    <p>At euismod diam lacinia molestie.</p>-->
<!--                                    <p>Integer et venenatis nunc</p>-->
<!--                                    <p>Commodo, congue nisl.</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="item-settings-nav">-->
<!--                                <ul>-->
<!--                                    <li>Edit Name</li>-->
<!--                                    <li>Delete Item</li>-->
<!--                                    <li>Add Note</li>-->
<!--                                </ul>-->
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
            </div> <!--            end list container-->

        </section>

        <?php require_once 'views/templates/edit_list_modal.php' ?>
        <?php require_once 'views/templates/new_list_modal.php' ?>
        <?php require_once 'views/templates/edit_account_modal.php' ?>
        <?php require_once 'views/templates/delete_account_modal.php' ?>


        <footer>
            <p>&copy;2015 ListApp</p>
        </footer>
    </div>  <!--    site wrapper end div-->

<script  type="text/javascript" src="assets/js/nav_and_modal.js"></script>
<script  type="text/javascript" src="assets/js/lists.js"></script>

</body>
</html>