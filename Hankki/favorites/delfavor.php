<?php
	session_start();
	
	$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$id=$_GET['id'];
	$userID = $_SESSION['ID'];
	
	$sql = "select * from whalsrl5650.Favorites where recipeID = $id and userID = '$userID';";
	$result = mysqli_query($link,$sql);
	
	if($result->num_rows==1)
	{
		$sql1 = "delete from whalsrl5650.Favorites where recipeID=$id and userID = '$userID';";
		$result1 = mysqli_query($link,$sql1);

	}
 ?>