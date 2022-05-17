<?php
require_once "partial/DB_CONNECTION.php";
$id = $_POST['id'];
$newStatus = $_POST['newStatus'];
$query = "UPDATE admins SET status='$newStatus' WHERE id=".$id;
$result = mysqli_query($connection,$query);
if ($result){
    header('Location:show_all_admins.php');
}