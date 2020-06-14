<?php
session_start();
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
				<title>Write Your Recipe~!</title>
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

				<form name="board_form" method="post" action="upload.php" enctype="multipart/form-data">
					<div id = "jb-container">

						<div id = 'jb-header'>
							<div >
								&nbsp; 닉네임:<?=$_SESSION["NICKNAME"] ?>
							</div>
							<div >&nbsp; 제목 </div>
							&nbsp; <input type="text" name="TITLE" id="title">
							</div>

							<div id = 'jb-content'>
							<div> &nbsp;카테고리<br/></div>
							<div>
							&nbsp;<select name = 'type'>
							<option value="밥">밥</option>
							<option value="밑반찬" >밑반찬</option>
							<option value="메인반찬">메인반찬</option>
							<option value="국,찌개">국,찌개</option>
							<option value="면요리">면요리</option>
							<option value="해물,어류" >해물,어류</option>
							<option value="분식">분식</option>
							<option value="술안주">술안주</option>
							<option value="디저트,음료">디저트,음료</option>
							</select>
						</div>
						<br/>

						<hr>

						<!--<div> 가격</div>
						<input type="text" name="PRICE" required>-->
						<div style="float:left;">
							&nbsp;가격대 <br>
							&nbsp;<input type = 'radio' name = 'price' value= '5000'/>
							만원 미만
							<input type = 'radio' name = 'price' value= '15000'/>
							만원~2만원
							<input type = 'radio' name = 'price' value= '25000'/>
							2만원~3만원
							<input type = 'radio' name = 'price' value= '50000'/>
							3만원 이상

						</div>

						<br/>
						<div style = "width:80%;"><Br>
							<!--<textarea rows="20" cols="80" name="CONTENT" required></textarea> -->
							&nbsp;							<textarea class="form-control" name="CONTENT" id="content" rows="4" placeholder="간단한 설명을 입력 해 주세요"></textarea></br>
							&nbsp;							<textarea class="form-control" name="ingredients" id="ingredients" rows="4" placeholder="음식 재료를 입력 해 주세요"></textarea>
						</div>

						<br/>
						<br/>

						<div id="step" style="float:none; margin:0 auto"></div>

						<button type="button" id="add_step_btn" style="height:50px" class="btn btn-primary btn-lg btn-block" onclick="addStep(this.id)">
							요리 과정 추가
						</button>
						<br>

						<div id = 'jb-footer' style = "width:80;">
							<div>
								대표사진
							</div>
							<div class="col2">
								<input type="file" name="upfile" required>
							</div>
						</div></br>
						<br>
						<div align="right">
							<!--<input type="submit" value="글쓰기">-->
							<button type = "submit" class = "btn btn-outline-success btn-lg" onclick="return CheckValidation()">
								레시피 올리기
							</button>
							<button type="button" onclick="location.href='list.php'" class="btn btn-outline-primary btn-lg">
								목록
							</button>
						</div>

					</div>
					</div>
				</form>

			</body>
		</html>
