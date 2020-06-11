<?php
session_start();
 ?>
 <!DOCTYPE HTML>
 <html>
     <head>
     <meta charset="UTF-8">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">    
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">    
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">   
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">    
    <link rel="shortcut icon" href="../favicon.ico"> 
    <link rel="stylesheet" type="text/css" href="css/style2.css" />
        
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
		color : #FFFFFF;
		background-color : #424242;;
		font-family : 'Sans-Serif';
	  }
	  #jb-header {
		padding: 20px;
		margin-bottom: 20px;
		border: 1px solid #bcbcbc;
		background-color : #FFFFFF;
		color : #424242;
		font-family : 'Sans-Serif';
	  }
	  #jb-content {
		width: 900px;
		padding: 20px;
		margin-bottom: 20px;
		float: center;
		border: 1px solid #bcbcbc;
		background-color : #FFFFFF;
		color : #424242;
		font-family : 'Sans-Serif';
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
		color : #424242;
		background-color : #FFFFFF;
		font-family : 'Sans-Serif';
	  }
	  @media ( max-width: 480px ) {
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
  
  </head>
 
 <body>
 
	<form name="board_form" method="post" action="upload.php" enctype="multipart/form-data">
                    <div id = "jb-container">
			<div id = 'jb-header'>
				<div >&nbsp; 닉네임:<?=$_SESSION["NICKNAME"]?> </div>                    

				<div >&nbsp; 제목 </div>
				<input type="text" name="TITLE" required>
			</div>

			<div id = 'jb-content'>
				<div> &nbsp;카테고리<br/></div>
				 <div>                 
				 <select name = 'type'>
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
				<div class="container" style="float:left;">
					가격대
					<input type = 'radio' name = 'price' value= '5000'/> 만원 미만
					<input type = 'radio' name = 'price' value= '15000'/> 만원~2만원
					<input type = 'radio' name = 'price' value= '25000'/> 2만원~3만원
					<input type = 'radio' name = 'price' value= '50000'/> 3만원 이상

				</div>


				<br/>
				<div style = "width:80%;">
				<!--<textarea rows="20" cols="80" name="CONTENT" required></textarea> -->
				&nbsp;<textarea class="form-control" name="CONTENT" rows="4">간단한 설명을 입력해주세요</textarea></br>
				&nbsp;<textarea class="form-control" name="ingredients" rows="4">음식 재료를 입력해주세요</textarea>					
				</div>

				<br/><br/>

				<div id="step" style="float:none; margin:0 auto"></div>

				<button type="button" id="add_step_btn" style="height:50px" class="btn btn-primary btn-lg btn-block" onclick="addStep(this.id)">요리 과정 추가</button>
				<br>					


				<div id = 'jb-footer' style = "width:80;">
					<div> 이미지파일1</div>
					<div class="col2"><input type="file" name="upfile" required></div>
				</div></br>
				<br>
		
				<div align="right">
					<!--<input type="submit" value="글쓰기">-->
					<button type = "submit" class = "btn btn-outline-success btn-lg" >글쓰기</button>
					<button type="button" onclick="location.href='list.php'" class="btn btn-outline-primary btn-lg">목록</button>
				</div>

			</div>
		   </div>
	</form>
		
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.nice-select.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<script src="../js/jquery.nicescroll.min.js"></script>
	<script src="../js/jquery.barfiller.js"></script>
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/jquery.slicknav.js"></script>
	<script src="../js/owl.carousel.min.js"></script>
	<script src="../js/main.js"></script>
	<script>
		var stepcount = 0;
		var receipe = new Array();

		function addStep(current){
			var new_obj;
			var tmp_id;
			var text;
			var tmp;
			var before_obj;
			var list_obj;
			var list_el;
			var del_btn;
			var del_txt_node;
			var div;
			var div_name;
			var time_div;
			var time_hour;
			var time_min;
			var time_sec;
			var time_div_tmp;
			var time_span_tmp;
			var string_tmp;
			tmp = "Step " + (stepcount + 1);
			tmp_id = "Step" + (stepcount + 1);
			div_name = "Step_div" + (stepcount + 1);
			new_obj = document.createElement('textarea');
			new_obj.setAttribute('name', tmp_id);
			new_obj.setAttribute('class', 'form-control');
			new_obj.setAttribute('id', tmp);
			new_obj.setAttribute('rows', '3');
			//텍스트 입력 태그 생성및 설정
			del_btn = document.createElement('button');
			del_btn.setAttribute('class', 'btn btn-danger btn-space');
			del_btn.setAttribute('id',  stepcount + 1);
			del_btn.setAttribute('onclick', 'deleteStep(id)');
			del_txt_node = document.createTextNode('취소');
			del_btn.appendChild(del_txt_node);
			//취소 태그 생성및 설정

			time_div = document.createElement('div');
			time_div.setAttribute('class', 'input-group input-group-sm mb-3');

			/////////////////////////////////////////////////////////////
			time_hour = document.createElement('input');
			time_hour.setAttribute('type', 'text');
			time_hour.setAttribute('class', 'form-control');
			time_hour.setAttribute('name', 'hour' + (stepcount + 1));
			time_hour.setAttribute('value', '0');
			time_hour.setAttribute('placeholder', '0');
			time_hour.setAttribute('aria-describedby','basic-addon2');

			time_div_tmp = document.createElement('div');
			time_div_tmp.setAttribute('class', 'input-group-append');
			time_span_tmp = document.createElement('span');
			time_span_tmp.setAttribute('class', 'input-group-text');
			time_span_tmp.setAttribute('id', 'basic-addon2');
			string_tmp = document.createTextNode('시');
			time_span_tmp.appendChild(string_tmp);
			time_div_tmp.appendChild(time_span_tmp);

			time_div.appendChild(time_hour);
			time_div.appendChild(time_div_tmp);	
			/////////////////////////////////////////////////////////////

			/////////////////////////////////////////////////////////////
			time_min = document.createElement('input');
			time_min.setAttribute('type', 'text');
			time_min.setAttribute('class', 'form-control');
			time_min.setAttribute('name', 'min' + (stepcount + 1));
			time_min.setAttribute('value', '0');
			time_min.setAttribute('placeholder', '0');
			time_min.setAttribute('aria-describedby','basic-addon2');

			time_div_tmp = document.createElement('div');
			time_div_tmp.setAttribute('class', 'input-group-append');
			time_span_tmp = document.createElement('span');
			time_span_tmp.setAttribute('class', 'input-group-text');
			time_span_tmp.setAttribute('id', 'basic-addon2');
			string_tmp = document.createTextNode('분');
			time_span_tmp.appendChild(string_tmp);
			time_div_tmp.appendChild(time_span_tmp);

			time_div.appendChild(time_min);
			time_div.appendChild(time_div_tmp);

			/////////////////////////////////////////////////////////////

			/////////////////////////////////////////////////////////////
			time_sec = document.createElement('input');
			time_sec.setAttribute('type', 'text');
			time_sec.setAttribute('class', 'form-control');
			time_sec.setAttribute('name', 'sec' + (stepcount + 1));
			time_sec.setAttribute('value' , '0');
			time_sec.setAttribute('placeholder', '0');
			time_sec.setAttribute('aria-describedby','basic-addon2');

			time_div_tmp = document.createElement('div');
			time_div_tmp.setAttribute('class', 'input-group-append');
			time_span_tmp = document.createElement('span');
			time_span_tmp.setAttribute('class', 'input-group-text');
			time_span_tmp.setAttribute('id', 'basic-addon2');
			string_tmp = document.createTextNode('초');
			time_span_tmp.appendChild(string_tmp);
			time_div_tmp.appendChild(time_span_tmp);

			time_div.appendChild(time_sec);
			time_div.appendChild(time_div_tmp);
			/////////////////////////////////////////////////////////////

			//div 태그안에 입력, 취소태그 넣기
			div = document.createElement('div');
			div.setAttribute('name', div_name);
			div.setAttribute('id', div_name);
			div.appendChild(new_obj);
			div.appendChild(time_div);
			div.appendChild(del_btn);
			div.appendChild(document.createElement('hr'));
			div.appendChild(document.createElement('p'));
			before_obj = document.getElementById("step");
			before_obj.appendChild(div);

			stepcount++;
		}
		function deleteStep(current){
			var tmp_obj = "Step_div" + current;
			var target = document.getElementById(tmp_obj);
			target.remove();
		}
		
	</script>
		
 </body>
 </html>
