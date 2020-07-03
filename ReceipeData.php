<?php
class ReceipeData {
	private $title;
	private $step = array();
	//array data
	private $step_timer = array();
	//array data
	private $step_count;
	private $img_dir;

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
		$this -> img_dir = $img_dir;
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

}
?>