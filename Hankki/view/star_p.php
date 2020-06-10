<?php 		
	session_start();
	
	$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$id=$_GET['id'];
	$score=$_GET['idx'];
	
	$sql = "select * from whalsrl5650.Recipe where recipeID=$id";
								
	$result = mysqli_query($link, $sql);		
	$row=mysqli_fetch_assoc($result);
	
	$item_review = $row['reviewNum'];
 	$new_review = $item_review+1; 
	
	$item_score = $row['score'];
	
	$sql2 = "update whalsrl5650.Recipe set reviewNum=$new_review where recipeID=$id;"; // 글 review수 증가 
	$result2=mysqli_query($link, $sql2);
	
	if($item_review==0)
	{
		$sql3 = "update whalsrl5650.Recipe set score=$score where recipeID=$id;";
		$result3=mysqli_query($link,$sql3);
	} 
	else
	{
		$real_score = $item_score * $item_review;
		$real_score = $real_score + $score;
		$real_score = round($real_score/$new_review, 1);
		$sql3 = "update whalsrl5650.Recipe set score=$real_score where recipeID=$id;";
		$result3=mysqli_query($link,$sql3);
	}

	  
?>
