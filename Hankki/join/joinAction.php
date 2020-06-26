 <?php

$ID = $_REQUEST["ID"];
 $PASSWORD = $_REQUEST["PASSWORD"];
 $NICKNAME = $_REQUEST["NICKNAME"]; 
 $EMAIL = $_REQUEST["EMAIL"];



 require_once("../lib/MYDB.php");

 $pdo = db_connect();
 
 try{

$pdo->beginTransaction();
$sql = "insert into whalsrl5650.member VALUES(?, ?, ?, ?, now())";
 $stmh = $pdo->prepare($sql);
 $stmh->bindValue(1, $ID, PDO::PARAM_STR); 
 $stmh->bindValue(2, $PASSWORD, PDO::PARAM_STR);
$stmh->bindValue(3, $NICKNAME, PDO::PARAM_STR);
 $stmh->bindValue(4, $EMAIL, PDO::PARAM_STR);
 $stmh->execute();
 $pdo->commit();

print "<script language=javascript> alert('한끼뚝딱에 오신것을 환영합니다!'); location.replace('http://whalsrl5650.cafe24.com/index.php'); </script>";
 

 } catch (PDOException $Exception) {
 $pdo->rollBack();
 print "오류: ".$Exception->getMessage();
 }
 ?>