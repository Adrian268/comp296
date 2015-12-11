
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
var $list_cancel_btn = $modal.find('#cancel-list');

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


/**** EDIT ACCOUNT INFO ***/
var $edit_account_tgl = $('#edit-account-tgl');
var $edit_account_modal = $('.edit-account-modal');
var $edit_account_form = $edit_account_modal.find('#edit-account-form');
var $edit_name_input = $edit_account_modal.find('#edit-name-input');
var $edit_email_input = $edit_account_modal.find('#edit-email-input');
var $edit_account_close = $edit_account_modal.find('.close-btn');
var $cancel_account_edit = $edit_account_modal.find('#cancel-account-edit');
var $user_name = $('#user-name');
var $user_email = $('#user-email');
var $er_lbl = $('.error-msg');

$edit_account_tgl.on('click', function(e){
    $edit_name_input.val($user_name.text());
    $edit_email_input.val($user_email.text());
    $edit_account_modal.toggleClass('active');
    $change_password_form.hide();
    $edit_name_input.focus();
});

$edit_account_close.on('click', function(){
    $edit_account_modal.toggleClass('active');
});

$cancel_account_edit.on('click', function(){
    $edit_account_modal.toggleClass('active');
});


$edit_account_form.submit(function(e){
    e.preventDefault();

    var name = $edit_name_input.val();
    var email = $edit_email_input.val();
    var er_label = $(this).find('.error-msg');

    var edit_account;

    edit_account = $.post('controllers/accountcontroller.php', {
        new_name: name,
        new_email: email,
        edit_account_info: 'true'
    });

    edit_account.done(function(data){

        var user = JSON.parse(data);

        $user_name.text(user.name);
        $user_email.text(user.email);

        $edit_account_modal.toggleClass('active');

    });

});


/** change password form **/
var $change_password_form = $edit_account_modal.find('#change-password-form');
var $change_password_btn = $edit_account_modal.find('#show-password-form');

$change_password_btn.on('click', function(){
    $change_password_form.slideToggle();
});

$change_password_form.submit(function(e){
    e.preventDefault();

    var password = $(this).find('#edit-password-input').val();
    var password_cf = $(this).find('#confirm-edit-password-input').val();
    var email = $user_email.text();
    var er_label = $(this).find('.error-msg');
    var change_password;

    if(password === password_cf){
        change_password = $.post('controllers/accountcontroller.php', {

            new_password : password,
            new_password_cf : password_cf,
            email: email,
            change_password_rqst : 'true'
        });
    }else{

        er_label.text("Passwords do not match.");
    }

    change_password.done(function(data){

        if(data === "true"){

            $change_password_form.find('#edit-password-input').val("");
            $change_password_form.find('#confirm-edit-password-input').val("");
            er_label.text("");
            $edit_account_modal.toggleClass('active');

        }else{
            er_label.text(data);
        }
    });


});


/**************** -- ********************/


/*** delete account ***/

var $delete_account_tgl = $('#delete-account-tgl');
var $delete_account_modal = $('.delete-account-modal');
var $delete_account_form = $delete_account_modal.find('#delete-account-form');
var $password_field = $delete_account_form.find('#confirm-password-for-delete');
var $submit_account_delete = $delete_account_form.find('#submit-account-delete');
var $cancel_delete_account = $delete_account_form.find('#cancel-account-delete');
var $close_delete_account = $delete_account_modal.find('.close-btn');
var $er_label = $delete_account_form.find('.error-msg');


$delete_account_tgl.on('click', function(){

    $delete_account_modal.toggleClass('active');

});

$close_delete_account.on('click', function(){
    $delete_account_modal.toggleClass('active');
});

$cancel_delete_account.on('click', function(){
    $delete_account_modal.toggleClass('active');
});

$delete_account_form.submit(function(e){
    e.preventDefault();

    var password = $password_field.val();

    var delete_account_post = $.post("controllers/accountcontroller.php",{

        confirm_password : password,
        delete_account_rqst : true

    });

    delete_account_post.done(function(data){

        if(data === 'true'){

            window.location = 'http://localhost/listapp/index.php';

        }else{
            $password_field.val("");
            $er_label.text(data);
        }

    });


});


/********* -------- ***/


function showNav(){
    $nav.toggleClass('active');
    $header.toggleClass('active');
    $section.toggleClass('active');
    $footer.toggleClass('active');
}


$nav_tgl.on('click', function(){
    showNav();
    $menu_icon.toggleClass('active');
});

$list.on('click', function(){
    var $list_body = $(this).parent('div').next($list_body); // change to .next('.list-body') if animation does not work correctly

    $list_body.next($list_footer).slideToggle();  // change to .next('.list-footer') if animation does not work correctly
    $list_body.slideToggle();
    $(this).closest('.list-wrapper').find('.new_item_name').focus();
});

$sub_nav_tgl.on('click', function(){
    $sub_nav = $(this).next($sub_nav).slideToggle();
});

var editListModalChckBox = $edit_list_modal.find('#list-permission-chkbox');
$sub_nav_op.on('click', function(){
    var $value = $(this).text();
    var $id = $(this).attr('rel');
    var editable = $(this).data('editable');

    $list_id.val($id);
    $edit_list_name.val($value);
    editable == 1 ? editListModalChckBox.prop("checked", true): editListModalChckBox.prop("checked", false) ;
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
    var itemSettings = $(this).closest('.item-wrapper').find('#item-settings'+$nav_number);
    var numOfSettings = itemSettings.find('li');
    var height = numOfSettings.length == 3 ? "78px" : "26px";

    if(itemSettings.hasClass('active')){
        itemSettings.css({
            'height': "0px"
        });
        itemSettings.removeClass('active');
    }else{
        itemSettings.css({
            'height': height
        });
        itemSettings.addClass('active');
    }



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


    $edit_quantity.val($item_quantity);
    $item_edit.val($item_name);


    $item.closest('.item-wrapper').find('.container').toggleClass('edit');
    $item_edit.focus();

});

$list_wrapper.on('submit', '.edit-item-name-form', function(e){
    e.preventDefault();
    var $edit_item_form = $(this);
    var $item_id = $edit_item_form.closest('.item-wrapper').attr('rel');
    var $item_name = $edit_item_form.find('.item-name-edit-input').val();
    var $item_quantity = $edit_item_form.find('.edit-item-quantity').val();

    var $item_wrapper = $(this).closest('.item-wrapper');
    var $item_name_field = $item_wrapper.find('.item-name');
    var $item_quantity_field = $item_wrapper.find('.quantity');

    var edit_item = $.post('controllers/itemcontroller.php', {

        edit_item_name : $item_name,
        edit_item_quantity : $item_quantity,
        item_id : $item_id,
        edit_item : 'true'
    });

    edit_item.done(function(item_data){

        var item = JSON.parse(item_data);

        $item_name_field.text(item.name);

        if(item_data == 'false'){

            location.reload();

        }else{

            if( item.quantity > 1 ){
                $item_quantity_field.attr('rel', item.quantity);
                $item_quantity_field.text('('+item.quantity+')');
            }else{

                $item_quantity_field.attr('rel', 1);
                $item_quantity_field.text('');
            }

            $item_wrapper.find('.container').toggleClass('edit');
        }

    });


});

/*** set items as purchased ***/

var purchaseItemModal = $('.purchase-item-modal');
var purchaseItemForm = purchaseItemModal.find('#purchase-item-form');
var purchaseItemModalName = purchaseItemModal.find('#purchased-item-name');
var closePurchaseItemModal = purchaseItemModal.find('.close-btn');
var cancelPurchaseItemModal = purchaseItemModal.find('#cancel-purchased-item');
var purchasedItems;
var item;
var itemName;

$list_wrapper.on('click', '.set-as-purchased', function(e){
    e.preventDefault();

    purchaseItemModal.toggleClass('active');

    item = $(this).closest('.item-wrapper');
    purchasedItems = $(this).closest('.list-wrapper').find('.purchased-items');
    itemName= item.find('.item-name');

    purchaseItemModalName.text(itemName.text());

});

purchaseItemForm.submit(function(e){
    e.preventDefault();

    var purchaseItemPost;
    var checkBox = item.find('.set-as-purchased');
    var itemId = item.attr('rel');
    var itemSettingsContainer = item.find('.item-settings-nav');
    var editItemSetting = item.find('li.edit_item_name');
    var addNoteSetting = item.find('li.add-note-click');
    var checkMark = $("<img src='assets/img/checked-box-icon.png' class='bought-item-check'/>");

    purchaseItemPost = $.post("controllers/itemcontroller.php",{

        item_id : itemId,
        purchased : 1,
        set_item_as_purchased : true
    });

    purchaseItemPost.done(function(){

        checkMark.insertAfter(checkBox);
        checkBox.remove();
        itemName.addClass('bought-item');

        if(editItemSetting.length > 0){
            editItemSetting.remove();
            addNoteSetting.remove();

            if(itemSettingsContainer.hasClass('active'))
                itemSettingsContainer.css({'height': "26px"});
        }

        item.appendTo(purchasedItems);

        purchaseItemModal.removeClass('active');

    });

});

closePurchaseItemModal.on('click', function(){ purchaseItemModal.removeClass('active') });
cancelPurchaseItemModal.on('click', function(){ purchaseItemModal.removeClass('active') });


/*** SHARE LISTS ***/
var shareBtn = $list_wrapper.find('.share-list-btn');
var shareListModal = $('.share-list-modal');
var shareListForm = shareListModal.find('#share-list-form');
var shareListName = shareListModal.find('#shared-list-name');
var selectContactList = shareListModal.find('#select-contacts');
var shareListError = shareListModal.find('.error-msg');
var closeShareListModal = shareListModal.find('.close-btn');
var cancelShareListModal = shareListModal.find('#cancel-shared-list');
var sharedWithNames, listId;


shareBtn.on('click', function(){

    var listName = $(this).closest($list_wrapper).find('.list-name').text();
    sharedWithNames = $(this).closest($list_wrapper).find('.shared-with-names');
    listId = $(this).attr('rel');

    shareListError.text("");
    loadContacts();
    shareListName.text(listName);
    shareListModal.toggleClass('active');

});

shareListForm.submit(function(e){
    e.preventDefault();

    var shareListPost;
    var sharedContacts = [];
    var selectList = selectContactList.find('option:selected');

    selectList.each(function(){
        sharedContacts.push($(this).prop('value'));
    });

    if(sharedContacts.length > 0 ){

    shareListPost = $.post("controllers/listcontroller.php", {
        shared_list_id : listId,
        shared_with_contacts : sharedContacts,
        share_list_rqst : true
    });

    shareListPost.done(function(data){

        var names = JSON.parse(data);

        for (var index in names){

            if(sharedWithNames.text() === "")
                sharedWithNames.append(names[index]);
            else
                sharedWithNames.append(", "+names[index]);

        }

        shareListModal.removeClass('active');
    });

    }else{
        shareListError.text("Please select at least 1 contact");
    }

});

function loadContacts(){

    var contacts = contactsListWrapper.find('li');
    selectContactList.text('');

    contacts.each(function(){
        var contactEmail = $(this).find('.contact-email');
        var contactName = $(this).find('.contact-name');
        var contactId = $(this).attr('rel');

    if(contacts.length > 0)
        $("<option value='"+contactId+"' id='"+contactName.text()+"'>"+contactName.text()+" ("+contactEmail.text()+")</option>").appendTo(selectContactList);

    });
}


//function getSelectedContactsName(){
//
//    var contactNameArray = [];
//    var contactOptions = selectContactList.find('option:selected');
//
//    contactOptions.each(function(){
//        contactNameArray.push($(this).attr('id'));
//    });
//
//    return contactNameArray;
//}

closeShareListModal.on('click', function(){ shareListModal.removeClass('active')});
cancelShareListModal.on('click', function(){ shareListModal.removeClass('active')});




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

    delete_item.done(function(data){

        data == "true" ? item.remove() : location.reload();

    });


});

/** show contacts **/

var showContacts = $('#view-contacts');
var contactsWindow = $('.contacts-wrapper');
var goBack = contactsWindow.find('.go-back');

showContacts.on('click',function(){
    contactsWindow.toggleClass('active');
});

goBack.on('click', function(){
    contactsWindow.toggleClass('active');
    clearContactMsg();
});

function clearContactMsg(){
    contactCf.text("");
    contactErr.text("");
}

/**** ADD CONTACTS ***/

var contactsForm = contactsWindow.find('#add-contact-form');
var contactEmailField = contactsForm.find('#add-contact-input');
var contactCf = contactsWindow.find('#add-contact-msg');
var contactErr = contactsWindow.find('#add-contact-error');
var contactsListWrapper = contactsWindow.find('#contacts-list-wrapper');
var noContacts = contactsWindow.find('#no-contacts');

contactsForm.submit(function(e){
    e.preventDefault();

    var contactEmail = contactEmailField.val();

    var addContactPost = $.post('controllers/contactscontroller.php',{
        contact_email : contactEmail,
        add_new_contact : true
    });

    addContactPost.done(function(contact){
        //alert(contact);
        clearContactMsg();

        switch(contact){

            case "1": // error 1, no user by that email
                setContactMsg("Sorry, there is no user by that email", contactErr);
                break;
            case "2": // error 2, can't add self
                setContactMsg("You can't add yourself", contactErr);
                break;
            case "3": // error 3, already a contact
                setContactMsg("That person is already in your contacts", contactErr);
                break;
            default: // no errors, contact was added
                contact = JSON.parse(contact);
                var contactDiv = contactTmpl(contact);

                if(noContacts.is('li')){
                    noContacts.remove();
                }

                $(contactDiv).fadeIn().appendTo(contactsListWrapper);
                setContactMsg("Contact Saved ", contactCf);

        }

    });
});

function setContactMsg(msg, div){
    $("<p>"+msg+"</p>").fadeIn().appendTo(div);
}

function contactTmpl(contact){

    var contactImg = contact.profilePic == true ? "<div class='contact-img-pic'><img src='users/"+contact.contactId+"/img/profilepic.jpg'></div>" : "<div  class='contact-img'>"+contact.contactInit+"</div>";

    return "<li rel='"+contact.contactId+"'>"+
             contactImg+
             "<div><p class='contact-name'>&nbsp;"+contact.contactName+"</p></div>"+
             "<div class='contact-email'> "+contact.contactEmail+"</div>"+
             "<div class='remove-contact'><img src='assets/img/remove-contact.png'/></div>"+
           "</li>";

}





/*** DELETE CONTACT ***/
var contactDeleteModal = $('.delete-contact-modal');
var contactDeleteName = contactDeleteModal.find('#contact-delete-name');
var contactDeleteEmail = contactDeleteModal.find('#contact-delete-email');
var contactDeleteId = contactDeleteModal.find('#contact-delete-id');
var cancelDeleteContact = contactDeleteModal.find('#cancel-contact-delete');
var closeDeleteContact = contactDeleteModal.find('.close-btn');

cancelDeleteContact.on('click',function(){
    contactDeleteModal.toggleClass('active');
});

closeDeleteContact.on('click',function(){
    contactDeleteModal.toggleClass('active');
});

contactsListWrapper.on('click', '.remove-contact',function(){
    var contact = $(this).closest('li');
    var contactId = contact.attr('rel');
    var contactName = contact.find('.contact-name').text();
    var contactEmail = contact.find('.contact-email').text();

    contactDeleteName.text(contactName);
    contactDeleteEmail.text(contactEmail);
    contactDeleteId.val(contactId);

    contactDeleteModal.toggleClass('active');
});

var deleteContactForm = contactDeleteModal.find('#delete-contact-form');

deleteContactForm.submit(function(e){
    e.preventDefault();

    var cId    = contactDeleteId.val();
    var cName  = contactDeleteName.text();
    var cEmail = contactDeleteEmail.text();

    var deleteContactPost = $.post('controllers/contactscontroller.php',{

        contact_id          : cId,
        contact_name        : cName,
        contact_email       : cEmail,
        delete_contact_rqst : true

    });

    deleteContactPost.done(function(){

        clearContactMsg();
        var removeContactInt;

        var contact = $("li[rel="+cId+"]");

        contact.css({'transform' : 'translateX(500px)'});

        // wait .5s and then remove the li element, this allows the css:'transform' to animate
        removeContactInt = setInterval(function(){
            contact.remove();
            clearInterval(removeContactInt);
        }, 500);


        contactDeleteModal.toggleClass('active');
        setContactMsg("Contact Deleted", contactErr);

    });

});


//list type underlining

var listTypeTgl = $('#choose-list li');
var listTypeSection = $('#list-type');
var sharedListsContainer = $('#shared-lists-container');
var myListsContainer = $('#my-lists-container');

//var myListsTgl = listTypeTgl.find('#my_lists');
//var sharedListsTgl = listTypeTgl.find('#shared_lists');

listTypeTgl.on('click', function(){
    var listType = $(this).attr('rel');

    listTypeTgl.each(function(){
        $(this).removeClass('active');
    });

    $(this).addClass('active');

    if(listType == 'sharedlists'){
        myListsContainer.hide();
        sharedListsContainer.show();
    }
    else if(listType == 'mylists'){
        sharedListsContainer.hide();
        myListsContainer.show();
    }


});


//uploading profille pic
var changePictureTgl = $('#add-profile-picture');

var changePicModal = $('.change-profile-pic-modal'),
    picModalWindow = changePicModal.find('.modal'),
    closePicModal = changePicModal.find('.close-btn'),
    profilePicForm = changePicModal.find('#change-profile-pic-form'),
    profilePicError = profilePicForm.find('.error-msg'),
    cancelProfilePic = profilePicForm.find('#cancel-profile-pic');

var profilePicContainer = $('.profile-pic');
var formData, profilePic, imgSrc;

changePictureTgl.on('click', function(){changePicModal.addClass('active')});
closePicModal.on('click', function(){changePicModal.removeClass('active')});
cancelProfilePic.on('click', function(){changePicModal.removeClass('active')});

profilePicForm.submit(function(e){
    e.preventDefault();

    profilePicError.text("Uploading...");
    picModalWindow.addClass('active');

    formData = new FormData(document.getElementById('change-profile-pic-form'));

    $.ajax({

        url: "controllers/accountcontroller.php",
        type: "POST",
        data: formData,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false
    }).done(function(result){
        var d = new Date();

        profilePicError.text(" ");
        picModalWindow.removeClass('active');

        switch(result){

            case "1":
                profilePicError.text("Please select a file");
                break;
            case "2":
                profilePicError.text("Please select a valid file");
                break;
            case "3":
                profilePicError.text("Sorry, an error occurred, please try again");
                break;
            default:

                imgSrc = 'users/'+result+'/img/profilepic.jpg?'+ d.getTime(); // a time is added as a query variable to reload img src
                profilePic = $("<img src='"+imgSrc+"'>");

                profilePicContainer.html("");
                profilePicContainer.attr('class', 'contact-img-pic-lrg profile-pic');
                profilePic.appendTo(profilePicContainer);

                changePicModal.removeClass('active')
        }

    });

});

/*** deleting profile pic ***/
var deleteProfilePicTgl = $('#remove-profile-picture');

deleteProfilePicTgl.on('click', function(){

    var deleteProfilePicPost;
    var initial = profilePicContainer.attr('rel');

    profilePicContainer.html("");
    profilePicContainer.attr('class', 'contact-img-lrg profile-pic');
    profilePicContainer.text(initial);


    deleteProfilePicPost = $.post('controllers/accountcontroller.php', {
        delete_profile_pic : true
    });

    deleteProfilePicPost.done(function(result){

    });

});

$(window).load(function(){
    var $list_body = $('.list-body');
    var $list_footer = $('.list-footer');
    $list_body.hide();
    $list_footer.hide();
    $sub_nav.hide();
    sharedListsContainer.hide();
});