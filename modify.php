<?php
session_start();

$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650") or die("connect fail");

$id = $_REQUEST["recipeID"];

$sql = "select * from whalsrl5650.Recipe where recipeID=$id";

$result = mysqli_query($link, $sql);

$row=mysqli_fetch_assoc($result);

$subject = $row['title'];
$type = $row['type'];

$count=$row['cookTime'];

$item_title = str_replace(" ", "&nbsp;", $row['title']);

$item_content = $row['content'];

$item_date = $row['uploadDate'];
$item_date = substr($item_date, 0, 10);

$item_hit = $row['view_count'];
$new_hit = $item_hit + 1;

if(strlen($row['Image_copied']) > 0) {
		$path = "../data/".$row['Image_copied'];

		$chk_name = explode(".", $row['Image_copied']);
		$old_file = $chk_name[sizeof($chk_name)-1];
}


$item_ingredients=$row['ingredients'];
$item_price=$row['price'];


 $sql2="select * from whalsrl5650.Step where recipeID=$id";
 $result2=mysqli_query($link, $sql2);
 $row_step=mysqli_fetch_assoc($result2);

 $count=$row_step['step_count'];

$sql_time="select * from whalsrl5650.Timer where recipeID=$id";
$result_time=mysqli_query($link, $sql_time);
$row_time=mysqli_fetch_assoc($result_time);



$URL = './mylist.php';


?>


<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="//unpkg.com/bootstrap@4/dist/css/bootstrap.min.css">
		<meta charset="utf-8">
		<script src="http://code.jquery.com/jquery-latest.min.js"></script>

		<html lang="ko">
			<head>
				<meta charset="utf-8">
				<title>Modify Your Recipe~!</title>
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<style>
					#jb-container {
						width: 940px;
						margin: 10px auto;
						padding: 20px;
						border: 1px solid #bcbcbc;
						color: #FFFFFF;
						background-color: #424242;;
						font-family: 'Sans-Serif';
					}
					#jb-header {
						padding: 20px;
						margin-bottom: 20px;
						border: 1px solid #bcbcbc;
						background-color: #FFFFFF;
						color: #424242;
						font-family: 'Sans-Serif';
					}
					#jb-content {
						width: 900px;
						padding: 20px;
						margin-bottom: 20px;
						float: center;
						border: 1px solid #bcbcbc;
						background-color: #FFFFFF;
						color: #424242;
						font-family: 'Sans-Serif';
					}
					#jb-sidebar {
						width: 260px;
						padding: 20px;
						margin-bottom: 20px;
						float: right;
						border: 1px solid #bcbcbc;
					}
					#jb-footer {
						clear: both;
						padding: 20px;
						border: 1px solid #bcbcbc;
						color: #424242;
						background-color: #FFFFFF;
						font-family: 'Sans-Serif';
					}
					@media (max-width: 480px) {
						#jb-container {
							width: auto;
						}
						#jb-content {
							float: none;
							width: auto;
						}
						#jb-sidebar {
							float: none;
							width: auto;
						}
					}

					.btn {
						background-color: #333;
						border: 2px solid #333;
						color: #fff;
						line-height: 30px;
					}
					.btn:hover {

						background-color: #fff;
						border-color: #333;
						color: #333;
					}

				</style>
				<script type="text/javascript" src="handling_component.js"></script>
				<script type="text/javascript" src="validation.js"></script>
			</head>

			<body>

				<form name="board_form" method="post" action="modify_upload.php" enctype="multipart/form-data">
					<input type="hidden" name="old_file" value="<? echo $old_file ?>">
					<div id = "jb-container">

						<div id = 'jb-header'>
							<div >
								&nbsp; 닉네임:&nbsp; <?=$_SESSION["NICKNAME"] ?><Br>
							</div>
							<div >&nbsp; 제목 </div>
							&nbsp;  <input type="text" name="TITLE" id="title" value="<?=$subject?>" required>
							</div>

							<div id = 'jb-content'>
							<div> &nbsp;카테고리<br/></div>
							<div>
							&nbsp;<select name = 'type'>
							<option value="밥" <?php if($type=="밥") echo SELECTED;?>>밥</option>
							<option value="밑반찬" <?php if($type=="밑반찬") echo SELECTED;?>>밑반찬</option>
							<option value="메인반찬" <?php if($type=="메인반찬") echo SELECTED;?>>메인반찬</option>
							<option value="국,찌개" <?php if($type=="국,찌개") echo SELECTED;?>>국,찌개</option>
							<option value="면요리" <?php if($type=="면요리") echo SELECTED;?>>면요리</option>
							<option value="해물,어류" <?php if($type=="해물,어류") echo SELECTED;?>>해물,어류</option>
							<option value="분식" <?php if($type=="분식") echo SELECTED;?>>분식</option>
							<option value="술안주" <?php if($type=="술안주") echo SELECTED;?>>술안주</option>
							<option value="디저트,음료" <?php if($type=="디저트,음료") echo SELECTED;?>>디저트,음료</option>
							</select>
						</div>
						<br/>

						<hr>

						<!--<div> 가격</div>
						<input type="text" name="PRICE" required>-->
						<div style="float:left;">
						가격대 <Br>
							&nbsp;<input type = 'radio' name = 'price' value= '5000' <?php if($item_price=='5000') echo checked;?>/>
							만원 미만
							<input type = 'radio' name = 'price' value= '15000' <?php if($item_price=='15000') echo checked;?>/>
							만원~2만원
							<input type = 'radio' name = 'price' value= '25000' <?php if($item_price=='25000') echo checked;?>/>
							2만원~3만원
							<input type = 'radio' name = 'price' value= '50000' <?php if($item_price=='50000') echo checked;?>/>
							3만원 이상

						</div>

						<br/>
						<div style = "width:80%;"><Br>
							<!--<textarea rows="20" cols="80" name="CONTENT" required></textarea> -->
							&nbsp;							<textarea class="form-control" name="CONTENT" id="content" rows="4"><?=$item_content?></textarea></br>
							&nbsp;							<textarea class="form-control" name="ingredients" id="ingredients" rows="4"><?=$item_ingredients?></textarea>
						</div>

						<br/>
						<br/>

						<div id="step" style="float:none; margin:0 auto"></div>

						<button type="button" id="add_step_btn" style="height:50px" class="btn btn-primary btn-lg btn-block" onclick="addStep(this.id)">
							요리 과정 추가
						</button>
						<br>

						<div id = 'jb-footer' style = "width:80;">
              <?
                //////////////기존 첨부파일 표시 및 파일 첨부하기////////////////////////////
                echo "<table width=\"80%\">\n";

                if(strlen($old_file) > 0)
                {
                  //체크된 값만 chk_delete 배열에 순서대로 저장된다.
                  //chk_delete에 값이 들어있다면 체크가 된 것이다.
                  echo "<tr><td width=\"120\" align=\"left\">대표사진<Br>
                        <input type=\"file\" name=\"uploadedfile\" size=\"30\">&nbsp;
                        <img src=\"paperclip-16x16.png\"><a href=\"$path\">$old_file</a>
                        <input type=\"checkbox\" name=\"chk_delete\" value=\"$row[Image_copied]\">삭제 </td></tr>\n";
                }
                else
                {
                  echo "<tr><td width=\"120\" align=\"center\">대표사진<Br>
                        <input type=\"file\" name=\"uploadedfile\" size=\"30\"></td></tr>\n";
                  }

                echo "</table>\n";
                //////////////파일 첨부하기////////////////////////////
              ?>
						</div></br>

						<br>
						<div align="right">
              <input type="hidden" name="recipeID" value="<?=$id?>">
              <button type = "submit" class = "btn btn-outline-success btn-lg" onclick="return CheckValidation()">수정</button>
							<button type="button" onclick="location.href='list.php'" class="btn btn-outline-primary btn-lg">
								목록
							</button>
						</div>

					</div>
					</div>
				</form>

			</body>
		</html>
