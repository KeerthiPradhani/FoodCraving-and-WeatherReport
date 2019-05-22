<?php 
    include "db.inc"; 

    $db = new BusDB();
    if(!$db) {
      echo $db->lastErrorMsg();
    }
    session_start();

   
    if (!isset($_SESSION['name']) ) {
        header('Location: login.php');
        return;
    }
    

    
 
    
    
    // Check to see if we have some POST data, if we do process it
    if ( isset($_POST['pass1']) && isset($_POST['pass2']) ) {
        if ( strlen($_POST['pass1']) < 1 || strlen($_POST['pass2']) < 1 ) {
            $_SESSION['error'] = "Password is required";
            header("Location: change.php");
            return;
        } 
        else {
            $username = $_SESSION['name'];
            $pass1 = $_POST['pass1'];  // User supplied (perhaps from a form)
            $pass2 = $_POST['pass2']; // User supplied (perhaps from a form)
            $salt = 'XyZzy12*_'; 

            if ($pass1 == $pass2){

                $newhash = hash('md5', $salt.$pass1);
                $sql = "UPDATE Users SET WHERE Username='$username'";
                $db->query($sql);
                header("Location: inventory.php");
                return;
            }
                
            else {
                // No results in $rows means that the query has no results; the username is not in the database!
                $_SESSION["error"] = "Passwords should match.";
                header("Location: change.php") ;
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
                <a class="nav-link js-scroll-trigger" href="logout.php">Logout</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
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
                    <h1 class="h3 mb-3 font-weight-normal">Enter New Password</h1>
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
                    <label for="pass1" class="sr-only">Enter Password</label>
                    <input type="password" id="pass1" name="pass1" class="form-control" placeholder="Enter Password">
                    <label for="pass2" class="sr-only">Confirm Password</label>
                    <input type="password" id="pass2" name="pass2" class="form-control" placeholder="Confirm Password">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Change</button>
                    
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
	