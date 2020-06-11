<?php session_start();?>

<?php

	require_once("../lib/MYDB.php");
	$connect = db_connect();
	
	if($connect == false){
		echo "연결 실패";
	}
	
	
	$sql="select * from whalsrl5650.Recipe order by score desc limit 0, 4";
    $result = $connect->query($sql);

	$id = array();
	for($i = 0; $i < 4; $i++){
		$id[$i]=$_GET[$i];
	}
	class Item{
		private $item_num;
		private $item_subject;
		private $item_content;
		private $item_image;
		
		public function setInfo($data){
			$this->item_num = $data['recipeID'];
			$this->item_subject = $data['title'];
			$this->item_content = $data['content'];
			$item_image = $data['Image_copied'];
			$this->item_image = "../data/".$item_image;
		}
		public function getSubject(){
			return $this->item_subject;
		}
		
		public function getContent(){
			return $this->item_content;
		}
		
		public function getImage(){
			return $this->item_image;
		}
		public function showImage(){
			echo "<img src='".$this->item_image."' width='100' height='100' class='img-responsive'>";
		}
	}
	$itemList = array();
	$i = 0;
	while($data = $result->fetch(PDO::FETCH_ASSOC)){
		$newItem = new Item();
		$newItem->setInfo($data);
		$itemList[$i] = $newItem;
		$i++;
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="//unpkg.com/bootstrap@4/dist/css/bootstrap.min.css">
<meta charset="utf-8">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<title>Slide</title>
<style>
  *{margin:0;padding:0;}
  ul,li{list-style:none;}
  .slide{height:150px;overflow:hidden;}
  .slide ul{height:100%;}
  .slide li{height:100%;}
  .slide li:nth-child(1){background:#faa;}
  .slide li:nth-child(2){background:#afa;}
  .slide li:nth-child(3){background:#aaf;}
  .slide li:nth-child(4){background:#faf;}
</style>
<script>
const all = ele => document.querySelectorAll(ele)
const one = ele => document.querySelector(ele)
const slide = _ => {
  const wrap = one('.slide') // .slide 선택
  const target = wrap.children[0] // .slide ul 선택
  const len = target.children.length // .slide li 갯수
  // .slide ul의 너비 조정
  target.style.cssText = `width:calc(100% * ${len});display:flex;transition:1s`
  // .slide li의 너비 조정
  Array.from(target.children).forEach(ele => ele.style.cssText = `width:calc(100% / ${len});`)
  // 화면 전환 실행
  let pos = 0
  setInterval(() => {
    pos = (pos + 1) % len // 장면 선택
    target.style.marginLeft = `${-pos * 100}%`
  }, 2500) // 1500 = 1500ms = 1.5sec. 즉, 1.5초 마다 실행
}
window.onload = function () {
  slide()
}
</script>
</head>
<body>
	 <label>이런 음식은 어떤가요?</label>
<div class="slide">
  <ul>
    <li>
    	<div>
    	<span>
    		<?php $itemList[0]->showImage();?>
    	</span>
    	<div>
    		<p><?php echo $itemList[0]->getSubject(); ?></p>
    		<p><?php echo $itemList[0]->getContent();?></p>   		
    	</div>
    	</div>
    	
    </li>
    <li>
    	<div>
    	<span>
    		<?php $itemList[1]->showImage();?>
    	</span>
    	<div>
    		<p><?php echo $itemList[1]->getSubject();?></p>
    		<p><?php echo $itemList[1]->getContent();?></p>  
   		
    	</div>
    	</div>
    	
    </li>
    <li>
    	<div>
    	<span>
    		<?php $itemList[2]->showImage();?>
    	</span>
    	<div>
    		<p><?php echo $itemList[2]->getSubject();?></p>
    		<p><?php echo $itemList[2]->getContent();?></p>  
    		
    	</div>
    	</div>
    	
    </li>
    <li>
    	<div>
    	<span>
    		<?php $itemList[3]->showImage();?>
    	</span>
    	<div>
    		<p><?php echo $itemList[3]->getSubject();?></p>
    		<p><?php echo $itemList[3]->getContent();?></p>  
    		
    	</div>
    	</div>
    </li>
  </ul>
</div>
</body>
</html>