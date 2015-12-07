<div class="lists-container">

<div id="my-lists-container">

<?php require_once 'views/templates/mylists.php' ?>


<!--                <div class="list-wrapper">
                    <div class="list-heading">
                        <h4 class="list-name">Grocery List</h4>
                        <input type="text" placeholder="Add Item..." name="add_item">
                        <div class="created-info">
                            <p class="small date-created">12/12/12 12:00pm</p>
                            <p class="small created-by">by: Me</p>
                        </div>
                    </div>
                    <div class="list-body">
                        <div class="item-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox">
                                    <p class="item-name">Item 1</p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>Donec luctus ex risus</p>
                                    <p>Sed placerat dui odio</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox">
                                    <p class="item-name">Item 2 <span class="quantity">(3)</span></p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>Ut consequat, metus</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox">
                                    <p class="item-name">Item 3</p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>Maecenas orci magna</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
                            </div>
                        </div>
                        <div class="item-wrapper">
                            <div class="item-container">
                                <div class="container">
                                    <input type="checkbox" checked disabled>
                                    <p class="item-name bought-item">Item 4</p>
                                    <div class="item-settings-wrapper"><img src="assets/img/item-settings-icon.png" class="item-settings"></div>
                                </div>
                                <div class="notes">
                                    <p>At euismod diam lacinia molestie.</p>
                                    <p>Integer et venenatis nunc</p>
                                    <p>Commodo, congue nisl.</p>
                                </div>
                            </div>
                            <div class="item-settings-nav">
                                <ul>
                                    <li>Edit Name</li>
                                    <li>Delete Item</li>
                                    <li>Add Note</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="list-footer">
                        <div class="container">
                            <p class="shared-with">Shared With:</p>
                            <p class="shared-with-names">Bob, Jess, Michael</p>
                        </div>
                        <input type="submit" value="Share List" name="share_list" class="share-list-btn">
                    </div>
                </div>-->

</div>

<div id="shared-lists-container">

    <?php require_once 'views/templates/sharedlists.php' ?>

</div>

</div> <!--            end list container-->

<!--CONFIRM ITEM PURCHASE-->

<div class="modal-wrapper purchase-item-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" alt=""/></div>
        <form id="purchase-item-form">
            <p>Set item "<span id="purchased-item-name"></span>" as purchased?</p>
            <input type="submit" class="save-btn" id="submit-purchased-item" value="Yes"/>
            <input type="button" class="red-btn" id="cancel-purchased-item" value="No"/>
        </form>
    </div>
</div>


<!--SHARE LISTS MODAL-->

<div class="modal-wrapper share-list-modal">
    <div class="modal">
        <div class="close-btn"><img src="assets/img/close-icon.png" alt=""/></div>
        <form id="share-list-form">
            <label class="error-msg"></label>
            <p>Who would you like to share "<span id="shared-list-name"></span>" with?</p>
            <select id="select-contacts" multiple></select>
            <input type="submit" class="share-list-btn" id="submit-shared-list" value="Share"/>
            <input type="button" class="red-btn" id="cancel-shared-list" value="Cancel"/>
        </form>
    </div>
</div>