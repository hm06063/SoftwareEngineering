<?php include "list.php"?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width", initial-scale=1">
		
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Css Styles -->
	           <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
           
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
	
	<body>
		<?php include "../lib/top_menu_1.php"; ?>
		<div class="text-center">
				<h3>전체게시판</h3><br>
		</div>
		<hr>
		
		<div class="container">
			<div>					
				<table class="table table-striped">
				<thead>
					<th></th>
					<th>레시피이름</th>
					<th>작성자</th>
					<th>점수</th>
					<th>작성날짜</th>
					<th>조회수</th>		
				</thead>
				<?php while($data = $result->fetch(PDO::FETCH_ASSOC)){?>
					<tr>
						<?php
                                                    $item_type=$data["type"];
                                                    if($item_type !="분식")
                                                        continue;
						$item_num=$data['recipeID'];
						$item_subject=$data['title'];
						$item_image=$data['Image_copied'];
						$item_image="../data/".$item_image;					
						$item_date=$data['uploadDate'];
						$item_date=substr($item_date, 0, 10);

						$item_id=$data['userID'];
						$item_score=$data['score'];
						$item_hit=$data['view_count'];
						?>
						
						<td><a href="../view/view_data.php?recipeID=<?=$item_num?>"><?php echo "<img src='$item_image' width='250' height='250' class='img-responsive'>";?></a></td>
						<td><a href="../view/view_data.php?recipeID=<?=$item_num?>"><?= $item_subject?></a></td>
						<td><?= $item_id?></td>
						<td><?= $item_score?></td>
						<td><?= $item_date?></td>
						<td><?= $item_hit?></td>
					</tr>			   
				<?php } ?>
				</table>
					</tbody>
				</table>
					
					
			</div>
		</div>
		
	<div class="container">
		<div class="float-right">
			<button type="button" onclick="location.href='list.php'" class="btn btn-outline-primary btn-lg">목록</button>
      
	<?php
		if(isset($_SESSION["ID"])){
	?>
			<button type="button" onclick="location.href='write.php'" class="btn btn-outline-success btn-lg">글쓰기</button>
		</div>
    </div>
	<?php
	}
	?>
	
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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

	</body>
</html>
