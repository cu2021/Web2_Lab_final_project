<?php
//database connection
require_once "partial/DB_CONNECTION.php";
//getting the super global variable id;
$id = $_POST['id'];
//deletign the selected admin
$query = "DELETE FROM admins WHERE id=".$id;
//checking if the process is successfull or not.
$result = mysqli_query($connection,$query);
if ($result){
    header('Location:show_all_admins.php');
}