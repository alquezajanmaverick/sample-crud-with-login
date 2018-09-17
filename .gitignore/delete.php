<?php
require_once("PHPpdo.php");
$db = new DatabaseConnect();
if(isset($_GET['uid'])){
	$db->query("DELETE FROM tblperson WHERE ID = ? LIMIT 1");
	$db->bind(1,$_GET['uid']);
	$db->execute();
	header("Location:main.php");
}