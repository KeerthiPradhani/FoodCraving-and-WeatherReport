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
        <h1>Product Details</h1>
    </div>

    <?php
            $db = new StorefrontDB();
            $productID = $_GET["id"];

              // Get a list of all products 
            $query = $db->query("SELECT * FROM PRODUCTS WHERE ProductID = '$productID'");

            // display the products
            //init arrays
            $dataColumns = array();
            $dataRows = array();
            $firstRow = true;
            $row = $query->fetchArray(SQLITE3_ASSOC);
            echo '<div class="tableresponsive"><table class="table">';
                if ($firstRow) {
                    echo '<thead><tr class = "headingrow"><td>Product Name</td>';
                    echo '<td>Description</td>';
                    echo '<td>Image</td>';
                    echo '<td>Price</td>';
                    echo '</tr></thead>';
                    echo '<tbody>';
                    $firstRow = false;
                }
            
                echo '<tr class = "tabledata">';
                echo '<td>'.$row['Name'].'</td>';
                echo '<td>'.$row['Description'].'</td>';
                $img = '<img src="'. $row['ImageURL'] .'"/>';
                echo '<td>'.$img.'</td>';
                echo '<td>$'.$row['Price'].'</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table></div>';

                $db->close();
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
