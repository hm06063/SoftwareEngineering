<?php session_start(); ?>

<?php

require_once ("../lib/MYDB.php");
$connect = db_connect();

if ($connect == false) {
	echo "연결 실패";
}

$sql = "select * from whalsrl5650.Recipe order by score desc limit 0, 4";
$result = $connect -> query($sql);

$id = array();
for ($i = 0; $i < 4; $i++) {
	$id[$i] = $_GET[$i];
}
class Item {
	private $item_num;
	private $item_subject;
	private $item_content;
	private $item_image;

	public function setInfo($data) {
		$this -> item_num = $data['recipeID'];
		$this -> item_subject = $data['title'];
		$this -> item_content = $data['content'];
		$item_image = $data['Image_copied'];
		if($item_image === ""){
			$this -> item_image = "../data/sample.jpg";
		}
		else{
		$this -> item_image = "../data/" . $item_image;
		}
	}

	public function getSubject() {
		return $this -> item_subject;
	}

	public function getContent() {
		return $this -> item_content;
	}

	public function getImage() {
		return $this -> item_image;
	}

	public function showImage($flag) {
		if ($flag == 0) {
			echo "<img class='food_thumbnail' src='" . $this -> item_image . "' alt='...' >";
		} else {
			echo "<img class='card-img-top' src='" . $this -> item_image . "' width='100' height='100' class='img-responsive' alt='Card image cap'>";

		}
	}

	public function getLink() {
		return "../view/view_data.php?recipeID=" . $this -> item_num;
	}

}

$itemList = array();
$i = 0;
while ($data = $result -> fetch(PDO::FETCH_ASSOC)) {
	$newItem = new Item();
	$newItem -> setInfo($data);
	$itemList[$i] = $newItem;
	$i++;
}
?>

<html>
	<head>
		<meta charset="UTF-8">
	</head>

	<style>
		.box {
			width: 150px;
			height: 150px;
			border-radius: 70%;
			overflow: hidden;
		}
		.food_thumbnail {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		.carousel-control.left, .carousel-control.right {
			background-image: none !important;
			filter: none !important;
		}
		.carousel-caption h3, p {
			color: black !important;
		}
		.carousel-indicators li {
			display: inline-block;
			text-indent: 0;
			cursor: pointer;
			border: none;
			border-radius: 50%;
			background-color: #0000ff;
			box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.5);
		}
		.carousel-indicators .active {
			background-color: #f00;
		}
	</style>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script>
		$('.carousel').carousel({ interval: 2000 });
	</script>
	<body>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h3>이런 음식은 어떤가요?</h3>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						<li data-target="#carousel-example-generic" data-slide-to="3"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							
								<div class="coupon" style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[0] -> getLink(); ?>'">
								<div class="box">
									<?php $itemList[0] -> showImage(0); ?>
								</div>
								<div class="carousel-caption">
									<h3><?php echo $itemList[0] -> getSubject(); ?></h3>
									<p><?php echo $itemList[0] -> getContent(); ?></p>
								</div>
							</div>
							
						</div>
						<div class="item">
							<div class="coupon" style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[1] -> getLink(); ?>'">
								<div class="box">
									<?php $itemList[1] -> showImage(0); ?>
								</div>
								<div class="carousel-caption">
									<h3><?php echo $itemList[1] -> getSubject(); ?></h3>
									<p><?php echo $itemList[1] -> getContent(); ?></p>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="coupon" style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[2] -> getLink(); ?>'">
								<div class="box">
									<?php $itemList[2] -> showImage(0); ?>
								</div>
								<div class="carousel-caption">
									<h3><?php echo $itemList[2] -> getSubject(); ?></h3>
									<p><?php echo $itemList[2] -> getContent(); ?></p>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="coupon" style="cursor:pointer" onclick="window.location.href='<?php echo $itemList[3] -> getLink(); ?>'">
								<div class="box">
									<?php $itemList[3] -> showImage(0); ?>
								</div>
								<div class="carousel-caption">
									<h3><?php echo $itemList[3] -> getSubject(); ?></h3>
									<p><?php echo $itemList[3] -> getContent(); ?></p>
								</div>
							</div>
						</div>
						
					</div>

					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> <span class="sr-only">Previous</span> </a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> <span class="sr-only">Next</span> </a>
				</div>
			</div>
		</div>
	
	</body>
</html>