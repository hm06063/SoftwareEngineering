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
	
	if($result->num_rows==0)
	{
		$sql1 = "insert into whalsrl5650.Favorites values($id,'$userID');";
		$result1 = mysqli_query($link,$sql1);

	}
	else
	{
	}

?>
