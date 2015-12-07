<!--        new list modal window BEGIN-->
<div class="modal-wrapper new-list-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" alt=""/></div>
        <form action="controllers/listcontroller.php" method="post">
            <p>List Name</p>
            <input type="text" name="list_name" id="new-list-name-field" class="focus"/>

            <div id="permission-check">
                <div id="text">
                    <p>Allow others to edit list items, when the list is shared?</p>
                </div>
                <div class="slide-checkbox">
                    <input type="checkbox" name="list_permission_check" id="slide-checkbox-input">
                    <label for="slide-checkbox-input" class="label-for-slide-checkbox"></label>
                </div>
            </div>

            <input type="submit" name="add_new_list" class="save-btn" value="Save"/>
            <input type="button" id="cancel-list" class="red-btn" value="Cancel"/>
        </form>
    </div>
</div>
<!--        new list modal window END-->