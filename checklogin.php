<?php 
require_once "connect.php";

$login = $_POST["login"];
$db = DB::getInstance();
echo $db->checkLogin($login);
