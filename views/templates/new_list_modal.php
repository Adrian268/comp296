<!--        new list modal window BEGIN-->
<div class="modal-wrapper new-list-modal">
    <div class="modal ">
        <div class="close-btn"><img src="assets/img/close-icon.png" width="25px" height="25px" alt=""/></div>
        <form action="controllers/listcontroller.php" method="post">
            <p>List Name</p>
            <input type="text" name="list_name" id="list_name" class="focus"/>

            <div id="permission-check">
                <table>
                    <tr>
                        <td><input type="checkbox" name="list_permission_check"/></td>
                        <td>Allow other people to modify this list?</td>
                    </tr>
                </table>
            </div>

            <input type="submit" name="add_new_list" class="save-btn" value="Save"/>
            <input type="button" name="cancel" class="delete-btn" value="Cancel"/>
        </form>
    </div>
</div>
<!--        new list modal window END-->