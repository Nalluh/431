<?php
session_start();
   
include("connection.php");
include("functions.php");

$user_data = check_login($con);
//if user is not logged in check_login will return false and send back a badlogin
if(!$user_data){
    $user_info = array("badLogin" => $user_data );
    $json = json_encode($user_info);
    header( 'Content-Type: application/json; charset-utf-8');
    exit($json);
}

$user_id = $user_data['user_id'];
$users_name = $user_data['FName'] ." ". $user_data[ 'LName']; 
$user_email = $user_data['email'];

$user_info = array('email' => $user_email, 'name' => $users_name, 'id' => $user_id );
$json = json_encode($user_info);

header( 'Content-Type: application/json; charset-utf-8');
exit($json);
?>