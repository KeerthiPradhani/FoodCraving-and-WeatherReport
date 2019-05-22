<?php 
    include "db.inc"; 

    $db = new BusDB();
    if(!$db) {
      echo $db->lastErrorMsg();
    }
    session_start();

   
    if (isset($_SESSION['name']) ) {
        header('Location: inventory.php');
        return;
    }
    

    
 
    
    
    // Check to see if we have some POST data, if we do process it
    if ( isset($_POST['user']) && isset($_POST['pass']) ) {
        unset($_SESSION["name"]);
        if ( strlen($_POST['user']) < 1 || strlen($_POST['pass']) < 1 ) {
            $_SESSION['error'] = "Username and password are required";
            header("Location: login.php");
            return;
        } 
        else {
            $username = $_POST['user'];  // User supplied (perhaps from a form)
            $password = $_POST['pass']; // User supplied (perhaps from a form)
            $salt = 'XyZzy12*_'; 
            $sql = "SELECT hash FROM Users WHERE Username='$username'";
            $results = $db->query($sql);
            $rows = $results->fetchArray(SQLITE3_ASSOC);
            //
            // Are there results from the SQL query?
            if ($rows) {
                // Get the exepected hash values from the results
                $expectedHash = $rows['hash'];
        
                // Calculate the hash (salt + user supplied password)
                $actualHash = hash('md5', $salt.$password);
        
                // See if the hash equals what is in the database
                if ($actualHash === $expectedHash) {
                    // Matching password!
                    $_SESSION['name'] = $_POST['user'];
                    header("Location: inventory.php");
                    return;
                } 
                else {
                    // Not matching password :(
                    $_SESSION["error"] = "Incorrect username or password.";
                    header( 'Location: login.php' ) ;
                    return;
                }
            } 
            else {
                // No results in $rows means that the query has no results; the username is not in the database!
                $_SESSION["error"] = "Incorrect username or password.";
                header( 'Location: login.php' ) ;
                return;
            }
            
        }
    }

    $db->close();

?>

<!DOCTYPE html>
<html>
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Empire Bus Sales</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/empire.css" rel="stylesheet">
    <link rel="stylesheet" href ="css/style.css">

    </head>
    <body>
        <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="index.php"><img src ="img/empire-bus-full-color.png"></a>
          <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="inventory.php#about">Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="login.php">Admin Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <!-- <header class="masthead">
        <div class="fullscreen-bg">
            <video loop muted autoplay class="fullscreen-bg__video">
                <source src="vid/Renault.mp4" type="video/mp4">
            </video>
        </div>
    </header>   -->  
    <section id="about" class="about-section text-center">
        <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <div class="text-center">
                <form class="form-signin" method="POST">
                    <img class="mb-4" src="img/empire-bus-full-color.png" alt="">
                    <h1 class="h3 mb-3 font-weight-normal">Please Log in</h1>
                    <?php

                        if ( isset($_SESSION['success']) ) {
                            echo('<p class="mb-3" style="color: red;">'.htmlentities($_SESSION['success'])."</p>\n");
                            unset($_SESSION['success']);
                        }
                        if ( isset($_SESSION['error']) ) {
                            echo('<p class="mb-3" style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                            unset($_SESSION['error']);
                        }
                    ?>
                    <label for="user" class="sr-only">Username</label>
                    <input type="text" id="user" name="user" class="form-control" placeholder="Username">
                    <label for="pass" class="sr-only">Password</label>
                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>
            </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
  <footer class="bg-black small text-center text-white-50">
    <div class="container">
        <p>Location: 2674 W Henrietta Rd, Rochester, NY 14623</p><br>
        <p>Hours: Mon-Fri, 7:30 a.m. – 6:00 p.m.</p>
    </div>
  </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>            

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts-->
    <script src="js/empire.js"></script>

    </body>
</html>
	