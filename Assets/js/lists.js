
$edit_list_form.submit(function(e){
    e.preventDefault();
    saveList();
});

$delete_btn.on('click', function(){
    deleteList();
});

function saveList(){

    var list_id = $list_id.val();
    var list_name = $edit_list_name.val();
    var $list = $('.'+list_id+'');
    var listPermissionBox = $edit_list_modal.find('#list-permission-chkbox');
    var listPermission = listPermissionBox.prop('checked') == true ? 1 : 0;

    var edit_post = $.post("controllers/ListController.php", {

        list_id: list_id,
        list_name: list_name,
        list_permission: listPermission,
        list_option: 'save'
    });

    edit_post.done(function(data){
        $list.text(data);
        $list.closest('li').data('editable', listPermission);
        $list.closest('li').attr('data-editable', listPermission); // visual purposes this changes in inspector mode
        $edit_list_modal.removeClass('active');
    }

    );

}

function deleteList(){
    var list_id = $list_id.val();
    var $list = $('.'+list_id+'');

    var delete_post = $.post("controllers/ListController.php", {
        list_id: list_id,
        list_option: 'delete'
    });

    delete_post.done(function(){
        $list.closest('.list-wrapper').remove(); // removes the list from the main page
        $list.remove(); // removes the list from the settings page
        $edit_list_modal.removeClass('active');

    });
}


/*** ADD ITEMS ***/

var $new_item_form = $('.new-item-form');
var onShareListType;
var itemsToBuy;

$new_item_form.submit(function(e){
    e.preventDefault();

    var item_form = $(this);
    itemsToBuy = $(this).closest('.list-wrapper').find('.items-to-purchase');
    var item_name_input = item_form.find('.new_item_name');
    onShareListType = item_form.attr('rel');
    var item_name = item_name_input.val();

    var item_quantity_input = item_form.find('.new_item_quantity');
    var item_quantity = item_quantity_input.val();

    var item_note_input = item_form.find('.new_item_note');
    var item_note = item_note_input.val();

    var list_id = item_form.find('.list_id').val();


    var add_item_post = $.post("controllers/itemcontroller.php", {

        new_item_name: item_name,
        new_item_quantity: item_quantity,
        new_item_note: item_note,
        list_id: list_id

    });


    add_item_post.done(function(item_data){

        var item = JSON.parse(item_data);

        var itemSettings = onShareListType == 0 ? "<li class='add-note-click'>Add Note</li>" : "<li class='edit_item_name'>Edit Item</li>"+
                                                                                                       "<li class='delete-item-click'>Delete Item</li>"+
                                                                                                       "<li class='add-note-click'>Add Note</li>";

        var quantity = item.quantity > 1 ? "("+item.quantity+")" : "";

        var item_tmpl = "<div class='item-wrapper' rel='"+item.id+"'>" +
                          "<div class='item-container'>" +
                            "<div class='container'>" +
                                "<input type='checkbox' class='set-as-purchased'>" +
                                "<div class='item-name-container'>" +
                                  "<form class='edit-item-name-form'>"+
                                    "<p class='item-name-edit edit'><input class='item-name-edit-input' type='text'></p>"+
                                    "<input type='text' class='edit-item-quantity edit'>"+
                                    "<input type='submit' class='save-edit-name-btn edit' value='save'>"+
                                  "</form>"+
                                    "<p class='item-name item"+item.id+" no-edit'>"+ item.name +"</p>" +
                                    "<span class='quantity no-edit' rel='"+item.quantity+"'>"+
                                        quantity+
                                    "</span>" +
                                "</div>" +
                                "<div class='item-settings-wrapper' rel='"+item.id+"'><img src='assets/img/item-settings-icon.png' class='item-settings'></div>"+
                            "</div>"+
                            "<div class='notes'><p>"+item_note+"</p>"+
                                "<form class='add-new-note-form'>"+
                                  "<input type='text' class='new-note-input edit'/>"+
                                  "<input type='submit' value='Save' class='save-note-btn edit'/>"+
                                "</form>"+
                            "</div>"+
                          "</div>"+
                          "<div class='item-settings-nav' id='item-settings"+item.id+"'>"+
                            "<ul>"+
                                itemSettings+
                            "</ul>"+
                          "</div>"+
                       "</div>";


        $(item_tmpl).appendTo(itemsToBuy);

        item_name_input.val("");
        item_quantity_input.val(1);
        item_note_input.val("");

        item_name_input.focus();


    });
});



