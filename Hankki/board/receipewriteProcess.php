<?php
session_start();

if (!isset($_SESSION["ID"])) {
	print(" <script>alert('로그인 후 이용 해 주세요!'); history.back(); </script>");
}

include "ReceipeDAO.php";

$ReceipeDAO = new ReceipeDAO();
$tmp_array = Array();
$tmp_time_array = Array();
$tmp_time_array[1] = 0;

$i = 1;
$real_index = 1;
while ($i < 11) {
	$step_id = "Step" . $i;

	if (isset($_POST[$step_id]) && $_POST[$step_id] == true) {
		$tmp_array[$real_index] = $_POST[$step_id];

		$real_index++;
	}
	$i++;
}

$i = 1;
$real_index = 1;
while ($i < 11) {

	$name = "hour" . $i;

	if (isset($_POST[$name]) && $_POST[$name] == true) {
		$tmp = ((int)($_POST[$name])) * 60 * 60;
	} else {
		$tmp = 0;
	}

	$name = "min" . $i;
	if (isset($_POST[$name]) && $_POST[$name] == true) {
		$tmp += ((int)($_POST[$name])) * 60;
	} else {
		$tmp += 0;
	}

	$name = "sec" . $i;
	if (isset($_POST[$name]) && $_POST[$name] == true) {
		$tmp += ((int)($_POST[$name]));
	} else {
		$tmp += 0;
	}
	$tmp_time_array[$real_index] = $tmp;
	$real_index++;
	$i++;
}

$ReceipeDAO -> writeReceipeInfo($_REQUEST["TITLE"], $_REQUEST["CONTENT"], $_REQUEST["price"], $_FILES["upfile"], $_REQUEST["ingredients"], $_REQUEST["type"]);
$recipeID = $ReceipeDAO -> writeReceipeDetail($tmp_array, $tmp_time_array, $_REQUEST["TITLE"]);
$ReceipeDAO -> db_disconnect();
header("Location:http://whalsrl5650.cafe24.com/view/view_data.php?recipeID=" . $recipeID);
?>