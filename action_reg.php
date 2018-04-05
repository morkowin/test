<?php
session_start();
require_once "connect.php";

$errors = [];
if(isset($_POST["regsub"])){
	$email = htmlspecialchars($_POST["email"]);
	$login = htmlspecialchars($_POST["login"]);
	$realname = htmlspecialchars($_POST["realname"]);
	$password = htmlspecialchars($_POST["password"]);
	$birthdate = htmlspecialchars($_POST["birthdate"]);
	$countrylist = $_POST["countrylist"];

	SetCookie("email",$email);
	SetCookie("login",$login);
	SetCookie("realname",$realname);
	SetCookie("birthdate",$birthdate);
	SetCookie("countrylist",$countrylist);

	
	if(!preg_match("/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4})$/i",$email)){
		$errors[] = "Email is not valid";
	}
	if(!(strlen($email)>=5 && strlen($email)<=40)){
		$errors[] = "Email size not valid(min=5,max=40)";
	}
	if(!(strlen($login)>=5 && strlen($login)<=10)){
		$errors[] = "Login size not valid(min=5,max=10)";
	}
	if(!(strlen($realname)>=5 && strlen($realname)<=70)){
		$errors[] = "Name size not valid(min=5,max=70)";
	}

	if(!(strlen($password)>=5 && strlen($password)<=20)){
		$errors[] = "Password size not valid(min=5,max=20)";
	}else{
		$password = md5($password);
	}
	$db = DB::getInstance();
	if(!$db->checkLogin($login)){
		$errors[] = "login is not free";
	}
	if(!$db->checkEmail($email)){
		$errors[] = "Email is not free";
	}

	if($birthdate == "") {
		$errors[] = "Date birthdate not valid";
	}else{
		$resbirthdate = explode("-",$birthdate);
		$birthdate = mktime(2,0,30,$resbirthdate[1],$resbirthdate[2],$resbirthdate[0]);
	}

	if(!key_exists(0,$errors)){
		$idcountry = $db->getIdCountry($countrylist);
		$success=$db->insertDataToBd($email,$login,$realname,$password,$birthdate,$idcountry["id"]);
		if($success){
			$_SESSION["login"] = $login;
		}
	}
	else{
		$_SESSION["errors"]=$errors;
	}
	
	header("Location: registration.php");
	exit();
}
?>