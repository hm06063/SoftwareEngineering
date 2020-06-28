<?php
$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
if($link === false){
    die("연결 실패 " . mysqli_connect_error());
}
	
	//$id=$_GET['recipeID'];
	$id = $_POST['Id'];
	$sql = "select * from whalsrl5650.Recipe where recipeID=$id";
								
	$result = mysqli_query($link, $sql);


	
	$sql2="select * from whalsrl5650.Step where recipeID=$id";
	$result2=mysqli_query($link, $sql2);
	 
	$row_step=mysqli_fetch_assoc($result2);
	$count=$row_step['step_count'];	

	$sql_time="select * from whalsrl5650.Timer where recipeID=$id";
	$result_time=mysqli_query($link, $sql_time);
	
	$row_time=mysqli_fetch_assoc($result_time);
	
	$array_data = array();
	$array_time = array();
	$i = 0;
	for($start_count=1; $start_count<=$count; $start_count++){
		$word="step";
		$now_step=$word.$start_count;
		$array_data[$i] = $row_step[$now_step];
		$array_time[$i] = $row_time[$now_step]*100;
		$i++;
	}
	include 'slide_receipe.html';
?>