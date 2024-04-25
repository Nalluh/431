<?php

function check_login($con)
{
   if(isset ($_SESSION['user_id']))
   {
    // get id that was set at login
    $id = $_SESSION['user_id'];
    // find user with matching id
    $query = "Select * from Users where user_id = '$id' limit 1";
    $result = mysqli_query($con,$query);
    //if query is succesful && exsists in db 
    if($result && mysqli_num_rows($result) > 0)
    {
        // get all info associated with the id
        $user_data = mysqli_fetch_assoc($result);
        // return that info 
        return $user_data;
    }
   }
   // if session is not set redirect to login
    return false;
}

function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length =5;
    }
    $len = rand(4,$length);
    for($i=0; $i < $len; $i++)
    {
        $text.= rand(0,9);
    }
    return $text;
}


function hashPassword($password) {
    // Generate a new password hash using bcrypt algorithm
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Check if the hashing was successful
    if ($hashedPassword === false) {
        return null;
    }
    
    return $hashedPassword;
}


function verifyPassword($password, $hashedPassword) {
    // Verify the password against the hashed password
    return password_verify($password, $hashedPassword);
}

?>