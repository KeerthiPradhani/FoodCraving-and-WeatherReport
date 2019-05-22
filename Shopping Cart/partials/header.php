<!-- // TODO: All pages include this page; this is your header - make it pretty! -->
<?php include_once "inc/session.php"; ?>

<!-- // Common header -->
<div class="header">
    <!-- // Menu option for the "product" -->
    <a class="menu-item" href="products.php">Products</a>
    <?php
        if (hasSession()) {
            // The user is logged in!
            // Show menu items for the "shopping cart" and "logout"
    ?>
    <a class="menu-item" href="shoppingCart.php">Shopping Cart</a>
    <a class="menu-item" href="logout.php">Logout</a>
    <?php
        } else {
            // The user is not logged in :(
            // Show the "login" option
            // Show a menu option for "login"
    ?>
    <a class="menu-item" href="login.php">Login</a>
    <?php }?>
</div>
