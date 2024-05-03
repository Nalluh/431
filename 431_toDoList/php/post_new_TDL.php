<?php
session_start();
   
include("connection.php");
include("functions.php");

$user_data = check_login($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $toDoListTitle = $_POST['title'];
    $toDoListItems = array();
    foreach ($_POST['items'] as $index => $value) {
       $toDoListItems[$index] = $value;
    }


}

//insert To Do List Title and user idx into DB 
$query = "INSERT INTO User_Lists (User_idx, name) values ('{$user_data['idx']}', '$toDoListTitle')";
mysqli_query($con, $query);

// Grab List_idx that was just created 
$query = "Select list_idx from user_lists where name = '$toDoListTitle'";
$result = mysqli_query($con, $query);
//returns rows of results 
$list_idx =  mysqli_fetch_assoc($result);
//grab the list_idx that was just created 
$list_idx = $list_idx['list_idx'];

//submits  text (items) and list_idx into DB
foreach ($toDoListItems as $index => $value) {

        $query =  "INSERT INTO User_Lists_items (list_idx, text) values ('$list_idx', '$value')";
    mysqli_query($con, $query);
 }

// return to home 
header( "Location: /431_toDoList/home.html");

?>