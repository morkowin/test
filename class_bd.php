<?php 
class DB {
  protected $db;
  static private $instance = null;

  private function __construct() {
   $this->db = new Mysqli("mysql.hostinger.com.ua","u447731515_1993","80994887122","u447731515_1993");
  }

  private function __clone() {}

  static function getInstance() {
   if(self::$instance == null) {
    self::$instance = new self();
   }
   return self::$instance;
  }

  public function insertDataToBd($name,$tel){
	  $res = $this->db->query("insert into `users10` (`name`,`tel`) values ('".$name."','".$tel."')");
	  return $res;
  }
  
}



?>