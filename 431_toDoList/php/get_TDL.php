<?php
session_start();
   
include("connection.php");
include("functions.php");

if($_SERVER["REQUEST_METHOD"] == "GET")
{

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
$list_checkBox = array();

//firstname + lastname 
$users_name = $user_data['FName'] ." ". $user_data[ 'LName']; 

if(isset($_GET['selectedValue'])) {
    $selectedValue = $_GET['selectedValue'];
switch ($selectedValue) {
    case 'sortName':
        $query = "SELECT user_lists_items.text, user_lists.name, user_lists_items.isChecked FROM user_lists_items JOIN user_lists on user_lists_items.list_idx = user_lists.list_idx where user_idx = '{$user_data['idx']}' Order BY user_lists.name ASC, user_lists_items.isChecked DESC";
        $result = mysqli_query($con, $query);
        while($list_info = mysqli_fetch_assoc($result)){
            array_push($list_name, $list_info['name']);
            array_push($list_text,$list_info['text']);
            array_push($list_checkBox,$list_info['isChecked']);
        }
        break;
    case 'sortAsc':
        $query = "SELECT user_lists_items.text, user_lists.name, user_lists_items.isChecked FROM user_lists_items JOIN user_lists on user_lists_items.list_idx = user_lists.list_idx where user_idx = '{$user_data['idx']}' Order BY user_lists.name ASC, user_lists_items.isChecked DESC";
        $result = mysqli_query($con, $query);
        while($list_info = mysqli_fetch_assoc($result)){
            array_push($list_name, $list_info['name']);
            array_push($list_text,$list_info['text']);
            array_push($list_checkBox,$list_info['isChecked']);
        }
        break;
    case 'sortDesc':
        $query = "SELECT user_lists_items.text, user_lists.name, user_lists_items.isChecked FROM user_lists_items JOIN user_lists on user_lists_items.list_idx = user_lists.list_idx where user_idx = '{$user_data['idx']}' Order BY user_lists.name DESC, user_lists_items.isChecked DESC";
        $result = mysqli_query($con, $query);
        while($list_info = mysqli_fetch_assoc($result)){
            array_push($list_name, $list_info['name']);
            array_push($list_text,$list_info['text']);
            array_push($list_checkBox,$list_info['isChecked']);
        }
        break;
    default:
    $query = "SELECT user_lists_items.text, user_lists.name, user_lists_items.isChecked FROM user_lists_items JOIN user_lists on user_lists_items.list_idx = user_lists.list_idx where user_idx = '{$user_data['idx']}' Order BY user_lists.created ASC, user_lists_items.isChecked DESC";
    $result = mysqli_query($con, $query);
    while($list_info = mysqli_fetch_assoc($result)){
        array_push($list_name, $list_info['name']);
        array_push($list_text,$list_info['text']);
        array_push($list_checkBox,$list_info['isChecked']);
    }
}
}

// grab all list names corresponding to user idx and show them  in a dropdown menu (maybe)




$user_info = array('email' => $user_data['email'], 'name' => $users_name, 'id' => $user_data['user_id'], 'list_name'=>$list_name, 'list_text' => $list_text, 'list_checkbox' => $list_checkBox);
$json = json_encode($user_info);

header( 'Content-Type: application/json; charset-utf-8');
exit($json);
}
?>