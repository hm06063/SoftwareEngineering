<?php
	session_start();
$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

	$id = $_REQUEST["recipeID"];
	$sql = "select * from whalsrl5650.Recipe where recipeID=$id";

	$result = mysqli_query($link, $sql);

	$row=mysqli_fetch_assoc($result);
	$count=$row['cookTime'];

	$item_nick = $row['nickname'];
	$item_id = $row['userID'];

	$item_title = str_replace(" ", "&nbsp;", $row['title']);

	$item_content = $row['content'];

	$item_date = $row['uploadDate'];
	$item_date = substr($item_date, 0, 10);

	$item_hit = $row['view_count'];
	$new_hit = $item_hit + 1;

	$item_image=$row['Image_copied'];
	$item_image="../data/".$item_image;

	$item_ingredients=$row['ingredients'];

	$item_price=$row['price'];

	$sql1 = "update whalsrl5650.Recipe set view_count=$new_hit where recipeID=$id;"; // 글 조회수 증가
	$result1=mysqli_query($link, $sql1);

	 $sql2="select * from whalsrl5650.Step where recipeID=$id";
	 $result2=mysqli_query($link, $sql2);

	 $row_step=mysqli_fetch_assoc($result2);
	 $count=$row_step['step_count'];

	$sql_time="select * from whalsrl5650.Timer where recipeID=$id";
	$result_time=mysqli_query($link, $sql_time);

	$row_time=mysqli_fetch_assoc($result_time);
	include './view_myrecipe.php';


?>