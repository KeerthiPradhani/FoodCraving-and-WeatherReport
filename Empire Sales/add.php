<?php  include "db.inc"; 
    session_start();
    if (!isset($_SESSION['name']) ) {
        header('Location: login.php');
        return;
    }
    $db = new BusDB();
    if(!$db) {
        echo $db->lastErrorMsg();
    }

    if(isset($_POST['Submit'])){
        $new = $_POST['New'];
        $make = $_POST['Make'];
        $model = $_POST['Model'];
        $year = $_POST['Year'];
        $stk = $_POST['STK'];
        $vin = $_POST['VIN'];
        $mil = $_POST['Mileage'];
        $eng = $_POST['Engine'];
        $trans = $_POST['Transmission'];
        $cap = $_POST['Capacity'];
        $gas = $_POST['Gas'];
        $brake = $_POST['Brakes'];
        $seats = $_POST['Seats'];
        $width = $_POST['Width'];
        $height = $_POST['Height'];
        $length = $_POST['Length'];

        $sql = "INSERT INTO Specifications(Year, Make, Model, Engine, Transmission, Capacity, Gas, Brakes, Seats, Width, Height, Length) VALUES ($year,'$make','$model', '$eng','$trans','$cap', '$gas','$brake','$seats','$width','$height','$length');";
        $db->query($sql);
        $sql=$db->query("SELECT ID FROM Specifications WHERE Make='$make' AND Model='$model' AND Year=$year;");
        $result = $sql->fetchArray(SQLITE3_ASSOC);
        $id = $result['ID'];
        $sql = "INSERT INTO Inventory VALUES ('$stk', '$id', '$vin', $mil, $new);";
        if ($db->query($sql)) {
            header("Location: inventory.php");
            return;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

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

</head>

<body id="page-top">

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
            <a class="nav-link js-scroll-trigger" href="change.php">Change Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="fullscreen-bg">
          <video loop muted autoplay class="fullscreen-bg__video">
              <source src="vid/Renault.mp4" type="video/mp4">
          </video>
    </div>
      

  </header>

  <!-- About Section -->
  <section id="about" class="about-section text-center">
      
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <form name="add" method="POST">
            <?php
                if(!isset($_POST['Next'])){
                    echo " 
                        <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary\">
                            <input type=\"radio\" name=\"New\" id=\"used\" value=0 required>Used
                            </label>
                            <label class=\"btn btn-primary\">
                            <input type=\"radio\" name=\"New\" id=\"new\" value=1>New
                            </label>
                        </div>
                        <br>
                        <br>
                        <div class=\"form-group row\">
                            <label for=\"STK\" class=\"col-sm-2 col-form-label\">STK#:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"STK\" class=\"form-control\" id=\"STK\" placeholder=\"Stock#\" required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Make\" class=\"col-sm-2 col-form-label\">Make:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Make\" class=\"form-control\" id=\"Make\" placeholder=\"Make\" required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Model\" class=\"col-sm-2 col-form-label\">Model:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Model\" class=\"form-control\" id=\"Model\" placeholder=\"Model\" required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Year\" class=\"col-sm-2 col-form-label\">Year:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Year\" class=\"form-control\" id=\"Year\" placeholder=\"Year\" required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"VIN\" class=\"col-sm-2 col-form-label\">VIN:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"VIN\" class=\"form-control\" id=\"VIN\" placeholder=\"VIN\" required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Mileage\" class=\"col-sm-2 col-form-label\">Mileage:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Mileage\" class=\"form-control\" id=\"Mileage\" placeholder=\"Mileage\" required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <div class=\"col-sm-10\">
                                <button name=\"Next\" type=\"submit\" class=\"btn btn-primary\">Next</button>
                            </div>
                        </div>";
                }
                else{
                    $new = $_POST['New'];
                    $make = $_POST['Make'];
                    $model = $_POST['Model'];
                    $year = $_POST['Year'];
                    $stk = $_POST['STK'];
                    $vin = $_POST['VIN'];
                    $mil = $_POST['Mileage'];
                    $sql=$db->query("SELECT ID FROM Specifications WHERE Make='$make' AND Model='$model' AND Year=$year;");
                    $result = $sql->fetchArray(SQLITE3_ASSOC);
                    if(empty($result)){

                        echo " 
                        <div class=\"btn-group btn-group-toggle\" data-toggle=\"buttons\">
                            <label class=\"btn btn-primary\">
                            <input type=\"radio\" name=\"New\" id=\"used\" value=0 required>Used
                            </label>
                            <label class=\"btn btn-primary\">
                            <input type=\"radio\" name=\"New\" id=\"new\" value=1>New
                            </label>
                        </div>
                        <br>
                        <br>
                        <div class=\"form-group row\">
                            <label for=\"STK\" class=\"col-sm-2 col-form-label\">STK#:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"STK\" class=\"form-control\" id=\"STK\" placeholder=\"Stock#\" value=".$stk." required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Make\" class=\"col-sm-2 col-form-label\">Make:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Make\" class=\"form-control\" id=\"Make\" placeholder=\"Make\" value=".$make." required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Model\" class=\"col-sm-2 col-form-label\">Model:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Model\" class=\"form-control\" id=\"Model\" placeholder=\"Model\" value=".$model." required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Year\" class=\"col-sm-2 col-form-label\">Year:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Year\" class=\"form-control\" id=\"Year\" placeholder=\"Year\" value=".$year." required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"VIN\" class=\"col-sm-2 col-form-label\">VIN:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"VIN\" class=\"form-control\" id=\"VIN\" placeholder=\"VIN\" value=".$vin." required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Mileage\" class=\"col-sm-2 col-form-label\">Mileage:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Mileage\" class=\"form-control\" id=\"Mileage\" placeholder=\"Mileage\" value=".$mil." required>
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Engine\" class=\"col-sm-2 col-form-label\">Engine:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Engine\" class=\"form-control\" id=\"Engine\" placeholder=\"Engine\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Transmission\" class=\"col-sm-2 col-form-label\">Transmission:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Transmission\" class=\"form-control\" id=\"Transmission\" placeholder=\"Transmission\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Capacity\" class=\"col-sm-2 col-form-label\">Tank Capacity:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Capacity\" class=\"form-control\" id=\"Capacity\" placeholder=\"Tank Capacity\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Gas\" class=\"col-sm-2 col-form-label\">Gas Mileage:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Gas\" class=\"form-control\" id=\"Gas\" placeholder=\"Gas Mileage\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Brakes\" class=\"col-sm-2 col-form-label\">Brakes:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Brakes\" class=\"form-control\" id=\"Brakes\" placeholder=\"Brakes\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Seats\" class=\"col-sm-2 col-form-label\">Max Seating Rows:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Seats\" class=\"form-control\" id=\"Seats\" placeholder=\"Max Seating Rows\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Width\" class=\"col-sm-2 col-form-label\">Width:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Width\" class=\"form-control\" id=\"Width\" placeholder=\"Width\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Height\" class=\"col-sm-2 col-form-label\">Height:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Height\" class=\"form-control\" id=\"Height\" placeholder=\"Height\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <label for=\"Length\" class=\"col-sm-2 col-form-label\">Length:</label>
                            <div class=\"col-sm-10\">
                                <input type=\"text\" name =\"Length\" class=\"form-control\" id=\"Length\" placeholder=\"Length\">
                            </div>
                        </div>
                        <div class=\"form-group row\">
                            <div class=\"col-sm-10\">
                                <button name=\"Submit\" type=\"submit\" class=\"btn btn-primary\">Submit</button>
                            </div>
                        </div>";
                        

                    }
                    else{
                        $id = $result['ID'];
                        $sql = "INSERT INTO Inventory VALUES ('$stk', $id, '$vin', $mil, $new);";
                        if ($db->query($sql)) {
                            header("Location: inventory.php");
                            return;
                        }
                    }
                }    
            ?>
            
        </form>
        
    
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
