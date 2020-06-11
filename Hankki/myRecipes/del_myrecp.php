
<HTML>
<head>
</head>
<body>
<?php
	session_start();
	
	$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	
	$id=$_GET['id'];
	$userID = $_SESSION['ID'];
	
	$sql = "delete from whalsrl5650.Recipe where recipeID = $id;";
	$result = mysqli_query($link,$sql);
	
	$sql2 = "delete from whalsrl5650.Step where recipeID = $id;";
	$result2 = mysqli_query($link,$sql2);
	
	$sql3 = "delete from whalsrl5650.Timer where recipeID = $id;";
	$result3 = mysqli_query($link,$sql3);
 ?>
	<script>
	alert('해당 레시피의 삭제가 완료되었습니다.');
	history.back();
	</script>

 </body>
 </HTML>