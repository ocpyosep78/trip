<?php
class typeahead extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$action = (!empty($_GET['action'])) ? $_GET['action'] : '';
		unset($_GET['action']);
		
		if (empty($_GET['namelike'])) {
			echo json_encode(array());
			exit;
		}
		
		$array = array();
		if ($action == 'auto_complete') {
			$array = $this->auto_complete_model->get_array($_GET);
		} else if ($action == 'facility') {
			$array = $this->facility_model->get_array($_GET);
		} else if ($action == 'post') {
			$array_temp = $this->post_model->get_array($_GET);
			foreach ($array_temp as $row) {
				$array[] = array( 'id' => $row['id'], 'title_text' => $row['title_text'] );
			}
		}
		
		echo json_encode($array);
		exit;
	}
}