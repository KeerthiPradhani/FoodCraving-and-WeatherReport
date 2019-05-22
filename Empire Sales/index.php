<?php  include "db.inc"; 

  $db = new BusDB();
  if(!$db) {
    echo $db->lastErrorMsg();
  }


    if(isset($_POST["Send"])) {
        unset($_POST["Send"]);
        $recipient="axg3018@g.rit.edu";
        $subject="Query: Empire Bus";
        $sender=$_POST["name"];
        $senderEmail=$_POST["email"];
        $message=$_POST["message"];
        $phone = $_POST["phone"];

        $mailBody="Name: $sender\nPhone: $phone\n\n$message";

        mail($recipient, $subject, $mailBody, "From: $sender <$senderEmail>");

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
                <a class="nav-link js-scroll-trigger" href="login.php">Admin Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
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
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <h2 class="text-white mb-4">About Empire Bus Sales</h2>
          <p class="text-white-50">
              If you’re looking for buses, shuttles and mobility vans 
              for sale in Upstate New York, Empire Bus Sales is a reputable 
              dealer for ElDorado, World Trans, Federal Coach, Krystal, Embassy, 
              ENC and Metro Link buses and shuttles as well as MobilityTRANS  
              mobility vans, passenger shuttles & specialty vans. Empire Bus 
              Sales sells paratransit and passenger buses to transit authorities, 
              county and small-city transit systems, retirement communities and nursing homes, 
              airport and parking shuttle services, charter and limousine companies, hospitals, 
              church groups, private schools, colleges and universities throughout Upstate New York. 
              Empire Bus Sales has also placed secured transport vehicles in service with the state 
              and several county sheriffs’ departments.
          </p>
        </div>
      </div>
      <img src="img/bus.PNG" class="img-fluid" alt="">
    </div>
  </section>

  <!-- Projects Section -->
  <section id="projects" class="projects-section bg-light">
    <div class="container">

      <!-- Featured Project Row -->
      <div class="row align-items-center no-gutters mb-4 mb-lg-5">
        <div class="col-xl-8 col-lg-7">
          <img class="img-fluid mb-3 mb-lg-0" src="img/tour.jpg" alt="">
        </div>
        <div class="col-xl-4 col-lg-5">
          <div class="featured-text text-center text-lg-left">
            <h4>Best Rate in Market</h4>
            <p class="text-black-50 mb-0">Empire Bus Sales has a strong reputation for selling durable, 
              quality, safe, accessible and fuel-efficient buses that feature comfortable and versatile 
              seating options with competitive pricing. Our experienced sales & leasing team Visit our 
              inventory page to see our current inventory of buses for sale in Upstate New York or contact 
              us to let our sales team find the perfect new or used bus that fits your customized needs.</p>
          </div>
        </div>
      </div>

      <!-- Project One Row -->
      <div class="row justify-content-center no-gutters mb-5 mb-lg-0">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/van.png" alt="">
        </div>
        <div class="col-lg-6">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-left">
                <h4 class="text-white">Financing Available</h4>
                <p class="mb-0 text-white-50">Come in to any of our dealerships and 
                  we’ll walk you through the car loan process every step of the way. 
                  We’ll explain all the options available and go through key factors 
                  like down payment, APR, length of loan and more. 
                  Just as we’re here to help you find the right vehicle for your needs 
                  and budget, we’re also here to help you confidently secure used car financing. 
                  You can also browse this section for key tools and tips on financing used cars.
                </p>
                <hr class="d-none d-lg-block mb-0 ml-0">
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Project Two Row -->
      <div class="row justify-content-center no-gutters">
        <div class="col-lg-6">
          <img class="img-fluid" src="img/eldo.jpg" alt="">
        </div>
        <div class="col-lg-6 order-lg-first">
          <div class="bg-black text-center h-100 project">
            <div class="d-flex h-100">
              <div class="project-text w-100 my-auto text-center text-lg-right">
                <h4 class="text-white">Personalized Search</h4>
                <p class="mb-0 text-white-50">Our powerful search makes it easy to refine and 
                  personalize your results so you only see the cars and features you care about
                </p>
                <hr class="d-none d-lg-block mb-0 mr-0">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section id="contact" class="contact-section bg-black">
      <div class="container">
          <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">
    
              <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
              <h2 class="text-white mb-5">Contact Us</h2>
          <div class="col-lg-8 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form name="sentMessage" id="contactForm" novalidate="novalidate" method="POST">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Name</label>
                  <input class="form-control" name="name" id="name" type="text" placeholder="Name" required="required" data-validation-required-message="Please enter your name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Email Address</label>
                  <input class="form-control" name="email" id="email" type="email" placeholder="Email Address" required="required" data-validation-required-message="Please enter your email address.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Phone Number</label>
                  <input class="form-control" name="phone" id="phone" type="tel" placeholder="Phone Number" required="required" data-validation-required-message="Please enter your phone number.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Message</label>
                  <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Please enter a message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl" name="Send" id="sendMessageButton">Send</button>
              </div>
            </form>
          </div>
          <div class="social d-flex justify-content-center">
              <a href="https://twitter.com/EmpireBusSales1" class="mx-2">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="https://www.facebook.com/Empire-Bus-Sales-1619101491650918/" class="mx-2">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://www.linkedin.com/company/empire-bus-sales/" class="mx-2">
                <i class="fab fa-linkedin-in"></i>
              </a>
          </div>
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
