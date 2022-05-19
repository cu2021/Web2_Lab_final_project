<?php
//database connection
include_once "../Dashboard/partial/DB_CONNECTION.php";

if (isset($_GET['ratings'])) {
    //getting super global variables
    $rating = $_GET['ratings'];
    $storeId = $_GET['store_id'];
    //speciefying the mac address of the client
    $string = exec('getmac');
    $mac = substr($string, 0, 17);

    //save rating into database
    $query = "INSERT INTO rating (store_id,macAdd,rate)
    VALUES('$storeId','$mac','$rating')";
    $result = mysqli_query($connection, $query);
    //checking process status
    if ($result) {
        $errors = [];
        $success = true;
        header("Location:showStoreInfo.php?id=" . $storeId);
    } else {
        echo "please fix all errors";
    }
}
