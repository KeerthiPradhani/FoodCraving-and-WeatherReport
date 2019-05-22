<?php
    include 'inc/session.php';
    include 'inc/db.php';
    

    // If the user is NOT logged in, forward to "login.php"
    if (!hasSession()) {
        header('Location: login.php');
        exit();
    }
?>

<html>
    <head>
        <!-- // Include the common head elements -->
        <?php include 'partials/head-elements.php';?>
        <link rel='stylesheet' href='style.css'>
    </head>

    <body>

        <?php
            // Get the username from the session
            $db = new StorefrontDB();
            $username = getUsername();

            // Get the product ID from the GET request
            $productID = $_GET["id"];

               //Get the user ID
            $result = $db->query("SELECT UserID FROM Users WHERE Username = '$username'");
            $resultarray = $result->fetchArray(SQLITE3_ASSOC);
            $userID = $resultarray['UserID'];
          
           // Delete the entry from the Shopping Cart table
            $db->query("DELETE FROM ShoppingCart WHERE ProductID = '$productID' AND UserID = '$userID'");

            // Display the shopping cart after deletion
            $queryshopping = $db->query("SELECT * FROM ShoppingCart WHERE UserID = '$userID'");

            //init arrays
            $shopColumns = array();
            $shopRows = array();
            $firstRow = true;
            echo '<div class="tableresponsive"><table class="table">';
            while ($row = $queryshopping->fetchArray(SQLITE3_ASSOC)) {
                if ($firstRow) {
                    echo '<thead><tr class = "headingrow"><td>Product Name</td>';
                    echo '<td>Quantity</td>';
                    echo '<td>Price</td>';
                    echo '<td>Total Cost</td>';
                    echo '</tr></thead>';
                    echo '<tbody>';
                    $firstRow = false;
                }

                $prID = $row["ProductID"];
                $qproducts = $db->query("SELECT Price FROM Products WHERE ProductID = '$prID'");
                $rowpr = $qproducts->fetchArray(SQLITE3_ASSOC);

                $qprod = $db->query("SELECT Name FROM Products WHERE ProductID = '$prID'");
                $rowprname = $qprod->fetchArray(SQLITE3_ASSOC);

                $totalcost = intval($rowpr['Price']) * intval($row['Quantity']);
                $amountdue += $totalcost;
                echo '<tr class = "tabledata">';
                echo "<td><a href='product.php?id=" . $row['ProductID'] . "'>".$rowprname['Name']."</a></td>";
                echo '<td>'.$row['Quantity'].'</td>';
                echo '<td>$'.$rowpr['Price'].'</td>';
                echo '<td>$'.$totalcost.'</td>';
                echo "<td><a class = 'cartbutton' href='removeFromCart.php?id=" . $row['ProductID'] . "'>Remove from Cart</a></td>";
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table></div>';
            echo ' <div><h3>Congratulations! Your total amount to be paid is $'.$amountdue.'</h3></div>';
        ?>

            <form action="products.php">
            <div class = 'logindiv'>
                <button class = 'loginbutton' type="submit">Return to Shopping!</button>
            </div>
            </form>

        <!-- // Include the common script elements -->
        <?php include 'partials/footer.php'?>
        <?php include 'partials/script-elements.php'?>
    </body>
</html>
