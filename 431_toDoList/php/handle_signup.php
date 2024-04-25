<?php
session_start();

include("connection.php");
include("functions.php");


// get form info 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["userFName"];
    $last_name = $_POST["userLName"];
    $email = $_POST["userEmail"];
    $password = $_POST["userPassword"];
}


// check to see if email is already in db 
$query = "Select * from Users where Email= '$email'";

//if rows are returned then the user exists 
if ( mysqli_num_rows(mysqli_query($con,$query)) > 0 ){
        // go back to sign up form with URL Params
    header("Location: /431_toDoList/signup.html?signup_error=True");
    exit(); 
}

//sanitize information before submitting into database 
$sanitized_first_name =  mysqli_real_escape_string($con, $first_name);
$sanitized_last_name =  mysqli_real_escape_string($con, $last_name);
$sanitized_email =  mysqli_real_escape_string($con, $email);
$sanitized_password =  mysqli_real_escape_string($con, hashPassword($password) );
$user_id = random_num(20);

//insert into db 
$query = "insert into Users (user_id,password,FName,LName,email) values ('$user_id','$sanitized_password','$sanitized_first_name','$sanitized_last_name', '$sanitized_email')";
mysqli_query($con, $query);


header("Location: /431_toDoList/login.html");
exit();




?>
