<!--        list options modal window BEGIN-->
<div class="pop-up-wrapper">
    <div class="edit-list-pop-up">
        <div class="close-btn"><img src="assets/img/close-icon.png" width="25px" height="25px" alt=""/></div>
        <form action="controllers/listcontroller.php" method="post">
            <p>Edit Name:</p>
            <input type="text" name="list_name" id="list_name" class="focus"/>
            <input type="hidden" name="list_id" id="id_hidden"/>
            <input type="submit" name="list_option" class="save-btn" value="Save"/>
            <input type="submit" name="list_option" class="delete-btn" value="Delete List"/>
        </form>
    </div>
</div>
<!--        list options modal window END-->