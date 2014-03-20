<?php

class combo extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// default id & name
		$id = 'id';
		$title = 'title';
		$array = array();
		$label_empty_select = (isset($_POST['label_empty_select'])) ? $_POST['label_empty_select'] : '-';
		
		if ($action == 'category_sub') {
			$array = $this->category_sub_model->get_array($_POST);
		} else if ($action == 'city') {
			$array = $this->city_model->get_array($_POST);
		} else if ($action == 'region') {
			$array = $this->region_model->get_array($_POST);
		}
		
		echo ShowOption(array( 'Array' => $array, 'ArrayID' => $id, 'ArrayTitle' => $title, 'LabelEmptySelect' => $label_empty_select ));
		exit;
	}
}                                                