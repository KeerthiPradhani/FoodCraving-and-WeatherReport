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
    </head>

    <body>
        <div>
            <h1>Shopping Cart</h1>
        </div>
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
        
            //Make a query to see if there is an entry for the user ID and product ID
            $shoppingresults = $db->query("SELECT * FROM ShoppingCart WHERE UserID = '$userID' AND ProductID = '$productID'");
            $shoppingresultsarray = $shoppingresults->fetchArray(SQLITE3_ASSOC);


            //Make a query to Products table to retrieve the Price
            $queryproducts = $db->query("SELECT Price FROM Products WHERE ProductID = '$productID'");
            $rowproduct = $queryproducts->fetchArray(SQLITE3_ASSOC);
            $price = $rowproduct['Price'];


              //Make a query to Products table to retrieve the Product Name
            $queryproductsname = $db->query("SELECT Name FROM Products WHERE ProductID = '$productID'");
            $rowproductname = $queryproductsname->fetchArray(SQLITE3_ASSOC);
            $name = $rowproductname['Name'];


            // Update the quantity in the Shopping Cart table
            $quantity = 1;
            $newquantity = intval($shoppingresultsarray['Quantity'])+1;
            if (empty($shoppingresultsarray)) {
                $db->query("INSERT INTO ShoppingCart(UserID, ProductID, Quantity) VALUES ('$userID', '$productID', '$quantity')");
            }

            else{
                $db->query("UPDATE ShoppingCart set Quantity = '$newquantity' where UserID = '$userID' and ProductID = '$productID'");
            }


            // Display the cart
            $queryshopping = $db->query("SELECT * FROM ShoppingCart");

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
