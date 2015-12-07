
<div class="list-type-name">Shared Lists</div>

<?php
foreach($shared_lists_info as $list) {

    echo "<div class='list-wrapper'>
                            <div class='list-heading'>
                                <h4 class='list-name " . $list[0]['list_id'] . "'>" . $list[0]['list_name'] . "</h4>
                                <div class='created-info'>
                                    <p class='small date-created'>" . date("m/d/y h:i a", strtotime($list[0]['created_at'])) . "</p>
                                    <p class='small created-by'>by: ";
    if ($list[0]['user_id'] === $_SESSION['id'])
        echo $_SESSION['name'];
    else{
        echo $list[0]['creator'];
    }
    echo "</p>
                                </div>
                            </div>
                            <div class='list-body'>";

    foreach($shared_item_info as $item_array) {
        foreach ($item_array as $item) {

            if ($item['list_id'] === $list[0]['list_id']) {

                echo "
                            <div class='item-wrapper' rel='" . $item['item_id'] . "'>
                                <div class='item-container'>
                                    <div class='container'>";
                if ($item['purchased'] == 1) {
//                            echo "<input type='checkbox' class='set-as-purchased' disabled='' checked=''>";
                    echo "<img src='assets/img/checked-box-icon.png' class='bought-item-check'/>";
                } else echo "<input type='checkbox' class='set-as-purchased'>";

                echo "
                                       <div class='item-name-container'>
                                        <form class='edit-item-name-form'>
                                            <p class='item-name-edit edit'><input class='item-name-edit-input' type='text'></p>
                                            <input type='text' class='edit-item-quantity edit'>
                                            <input type='submit' class='save-edit-name-btn edit' value='save'>
                                        </form>";
                if ($item['purchased'] == 1) {
                    echo "<p class='item-name item" . $item['item_id'] . " no-edit bought-item'>" . $item['item_name'] . "</p>
                                        <span class='quantity no-edit' rel='" . $item['quantity'] . "'>";
                } else echo "<p class='item-name item" . $item['item_id'] . " no-edit'>" . $item['item_name'] . "</p>
                                        <span class='quantity no-edit' rel='" . $item['quantity'] . "'>";


                if ($item['quantity'] > 1) {
                    echo "(" . $item['quantity'] . ")";
                }

                echo "</span>
                  </div>


                  ";

                    if( $item['purchased'] == 0){
                        echo "<div class='item-settings-wrapper' rel='" . $item['item_id'] . "'><img src='assets/img/item-settings-icon.png' class='item-settings'></div>";
                    }


                echo "</div>
                        <div class='notes'>";

                foreach ($shared_note_info as $note_array) {
                    foreach ($note_array as $note) {

                        if ($note['item_id'] === $item['item_id']) {

                            echo "<p>" . $note['content'] . "</p>";

                        }
                    }
                }

                echo "    <form class='add-new-note-form'>
                                    <input type='text' class='new-note-input edit'/>
                                    <input type='submit' value='Save' class='save-note-btn edit'/>
                                  </form>
                          </div>
                                </div>
                                <div class='item-settings-nav' id='item-settings".$item['item_id']."'>
                                    <ul>";

                if ($list[0]['editable'] == 1){
                    echo   "<li class='edit_item_name'>Edit Item</li>
                                            <li class='delete-item-click'>Delete Item</li>
                                            <li class='add-note-click'>Add Note</li>";
                }else echo "<li class='add-note-click'>Add Note</li>";

                echo     "</ul>
                                </div>
                            </div>";

            } // end if item
        }

    } // end item loop


    echo "
                            <form class='new-item-form' rel='".$list[0]['editable']."'>
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
                                    <tr><td><input type='hidden' name='list_id' class='list_id' value='".$list[0]['list_id']."'/></td></tr>
                                </table>
                            </form>
                        </div>
                            <div class='list-footer'>
                                <div class='container'>
                                    <p class='shared-with'>Shared With:</p>
                                    <p class='shared-with-names'>";
//                                    echo "<pre>", print_r($list_shared_with), "</pre>";

    $pos = 0;
    foreach($shared_with_id as $shared_with) {
        for ($l = 0; $l < count($shared_with); $l++) {

            if ($shared_with[$l]['list_id'] === $list[0]['list_id']) {

                for ($i = 0; $i < count($shared_with_names); $i++) {

                    if ($shared_with[$l]['viewer_id'] === $shared_with_names[$i][0]['user_id']) {

                        if ($pos == 0)
                            echo $shared_with_names[$i][0]['creator'];
                        else
                            echo ", " . $shared_with_names[$i][0]['creator'];


                        break;

                    }

                }
                $pos++;
            }

        }
    }


    echo "</p>
                                </div>
                            </div>

                   </div>";

}
?>