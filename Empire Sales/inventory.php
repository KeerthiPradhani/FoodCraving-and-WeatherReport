<?php  include "db.inc"; 
  session_start();

  $db = new BusDB();
  if(!$db) {
    echo $db->lastErrorMsg();
  }

  if(isset($_GET['Make'])){
    if($_GET['Make'] == 'Select a Make'){
      if(isset($_GET['New'])){
        header('Location: inventory.php?New='.$_GET['New']);
        return;
      }
      else{
        header('Location: inventory.php');
        return;
      }
    }

  }

  if(isset($_GET['Model'])){
    if($_GET['Model'] == 'Select a Model'){
      if(isset($_GET['New'])){
        header('Location: inventory.php?New='.$_GET['New'].'&Make='.$_GET['Make']);
        return;
      }
      else{
        header('Location: inventory.php?Make='.$_GET['Make']);
        return;
      }  
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
  <header class="masthead">
    <div class="fullscreen-bg">
          <video loop muted autoplay class="fullscreen-bg__video">
              <source src="vid/Renault.mp4" type="video/mp4">
          </video>
    </div>
    
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <form action="inventory.php#about">

          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-primary">
              <input type="radio" name="New" id="used" value=0>Used
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="New" id="new" value=1>New
            </label>
      
          </div>

          <br>
          <br>
          <div class="form-group row">
            <div id = "make" class="col-sm-5">
            <select name="Make">
              <option value="Select a Make">Select a Make</option>

              <?php
                $sql = "SELECT DISTINCT Make from Specifications";
                $ret = $db->query($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
                  echo "<option value=\"" . $row['Make'] . "\">". $row['Make'] ."</option>";
                }
              ?>          
            </select>
          </div>
            <div id = "model" class="col-sm-5">
            <select name="Model">
              <option value="Select a Model">Select a Model</option>
              <?php
                $sql = "SELECT DISTINCT Model from Specifications";
                $ret = $db->query($sql);
                while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
                  echo "<option value=\"" . $row['Model'] . "\">". $row['Model'] ."</option>";
                }
              ?>
            </select>
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-primary js-scroll-trigger">Search</button>
            </div>
          </form>
        </div>  
      </div>
      

  </header>

  <!-- About Section -->
  <section id="about" class="about-section text-center">
      <?php  
        
         $sql = "SELECT STK, Year, Make, Model, VIN, Mileage from Inventory INNER JOIN Specifications ON Inventory.ID=Specifications.ID";
         
         if(isset($_GET['Make'])){
          $make = $_GET['Make'];
          $sql = "SELECT STK, Year, Make, Model, VIN, Mileage from Inventory INNER JOIN Specifications ON Inventory.ID=Specifications.ID WHERE Make='$make'";
         }
         
         if(isset($_GET['Model'])){
        
          $model = $_GET['Model']; 
          $sql = "SELECT STK, Year, Make, Model, VIN, Mileage from Inventory INNER JOIN Specifications ON Inventory.ID=Specifications.ID WHERE Make='$make' AND Model='$model'";
         }

         if(isset($_GET['New'])){
           $new = $_GET['New'];
           $sql = $sql." AND New=$new";
         }
         
         
         // Display the query results
         $root = $db->query($sql);
         $result = $root->fetchArray(SQLITE3_ASSOC);
         if(empty($result)){
           echo "<div class=\"container\"><h3>No Available Results!</h3></div>";
         }

         echo "
         <table class=\"table table-striped table-dark table-bordered table-sm\">
          <thead class=\"thead-dark\">
            <tr>
                <th scope=\"col\">STK#</th>
                <th scope=\"col\">Year</th>
                <th scope=\"col\">Make</th>
                <th scope=\"col\">Model</th>
                <th scope=\"col\">VIN</th>
                <th scope=\"col\">Mileage</th>
            </tr>
          </thead>
         ";

         // Execute the query
        
         $ret = $db->query($sql);
   
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
             echo "<tr>";
             echo "<td><a href=\"product.php?STK=".$row['STK']."\">".$row['STK']."</a></td>";
             echo "<td>".$row['Year'] ."</td>";
             echo "<td>". $row['Make'] ."</td>";
             echo "<td>".$row['Model']."</td>";
             echo "<td>".$row['VIN'] ."</td>";
             echo "<td>".number_format($row['Mileage'])."</td>";
             echo "</tr>";
         }
         echo "</table>";
         if (isset($_SESSION['name']) ) {
          echo "<div class=\"col-sm-2\">
          <a href=\"add.php\"class=\"btn btn-primary js-scroll-trigger\">Add</a>
        </div>";
        }
         
         // Close the database
         $db->close();
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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>            

  <!-- Plugin JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

  <!-- Custom scripts-->
  <script src="js/empire.js"></script>

</body>

</html>
