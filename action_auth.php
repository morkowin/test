<?php
session_start();
require_once "connect.php";

$errors = [];
if(isset($_POST["authsub"])){
	$emaillogin = htmlspecialchars($_POST["emaillogin"]);
	$password = md5(htmlspecialchars(trim($_POST["password"])));
	$db = DB::getInstance();
	$auth = $db->authFunc($emaillogin,$password);
			if($auth) {
				$_SESSION["login"] = $emaillogin;
			}
			else {
				$errors[] = "Incorrect username / email or/and password";
				$_SESSION["errors"]=$errors;
			}
				
			
			
	header("Location: signin.php");
	exit();
}
?>