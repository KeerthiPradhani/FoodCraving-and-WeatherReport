<html>
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>College Database</title>

    <!--Add the style sheet-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui.js" type="text/javascript"></script>
    <script src="js/custom.js" type="text/javascript"></script>

    <script>
        function validateAddForm() {
            // CHeck if all the fields are filled out correctly
        if(document.forms["add-college"]["college"].value == ""){
            alert("Please enter the name of the college!");
            document.getElementById("collegeadd").style.border = "none";
            document.getElementById("collegeadd").style.outline = "1px solid red";
            return false;
        }

        else{
            document.getElementById("collegeadd").style.borderBottom = "1px solid #666";
            document.getElementById("collegeadd").style.outline = "none";

        if(document.forms["add-college"]["city"].value == ""){
            alert("Please enter the name of the city!");
            document.getElementById("cityadd").style.border = "none";
            document.getElementById("cityadd").style.outline = "1px solid red";
            return false;
        }
        else{  
            document.getElementById("cityadd").style.borderBottom = "1px solid #666";
            document.getElementById("cityadd").style.outline = "none";

        if(document.forms["add-college"]["state"].value == ""){
            alert("Please enter the name of the state!");
            document.getElementById("stateadd").style.border = "none";
            document.getElementById("stateadd").style.outline = "1px solid red";
            return false;
                }
            }
        }
        if(document.forms["add-college"]["state"].value.length != 2){
            alert("State has to be a 2 character word!");
            document.getElementById("stateadd").style.border = "none";
            document.getElementById("stateadd").style.outline = "1px solid red";
            return false;
            }
        }

        function validateUpdateForm(){
            if(document.forms["change-city"]["cityupdate"].value == ""){
            alert("Please enter the name of the city!");
            document.getElementById("cityupdate").style.border = "none";
            document.getElementById("cityupdate").style.outline = "1px solid red";
            return false;
        }

        else{
            document.getElementById("cityupdate").style.borderBottom = "1px solid #666";
            document.getElementById("cityupdate").style.outline = "none";

            if(document.forms["change-city"]["stateupdate"].value == ""){
            alert("Please enter the name of the state!");
            document.getElementById("stateupdate").style.border = "none";
            document.getElementById("stateupdate").style.outline = "1px solid red";
            return false;
        }
        else{  
            document.getElementById("stateupdate").style.borderBottom = "1px solid #666";
            document.getElementById("stateupdate").style.outline = "none";
            }
        }

        if(document.forms["change-city"]["stateupdate"].value.length != 2){
            alert("State has to be a 2 character word!");
            document.getElementById("stateupdate").style.border = "none";
            document.getElementById("stateupdate").style.outline = "1px solid red";
            return false;
        }
        }
    </script>
    </head>
	<body>
<?php 

    // Open the database
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

    // insert values to database
    $insertsql =<<<EOF
DROP TABLE IF EXISTS collegeinfo;
create table collegeinfo (
        college varchar(60) Primary Key,
        state varchar(2),
        city varchar(30));

insert into collegeinfo values ('Rochester Institute of Technology', 'NY','Rochester');
insert into collegeinfo values ('University of Rochester', 'NY','Rochester');
insert into collegeinfo values ('St. John Fisher', 'NY','Rochester');
insert into collegeinfo values ('Nazareth', 'NY','Rochester');
insert into collegeinfo values ('MCC', 'NY','Rochester');
insert into collegeinfo values ('Syracuse University', 'NY','Syracuse');
insert into collegeinfo values ('LeMoyne University', 'NY','Syracuse');
insert into collegeinfo values ('St. Olaf', 'MN','Rochester');
insert into collegeinfo values ('Mayo Clinic', 'MN','Rochester');
insert into collegeinfo values ('Daemen College', 'NY','Amherst');
insert into collegeinfo values ('Oakland Community College', 'MI','Rochester');
EOF;

// execute the query
$db->query($insertsql);

//display the contents of the table
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

    $collsql = "SELECT college from collegeinfo";
    $collset = $db->query($collsql);

    
?>
<div class = "buttondiv" id = "buttondiv">
        <button type = "button" class = "add" >Add an entry</button> 
        <button type = "button" class = "update">Update an entry</button>
</div> 

<form name="add-college"  onsubmit="return validateAddForm()" method="POST" action="add.php">
<div class='lightBox1'>
        <h1>
            <span class='close1'><i class='fa fa-times' aria-hidden='true'></i></span>
            ADD NEW ENTRY
        </h1>
        <div class='contentBlock'>
            <div class='regForms'>
                <div class='regInput'>
                    <input type='text' id = 'collegeadd' name = 'college' placeholder='College Name*'>
                </div>
                <div class='regInput'>
                    <input type='text' id = 'cityadd' name = 'city' placeholder='City*'>
                </div>
                <div class='regInput'>
                    <input type='text' id = 'stateadd' name = 'state' placeholder='State*'>
                </div>
                <div class='regInput'>
                    <button type = 'submit' class='btn'>ADD</button>
                </div> 
            </div>
        </div>
    </div>
    <div class='bg_overlay1'></div>
    </form>


    <form name="change-city" onsubmit="return validateUpdateForm()" method="POST" action="update.php">
    <div class='lightBox2'>
        <h1>
             <span class='close2'><i class='fa fa-times' aria-hidden='true'></i></span>
            UPDATE AN ENTRY
        </h1>
        <div class='contentBlock'>
            <div class='regForms'>
                <div class='regInput'>
                <?php 
                echo "<select name= 'collegename'  id = 'collegename' class = 'dropdownmenu'>"; 
                while($row = $collset->fetchArray(SQLITE3_ASSOC) ) {
                    echo "<option value=\"" . $row['college'] . "\">". $row['college'] ."</option>";
                }
                echo "</select>";
                ?>
          </div>
                <div class='regInput'>
                    <input type='text' name = 'cityupdate' placeholder='City*' id = 'cityupdate'>
                </div>
                <div class='regInput'>
                    <input type='text' name = 'stateupdate' placeholder='State*' id = 'stateupdate'>
                </div>
                <div class='regInput'>
                    <button type = 'submit' class='btn'>UPDATE</a>
                </div>
            </div>
        </div>
    </div>
</form>
    <div class='bg_overlay2'></div>

</body>
</html>
