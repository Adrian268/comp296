<!--        DELETE ACCOUNT modal window BEGIN-->
<div class="modal-wrapper delete-account-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" alt=""/></div>
        <form id="delete-account-form">
            <label class="error-msg"></label>
            <p>Are you sure you want to delete this account? <br/>
            This process cannot be undone.
            </p>
            <p>Confirm your password to delete your account.</p>
            <input type="password" id="confirm-password-for-delete" required/>
            <input type="submit" class="red-btn" id="submit-account-delete" value="Delete My Account"/>
            <input type="button" class="save-btn" id="cancel-account-delete" value="Cancel"/>
        </form>
    </div>
</div>

<!--        DELETE modal window END-->