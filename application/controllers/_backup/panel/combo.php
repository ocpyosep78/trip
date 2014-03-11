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
		$title = 'name';
		$array = array();
		$label_empty_select = (isset($_POST['label_empty_select'])) ? $_POST['label_empty_select'] : '-';
		
		if ($action == 'category_sub') {
			$array = $this->Category_Sub_model->get_array($_POST);
		} else if ($action == 'city') {
			$array = $this->City_model->get_array($_POST);
		} else if ($action == 'vehicle_type') {
			$array = $this->Vehicle_Type_model->get_array($_POST);
		}
		
		echo ShowOption(array( 'Array' => $array, 'ArrayID' => $id, 'ArrayTitle' => $title, 'LabelEmptySelect' => $label_empty_select ));
		exit;
	}
}                                                