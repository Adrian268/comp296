<?php
$contact_list = "";

if(isset($contacts) && count($contacts) > 0) {

    foreach ($contacts as $contact) {

        $contact_img = file_exists('users/'.$contact['user_id'].'/img/profilepic.jpg') ? "<div class='contact-img-pic'><img src='users/".$contact['user_id']."/img/profilepic.jpg'></div>" : "<div class='contact-img'>".$contact['name'][0]."</div>";

        $contact_list .= "<li rel='" . $contact['user_id'] . "'>".$contact_img."
                            <div><p class='contact-name'>".$contact['creator']."</p></div>
                            <div class='contact-email'>".$contact['email']."</div>
                            <div class='remove-contact'><img src='assets/img/remove-contact.png'/></div>
                          </li>";
    }

}else{

    $contact_list = "<p id='no-contacts'>You don't have any contacts yet.<br/><br/>You can enter a users email above to add them to your contacts lists. </p>";
}
?>

<div class="contacts-wrapper">
    <div class="contacts-container">
        <div id="add-contact-msg"></div>
        <div id="add-contact-error"></div>
        <div class="go-back"></div>
        <div class="add-contact-container">
            <form id="add-contact-form">
                <p>Add New Contact</p>
                <input type="email" id="add-contact-input" placeholder="email address"/>
                <input type="submit" id="add-contact-btn" class="regular-btn" value="SAVE"/>
            </form>
        </div>
        <ul id="contacts-list-wrapper">

            <?=$contact_list?>

        </ul>
    </div>
</div>

<div class="modal-wrapper delete-contact-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" alt=""/></div>
        <form id="delete-contact-form">
            <p>Delete "<span id="contact-delete-name"></span>" from contacts?</p>
            <p>Email: <span id="contact-delete-email"></span></p>
            <input type="hidden" id="contact-delete-id"/>
            <input type="submit" class="green-btn" id="submit-contact-delete" value="Yes"/>
            <input type="button" class="red-btn cancel-btn" id="cancel-contact-delete" value="Cancel"/>
        </form>
    </div>
</div>