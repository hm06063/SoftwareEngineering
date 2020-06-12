<?php 		
	session_start();
	
	$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	$id=$_GET['id'];
	$score=$_GET['idx'];
	$userID=$_SESSION["ID"];
	
	$sql_check="select * from whalsrl5650.Score where userID='$userID' and recipeID=$id";
	$result_check=mysqli_query($link, $sql_check);
								
	if(mysqli_num_rows($result_check)==0){
		$sql = "select * from whalsrl5650.Recipe where recipeID=$id";
									
		$result = mysqli_query($link, $sql);		
		$row=mysqli_fetch_assoc($result);
		
		$item_review = $row['reviewNum'];
		$new_review = $item_review+1; 
		
		$item_score = $row['score'];
		
		$sql2 = "update whalsrl5650.Recipe set reviewNum=$new_review where recipeID=$id;"; // 글 review수 증가 
		$result2=mysqli_query($link, $sql2);
		
		$sql_in = "insert into whalsrl5650.Score values($id, '$userID');";
		mysqli_query($link, $sql_in);
		
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
		$content="완료되었습니다";
		echo json_encode($content);
		exit();
	
	}
	else{
		$content="이미 평가하셨습니다!";
		echo json_encode($content);
		exit();
	}

	  
?>
