// list selectors
var listWrappers = $('.list-wrapper');
var list = $('.list-name');

/*** ANIMATING LISTS ***/
list.click(function(){
    var listClass = $(this).attr('class');
    var listName  = listClass.split(" ");
    var listWrapper = $(this).closest('.list-wrapper');
    var listBody   = listWrapper.find('.list-body');
    var listFooter = listWrapper.find('.list-footer');
    var itemNameInput = listWrapper.find('.new-item-name');

    listWrapper.toggleClass('showing');

    // save cookie to show the opened list when page reloads
    listWrapper.hasClass('showing') ? document.cookie="activeList="+listName[1] : document.cookie="activeList=none";

    listBody.slideToggle();
    listFooter.slideToggle();

    // set focus on the item name form field
    itemNameInput.focus();

});


/** ITEM SETTINGS ANIMATION ***/
listWrappers.on('click', '.item-settings-wrapper', function(){
    var navNumber = $(this).attr('rel');
    var itemSettings = $(this).closest('.item-wrapper').find('#item-settings'+navNumber);
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




/*** ANIMATE LEFT NAVIGATION ***/
var leftNav     =   $('.left-navigation');
var topHeader   =   $('.top-heading');
var bodySection =   $('section');
var footer      =   $('footer');
var navIcon     =   $('#nav-toggle');
var menuIconBrs =   navIcon.find('.menu-icon-bar');

function toggleNav(){

    leftNav.toggleClass('active');
    topHeader.toggleClass('active');
    bodySection.toggleClass('active');
    footer.toggleClass('active');
    menuIconBrs.toggleClass('active');
}

navIcon.click(function(){
    toggleNav();
});


/*** ANIMATE SUB MENUS ***/
var toggleSubNav = $('.sub-nav-tgl');
var subNav = $('.sub-nav');

toggleSubNav.on('click', function(){
    $(this).next(subNav).slideToggle();
});




/*** MODAL WINDOW CLASS ***/
function ModalWindow(modal){

    this.modal      = $(modal);
    this.form       = this.modal.find('form');
    this.errorLbl   = this.form.find('.error-msg');
    this.closeBtn   = this.modal.find('.close-btn');
    this.cancelBtn  = this.modal.find('.cancel-btn');

    this.clearWindow = function(){};

    this.disable    = function(){
        this.modal.find('.modal').addClass('active');
    };

    this.enable     = function(){
        this.modal.find('.modal').removeClass('active');
    };

    this.showWindow = function(){
        this.modal.addClass('active');
    };

    this.hideWindow = function(){
        this.modal.removeClass('active');
        this.clearWindow();
    };

    this.closeBtn.click(function(){
        this.hideWindow();
    }.bind(this));

    this.cancelBtn.click(function(){
        this.hideWindow();
    }.bind(this));

}


/*** CREATING NEW LIST  ***/

var newListForm = $('#new-list-form'); // form in the top heading with 'ADD LIST' button. does not have a modal window
var newListName = newListForm.find('#new-list-name'); // input field inside the New List form

var newList = new NewListModal();

function NewListModal(){

    ModalWindow.call(this, '.new-list-modal');

    this.listNameField = this.form.find('#new-list-name-field');

}

newListForm.submit(function(e){
    e.preventDefault();

    newList.showWindow();
    newList.listNameField.val(newListName.val());
});



/**** EDIT ACCOUNT INFO ***/
function EditAccountModal(){
    ModalWindow.call(this, '.edit-account-modal');

    this.form.each(function(index, element){
        var form = $(element);

        if(form.attr('id') == 'change-password-form'){
            this.changePasswordForm = form;

        }else if(form.attr('id') == 'edit-account-form'){
            this.editAccountForm = form;
        }

    }.bind(this));

    this.editAccountNameField  = this.form.find('#edit-name-input');
    this.editAccountEmailField = this.form.find('#edit-email-input');
    this.changePasswordBtn     = this.modal.find('#show-password-form');

    this.editPasswordField     = this.changePasswordForm.find('#edit-password-input');
    this.cfEditPasswordField   = this.changePasswordForm.find('#confirm-edit-password-input');

    this.changePasswordFormErr = this.changePasswordForm.find(this.errorLbl);

    this.clearWindow = function(){
        this.clearPasswordErr();
        this.editPasswordField.val("");
        this.cfEditPasswordField.val("");
        this.changePasswordForm.hide();
    };

    this.showPasswordErr       = function(msg){
        this.changePasswordFormErr.text(msg);
    };

    this.clearPasswordErr       = function(){
        this.showPasswordErr("");
    };

    this.changePasswordBtn.click(function(){
        this.changePasswordForm.slideToggle();
    }.bind(this));

}

var editAccountToggle = $('#edit-account-tgl');
var userName = $('#user-name'); //user name from the left hidden menu
var userEmail = $('#user-email'); //user email from the left hidden menu

var editAccount = new EditAccountModal();

editAccountToggle.click(function(){

    editAccount.showWindow();
    editAccount.changePasswordForm.hide();
    editAccount.editAccountNameField.val(userName.text());
    editAccount.editAccountEmailField.val(userEmail.text());

    editAccount.editAccountEmailField.focus();
});

editAccount.editAccountForm.submit(function(e){
    e.preventDefault();

    editAccount.disable();

    var name = editAccount.editAccountNameField.val();
    var email = editAccount.editAccountEmailField.val();
    var editAccountPost;

    editAccountPost = $.post('controllers/accountcontroller.php', {
        new_name: name,
        new_email: email,
        edit_account_info: 'true'
    });

    editAccountPost.done(function(data){

        var user = JSON.parse(data);

        userName.text(user.name);
        userEmail.text(user.email);

        editAccount.enable();
        editAccount.hideWindow();
    });

});


/*** CHANGE PASSWORD FORM ***/
editAccount.changePasswordForm.submit(function(e){
    e.preventDefault();

    var password = editAccount.editPasswordField.val();
    var cfPassword = editAccount.cfEditPasswordField.val();
    var email = userEmail.text();
    var changePasswordPost;


    if(password === cfPassword){
        editAccount.disable();

        changePasswordPost = $.post('controllers/accountcontroller.php', {

            new_password : password,
            new_password_cf : cfPassword,
            email: email,
            change_password_rqst : 'true'
        });

        changePasswordPost.done(function(data){

            editAccount.enable();

            if(data === "true"){

                editAccount.editPasswordField.val("");
                editAccount.cfEditPasswordField.val("");
                editAccount.clearPasswordErr();

                editAccount.hideWindow();

            }else{
                editAccount.clearPasswordErr();
            }
        });

    }else{

        editAccount.showPasswordErr("Passwords do not match.");
    }

});


/*** EDIT LISTS ***/
function EditListModal() {
    ModalWindow.call(this, '.edit-list-modal');

    this.editListNameField  = this.form.find('#edit-list-name-field');
    this.editListId         = this.form.find('#id_hidden');
    this.deleteListBtn      = this.form.find('#delete-list-btn');

    this.editListModalChckBox = this.form.find('#list-permission-chkbox');

    this.deleteListBtn.click(function(){

        this.disable();
        deleteList();

    }.bind(this));

    this.form.submit(function(e){
        e.preventDefault();

        this.disable();

        saveListChanges();

    }.bind(this));
}

var editListOp = $('#list-sub-nav li');

var editList = new EditListModal();

editListOp.click( function(){

    editList.showWindow();

    var $value = $(this).text();
    var $id = $(this).attr('rel');
    var editable = $(this).data('editable');

    editList.editListId.val($id);
    editList.editListNameField.val($value);
    editable == 1 ? editList.editListModalChckBox.prop("checked", true) : editList.editListModalChckBox.prop("checked", false) ;

    editList.editListNameField.focus();
});



function saveListChanges(){

    var listId = editList.editListId.val();
    var listName = editList.editListNameField.val();
    var list = $('.'+listId+'');
    var listPermission = editList.editListModalChckBox.prop('checked') == true ? 1 : 0;

    var editListPost = $.post("controllers/ListController.php", {
        list_id: listId,
        list_name: listName,
        list_permission: listPermission,
        list_option: 'save'
    });

    editListPost.done(function(data){
            editList.enable();
            list.text(data);
            list.closest('li').data('editable', listPermission);
            list.closest('li').attr('data-editable', listPermission); // visual purposes this changes in inspector mode
            editList.hideWindow();
        }

    );

}

function deleteList(){
    var listId = editList.editListId.val();
    var list = $('.'+listId+'');

    var deletePost = $.post("controllers/ListController.php", {
        list_id: listId,
        list_option: 'delete'
    });

    deletePost.done(function(){
        editList.enable();
        list.closest('.list-wrapper').remove(); // removes the list from the main page
        list.remove(); // removes the list from the settings page
        editList.hideWindow();
    });
}


/*** DELETING ACCOUNT ***/
function DeleteAccountModal(){
    ModalWindow.call(this, '.delete-account-modal');

    this.deleteAccountPasswordField = this.form.find('#confirm-password-for-delete');

    this.clearWindow = function(){
        this.errorLbl.text("");
        this.deleteAccountPasswordField.val("");
    };

    this.form.submit(function(e){
        e.preventDefault();
        this.disable();
        deleteAccountF();
    }.bind(this));
}

var deleteAccountToggle = $('#delete-account-tgl');
var deleteAccount = new DeleteAccountModal();

deleteAccountToggle.on('click', function(){

    deleteAccount.showWindow();

});


function deleteAccountF() {
    var password = deleteAccount.deleteAccountPasswordField.val();

    var deleteAccountPost = $.post("controllers/accountcontroller.php", {

        confirm_password: password,
        delete_account_rqst: true

    });

    deleteAccountPost.done(function (data) {

        if (data === 'true') {

            window.location = 'http://localhost/listapp/index.php';

        } else {
            deleteAccount.enable();
            deleteAccount.deleteAccountPasswordField.val("");
            deleteAccount.errorLbl.text(data);
        }

    });

}



/*** SHARE LISTS ***/
var sharedWithNames, listId;

function ShareListModal() {
    ModalWindow.call(this, '.share-list-modal');

    this.sharedListName = this.form.find('#shared-list-name');
    this.selectContactList = this.form.find('#select-contacts');

    this.clearWindow = function () {
        this.selectContactList.text("");
        this.errorLbl.text();
    };

    this.loadContacts = function () {

        var contacts = contactsListWrapper.find('li');
        this.clearWindow();

        contacts.each(function () {
            var contactEmail = $(this).find('.contact-email');
            var contactName = $(this).find('.contact-name');
            var contactId = $(this).attr('rel');

            if (contacts.length > 0)
                $("<option value='" + contactId + "' id='" + contactName.text() + "'>" + contactName.text() + " - " + contactEmail.text() + "</option>").appendTo(shareList.selectContactList);

        });
    };

    this.form.submit(function (e) {
        e.preventDefault();

        var sharedContacts = [];
        var selectList = this.selectContactList.find('option:selected');

        selectList.each(function () {
            sharedContacts.push($(this).prop('value'));
        });

        if (sharedContacts.length > 0) {
            this.disable();

            $.post("controllers/listcontroller.php", {

                shared_list_id: listId,
                shared_with_contacts: sharedContacts,
                share_list_rqst: true

            }).done(function (data) {
                this.enable();

                var names = JSON.parse(data);

                for (var index in names) {

                    if (sharedWithNames.text() === "")
                        sharedWithNames.append(names[index]);
                    else
                        sharedWithNames.append(", " + names[index]);

                }

                this.hideWindow();

            }.bind(this));

        } else {
            this.errorLbl.text("Please select at least 1 contact");
        }

    }.bind(this));
}

var shareBtn = listWrappers.find('.share-list-btn');
var shareList = new ShareListModal();

shareBtn.on('click', function(){

    shareList.showWindow();

    var listName = $(this).closest(listWrappers).find('.list-name').text();
    sharedWithNames = $(this).closest(listWrappers).find('.shared-with-names');
    listId = $(this).attr('rel');

    shareList.loadContacts();
    shareList.sharedListName.text(listName);

});



/*** SET ITEMS AS PURCHASED ***/

var purchasedItems, item, itemName;

function PurchaseItemModal() {
    ModalWindow.call(this, '.purchase-item-modal');

    this.purchaseItemName = this.form.find('#purchased-item-name');

    this.form.submit(function (e) {
        e.preventDefault();

        this.disable();

        var checkBox = item.find('.set-as-purchased');
        var itemId = item.attr('rel');
        var itemSettingsContainer = item.find('.item-settings-nav');
        var editItemSetting = item.find('li.edit_item_name');
        var addNoteSetting = item.find('li.add-note-click');
        var checkMark = $("<img src='assets/img/checked-box-icon.png' class='bought-item-check'/>");

        $.post("controllers/itemcontroller.php", {

            item_id: itemId,
            purchased: 1,
            set_item_as_purchased: true

        }).done(function () {

            this.enable();

            checkMark.insertAfter(checkBox);
            checkBox.remove();
            itemName.addClass('bought-item');

            if (editItemSetting.length > 0) {
                editItemSetting.remove();
                addNoteSetting.remove();

                if (itemSettingsContainer.hasClass('active'))
                    itemSettingsContainer.css({'height': "26px"});
            }

            item.appendTo(purchasedItems);

            this.hideWindow();

        }.bind(this));

    }.bind(this));
}

var purchaseItem = new PurchaseItemModal();

listWrappers.on('click', '.set-as-purchased', function(e){
    e.preventDefault();

    purchaseItem.showWindow();

    item  = $(this).closest('.item-wrapper');
    itemName = item.find('.item-name');
    purchasedItems = $(this).closest('.list-wrapper').find('.purchased-items');

    purchaseItem.purchaseItemName.text(itemName.text());

});




/*** UPLOADING PROFILE PICTURE ***/

function ProfilePicModal(){
    ModalWindow.call(this, '.change-profile-pic-modal');

    this.clearWindow = function(){
        this.errorLbl.text("");
    };

    this.form.submit(function(e){
        e.preventDefault();

        this.errorLbl.text("Uploading...");

        this.disable();

        uploadProfilePic();

    }.bind(this));

}


var changePictureTgl = $('#add-profile-picture');
var profilePicContainer = $('.profile-pic');

var profilePicWindow = new ProfilePicModal();

changePictureTgl.on('click', function(){
    profilePicWindow.showWindow();
});

function uploadProfilePic() {

    var formData = new FormData(document.getElementById('change-profile-pic-form'));

    $.ajax({

        url: "controllers/accountcontroller.php",
        type: "POST",
        data: formData,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false

    }).done(function (result) {
        profilePicWindow.enable();
        var d = new Date(); // used to append as a variable on the image source

        switch (result) {

            case "1":
                profilePicWindow.errorLbl.text("Please select a file");
                break;
            case "2":
                profilePicWindow.errorLbl.text("Please select a valid file");
                break;
            case "3":
                profilePicWindow.errorLbl.text("Sorry, an error occurred, please try again");
                break;
            default:
                var imgSrc = 'users/' + result + '/img/profilepic.jpg?' + d.getTime(); // a time is added as a query variable to reload img src
                var profilePic = $("<img src='" + imgSrc + "'>");

                profilePicContainer.html("");
                profilePicContainer.attr('class', 'contact-img-pic-lrg profile-pic');
                profilePic.appendTo(profilePicContainer);

                profilePicWindow.hideWindow();
        }

    });
}

/*** DELETING PROFILE PICTURE ***/
var deleteProfilePicTgl = $('#remove-profile-picture');

deleteProfilePicTgl.on('click', function(){

    var initial = profilePicContainer.attr('rel');

    profilePicContainer.html("");
    profilePicContainer.attr('class', 'contact-img-lrg profile-pic');
    profilePicContainer.text(initial);

    $.post('controllers/accountcontroller.php', {
        delete_profile_pic : true
    });

});


/*** SELECTING THE RIGHT LIST TYPE TAB ***/
var listTypeTgl = $('#choose-list li');
var sharedListsContainer = $('#shared-lists-container');
var myListsContainer = $('#my-lists-container');

listTypeTgl.click(function(){
    var listType = $(this).attr('rel');

    //set cookie to select the right list type tab on page reload
    document.cookie='listType='+listType;

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


// -----------------------------------------



/*** EDIT ITEMS ***/
listWrappers.on('click', '.edit_item_name', function(){
    var itemWrapper = $(this).closest('.item-wrapper');
    var item = itemWrapper.find('.item-name');
    var itemNameInput = itemWrapper.find('.item-name-edit-input');
    var itemQuantityInput = itemWrapper.find('.edit-item-quantity');

    var itemQuantity = itemWrapper.find('.quantity').attr('rel');
    var itemName = item.text();

    itemQuantityInput.val(itemQuantity);
    itemNameInput.val(itemName);

    item.closest('.item-wrapper').find('.container').toggleClass('edit');
    itemNameInput.focus();

});

listWrappers.on('submit', '.edit-item-name-form', function(e){
    e.preventDefault();

    var editItemForm = $(this);
    var itemId = editItemForm.closest('.item-wrapper').attr('rel');
    var itemName = editItemForm.find('.item-name-edit-input').val();
    var itemQuantity = editItemForm.find('.edit-item-quantity').val();

    var itemWrapper = $(this).closest('.item-wrapper');
    var itemNameField = itemWrapper.find('.item-name');
    var itemQuantityField = itemWrapper.find('.quantity');

    var editItemPost = $.post('controllers/itemcontroller.php', {

        edit_item_name : itemName,
        edit_item_quantity : itemQuantity,
        item_id : itemId,
        edit_item : 'true'
    });

    editItemPost.done(function(item_data){

        var item = JSON.parse(item_data);

        itemNameField.text(item.name);

        if(item_data == 'false'){

            location.reload();

        }else{

            if( item.quantity > 1 ){
                itemQuantityField.attr('rel', item.quantity);
                itemQuantityField.text('('+item.quantity+')');
            }else{

                itemQuantityField.attr('rel', 1);
                itemQuantityField.text('');
            }

            itemWrapper.find('.container').toggleClass('edit');
        }

    });
});

/*** DELETING ITEMS ***/
listWrappers.on('click', '.delete-item-click', function(){

    var item = $(this).closest('.item-wrapper');
    var itemId = item.attr('rel');

    var deleteItemPost = $.post('controllers/itemcontroller.php', {

        item_id : itemId,
        delete_item : 'true'
    });

    deleteItemPost.done(function(data){
        /*
            If php couldn't delete the list it means permissions for
            the list have changed, the page gets reloaded to show new item
            settings options
         */

        data == "true" ? item.remove() : location.reload();

    });


});




/*** ADD NOTE ***/
listWrappers.on('click', '.add-note-click', function(){
    var newNoteForm = $(this).closest('.item-wrapper').find('.add-new-note-form');
    var noteInputField = newNoteForm.find('.new-note-input');

    newNoteForm.toggleClass('edit');
    noteInputField.focus();
});

listWrappers.on('submit', '.add-new-note-form', function(e){
    e.preventDefault();

    var noteForm = $(this);
    var noteInputField = noteForm.find('.new-note-input');
    var noteContent = noteInputField.val();
    var itemId = noteForm.closest('.item-wrapper').attr('rel');

    if(noteContent !="" ){

       $.post('controllers/notecontroller.php', {

            item_id: itemId,
            note_content: noteContent

        }).done(function(){

           $("<p>"+noteContent+"</p>").insertBefore(noteForm);

           noteForm.toggleClass('edit');
           noteInputField.val("");
        });
    }
});




/** SHOW CONTACTS **/
var showContacts = $('#view-contacts');
var contactsWindow = $('.contacts-wrapper');
var goBack = contactsWindow.find('.go-back');
var removeContactIcon = contactsWindow.find('.remove-contact');

showContacts.click(function(){
    contactsWindow.toggleClass('active');
});

goBack.click(function(){
    contactsWindow.toggleClass('active');
    removeContactIcon.removeClass('show-contact');
    clearContactMsg();
});

function clearContactMsg(){
    contactCf.text("");
    contactErr.text("");
}

function updateContacts(option){
    var contactsBadge = showContacts.find('.contacts-badge');
    var contactAmount = eval(contactsBadge.text());


    if(option == 'add')
        contactAmount += 1;
    else if(option == 'remove')
        contactAmount -= 1;

    contactsBadge.text(contactAmount);
}


/**** ADD CONTACTS ***/
var contactsForm = contactsWindow.find('#add-contact-form');
var contactEmailField = contactsForm.find('#add-contact-input');
var contactCf = contactsWindow.find('#add-contact-msg');
var contactErr = contactsWindow.find('#add-contact-error');
var contactsListWrapper = contactsWindow.find('#contacts-list-wrapper');
var noContacts = contactsWindow.find('#no-contacts');

function setContactMsg(msg, div){
    $("<p>"+msg+"</p>").fadeIn().appendTo(div);
}


contactsForm.submit(function(e){
    e.preventDefault();

    var contactEmail = contactEmailField.val();

    $.post('controllers/contactscontroller.php',{
        contact_email : contactEmail,
        add_new_contact : true

    }).done(function(contact){

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

                if(noContacts.is('p')){
                    noContacts.remove();
                }

                updateContacts('add');
                $(contactDiv).fadeIn().appendTo(contactsListWrapper);
                setContactMsg("Contact Saved ", contactCf);

        }
    });

});

function contactTmpl(contact){

    var contactImg = contact.profilePic == true ? "<div class='contact-img-pic'><img src='users/"+contact.contactId+"/img/profilepic.jpg'></div>" : "<div  class='contact-img'>"+contact.contactInit+"</div>";

    return "<li rel='"+contact.contactId+"'>"+
             contactImg+
             "<div><p class='contact-name'>&nbsp;"+contact.contactName+"</p></div>"+
             "<div class='contact-email'>"+contact.contactEmail+"</div>"+
             "<div class='remove-contact'><img src='assets/img/remove-contact.png'/></div>"+
           "</li>";

}


/*** SHOW REMOVE CONTACT ICON ***/
var contactsContainer = $('.contacts-container ul');

contactsContainer.on('click', 'li', function(){
    $(this).find('.remove-contact').toggleClass('show-contact');

});


/*** DELETE CONTACT ***/

function RemoveContactModal(){
    ModalWindow.call(this, '.delete-contact-modal');

    this.contactDeleteName  = this.form.find('#contact-delete-name');
    this.contactDeleteEmail = this.form.find('#contact-delete-email');
    this.contactDeleteId    = this.form.find('#contact-delete-id');

    this.form.submit(function(e){
        e.preventDefault();
        this.disable();
        deleteContact(this.contactDeleteId, this.contactDeleteName, this.contactDeleteEmail);

    }.bind(this));

}

var removeContact = new RemoveContactModal();

contactsListWrapper.on('click', '.remove-contact',function(){
    var contact = $(this).closest('li');
    var contactId = contact.attr('rel');
    var contactName = contact.find('.contact-name').text();
    var contactEmail = contact.find('.contact-email').text();

    removeContact.contactDeleteName.text(contactName);
    removeContact.contactDeleteEmail.text(contactEmail);
    removeContact.contactDeleteId.val(contactId);
    removeContact.showWindow();

});


function deleteContact(id, name, email){

    var cId    = id.val();
    var cName  = name.text();
    var cEmail = email.text();

    $.post('controllers/contactscontroller.php',{

        contact_id          : cId,
        contact_name        : cName,
        contact_email       : cEmail,
        delete_contact_rqst : true

    }).done(function(){

        removeContact.enable();
        updateContacts('remove');
        clearContactMsg();

        var removeContactInt;

        var contact = $("li[rel="+cId+"]");

        contact.css({'transform' : 'translateX(500px)'});

        // wait .5s and then remove the li element, this allows the css:'transform' to animate
        removeContactInt = setInterval(function(){
            contact.remove();
            clearInterval(removeContactInt);
        }, 500);


        removeContact.hideWindow();
        setContactMsg("Contact Deleted", contactErr);

    });
}



/*** ADD ITEMS ***/

var newItemForm = $('.new-item-form');
var onShareListType;
var itemsToBuy;

newItemForm.submit(function(e){
    e.preventDefault();

    var itemForm = $(this);
    var itemNameInput     = itemForm.find('.new-item-name');
    var itemQuantityInput = itemForm.find('.new-item-quantity');
    var itemNoteInput     = itemForm.find('.new_item_note');

    var itemNote = itemNoteInput.val();
    var itemQuantity = itemQuantityInput.val();
    var itemName = itemNameInput.val();
    var listId = itemForm.find('.list-id').val();

    onShareListType = itemForm.attr('rel');

    itemsToBuy = $(this).closest('.list-wrapper').find('.items-to-purchase');

    $.post("controllers/itemcontroller.php", {

        new_item_name: itemName,
        new_item_quantity: itemQuantity,
        new_item_note: itemNote,
        list_id: listId

    }).done(function(item_data){

        var item = JSON.parse(item_data);

        var itemTmpl = itemTemplate(item, itemNote);

        $(itemTmpl).appendTo(itemsToBuy);

        itemNameInput.val("");
        itemQuantityInput.val(1);
        itemNoteInput.val("");

        itemNameInput.focus();
    });
});

function itemTemplate(item, itemNote){

    var itemSettings = onShareListType == 0 ? "<li class='add-note-click'>Add Note</li>" :  "<li class='edit_item_name'>Edit Item</li>"+
                                                                                            "<li class='delete-item-click'>Delete Item</li>"+
                                                                                            "<li class='add-note-click'>Add Note</li>";


    var quantity = item.quantity > 1 ? "("+item.quantity+")" : "";

    return  "<div class='item-wrapper' rel='"+item.id+"'>" +
                "<div class='item-container'>" +
                    "<div class='container'>" +
                        "<div class='custom-checkbox set-as-purchased'>" +
                        "<input type='checkbox' id='set-as-purchased'>" +
                        "<label for='set-as-purchased' class='custom-checkbox-label'></label>"+
                        "</div>" +
                        "<div class='item-name-container'>" +
                            "<form class='edit-item-name-form'>"+
                                "<p class='item-name-edit edit'><input class='item-name-edit-input' type='text'></p>"+
                                "<input type='text' class='edit-item-quantity edit'>"+
                                "<input type='submit' class='save-edit-name-btn edit regular-btn' value='save'>"+
                            "</form>"+
                            "<p class='item-name item"+item.id+" no-edit'>"+ item.name +"</p>" +
                            "<span class='quantity no-edit' rel='"+item.quantity+"'>"+
                                quantity+
                            "</span>" +
                        "</div>" +
                        "<div class='item-settings-wrapper' rel='"+item.id+"'></div>"+
                    "</div>"+
                    "<div class='notes'><p>"+itemNote+"</p>"+
                        "<form class='add-new-note-form'>"+
                            "<input type='text' class='new-note-input edit'/>"+
                            "<input type='submit' value='Save' class='save-note-btn edit regular-btn'/>"+
                        "</form>"+
                    "</div>"+
                "</div>"+
                "<div class='item-settings-nav' id='item-settings"+item.id+"'>"+
                    "<ul>"+
                        itemSettings+
                    "</ul>"+
                "</div>"+
            "</div>";

}


/** FUNCTIONS TO EXECUTE WHEN THE PAGE LOADS ***/
$(window).load(function(){
    var listBody = $('.list-body');
    var listFooter = $('.list-footer');
    var listType = getCookie('listType');

    // hide the lists and sub menus
    listBody.hide();
    listFooter.hide();
    subNav.hide();


    // check the cookie 'listype' value and display appropriate lists
    if(listType == 'sharedlists'){
        $('#shared-lists').addClass('active');
        myListsContainer.hide();
        sharedListsContainer.show();
    }
    else if(listType == 'mylists'){
        $('#my-lists').addClass('active');
        sharedListsContainer.hide();
        myListsContainer.show();
    }else{
        $('#my-lists').addClass('active');
        sharedListsContainer.hide();
    }

     var activeList = listWrappers.find('.'+getCookie('activeList'));

     activeList.closest('.list-wrapper').addClass('showing');
     activeList.closest('.list-wrapper').find('.list-body').show();
     activeList.closest('.list-wrapper').find('.list-footer').show();


});


/*** GET BROWSER COOKIE FUNCTION ***/
function getCookie(cName) {
    var name = cName + "=";
    var ca = document.cookie.split(';');

    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}