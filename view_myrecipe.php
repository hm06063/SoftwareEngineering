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
	 $count=$row_step['step_count'];

	$sql_time="select * from whalsrl5650.Timer where recipeID=$id";
	$result_time=mysqli_query($link, $sql_time);

	$row_time=mysqli_fetch_assoc($result_time);



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
						<li>가격 : <?php echo $item_price; ?> </li>
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
                        <li><?php echo $row_step[$now_step];?></li>
                    </ul>
                </div>

				<br><br><br>
				<?php if(empty($row_time[$now_step])==false){?>
				<div align="center">
				<span id=<?php echo $now_step?>>
				<h1><b> <?php echo floor($row_time[$now_step]/60)?>분&nbsp<?php echo ($row_time[$now_step]%60)?>초</b></h1>
				</span>
				<br>
				<div class="wrap"><button class="button" onclick="timer(<?php echo $row_time[$now_step]?>, <?php echo "'".$now_step."'"?>)">시작</button></div>
				<br><br>
				</div>
				<?php } ?>

              </div>

            </div>
    	</div>
    </div>
	<?php } ?>

</div>


<script type="text/javascript">
    var time = 0;
   var count;
	var count_re;
	var pivot;


	function play() {
		var audio = document.getElementById('audio_play');
		if (audio.paused) {
			audio.play();
		}else{
			audio.pause();
			audio.currentTime = 0
		}
	}

   function timer(num,str){
		pivot=str;
		count=num;
		count_re=count;
		var count_min=parseInt(count_re/60);
		var count_sec=count_re%60;
        clearInterval(time);
        time = setInterval("myTimer()", 1000);

    }

    function myTimer() {
        count_re= count_re - 1;
		count_min=parseInt(count_re/60);
		count_sec=count_re%60;

        document.getElementById(pivot).innerHTML = "<h1><b>" + count_min + "분&nbsp" + count_sec + "초</b></h1>";
        if (count_re == 0) {
            clearInterval(time); // 시간 초기화
            count_re=count;
			count_min=parseInt(count_re/60);
			count_sec=count_re%60;
			play();
        }
    }


	function del_myrecp(){
		$.ajax({
			url:"del_myrecp.php",
			type:"GET",
			data:{'id':<?php echo $id?>},
			dataType:"json",
			success:function(output, textstatus){
				console.log(output);
				alert(output);
			},
			error:function(request,status,error){
				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
		history.back();
	}

</script>

<div class="container">
	<div class = "low-button">

	   <div class="col-md-6 col-md-offset-3" >

		 <div align="right">
			 <button type="button" onclick="location.href='mylist.php'" class="btn btn-outline-primary btn-lg" >목록으로</button>
			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <button class="btn btn-outline-primary btn-lg" type="button" onclick="location.href='modify.php?recipeID=<?=$id?>'">수정</button>
			 <button type="button" class="btn btn-outline-primary btn-lg" onclick="del_myrecp();">삭제</button>
		 </div>
	   </div>

	 </div>
</div>

</body>

</html>
