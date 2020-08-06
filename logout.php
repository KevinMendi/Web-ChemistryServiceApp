<?php
session_start();


if(isset($_SESSION['user_id'])) {
session_destroy();
unset($_SESSION['user_id']);
unset($_SESSION['username']); 
unset($_SESSION['name']); 
unset($_SESSION['company_id']);
unset($_SESSION['user_role_id']);
unset($_SESSION['user_group_id']);
unset($_SESSION['user_role_name']);
unset($_SESSION['user_group_name']);
unset($_SESSION['logged_in_time']);

header("Location: https://chemistryservice.rimpido.com");
exit;
} else {
header("Location: https://chemistryservice.rimpido.com");
exit;
}



?>