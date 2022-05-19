<?php
//database connection
require_once "partial/DB_CONNECTION.php";
//getting the super global variable id;
$id = $_POST['id'];
//deletign the selected category
$query = "DELETE FROM categories WHERE id=".$id;
//checking if the process is successfull or not.
$result = mysqli_query($connection,$query);
if ($result){
    header('Location:show_category.php');
}