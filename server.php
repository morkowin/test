<?php 
require_once "class_bd.php";
$db = DB::getInstance();
echo $db->insertDataToBd($_POST["name"],$_POST["tel"]);

?>