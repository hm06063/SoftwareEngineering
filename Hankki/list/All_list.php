<?php session_start();?> 
<?php
        require_once("../lib/MYDB.php");
        $pdo = db_connect();
       if(isset($_REQUEST["page"])) 
        $page=$_REQUEST["page"];
        else
        $page=1;
        $scale = 5; // 한 페이지에 보여질 게시글 수
        $page_scale = 3; 
       $first_num = ($page-1) * $scale; 
       $sql="select * from whalsrl5650.Recipe order by recipeID desc limit $first_num, $scale";

        $result = $pdo->query($sql);
        $sql = "select * from whalsrl5650.Recipe"; 
        $result2 = $pdo->query($sql);
        $total_row = $result2->rowCount(); 
        $total_page = ceil($total_row / $scale); 
        $current_page = ceil($page/$page_scale); 
 ?>

