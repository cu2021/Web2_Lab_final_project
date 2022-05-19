<?php
//database connection
require_once "partial/DB_CONNECTION.php";
//getting the id super global variable and the status
$id = $_POST['id'];
$newStatus = $_POST['newStatus'];
//update the status for the selected admin
$query = "UPDATE admins SET status='$newStatus' WHERE id=".$id;
$result = mysqli_query($connection,$query);
//checking the status of the process
if ($result){
    header('Location:show_all_admins.php');
}