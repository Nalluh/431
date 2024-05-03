<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

//grab input and form arrays to assist in DB  manipulation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newTitle = $_POST['updateTitle'];
    $listNameReference = $_POST['listNameReference'];
    $deleteListTitle = $_POST['deleteListTitle'];
    $isChecked = array();
    $task = array();
    $taskToBeDeleted = array();
    if(isset($_POST['removeItems'])){
    foreach ($_POST['removeItems'] as $count => $item) {
        array_push($taskToBeDeleted,$item);

    }
}
    foreach ($_POST['updatedItems'] as $index => $value) {
        $checkBoxIndex = 'isTaskCompleted'.$index;
        if(isset( $_POST[$checkBoxIndex])){
        array_push($isChecked,1);
        array_push($task,$value); 
        }
        else{
        array_push($isChecked,0);
        array_push($task,$value); 
        }
    }
}


// if deleteListTitle is set that means we need to delete
if(isset($deleteListTitle)){
// grab the list idx
$query = "SELECT list_idx FROM user_lists where name = '$deleteListTitle'";
$result = mysqli_query($con, $query);
$result = mysqli_fetch_assoc( $result );
$list_idx = $result['list_idx'];


$query = "DELETE FROM user_lists_items WHERE list_idx = '$list_idx'";
mysqli_query($con , $query);
$query = "DELETE FROM user_lists WHERE name = '$deleteListTitle' and user_idx = '{$user_data['idx']}' ";
mysqli_query($con , $query);

}


// grab the list idx
$query = "SELECT list_idx FROM user_lists where name = '$listNameReference'";
$result = mysqli_query($con, $query);
$result = mysqli_fetch_assoc( $result );
$list_idx = $result['list_idx'];

if($listNameReference != $newTitle){
    echo $listNameReference . $newTitle;
    $query = "UPDATE `user_lists` set name = '$newTitle' where name = '$listNameReference'";
    mysqli_query($con, $query);
    
}


foreach ($task as $index => $value){
    //verify if the tasks is already in the DB
    $query = "SELECT * from `user_lists_items` where text = '$value' and list_idx= '$list_idx' ";
    $result = mysqli_query($con,$query);
    //if it is in the database update the row
    if(mysqli_num_rows($result) > 0){
    $query =  "UPDATE `user_lists_items` SET isChecked = '{$isChecked[$index]}' where text = '$value' and list_idx = '$list_idx'";
    mysqli_query($con,$query);

    } //if not in DB create new row 
    else{

        $sanitized_input = mysqli_real_escape_string($con,$value);
        $query =  "INSERT INTO User_Lists_items (list_idx, text, isChecked) values ('$list_idx', '$sanitized_input', '{$isChecked[$index]}')";
        mysqli_query($con,$query);
    }

}

foreach($taskToBeDeleted as $count => $item){
    $query = "DELETE  FROM `user_lists_items` WHERE text = '$item' and list_idx = '$list_idx'  ";
    mysqli_query($con,$query);
}

header( "Location: /431_toDoList/home.html");


?>