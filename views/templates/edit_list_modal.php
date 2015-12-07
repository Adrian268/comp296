<!--        list options modal window BEGIN-->
<div class="modal-wrapper edit-list-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" alt=""/></div>
        <form action="controllers/listcontroller.php" method="post" id="edit-list-form">
            <p>Edit Name</p>
            <input type="text" name="list_name" id="edit-list-name-field" class="focus"/>
            <div id="list-permission-container">
                <p>Allow others to edit items in this list.<br/>
                <span class="small">This only applies to people you share this list with.</span>
                </p>
                <div id="checkbox-container">
                    <div class="slide-checkbox">
                        <input type="checkbox" id="list-permission-chkbox" >
                        <label for="list-permission-chkbox" class="label-for-slide-checkbox"></label>
                    </div>
                </div>
            </div>
            <input type="hidden" name="list_id" id="id_hidden"/>
            <input type="submit" name="list_option" class="save-btn" value="Save"/>
            <input type="submit" name="list_option" class="delete-btn" value="Delete List"/>
        </form>
    </div>
</div>
<!--        list options modal window END-->