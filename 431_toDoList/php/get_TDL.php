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

$list_name = array();
$list_text = array();

//firstname + lastname 
$users_name = $user_data['FName'] ." ". $user_data[ 'LName']; 

$query = "SELECT user_lists_items.text, user_lists.name FROM user_lists_items JOIN user_lists on user_lists_items.list_idx = user_lists.list_idx where user_idx = '{$user_data['idx']}'"; 
$result = mysqli_query($con, $query);

// grab all list names corresponding to user idx and show them  in a dropdown menu (maybe)

while($list_info = mysqli_fetch_assoc($result)){
    array_push($list_name, $list_info['name']);
    array_push($list_text,$list_info['text']);
}


$user_info = array('email' => $user_data['email'], 'name' => $users_name, 'id' => $user_data['user_id'], 'list_name'=>$list_name, 'list_text' => $list_text);
$json = json_encode($user_info);

header( 'Content-Type: application/json; charset-utf-8');
exit($json);

?>