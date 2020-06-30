<?php
	$conn=mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
	if(mysqli_connect_error($conn)){
		echo "페이지에 접속할 수 없습니다<br>";
	}
	
	$recipe_name=$_POST['recipe_name'];
	$cate=$_POST['cate'];
	$cost=$_POST['cost'];
	
	if(empty($recipe_name)){
		$name_sql="title LIKE '%'";
	}
	else{
		$name_sql="title LIKE '%$recipe_name%'";
	}
	
	if(empty($cate)){
		$cate_sql="type LIKE '%'";
	}
	else{
		$cate_sql="type LIKE '%$cate%'";
	}
	
	if(empty($cost)){
		$cost_sql="price>=0";
	}
	else{
		$cost_sql="price=$cost";
	}
	
	$sql="select * from whalsrl5650.Recipe where ".$name_sql." and ".$cate_sql." and ".$cost_sql.";";

	include_once("./search_go.html");
	
	
?>

