<html>
    <head>
        <!-- // Include the common head elements -->
        <?php include 'partials/head-elements.php'?>
    </head>

    <body>
        <?php

            // Include the database class
            include 'inc/db.php';

            // Instantiate the database
            $db = new StorefrontDB();
            if (!$db) {
                echo '<div>Could not create database!</div>';
                exit();
            }

            // Check to see if the database should be initialized
            echo "
                <div>Steps</div>
                <div>
                    <ul>
                ";
            echo '<li>initializing database</li>';

            // Code to initialize the database
            $db->initialize();

            // add the default user
            echo '<li>adding users</li>';
            $db->addUser('keerthi', 'password');

            // add products 
            echo '<li>adding products</li>';
            $db->addProduct('Widget 1', 'color - red', 'https://via.placeholder.com/300', '14');
            $db->addProduct('Widget 2', 'color - brown', 'https://via.placeholder.com/300', '12');
            $db->addProduct('Widget 3', 'color - pink', 'https://via.placeholder.com/300', '11');
            

            echo '<li>done</li>';

            echo "
                    </ul>
                </div>
                ";

            $db->close();
        ?>
            <form action="login.php">
            <div class = 'logindiv'>
                <button class = 'loginbutton' type="submit">Login here!</button>
            </div>
            </form>
            <form action="signup.php">
            <div class = 'signupdiv'>
                <button class = 'signupbutton' type="submit">New User? Signup!</button>
            </div>
            </form>

        <!-- // Include the common script elements -->
        <?php include 'partials/script-elements.php'?>

    </body>
</html>