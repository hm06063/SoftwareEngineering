<?php
	session_start();
$link = mysqli_connect("localhost", "whalsrl5650", "whalsrl5650!", "whalsrl5650");
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

	$id = $_REQUEST["recipeID"];
	$sql = "select * from whalsrl5650.Recipe where recipeID=$id";

	$result = mysqli_query($link, $sql);

	$row=mysqli_fetch_assoc($result);
	$count=$row['cookTime'];

	$item_nick = $row['nickname'];
  $item_id = $row['userID'];

	$item_title = str_replace(" ", "&nbsp;", $row['title']);

	$item_content = $row['content'];

	$item_date = $row['uploadDate'];
	$item_date = substr($item_date, 0, 10);

	$item_hit = $row['view_count'];
	$new_hit = $item_hit + 1;

	$item_image=$row['Image_copied'];
	$item_image="../data/".$item_image;

	$item_ingredients=$row['ingredients'];

	$item_price=$row['price'];

	$sql1 = "update whalsrl5650.Recipe set view_count=$new_hit where recipeID=$id;"; // 글 조회수 증가
	$result1=mysqli_query($link, $sql1);

	 $sql2="select * from whalsrl5650.Step where recipeID=$id";
	 $result2=mysqli_query($link, $sql2);

	 $row_step=mysqli_fetch_assoc($result2);
	 $count=0;

	$step1 = $row_step['step1'];
	if(!empty($step1)){
		$count++;
	}

	$step2 = $row_step['step2'];
	if(!empty($step2)){
		$count++;
	}

	$step3 = $row_step['step3'];
	if(!empty($step3)){
		$count++;
	}
	


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recipe view</title>
	 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    	 <link href="../css/view.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


	<audio id='audio_play' src='./sound.mp3'></audio>
	<style>
		.starR{
		  background: url('http://miuu227.godohosting.com/images/icon/ico_review.png') no-repeat right 0;
		  background-size: auto 100%;
		  width: 30px;
		  height: 30px;
		  display: inline-block;
		  text-indent: -9999px;
		  cursor: pointer;
		}
		.starR.on{background-position:0 0;}
		
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

<div class="container">
	<div class="col-md-6 col-md-offset-3" >
        <div align = "left">
			<button type="button" class="btn" onclick="delfavor();">즐겨찾기 해제</button>
		</div>
			
		<div class="row">
			<h1 class="text-center"><?php echo $item_title?></h1>
			<p class="text-center"></p>
		</div>
    </div>
	</br>



    <div id="quicknav">
        <ul>
			<?php
			for($step_count=1; $step_count <= $count; $step_count++){?>
				<li><a href="#<?php echo $step_count?>" class="btn btn-primary">step <?php echo $step_count?> </a></li>

			<?php } ?>
        </ul>
    </div>
	<br><br>

	<div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default coupon">
              <div class="panel-heading" id="head">
			  
                <div class="panel-title" id="title">
					
                    <span class="hidden-xs"><?php echo $item_title?></span>
                    <span class="visible-xs"><?php echo $item_title?></span>
                </div>
              </div>
              <div class="panel-body">
				<?php echo "<img src='$item_image' class='coupon-img img-rounded'>";?>
				<div class="col-md-9">
                    <ul class="items">
						<li>가격 : <?php
						if ($item_price==5000){ echo '만원 미만';}
						else if ($item_price ==15000) {echo '만원~ 2만원';}
						else if ($item_price == 25000) {echo '2만원 ~ 3만원';}
						else if ($item_price == 50000) {echo '3만원 이상';}
						?> </li>
                        <li>재료 : <?php echo $item_ingredients ?></li>
                    </ul>
                </div>

                <div class="col-md-12">
                    <p class="disclosure">부가설명 : <?php echo $item_content ?></p>
                </div>
              </div>
              <div class="panel-footer">
                <div class="coupon-code">
                    작성일 : <?php echo $item_date?>
                </div>
                <div>
			작성자 : <?php echo $item_nick?>
		</div>
		
		  
	<?php
		if(isset($_SESSION["ID"])){
	?>
		<!--<div align = "right">
			<p id="star_grade">
				 별점 입력하기 :
				<a href="#">★</a>
				<a href="#">★</a>
				<a href="#">★</a>
				<a href="#">★</a>
				<a href="#">★</a>
			</p>
		</div>-->
		
		<div class="starRev" align ="right">
		  <span class="starR on"></span>
		  <span class="starR"></span>
		  <span class="starR"></span>
		  <span class="starR"></span>
		  <span class="starR"></span>
		  
		</div>
		<?php
		}
	?>

              </div>

            </div>
    	</div>
    </div>

	<?php

	for($start_count=1; $start_count<=$count; $start_count++){
		$word="step";
		$now_step=$word.$start_count;
	?>

	<div class="row" id="<?php echo $start_count?>">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default coupon">
              <div class="panel-heading" id="head">
                <div class="panel-title" id="title" >
                    <span class="hidden-xs">step <?php echo $start_count?></span>
                    <span class="visible-xs">step <?php echo $start_count?></span>
                </div>
              </div>
              <div class="panel-body">
                <div class="col-md-9">
                    <ul class="items">
                        <li><?php echo $$now_step ?></li>
                    </ul>
                </div>
              </div>

            </div>
    	</div>
    </div>
	<?php } ?>

</div>


	<div align="center">
		<strong><h2>Timer</h2></strong><br>
		<span id="countdown"></span>
		<br>
		<div class="wrap"><button class="button" onclick="timer();">시작</button></div>
		<br><br>


	</div>

<?php
		$sql3 = "select cookTime from whalsrl5650.Recipe where recipeid=$id;";

		$result3 = mysqli_query($link, $sql3);          

		$row3=mysqli_fetch_assoc($result3);
		$count=$row3['cookTime'];
		echo "<script>var count = '".$count."';</script>";


?>

<script type="text/javascript">
    var time = 0;
    var count_re=count;
	var count_min=parseInt(count_re/60);
	var count_sec=count_re%60;

	document.getElementById("countdown").innerHTML="<h1><b>" +count_min+"분&nbsp"+count_sec+"초</b></h1>";

	function play() {
		var audio = document.getElementById('audio_play');
		if (audio.paused) {
			audio.play();
		}else{
			audio.pause();
			audio.currentTime = 0
		}
	}

    function timer() {
        clearInterval(time);
        time = setInterval("myTimer()", 1000);

    }

    function myTimer() {
        count_re= count_re - 1;
		count_min=parseInt(count_re/60);
		count_sec=count_re%60;

        document.getElementById("countdown").innerHTML = "<h1><b>" + count_min + "분&nbsp" + count_sec + "초</b></h1>";
        if (count_re == 0) {
            clearInterval(time); // 시간 초기화
            count_re=count;
			count_min=parseInt(count_re/60);
			count_sec=count_re%60;
			play();
        }
    }

	function getIndex(ele){
		var i=0;
		while((ele=ele.previousSiblint)!=null){
			i++;
		}
		return i;
	}
	
	
	//$('#star_grade a').click(function(){
		//$(this).parent().children("a").removeClass("on");  /* 별점의 on 클래스 전부 제거 */
		//$(this).addClass("on").prevAll("a").addClass("on"); /* 클릭한 별과, 그 앞 까지 별점에 on 클래스 추가 */
		/*var idx = $('#star_grade a').index(this)+1;
		
		$.ajax({
			url:"reviewed.php",
			type:"GET",
			data:{'idx':idx,'id':<?php echo $id?>},
			dataType:"json",
		});

		return false;
	});*/
	
	$('.starRev span').click(function(){
	  $(this).parent().children('span').removeClass('on');
	  $(this).addClass('on').prevAll('span').addClass('on');
	  var idx = $(this).index+1;
		
		$.ajax({
			url:"reviewed.php",
			type:"GET",
			data:{'idx':idx,'id':<?php echo $id?>},
			dataType:"json",
		});
	  return false;
	});
	
	function delfavor(){
		$.ajax({
			url:"delfavor.php",
			type:"GET",
			data:{'id':<?php echo $id?>},
			dataType:"json",
		});
	  return false;
	}

</script>

<div class="container">
<div class = "low-button">

   <div align="center">

     <button type="button" onclick="location.href='fav_list.php'" class="btn btn-outline-primary btn-lg">목록으로</button>
     <button class="btn btn-outline-primary btn-lg" type="button" onclick="location.href='modify.php?recipeID=<?=$id?>$item_id=<?=$_SESSION["ID"]?>'">수정</button>
 
 </div>
 </div>
</div>

</body>

</html>
