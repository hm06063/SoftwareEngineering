<?php
	session_start();
	require_once("../lib/MYDB.php");
	$pdo = db_connect(); 
	
	$sql = "select * from whalsrl5650.Recipe order by recipeID desc";
	$result = $pdo->query($sql);
	$count=$result->rowCount(); 
?>