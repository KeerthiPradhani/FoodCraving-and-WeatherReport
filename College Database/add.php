<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>College Database</title>

    <!--include the style sheets-->
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js" type="text/javascript"></script>
    <script src="js/custom.js" type="text/javascript"></script>
    </head>
	<body>
<?php 
    // open the database
    class collegedatabase extends SQLite3 {
        function __construct() {
            $this->open('colleges.db');
        }
    }
        
    //create an instance of a class
    $db = new collegedatabase();
    if(!$db) {
        echo $db->lastErrorMsg();
    }
    
    // store the values from user input
    $college =  testcollege($_POST['college']);
    $state = teststate($_POST['state']);
    $city = testcity($_POST['city']);

    // Evaluation of data on server side
    function testcollege($data){
        if(empty($_POST["college"])){
            echo "<script type='text/javascript'>alert('College name is empty!');</script>";
        
        }
        else{
            return $data;
        }
    }

    function testcity($data){
        if(empty($_POST["city"])){
            echo "<script type='text/javascript'>alert('City name is empty!');</script>";
        }
        else{
            return $data;
        }
    }

    function teststate($data){
        if(empty($_POST["state"])){
            echo "<script type='text/javascript'>alert('State can consist of only 2 characters!');</script>";
        }
        else{
            return $data;
        }
    }

     // Create the query to get the info
    $sql = "INSERT INTO collegeinfo VALUES(\"$college\", \"$state\", \"$city\")";

    // Execute the query and display alert message
    if ($db->query($sql)) {

        echo "<script type='text/javascript'>alert('Successfully Added!');</script>";
    } else {
        $error = $db->lastErrorMsg();
        echo "<script type='text/javascript'>alert('Error Adding: $error');</script>";
    }
    $selectsql = "SELECT * from collegeinfo";

    // display the details of the table
    echo "
	<table>
        <tr>
            <th>Name</th>
		    <th>State</th>
		    <th>City</th>
		</tr>
   ";

    // Execute the query
    $ret = $db->query($selectsql);

    // Display the query results
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
        echo "<tr>";
        echo "<td>". $row['college'] ."</td>";
        echo "<td>". $row['state'] ."</td>";
        echo "<td>".$row['city'] ."</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Close the database
    $db->close();    
?>
	</body>
</html>


