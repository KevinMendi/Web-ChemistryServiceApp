<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
function __autoload($class)
{
  require_once "classes/$class.php";
}

$ch = new Chempo();
$uname = (String)$_POST["username"];

//echo $uname;

if($uname != "")
{
$count = $ch->countUser($uname);
$countToInt = (int)$count['userCount'];
if($countToInt > 0)
{
    echo "<span class='status-not-available' style ='color:red'>Sorry! This username is already taken.</span>";
}
else
{
     echo "<span class='status-available' style='color:green'>Username is available.</span>";
}
}






/*
if(!empty($_POST["username"])) {
  $query = "SELECT * FROM users WHERE userName='" . $_POST["username"] . "'";
  $user_count = $db_handle->numRows($query);
  if($user_count>0) {
      echo "<span class='status-not-available'> Username Not Available.</span>";
  }else{
      echo "<span class='status-available'> Username Available.</span>";
  }
}
*/
?>


