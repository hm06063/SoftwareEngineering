<?php session_start(); ?>

 <meta charset="utf-8">

 <?php
 if(!isset($_SESSION["ID"])) { //버그처리
 ?>
 <script>
 alert('로그인 후 이용해 주세요.');
history.back();
</script>


 <?php
 }

 $subject=$_REQUEST["TITLE"];
$content=$_REQUEST["CONTENT"];
$price=$_REQUEST["price"];
$files = $_FILES["upfile"]; //첨부파일

$type=$_REQUEST["type"];
$ingredients=$_REQUEST["ingredients"];

 $upload_dir ='../data/'; 

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
          
           $copied_file_name = $new_file_name.".".$file_ext;
           $uploaded_file = $upload_dir.$copied_file_name;
           if( $upfile_size > 5000000 ) {
           print("<script>alert('업로드 파일 크기가 지정된 용량(5MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');history.back();</script>");
           exit;}


           if ( ($upfile_type!= "image/gif") && ($upfile_type!= "image/jpeg")&&($upfile_type!= "image/png"))
           {
           print(" <script>alert('JPG/ GIF/PNG 형식의 이미지 파일만 업로드 가능합니다!'); history.back(); </script>");
           exit;
           }

           if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
            {
            print("<script>alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');history.back();</script>");
               
               
            exit;
            }
           }
 
require_once("../lib/MYDB.php");
 $pdo = db_connect();
 
 
 
try{
 $pdo->beginTransaction();
 $sql = "insert into whalsrl5650.Recipe(userID,nickname,title,price,content,uploadDate,reviewNum,";
 $sql .= "Image, Image_copied,type,ingredients)"; 
 $sql .= "values(?, ?, ?, ?,?, now(), 0,?,?,?,?)"; 
$stmh = $pdo->prepare($sql);
 $stmh->bindValue(1, $_SESSION["ID"], PDO::PARAM_STR);
 $stmh->bindValue(2, $_SESSION["NICKNAME"], PDO::PARAM_STR);
 $stmh->bindValue(3, $subject, PDO::PARAM_STR);
 $stmh->bindValue(4, $price, PDO::PARAM_STR);//
 $stmh->bindValue(5, $content, PDO::PARAM_STR);//
 $stmh->bindValue(6, $upfile_name, PDO::PARAM_STR);
 $stmh->bindValue(7, $copied_file_name, PDO::PARAM_STR);
 $stmh->bindValue(8, $type, PDO::PARAM_STR);
 $stmh->bindValue(9, $ingredients, PDO::PARAM_STR);
 $stmh->execute();
 $pdo->commit();
 header("Location:http://whalsrl5650.cafe24.com/list/All_list.php");
 } catch (PDOException $Exception) {
 $pdo->rollBack();
 print "오류: ".$Exception->getMessage();
 }
 
 ?>
