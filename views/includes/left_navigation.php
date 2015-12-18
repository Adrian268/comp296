<!--    HIDDEN LEFT NAVIGATION-->
<nav class="left-navigation">

    <?=$profile_pic?>

    <div id="user-info">
        <ul>
            <li><p id="user-name"><?=$user_data['name']?></p></li>
            <li><p id="user-email"><?=$user_data['email']?></p></li>
        </ul>
    </div>

    <ul>
        <li><img src="assets/img/account.png" /><a href="#" onclick="return false;" class="sub-nav-tgl" >My Account</a>
            <ul class="sub-nav">
                <li><a href="#" onclick="return false;" id="edit-account-tgl">Edit Account Info</a></li>
                <li><a href="#" onclick="return false;" id="delete-account-tgl">Delete Account</a></li>
            </ul>
        </li>
        <li>
            <img src="assets/img/contacts.png" /><a href="#" onclick="return false;" class="sub-nav-tgl" id="view-contacts">Contacts <span class='contacts-badge'><?=$number_of_contacts?></span></a>
        </li>
        <li><img src="assets/img/edit-list-icon.png" /><a href="#" onclick="return false;" class="sub-nav-tgl">Edit Lists</a>
            <ul class="sub-nav" id="list-sub-nav">
                <?=$list_sub_nav?>
            </ul>
        </li>
        <li><img src="assets/img/gears.png" alt=""/><a href="#" onclick="return false;" class="sub-nav-tgl" >Settings</a>
            <ul class="sub-nav">
                <li><a href="#" onclick="return false;" id="add-profile-picture">Change Profile Picture</a></li>
                <li><a href="#" onclick="return false;" id="remove-profile-picture">Delete Profile Picture</a></li>
            </ul>
        </li>
    </ul>

</nav>
<!--    END LEFT HIDDEN NAV-->