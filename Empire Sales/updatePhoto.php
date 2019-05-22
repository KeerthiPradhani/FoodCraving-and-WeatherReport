<?php include "db.inc"; 

    session_start();
    if (!isset($_SESSION['name']) ) {
        header('Location: login.php');
        return;
    }
    $db = new BusDB();
    if(!$db) {
        echo $db->lastErrorMsg();
    }

    if($_POST["ID"]!=""){
        $ID = $_POST["ID"];
        $target_path = './img/';
        $filename = basename($_FILES['uploadedfile']['name']);
        $target_path = $target_path .$ID .'/' .$filename;
    }

    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)){
        $db->exec("INSERT INTO Photos VALUES ('$ID', '$target_path')");
    }
    chmod($target_path, 0755);
    $sql = "SELECT STK from Inventory WHERE ID='$ID'";
    $ret = $db->query($sql);
    $result = $ret->fetchArray(SQLITE3_ASSOC);
    
    header('Location: product.php?STK='.$result['STK']);
    $db->close();
    return;

?>