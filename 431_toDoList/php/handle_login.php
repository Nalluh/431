<?php
session_start();

include("connection.php");
include("functions.php");

//grab input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['userEmail'];
    $password = $_POST['userPassword'];
}

//prevent sql injection 
$sanitized_email =  mysqli_real_escape_string($con, $email);

//look for email in db 
$query = "select * from Users where email = '$sanitized_email' limit 1";
$result = mysqli_query($con, $query);
//if email found in db 
if (mysqli_num_rows($result) > 0)
{
//get rows that are associated with the email
$user_data = mysqli_fetch_assoc($result);
// check if the password is correct 
if (verifyPassword($password,$user_data['password'])){
    //set  session variables 
    $_SESSION['user_id'] = $user_data['user_id'];
    $_SESSION['email'] = $user_data['email'];
    //redirect to home with success login
    header("Location: /431_toDoList/home.html");
    exit(); 
    
 }
}
//else wrong info and return to login with error 
header("Location: /431_toDoList/login.html?incorrectlogin=True");
exit(); 


?>