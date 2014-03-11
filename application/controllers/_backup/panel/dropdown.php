<?php

class dropdown extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		$select_class = 'select-'.preg_replace('/_/i', '-', $action);
		
		if ($action == 'category_sub') {
			$display_value = 'name';
			$array = $this->Category_Sub_model->get_array($_POST);
		} else if ($action == 'advert_type_sub') {
			$display_value = 'advert_type_name';
			$array = $this->Advert_Type_Sub_model->get_array($_POST);
		}
		
		$result = '';
		foreach ($array as $row) {
			$result .= '<li><a class="cursor '.$select_class.'" data-row=\''.json_encode($row).'\'>'.$row[$display_value].'</a></li>';
		}
		
		echo $result;
		exit;
	}
}