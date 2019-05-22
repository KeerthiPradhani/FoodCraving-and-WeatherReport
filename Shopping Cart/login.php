<?php
    include 'inc/session.php';
    include 'inc/db.php';

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
        $authenticated = $db->authenticateUser($_POST['username'], $_POST['password']);
        // Close the database
        $db->close();

        if ($authenticated) {
            // User is authenticated
            //
            // Start the session (place the "username" into the session)
            startSession($_POST['username']);
            // Redirect to "products.php"
            header('Location: products.php');
            exit();
        } else {
            //User is NOT authenticated
            //
            // Redirect to the login page and append a message for the user
            // Redirects are GET's
            echo "<script type='text/javascript'>alert('Invalid username and password!');</script>";
            
        }
    }
?>

<html>
    <head>
        <!-- // Include the common head elements -->
        <?php include 'partials/head-elements.php'?>
    </head>

    <body>

        <!-- The login form; notice the method is POST and the action is THIS PAGE-->
        <form method="POST" action="login.php">
            <div>
                <h1>Login Page</h1>
            </div>
            <div>
                <span class = 'usernamespan'>Username</span>
                <input class = 'usernameinput' type="text" name="username">
            </div>
            <div class = 'passworddiv'>
                <span class = 'passwordspan'>Password</span>
                <input class = 'passwordinput' type="password" name="password">
            </div>
            <div class = 'logindiv'>
                <button class = 'loginbutton' type="submit">Login</button>
            </div>
            <div class = 'signupdiv'>
                <a class = 'signuplink' href="signup.php">New User? Sign up here!</a>
            </div>
        </form>

        <!-- // Include the common script elements -->
        <?php include 'partials/script-elements.php'?>
    </body>
</html>
