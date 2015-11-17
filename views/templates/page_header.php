<div class="top-heading">
    <div id="logo-link-container">
        <div id="logo"><a href="<?php echo DIR_PATH?>index.php">
                <p>ListApp</p></a></div>
        <div id="top-right">
            <ul>
                <li <?php if(isset($page) && $page=='index') echo "class='active'"?>>
                    <a href="<?php echo DIR_PATH?>index.php" > Log In </a>
                </li>
                <li <?php if(isset($page) && $page=='register') echo "class='active'"?>>
                    <a href="<?php echo DIR_PATH?>register.php" > Register </a>
                </li>
            </ul>
        </div>
    </div>
</div>