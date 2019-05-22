<?php
    include 'inc/session.php';
    include 'inc/db.php';
?>

<html>
    <head>
        <!-- // Include the common head elements -->
        <?php include 'partials/head-elements.php'?>
    </head>

    <body>
        <div>
             <h1>Products available</h1>
        </div>
        <?php
            $db = new StorefrontDB();

             //Get a list of all products
            $query = $db->query("SELECT * FROM PRODUCTS");

            // Display the products
            //init arrays
            $dataColumns = array();
            $dataRows = array();
            $firstRow = true;
            echo '<div class="tableresponsive"><table class="table">';
            while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
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
                echo "<td><a href='product.php?id=" . $row['ProductID'] . "'>".$row['Name']."</a></td>";
                echo '<td>'.$row['Description'].'</td>';
                $img = '<img src="'. $row['ImageURL'] .'"/>';
                echo '<td>'.$img.'</td>';
                echo '<td>$'.$row['Price'].'</td>';
               

               
                echo "<td><a class = 'cartbutton' href='addToCart.php?id=" . $row['ProductID'] . "'>Add to Cart</a></td>";
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table></div>';
            $db->close();
        ?>


        <!-- // Include the common script elements -->
        <?php include 'partials/footer.php'?>
        <?php include 'partials/script-elements.php'?>
    </body>
</html>
