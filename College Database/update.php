<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>College Database</title>

    <!--Include the style sheet-->
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
    // Open the database
    class collegedatabase extends SQLite3 {
        function __construct() {
            $this->open('colleges.db');
        }
    }
        
    // create an instance of the database
    $db = new collegedatabase();
    if(!$db) {
        echo $db->lastErrorMsg();
    }
    
    // store the user input
    $college = testcollege($_POST['collegename']);
    $city = testcity($_POST['cityupdate']);
    $state = teststate($_POST['stateupdate']);

    // Evaluation of data on server side
    function testcollege($data){
        if(empty($_POST["collegename"])){
            echo "<script type='text/javascript'>alert('College name is empty!');</script>";
        
        }
        else{
            return $data;
        }
    }

    function testcity($data){
        if(empty($_POST["cityupdate"])){
            echo "<script type='text/javascript'>alert('City name is empty!');</script>";
        }
        else{
            return $data;
        }
    }

    function teststate($data){
        if(empty($_POST["stateupdate"])){
            echo "<script type='text/javascript'>alert('State can consist of only 2 characters!');</script>";
        }
        else{
            return $data;
        }
    }


    // Create the query to update the details
    $cityupdatesql = <<<EOF
    UPDATE collegeinfo SET city='$city' WHERE college='$college';
EOF;

    $stateupdatesql = <<<EOF
    UPDATE collegeinfo SET state='$state' WHERE college='$college';
EOF;
        
    // Execute the query
    $ret1 = $db->query($cityupdatesql);
    $ret2 = $db->query($stateupdatesql);

    //post an alert message
    if (($db->query($stateupdatesql))&& ($db->query($cityupdatesql))) {

        echo "<script type='text/javascript'>alert('Successfully Updated!');</script>";
    } else {
        $error = $db->lastErrorMsg();
        echo "<script type='text/javascript'>alert('Error Updating: $error');</script>";
    }

    // Display the query results
    $selectsql = "SELECT * from collegeinfo";

    echo "
	<table>
        <tr>
            <th>Name</th>
		    <th>State</th>
		    <th>City</th>
		</tr>
   ";

    // Execute the query
    $result = $db->query($selectsql);

    // Display the query results
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
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


