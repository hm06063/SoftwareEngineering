<?php
require_once ("../lib/MYDB.php");
include "ReceipeData.php";

class ReceipeDAO {
	private $connect;

	function __construct() {
		$this -> connect = db_connect();
		//MYDB에 db연결 메서드만 정의 해 놨음.
		if ($this -> connect == false) {
			die("서버와의 연결 실패! : " . mysqli_connect_error());
		}
	}

	public function writeReceipeInfo($title, $content, $price, $files, $ingredients, $type) {
		//$레시피의 전체적인 데이터(음식이름, 간단한 설명, 가격, 파일이름, 성분 및 재료, 전체적인 소요시간, 음식 종류)를 DB에 저장
		//$step이랑 $step_count는 배열 데이터

		$upload_dir = '../data/';

		$upfile_name = $files["name"];
		$upfile_tmp_name = $files["tmp_name"];
		$upfile_type = $files["type"];
		$upfile_size = $files["size"];
		$upfile_error = $files["error"];
		$file = explode(".", $upfile_name);
		$file_name = $file[0];
		$file_ext = $file[1];

		if (!$upfile_error) {
			$new_file_name = date("Y_m_d_H_i_s");

			$copied_file_name = $new_file_name . "." . $file_ext;
			$uploaded_file = $upload_dir . $copied_file_name;
			if ($upfile_size > 5000000) {
				print("<script>alert('업로드 파일 크기가 지정된 용량(5MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');history.back();</script>");
				exit ;
			}

			if (($upfile_type != "image/gif") && ($upfile_type != "image/jpeg") && ($upfile_type != "image/png")) {
				print(" <script>alert('JPG/ GIF/PNG 형식의 이미지 파일만 업로드 가능합니다!'); history.back(); </script>");
				exit ;
			}

			if (!move_uploaded_file($upfile_tmp_name, $uploaded_file)) {
				$script_string = "<script>alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다." . $uploaded_file . "');";
				print($script_string . "history.back();</script>");
				exit ;
			}
		}

		try {
			$sql = "insert into whalsrl5650.Recipe(userID,nickname,title,price,content,uploadDate,reviewNum,";
			$sql .= "Image, Image_copied,type,ingredients)";
			$sql .= "values(?, ?, ?, ?,?, now(), 0,?,?,?,?)";
			$stmh = $this -> connect -> prepare($sql);
			$stmh -> bindValue(1, $_SESSION["ID"], PDO::PARAM_STR);
			$stmh -> bindValue(2, $_SESSION["NICKNAME"], PDO::PARAM_STR);
			$stmh -> bindValue(3, $title, PDO::PARAM_STR);
			$stmh -> bindValue(4, $price, PDO::PARAM_STR);
			$stmh -> bindValue(5, $content, PDO::PARAM_STR);
			$stmh -> bindValue(6, $upfile_name, PDO::PARAM_STR);
			$stmh -> bindValue(7, $copied_file_name, PDO::PARAM_STR);
			$stmh -> bindValue(8, $type, PDO::PARAM_STR);
			$stmh -> bindValue(9, $ingredients, PDO::PARAM_STR);
			$this -> connect -> beginTransaction();
			$stmh -> execute();
			$this -> connect -> commit();

			//header("Location:http://whalsrl5650.cafe24.com/list/All_list_view.php");
		} catch(PDOException $Exception) {
			$this -> connect -> rollBack();
			print "오류 : " . $Exception -> getMessage();
		}

	}

	public function writeReceipeDetail($step, $step_count, $title) {
		$SQL = "select recipeID from whalsrl5650.Recipe where userID=? and title=? ";
		$stmh = $this -> connect -> prepare($SQL);
		$stmh -> bindValue(1, $_SESSION["ID"]);
		$stmh -> bindValue(2, $title);
		$stmh -> execute();
		$row = $stmh -> fetch(PDO::FETCH_ASSOC);
		$recipeID = $row['recipeID'];

		print_r($row);
		echo $recipeID;

		$SQL = "insert into whalsrl5650.Step(recipeID) values(?)";
		$stmh = $this -> connect -> prepare($SQL);
		$stmh -> bindValue(1, $recipeID);

		try {
			$this -> connect -> beginTransaction();
			$stmh -> execute();
			$this -> connect -> commit();
		} catch(PDOException $e) {
			$this -> connect -> rollback();
			echo $e -> getMessage();
		}

		$SQL = "insert into whalsrl5650.Timer(recipeID) values(?)";
		$stmh = $this -> connect -> prepare($SQL);
		$stmh -> bindValue(1, $recipeID);

		try {
			$this -> connect -> beginTransaction();
			$stmh -> execute();
			$this -> connect -> commit();
		} catch(PDOException $e) {
			$this -> connect -> rollback();
			echo $e -> getMessage();
		}

		$SQL = "update whalsrl5650.Step set step_count = ? where recipeID = ? ";
		$stmh = $this -> connect -> prepare($SQL);
		$stmh -> bindValue(1, count($step));
		$stmh -> bindValue(2, $recipeID);

		try {
			$this -> connect -> beginTransaction();
			$stmh -> execute();
			$this -> connect -> commit();
		} catch(PDOException $e) {
			$this -> connect -> rollback();
			echo $e -> getMessage();
		}

		for ($i = 1; $i <= count($step); $i++) {
			$string = $step[$i];
			$timer = $step_count[$i];

			$SQL1 = "update whalsrl5650.Step set step" . $i . " = ?" . " where recipeID = ?";
			$stmh1 = $this -> connect -> prepare($SQL1);
			$stmh1 -> bindValue(1, $string);
			$stmh1 -> bindValue(2, $recipeID);

			$SQL2 = "update whalsrl5650.Timer set step" . $i . " = ? " . " where recipeID = ?";
			$stmh2 = $this -> connect -> prepare($SQL2);
			$stmh2 -> bindValue(1, $timer);
			$stmh2 -> bindValue(2, $recipeID);

			try {
				$this -> connect -> beginTransaction();
				$stmh1 -> execute();
				$stmh2 -> execute();
				$this -> connect -> commit();
			} catch(PDOException $e) {
				$this -> connect -> rollback();
				echo $e -> getMessage();
			}
		}
		return $recipeID;

	}

	public function readData($id){
		$SQL = "select * from whalsrl5650.Recipe where recipeID = ?";
		$stmh = $this -> connect -> prepare($SQL);
		$stmh -> bindValue(1, $id);
		$stmh -> execute();
		
		$row = $stmh -> fetch(PDO::FETCH_ASSOC);
		
		$ReceipeData = new ReceipeData();
		$ReceipeData->setUserid($row['userID']); 
		$ReceipeData->setTitle(str_replace(" ", "&nbsp;", $row['title']));
		$ReceipeData->setContent($row['content']);
		$ReceipeData->setDate(substr($row['uploadDate'],0,10));
		$ReceipeData->setHit($row['view_count']);
		$ReceipeData->setImg_dir($row['Image_copied']);
		$ReceipeData->setIngredients($row['ingredients']);
		$ReceipeData->setPrice($row['price']);
		
		$SQL = "select * from whalsrl5650.Step where recipeID = ? ";
		$stmh = $this->connect->prepare($SQL);
		$stmh -> bindValue(1, $id);
		$stmh -> execute();		
		$row = $stmh -> fetch(PDO::FETCH_ASSOC);
		
		$ReceipeData->setStep($row);
		$ReceipeData->setCount($row['step_count']);
		
		$SQL = "select * from whalsrl5650.Timer where recipeID = ?";
		$stmh = $this->connect->prepare($SQL);
		$stmh->bindValue(1, $id);
		$stmh -> execute();
		$row = $stmh-> fetch(PDO::FETCH_ASSOC);
		
		$ReceipeData->setStep_timer($row);
		
		/************************************************
		 * 조회수 증가 처리 필요
		 ************************************************/
	
		return $ReceipeData;
	}

	public function db_disconnect() {
		$this -> connect = null;
	}

}
?>
