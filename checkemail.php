<?php 
require_once "connect.php";

$email = $_POST["email"];
$db = DB::getInstance();
echo $db->checkEmail($email);
