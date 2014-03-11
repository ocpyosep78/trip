<?php

class json extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'advert_type_sub') {
			$_POST['category_sub_id'] = (isset($_POST['category_sub_id'])) ? $_POST['category_sub_id'] : 0;
			$result = $this->Advert_Type_Sub_model->get_array($_POST);
		} else if ($action == 'category_sub') {
			$result = $this->Category_Sub_model->get_array($_POST);
		}
		
		echo json_encode($result);
		exit;
	}
}                                                