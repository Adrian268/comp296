<div class="contacts-wrapper">
    <div class="contacts-container">
        <div class="go-back"><p>&#8592;</p></div>
        <div class="add-contact-container">
            <form id="add-contact-form">
                <p>Add New Contact</p>
                <input type="email" id="add-contact-input" placeholder="email address"/>
                <input type="submit" id="add-contact-btn" class="regular-btn" value="Save"/>
            </form>
        </div>
        <div id="add-contact-msg"></div>
        <div id="add-contact-error"></div>
        <ul id="contacts-list-wrapper">
            <?php

            if(isset($contacts) && count($contacts) > 0) {

                foreach ($contacts as $contact_num => $contact) {

                    echo "<li rel='" . $contact[0]['user_id'] . "'>
                            <div class='contact-img'>".$contact[0]['name'][0]."</div>
                            <div><p class='contact-name'>".$contact[0]['creator']."</p></div>
                            <div class='contact-email'>".$contact[0]['email']."</div>
                            <div class='remove-contact'><img src='assets/img/remove-contact.png'/></div>
                          </li>";
                }

            }else{

                echo "<li id='no-contacts'>You don't have any contacts yet.<br/><br/>You can enter a users email above to add them to
                        your contacts lists. </li>";
            }


            ?>

<!--            <li>-->
<!--                <div class="contact-img">E</div>-->
<!--                <div><p class="contact-name">Emily</p></div>-->
<!--                <div class="contact-email">emily@gmail.com</div>-->
<!--                <div class="remove-contact">x</div>-->
<!--            </li>-->

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
            <input type="submit" class="save-btn" id="submit-contact-delete" value="Yes"/>
            <input type="button" class="red-btn" id="cancel-contact-delete" value="Cancel"/>
        </form>
    </div>
</div>