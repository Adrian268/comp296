
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
var $edit_list_modal = $('.edit-list-modal');
var $save_btn = $modal.find('.save-btn');
var $delete_btn = $modal.find('.delete-btn');
var $close_btn = $modal.find('.close-btn');
var $list_id = $modal.find('#id_hidden');
var $list_name = $modal.find('#list_name');

// new list selectors
var $new_list_form = $('#new-list-form');
var $new_list_name = $new_list_form.find('#new-list-name');
var $new_item = $new_list_form.find('.new-item');


// new list modal window selectors
var $list_name_field = $modal.find('#list_name');
var $another_item_btn = $modal.find('.another-item-btn');
var $new_items_table = $modal.find('#new-list-items-wrapper');
var $list_cancel_btn = $modal.find('.delete-btn');

// list selectors
var $list = $('.list-name');
var $list_body = $('.list-body');
var $list_footer = $('.list-footer');

// item settings selectors
var $item_container = $('.item-container');
var $item_settings = $item_container.find('.item-settings-wrapper');


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
    $list_name.val($value);
    openModal($edit_list_modal)
});

$close_btn.on('click', function(){
    closeModal($modal);
});

$item_settings.on('click', function(){
    $(this).closest($item_container).toggleClass('active');
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

    $list_name = $new_list_name.val();
    $list_name_field.val($list_name);

    openModal($new_list_modal);
});

$list_cancel_btn.on('click', function(){
    closeModal($modal);
});



//$another_item_btn.on('click', function(){
//
//    var new_item_tr = "<tr class='new-list-item'>"+
//                        "<td><input type='text' class='new-item'' id='item"+list_num+"'/></td>" +
//                        "<td><input type='text' class='item-quantity'' /></td>" +
//                   "</tr>";
//
//    list_num++;
//
//
//    $new_items_table.append(new_item_tr);
//});

