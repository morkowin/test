<?php 
class DB {
  protected $db;
  static private $instance = null;

  private function __construct() {
   $this->db = new Mysqli("localhost", "root", "", "test");
  }

  private function __clone() {}

  static function getInstance() {
   if(self::$instance == null) {
    self::$instance = new self();
   }
   return self::$instance;
  }
  
  public function checkEmail($email){
	  $res = $this->db->query("select * from `users` where `email` = '$email'");
	  if($res->fetch_assoc()){
		  return false;
	  }
	 else return true;
  }
  public function checkLogin($login){
	  $res = $this->db->query("select * from `users` where `login` = '$login'");
	  if($res->fetch_assoc()){
		  return false;
	  }
	  else return true;
  }
  public function getCountryes(){
	  $res = $this->db->query("select * from `countrys`");
	  $arrs = [];
	  while($row = $res->fetch_assoc()){
		  $arrs[] = $row;
	  }
	  return $arrs;
  }
  public function getIdCountry($countrylist){
	  $res = $this->db->query("select * from `countrys` where `name` = '$countrylist'");
	  if($row = $res->fetch_assoc()){
		  return $row;
	  }
	  return false;
  }
  public function insertDataToBd($email,$login,$realname,$password,$birthdate,$id){
	  $res = $this->db->query("insert into `users` (`email`,`login`,`name`,`password`,`birthdate`,`country`) values ('".$email."','".$login."','".$realname."','".$password."','".$birthdate."','".$id."')");
	  return $res;
  }
  public function getDataUserForLogin($login){
	  $res = $this->db->query("select * from `users` where `login` = '$login'");
	  if($row = $res->fetch_assoc()){
		  return $row;
	  }
	  return false;
  }
  public function authFunc($emaillogin,$password){
	  $res = $this->db->query("select * from `users` where ((`login` = '$emaillogin') OR (`email` = '$emaillogin')) AND (`password` = '$password')");
	  if($res->fetch_assoc()){
		  return true;
	  }
	  else return false;
  }
  
  public function getDataUserForLoginEmail($login){
	  $res = $this->db->query("select * from `users` where (`login` = '$login') OR (`email` = '$email')");
	  if($row = $res->fetch_assoc()){
		  return $row;
	  }
	  return false;
  }
}



?>