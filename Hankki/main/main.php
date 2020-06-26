
<?php
    if(!isset($_SESSION["ID"]))
	{
        include "logoutMain_view.php";            
	}
	else
	{
           include "loginMain_view.php"; 
	}
     
?>

<?php
require_once ("./lib/MYDB.php");
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
		} else if ($flag == 1) {
			//data-setbg는 왜 안 되는것이징
			//echo "<div class='blog__item__pic set-bg' data-setbg='" . $this -> item_image . "'></div>";
			echo "<img src='" . $this->item_image."' class='rounded float-left' alt='...'>";
		}		
		else {
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

<?php include "recommendationInMain_view.php"?>
  
  
