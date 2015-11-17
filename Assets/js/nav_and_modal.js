
// navigation menu animation selectors
var $nav = $('.main-navigation');
var $header = $('.top-heading');
var $section = $('section');
var $footer = $('footer');
var $nav_tgl = $('#nav-toggle');
var $menu_icon = $nav_tgl.find('.menu-icon-bar');
var $sub_nav_tgl = $('.sub-nav-tgl');
var $sub_nav = $('.sub-nav');
var $sub_nav_op = $('#list-sub-nav li');

var $modal = $('.modal-wrapper');

// edit list window selectors
var $edit_list_form = $modal.find('#edit-list-form');
var $new_list_modal = $('.new-list-modal');
var $new_list_close_btn = $new_list_modal.find('.close-btn');
var $edit_list_modal = $('.edit-list-modal');
var $edit_list_close_btn = $edit_list_modal.find('.close-btn');
var $save_btn = $modal.find('.save-btn');
var $delete_btn = $modal.find('.delete-btn');
var $close_btn = $modal.find('.close-btn');
var $list_id = $modal.find('#id_hidden');
var $edit_list_name = $modal.find('#edit-list-name-field');

// new list selectors
var $new_list_form = $('#new-list-form');
var $new_list_name = $new_list_form.find('#new-list-name');
var $new_item = $new_list_form.find('.new-item');


// new list modal window selectors
var $new_list_name_field = $modal.find('#new-list-name-field');
var $another_item_btn = $modal.find('.another-item-btn');
var $new_items_table = $modal.find('#new-list-items-wrapper');
var $list_cancel_btn = $modal.find('.red-btn');

// list selectors
var $list_wrapper = $('.list-wrapper');
var $list = $('.list-name');
var $list_body = $('.list-body');
var $list_footer = $('.list-footer');

// item settings selectors
var $item_container = $('.item-container');
var $item_wrapper = $('.item-wrapper');
var $item_settings = $item_container.find('.item-settings-wrapper');
//var $item_settings_nav = $item_wrapper.find('.item-settings-nav');


function showNav(){
    $nav.toggleClass('active');
    $header.toggleClass('active');
    $section.toggleClass('active');
    $footer.toggleClass('active');
}

function closeModal($modal){
    $modal.css({
        'transition':'none',
        'visibility':'hidden',
        'opacity':'0'});
}

function openModal($modal){
    $modal.css({
        'transition': 'all .6s ease',
        'visibility':'visible',
        'opacity' : '1'});
}

$nav_tgl.on('click', function(){
    showNav();
    $menu_icon.toggleClass('active');
});

$list.on('click', function(){
    var $list_body = $(this).parent('div').next($list_body); // change to .next('.list-body') if animation does not work correctly

    $list_body.next($list_footer).slideToggle();  // change to .next('.list-footer') if animation does not work correctly
    $list_body.slideToggle();
});

$sub_nav_tgl.on('click', function(){
    $sub_nav = $(this).next($sub_nav).slideToggle();
});

$sub_nav_op.on('click', function(){
    var $value = $(this).text();
    var $id = $(this).attr('rel');
    $list_id.val($id);
    $edit_list_name.val($value);
    $edit_list_modal.toggleClass('active');
    $edit_list_name.select().focus();
});

$new_list_close_btn.on('click', function(){
    $new_list_modal.toggleClass('active');
});

$edit_list_close_btn.on('click', function(){
    $edit_list_modal.toggleClass('active');
});

$list_wrapper.on('click', '.item-settings-wrapper', function(){
    var $nav_number = $(this).attr('rel');
    $(this).closest('.item-wrapper').find('#item-settings'+$nav_number).toggleClass('active');
});


$(window).load(function(){
    var $list_body = $('.list-body');
    var $list_footer = $('.list-footer');
    $list_body.hide();
    $list_footer.hide();
    $sub_nav.hide();
});


$new_list_form.submit(function(e){
    e.preventDefault();

    var list_name = $new_list_name.val();
    $new_list_name_field.val(list_name);

    $new_list_modal.toggleClass('active');
    $save_btn.focus();
});

$list_cancel_btn.on('click', function(){
    $new_list_modal.toggleClass('active');
});



/*** EDIT ITEMS ***/

$list_wrapper.on('click', '.edit_item_name', function(){
    var $item_wrapper = $(this).closest('.item-wrapper');
    var $item = $item_wrapper.find('.item-name');
    var $item_edit = $item_wrapper.find('.item-name-edit-input');
    var $edit_quantity = $item_wrapper.find('.edit-item-quantity');

    var $item_quantity = $item_wrapper.find('.quantity').attr('rel');
    var $item_name = $item.text();

    $item_edit.focus();
    $edit_quantity.val($item_quantity);
    $item_edit.val($item_name);


    $item.closest('.item-wrapper').find('.container').toggleClass('edit');

});

$list_wrapper.on('submit', '.edit-item-name-form', function(e){
    e.preventDefault();
    var $edit_item_form = $(this);
    var $item_id = $edit_item_form.closest('.item-wrapper').attr('rel');
    var $item_name = $edit_item_form.find('.item-name-edit-input').val();
    var $item_quantity = $edit_item_form.find('.edit-item-quantity').val();

    var edit_item = $.post('controllers/itemcontroller.php', {

        edit_item_name : $item_name,
        edit_item_quantity : $item_quantity,
        item_id : $item_id,
        edit_item : 'true'
    });

    edit_item.done(function(data){

    // modify dom to add edited item

    });


});


/*** ADD NOTE ***/

$list_wrapper.on('click', '.add-note-click', function(){
    var new_note_form = $(this).closest('.item-wrapper').find('.add-new-note-form');
    var note_input = new_note_form.find('.new-note-input');

    new_note_form.toggleClass('edit');
    note_input.focus();
});

$list_wrapper.on('submit', '.add-new-note-form', function(e){
    e.preventDefault();
    var note_form = $(this);
    var note_input = note_form.find('.new-note-input');
    var note_content = note_input.val();
    var item_id = note_form.closest('.item-wrapper').attr('rel');
    var new_note_form = $(this).closest('.item-wrapper').find('.add-new-note-form');

    var new_note_post;

    if(note_content !="" ){
        new_note_post = $.post('controllers/notecontroller.php', {

            item_id: item_id,
            note_content: note_content

        });
    }

    new_note_post.done(function(data){
        $("<p>"+note_content+"</p>").insertBefore(note_form);

        new_note_form.toggleClass('edit');
        note_input.val("");

    });

});


/*** DELETING ITEMS ***/
$list_wrapper.on('click', '.delete-item-click', function(){

    var item = $(this).closest('.item-wrapper');
    var item_id = item.attr('rel');

    var delete_item = $.post('controllers/itemcontroller.php', {

        item_id : item_id,
        delete_item : 'true'
    });

    delete_item.done(function(){

        item.remove();

    });


});