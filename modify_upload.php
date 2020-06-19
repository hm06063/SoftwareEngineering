<?php
session_start();

$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650") or die("connect fail");

$id=$_REQUEST["recipeID"];
$subject=$_REQUEST["TITLE"];
$content=$_REQUEST["CONTENT"];
$price=$_REQUEST["price"];

$type=$_REQUEST["type"];
$ingredients=$_REQUEST["ingredients"];

$file_sql = "SELECT * FROM whalsrl5650.Recipe WHERE recipeID=$id";
$file_result = mysqli_query($link, $file_sql);
$file_row = mysqli_fetch_array($file_result);


if($_FILES['upfile']['name'] != "" )	{  // 새로운 첨부파일 있을 때

  if(!empty($_POST['chk_delete']) && !empty($_POST['old_file']))  // 삭제 체크 된 경우
  unlink($file_row[Image_copied]);  // 첨부파일 삭제

  //////////////////////파일 업로드 처리////////////////////////////
  $max_file_size  = 5000000;
  $uploaddir = '../data/';

  // 중복되지 않는 파일로 만듦
  $filename = $uploaddir.date("Y_m_d_H_i_s")."_".$_FILES['upfile']['name'];

  //파일 확장자 확인
  $chk_file = explode(".", $_FILES['upfile']['name']);
  $extension = $chk_file[sizeof($chk_file)-1];

  if( ($extension!= "image/gif") && ($extension!= "image/jpeg")&&($extension!= "image/png")) {
    $errmsg = $_FILES['upfile']['name']." JPG/ GIF/PNG 형식의 이미지 파일만 업로드 가능합니다!";
    exit;
  }

  //파일용량 확인
  if($_FILES['upfile']['size'] > $max_file_size) {
    $errmsg = $_FILES['upfile']['name']." 업로드 파일 크기가 지정된 용량(5MB)을 초과합니다!<br>파일 크기를 체크해주세요!";
    exit;
  }

  move_uploaded_file($_FILES['upfile']['tmp_name'],$filename);
  // chmod("$filename",0707); // 파일에 권한 설정

  if (!move_uploaded_file($_FILES['upfile']['tmp_name'],$filename) )
{
 print("<script>alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');history.back();</script>");
 exit;
}

	if($errmsg == "") {
    $query = "UPDATE whalsrl5650.Recipe SET title='$subject', price='$price', content='$content' WHERE recipeID = $id";
    $rlt = mysqli_query($link,$query) or die("rlt fail");

    $query2 = "UPDATE whalsrl5650.Recipe SET type='$type', ingredients='$ingredients' WHERE recipeID = $id";
    $rlt2 = mysqli_query($link,$query2) or die("rlt2 fail");

    $query3 = "UPDATE whalsrl5650.Recipe SET Image_copied='$filename' WHERE recipeID = $id";
    $rlt3 = mysqli_query($link,$query3) or die("rlt3 fail");

    echo "<script language=\"JavaScript\">
  	        alert(\"글을 수정했습니다.\");
              document.location.replace(\"view_myrecipe.php?recipeID=".$id."\");
            /script>";
          }
    else {
      echo "<script language=\"JavaScript\">
         	        alert(\"$errmsg\");
                  document.location.replace(\"view_myrecipe.php?recipeID=".$id."\");
                  </script>";
         		}
  }


  elseif(empty($_POST['chk_delete'])) { // 기존 첨부파일 그대로 올릴 경우
      $query = "UPDATE whalsrl5650.Recipe SET title='$subject', price='$price', content='$content' WHERE recipeID = $id";
      $rlt = mysqli_query($link,$query) or die("rlt fail");

      $query2 = "UPDATE whalsrl5650.Recipe SET type='$type', ingredients='$ingredients' WHERE recipeID = $id";
      $rlt2 = mysqli_query($link,$query2) or die("rlt2 fail");

      echo "<script language=\"JavaScript\">
            alert(\"글을 수정했습니다.\");
              document.location.replace(\"view_myrecipe.php?recipeID=".$id."\");
            /script>";
  }



  elseif(!empty($_POST['chk_delete'])) { // 새로운 첨부파일없이 삭제만 할 경우
    echo "<script language=\"JavaScript\">
                alert(\"대표사진을 등록해주세요.\");
                document.location.replace(\"view_myrecipe.php?recipeID=".$id."\");
                </script>";
          }

  else {
    echo "<script language=\"JavaScript\">
                alert(\"fail.\");
                document.location.replace(\"view_myrecipe.php?recipeID=".$id."\");
                </script>";
  }


?>




<HTML>
<head>
</head>
<body>
	<?php

	/***********************************************************************************
	 * 주의) 모든 배열 데이터의 index는 1부터 시작하도록 해놨습니다.
	 *
	 ***********************************************************************************/
		class Receipe{
			private $TITLE;
			private $step;//array data
			private $step_timer;//array data
			private $step_count;
			private $consumed_time;

			public function Receipe(){

			}

			public function setInfo(){

				//각 레시피 단계에 해당하는 문자열을 배열로 저장
				$this->step = array();
				$i = 1;
				$real_index = 1;
				while($i < 11){
					$step_id = "Step".$i;

					if(isset($_POST[$step_id]) && $_POST[$step_id] == true){
						$this->step[$real_index] = $_POST[$step_id];
						$real_index++;
					}
					$i++;
				}
				//총 몇단계 레시피 인지
				$this->step_count = count($this->step);


			}

			public function setTimeInfo(){
				$this->step_timer = array();
				$this->step_timer[1] = 0;//php는 배열 원소에 스칼라 값을 넣을려면 먼저 이렇게 스칼라값으로 초기화 해야만 합니다 아니면 {Warning: Cannot use a scalar value as an array} 발생
				$i = 1;
				$real_index = 1;
				while($i < 11){

					$name = "hour".$i;

					if(isset($_POST[$name]) && $_POST[$name] == true){
						$tmp = ((int)($_POST[$name]))*60*60;
					}
					else{
						$tmp = 0;
					}


					$name = "min".$i;
					if(isset($_POST[$name]) && $_POST[$name] == true){
						$tmp += ((int)($_POST[$name]))*60;
					}
					else{
						$tmp += 0;
					}


					$name = "sec".$i;
					if(isset($_POST[$name]) && $_POST[$name] == true){
						$tmp += ((int)($_POST[$name]));
					}
					else{
						$tmp += 0;
					}
					$this->step_timer[$real_index] = $tmp;
					$real_index++;
					$i++;
				}
			}

			public function showInfo(){
				//값이 제대로 들어갔는지 확인해주는 함수임
				//개발자모드에서 확인만 하는 용도로 나중에 프로젝트 제출때는 호출 ㄴㄴ

				for($i = 1; $i <= count($this->step); $i++){
					echo "단계".$i.": ".$this->step[$i]."<br>";
					echo $this->step_timer[$i]."초 소요"."<br>";
				}

			}

			public function insert()
			{
					//여기서 부터는 db에 연결하고 데이터 저장
				$servername = "localhost";
				$user="whalsrl5650";
				$password = "whalsrl5650!";
				$dbname = "whalsrl5650";

				$connect = mysqli_connect($servername, $user, $password, $dbname);
				if($connect==false){
					 die("서버와의 연결 실패! : ".mysqli_connect_error());
				}
				//echo "서버와의 연결 성공<br>";


				$recipe_name = $_REQUEST["TITLE"];
				//echo $recipe_name;

				$sql5 = "select recipeID from whalsrl5650.Recipe where userID='".$_SESSION["ID"]."' and title='".$recipe_name."';";
				$result5 = mysqli_query($connect,$sql5);
				$row=mysqli_fetch_assoc($result5);
				$recipeID=$row['recipeID'];

				$sql1 = "INSERT INTO whalsrl5650.Step(recipeID) VALUES(".$recipeID.");";
				$result1 = mysqli_query($connect,$sql1);

				$sql2 = "INSERT INTO whalsrl5650.Timer(recipeID) VALUES(".$recipeID.");";
				$result2 = mysqli_query($connect,$sql2);

				$sql_c="UPDATE whalsrl5650.Step SET step_count=".count($this->step)." where recipeID=".$recipeID.";";
				$result_c=mysqli_query($connect, $sql_c);
				for($i = 1; $i <= count($this->step); $i++){
					$string = $this->step[$i];
					$time = $this->step_timer[$i];

					$sql3 = "UPDATE whalsrl5650.Step SET step".$i." = '".$string."' where recipeID=".$recipeID.";";
					$result3 = mysqli_query($connect,$sql3);
					//echo $sql3;

					$sql4 = "UPDATE whalsrl5650.Timer SET step".$i." = ".$time." where recipeID=".$recipeID.";";
					$result4 = mysqli_query($connect,$sql4);

					if(($result3==false)||($result4==false)){
							die(mysqli_error($connect));
					}

							//echo "단계".$i.": ".$this->step[$i]."<br>";
							//echo $this->step_timer[$i]."초 소요"."<br>";
				}
			}

		}

		$newReceipe = new Receipe();
		$newReceipe->setInfo();
		$newReceipe->setTimeinfo();
		//$newReceipe->showInfo();

		$newReceipe->insert();

    	mysqli_close($connect);
		//db연결 종료


		//�����̷��� �ϱ����� db�� �����ϴ� ���� session �̵� �ʿ�
		//Header("Location:./writing_form.php");
		//Header("Location:./receipe_view.php");
		//���߿� ������ �� ����Ʈ�� �̵��ϵ��� �ؾ���

	?>


 </body>
</HTML>
