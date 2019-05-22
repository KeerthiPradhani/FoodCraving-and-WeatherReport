<?php
    include 'inc/session.php';
    include 'inc/db.php';
    //include 'initDB.php';

    // If the user is logged in already, forward to "products.php"
    if (hasSession()) {
        header('Location: products.php');
        exit();
    }

    
    // If the request was a POST, process the login
    if ('POST' === $_SERVER['REQUEST_METHOD']) {
        // Create a DB instance
        $db = new StorefrontDB();
        
        // Check to see if the user authenticates
        $db->addUser($_POST['username'], $_POST['password']);
        echo "<script type='text/javascript'>alert('Successfully signed up! Please log in with your credentials!');</script>";
        // Close the database
        $db->close();
        header('Location: login.php');
    }
?>

<html>
    <head>
        <!-- // Include the common head elements -->
        <?php include 'partials/head-elements.php'?>
        
    </head>

    <body>

        <!-- The Signup form; notice the method is POST and the action is THIS PAGE-->
        <form method="POST" action="signup.php">
            <div>
                <h1>Signup Page</h1>
            </div>
            <div>
                <span class = 'usernamespan'>Username</span>
                <input class = 'usernameinput' type="text" name="username">
            </div>
            <div class = 'passworddiv'>
                <span class = 'passwordspan'>Password</span>
                <input class = 'passwordinput' type="password" name="password">
            </div>
            <div class = 'signupdiv'>
                <button class = 'signupbutton' type="submit">Signup</button>
            </div>
        </form>

        <!-- // Include the common script elements -->
        <?php include 'partials/script-elements.php'?>
    </body>
</html>
