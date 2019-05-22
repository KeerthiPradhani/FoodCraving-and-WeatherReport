<?php  include "db.inc"; 

  session_start();
 
  $db = new BusDB();
  if(!$db) {
      echo $db->lastErrorMsg();
  }
  $stk = $_GET['STK'];

  $sql=$db->query("SELECT Inventory.ID FROM Inventory INNER JOIN Specifications ON Inventory.ID=Specifications.ID WHERE Inventory.STK='$stk';");
  $result = $sql->fetchArray(SQLITE3_ASSOC);

  $ID = $result['ID'];

  $result=$db->query("SELECT * FROM Photos WHERE ID=$ID"); 
  
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
          <?php
            if (!isset($_SESSION['name']) ) {
              echo "<li class=\"nav-item\">
              <a class=\"nav-link js-scroll-trigger\" href=\"login.php\">Admin Login</a>
            </li>";
            }
            else{
              echo "<li class=\"nav-item\">
              <a class=\"nav-link js-scroll-trigger\" href=\"logout.php\">Logout</a>
            </li>";

            echo "<li class=\"nav-item\">
              <a class=\"nav-link js-scroll-trigger\" href=\"change.php\">Change Password</a>
            </li>";
            }
          ?>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="index.php#contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header>
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
            <div id="div-carCarousel">
                <div id="carCarousel" class="carousel slide">

                    <!-- Content of Carousel -->
                    <?php  
                        $index = 0;
                        while($row = $result->fetchArray(SQLITE3_ASSOC)){
                            if($index==0){
                                echo "<div class='carousel-item active'>
                                    <img src='" .$row['Path'] ."' alt='Car photo'>
                                </div>";
                            }else{
                                echo "<div class='carousel-item'>
                                    <img src='" .$row['Path']. "' alt='Car photo'>
                                </div>";
                            }
                            $index++;
                        } 
                    ?>

                    <!-- Carousel control -->
                    <a class="carousel-control-prev" href="#carCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <!-- Image Indicators below the carousel -->
                <div class="indicators">

                    <!-- Content of Indicators -->
                    <ol class="carousel-indicators">
                        <?php  
                            $indicate_index = 0;
                            while($row = $result->fetchArray(SQLITE3_ASSOC)){
                                echo "<img data-target='#carCarousel' data-slide-to='".$indicate_index."' src='" .$row['Path']. "' alt='Car photo'>";
                                $indicate_index++;
                            }
                            
                        ?>
                    </ol>
                    <!-- Indicators control -->
                    <a href="#" class="indicators-control indicators-control-left" role="button">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a href="#" class="indicators-control indicators-control-right" role="button">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                </div>
            </div>
        
        </div>  
    </div>
      <?php  
        
         $sql = "SELECT Specifications.ID, STK, Year, Make, Model, VIN, Mileage, Engine, Transmission, 
         Capacity, Gas, Brakes, Seats, Width, Height, Length 
         from Inventory INNER JOIN Specifications ON Inventory.ID=Specifications.ID WHERE Inventory.STK='$stk'";
         

         echo "<table class=\"table table-striped table-dark table-bordered table-sm\">";

         // Execute the query
         $ret = $db->query($sql);
         // Display the query results
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
             echo "<tr>";
             echo "<th scope=\"row\">STK#</th>";
             echo "<td>".$row['STK']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Year</th>";
             echo "<td>".$row['Year']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Make</th>";
             echo "<td>".$row['Make']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Model</th>";
             echo "<td>".$row['Model']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">VIN</th>";
             echo "<td>".$row['VIN']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Mileage</th>";
             echo "<td>".number_format($row['Mileage'])."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Engine</th>";
             echo "<td>".$row['Engine']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Transmission</th>";
             echo "<td>".$row['Transmission']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Tank Capacity</th>";
             echo "<td>".$row['Capacity']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Gas Mileage</th>";
             echo "<td>".$row['Gas']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Brakes</th>";
             echo "<td>".$row['Brakes']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Max Seating Rows</th>";
             echo "<td>".$row['Seats']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Width</th>";
             echo "<td>".$row['Width']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Height</th>";
             echo "<td>".$row['Height']."</td>";
             echo "</tr>";
             echo "<tr>";
             echo "<th scope=\"row\">Length</th>";
             echo "<td>".$row['Length']."</td>";
             echo "</tr>";
         }
         echo "</table>";
         
         
         // Close the database
         $result = $ret->fetchArray(SQLITE3_ASSOC);
         
      ?>
      <?php
            if (isset($_SESSION['name']) ) {

              echo "<h1>Add Photo</h1>
              <form action=\"updatePhoto.php\" method=\"POST\" enctype=\"multipart/form-data\">
                <div class=\"form-group\">
                  <input type=\"hidden\" name=\"ID\" class=\"form-control\" value=".$result['ID'].">
                </div>
                <div class=\"form-group\">
                  <div class=\"form-group floating-label-form-group controls mb-0 pb-2\">
                    <label for=\"uploadedfile\">New Photo:</label>
                    <input type=\"file\" name=\"uploadedfile\" class=\"form-control\">
                  </div>
                </div> 
                <button type=\"submit\" class=\"btn btn-primary\">Upload</button>
              </form>";
            
            }
      ?>
      

    
    
  </section>

  <!-- Footer -->
  <footer class="bg-black small text-center text-white-50">
    <div class="container">
        <p>Location: 2674 W Henrietta Rd, Rochester, NY 14623</p><br>
        <p>Hours: Mon-Fri, 7:30 a.m. – 6:00 p.m.</p>
    </div>
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>            

  <!-- Plugin JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

  <!-- Custom scripts-->
  <script src="js/empire.js"></script>

</body>

</html>
