<?php
class ReceipeData {
	private $userid;
	private $title;
	private $content;
	private $ingredients;
	private $price;
	private $step = array();
	//array data
	private $step_timer = array();
	//array data
	private $count;
	private $step_count;
	private $date;
	private $img_dir;
	private $hit;

	public function setUserid($userid) {
		$this -> userid = $userid;
	}

	public function setTitle($title) {
		$this -> title = $title;
	}

	public function setStep($step) {
		$this -> step = $step;
	}

	public function setStep_timer($step_timer) {
		$this -> step_timer = $step_timer;
	}

	public function setStep_count($step_count) {
		$this -> step_count = $step_count;
	}

	public function setImg_dir($img_dir) {
		$this -> img_dir = "../data/" . $img_dir;
	}

	public function setDate($date) {
		$this -> date = $date;
	}

	public function setContent($content) {
		$this -> content = $content;
	}

	public function setHit($hit) {
		$this -> hit = $hit;
	}

	public function setIngredients($ingredients) {
		$this -> ingredients = $ingredients;
	}

	public function setPrice($price) {
		$this -> price = $price;
	}

	public function setCount($count) {
		$this -> count = $count;
	}

	public function getUserid() {
		return $this -> userid;
	}

	public function getTitle() {
		return $this -> title;
	}

	public function getStep() {
		return $this -> step;
	}

	public function getStep_timer() {
		return $this -> step_timer;
	}

	public function getStep_count() {
		return $this -> step_count;
	}

	public function getImg_dir() {
		return $this -> img_dir;
	}

	public function getDate() {
		return $this -> date;
	}

	public function getContent() {
		return $this -> content;
	}

	public function getHit() {
		return $this -> hit;
	}

	public function getIngredients() {
		return $this -> ingredients;
	}

	public function getPrice() {
		return $this -> price;
	}

	public function getCount() {
		return $this -> count;
	}

}
?>