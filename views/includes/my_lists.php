<?php

// BEGIN LIST DATA LOOP

foreach($list_data as $list){

    $purchased_items = "";
    $items_to_purchase = "";
    $names_shared_with = "";

    foreach($item_data as $item){

        if($item['list_id'] === $list['list_id']){

            if($item['purchased'] == 0){

                $items_to_purchase .= itemTemplate($item, $note_data);

            }else if($item['purchased'] == 1 ){

                $purchased_items .= itemTemplate($item, $note_data);
            }
        }
    } // end item loop

    // get names for who a list is shared with
    $pos = 0;
    for( $l = 0 ; $l < count($shared_list_data) ; $l++){

        if($shared_list_data[$l]['list_id'] === $list['list_id']){

            for($i = 0 ; $i < count($shared_lists_names) ; $i++){

                if ($shared_list_data[$l]['viewer_id'] === $shared_lists_names[$i]['user_id']){

                    if($pos ==  0)
                        $names_shared_with .= $shared_lists_names[$i]['creator'];
                    else
                        $names_shared_with .= ", " . $shared_lists_names[$i]['creator'];
                    break;
                }
            }

            $pos++;
        }
    }

    echo "<div class='list-wrapper'>

            <div class='list-heading'>
                <h4 class='list-name ".$list['list_id']."'>".$list['list_name']."</h4>
                <div class='created-info'>
                    <p class='small date-created'>".date("m/d/y h:i a",strtotime($list['created_at']))."</p>
                    <p class='small created-by'>by: ".$list['creator']."</p>
                </div>
            </div> <!-- end list heading -->

            <div class='list-body'>
                <div class='items-to-purchase'>".$items_to_purchase."</div>
                <div class='purchased-items'>".$purchased_items."</div>

                <form class='new-item-form' rel='my-list'>
                    <table>
                        <tr>
                            <td>Item Name</td>
                            <td>Quantity</td>
                            <td>Note</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><input type='text' class='new-item-name'/></td>
                            <td><input type='text' class='new-item-quantity' value='1'/></td>
                            <td><input type='text' class='new_item_note'/></td>
                            <td><input type='submit' class='regular-btn' value='add item' /></td>
                        </tr>
                        <tr>
                            <td><input type='hidden' class='list-id' value='".$list['list_id']."'/></td>
                        </tr>
                    </table>
              </form>
            </div> <!-- end list body -->

            <div class='list-footer'>
                <div class='container'>
                    <p class='shared-with'>Shared With:</p>
                    <p class='shared-with-names'>".$names_shared_with."</p>
                </div>
                <input type='submit' value='Share List' class='share-list-btn' rel='".$list['list_id']."'>
            </div> <!-- end list footer -->

          </div> <!-- end list wrapper -->";

} // end list loop
