<?php

function itemTemplate($item, $note_data, $is_editable = true){

    $items = "<div class='item-wrapper' rel='".$item['item_id']."'>
                <div class='item-container'>
                    <div class='container'>";

    $item['purchased'] == 1 ?
        $items .= "<img src='assets/img/checked-box-icon.png' class='bought-item-check'/>" :
        $items .= "<div class='custom-checkbox set-as-purchased'>
                        <input type='checkbox' id='set-as-purchased'>
                        <label for='set-as-purchased' class='custom-checkbox-label'></label>
                   </div>";

    $items .= "<div class='item-name-container'>
                <form class='edit-item-name-form'>
                    <p class='item-name-edit edit'><input class='item-name-edit-input' type='text'></p>
                        <input type='text' class='edit-item-quantity edit'>
                        <input type='submit' class='save-edit-name-btn edit regular-btn' value='save'>
                </form>";

    $item['purchased'] == 1 ?
        $items .= "<p class='item-name item".$item['item_id']." no-edit bought-item'>".$item['item_name']."</p>
                        <span class='quantity no-edit' rel='".$item['quantity']."'>" :
        $items .= "<p class='item-name item".$item['item_id']." no-edit'>".$item['item_name']."</p>
                        <span class='quantity no-edit' rel='".$item['quantity']."'>";

    if($item['quantity'] > 1 )
        $items .= "(".$item['quantity'].")";


    $items .= "</span>
                  </div>"; //end item name container

    $items .= "<div class='item-settings-wrapper' rel='" . $item['item_id'] . "'></div>";

    $items .= "</div>
                <div class='notes'>";


    foreach($note_data as $note){

        if($note['item_id'] === $item['item_id']){

            $items .= "<p>".$note['content']."</p>";

        }
    }

    $items .= "<form class='add-new-note-form'>
                 <input type='text' class='new-note-input edit'/>
                 <input type='submit' value='Save' class='save-note-btn edit regular-btn'/>
               </form>
            </div>
            </div>
            <div class='item-settings-nav' id='item-settings".$item['item_id']."'>
                <ul>";

    if($item['purchased'] == 1 && $is_editable == true){

        $items .= "<li class='delete-item-click'>Delete Item</li>";

    }else if($is_editable == false){
        $items .= "<li class='add-note-click'>Add Note</li>";
    }else{

        $items .= " <li class='edit_item_name'>Edit Item</li>
                    <li class='delete-item-click'>Delete Item</li>
                    <li class='add-note-click'>Add Note</li>";
    }

    $items .= "</ul>
             </div>
          </div>"; // end item wrapper

    return $items;
}

?>

<div class="lists-container">

    <div id="my-lists-container">
        <?php require_once 'views/includes/my_lists.php' ?>
    </div>

    <div id="shared-lists-container">
        <?php require_once 'views/includes/shared_lists.php' ?>
    </div>

</div> <!-- end list container-->

<!--CONFIRM ITEM PURCHASE MODAL-->
<div class="modal-wrapper purchase-item-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" /></div>
        <form id="purchase-item-form">
            <p>Set item "<span id="purchased-item-name"></span>" as purchased?</p>
            <input type="submit" class="green-btn" id="submit-purchased-item" value="Yes"/>
            <input type="button" class="red-btn cancel-btn" id="cancel-purchased-item" value="No"/>
        </form>
    </div>
</div>


<!--SHARE LISTS MODAL-->
<div class="modal-wrapper share-list-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" /></div>
        <form id="share-list-form">
            <label class="error-msg"></label>
            <p>Who would you like to share "<span id="shared-list-name"></span>" with?</p>
            <div class="select-contacts-wrapper">
                <select id="select-contacts" multiple></select>
            </div>
            <input type="submit" class="share-list-btn" id="submit-shared-list" value="Share"/>
            <input type="button" class="red-btn cancel-btn" id="cancel-shared-list" value="Cancel"/>
        </form>
    </div>
</div>