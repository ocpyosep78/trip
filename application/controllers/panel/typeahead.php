<?php
class typeahead extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$action = (!empty($_GET['action'])) ? $_GET['action'] : '';
		unset($_GET['action']);
		
		// user
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
		
		if (empty($_GET['namelike'])) {
			echo json_encode(array());
			exit;
		}
		
		$array = array();
		if ($action == 'auto_complete') {
			$array = $this->auto_complete_model->get_array($_GET);
		} else if ($action == 'facility') {
			$array = $this->facility_model->get_array($_GET);
		} else if ($action == 'member') {
			$array_temp = $this->member_model->get_array($_GET);
			foreach ($array_temp as $row) {
				$array[] = array( 'id' => $row['id'], 'first_name' => $row['first_name'], 'last_name' => $row['last_name'], 'full_name' => $row['full_name'] );
			}
		} else if ($action == 'post') {
			// add member id
			if ($user['user_type_id'] == USER_TYPE_MEMBER) {
				$_GET['member_id'] = $user['id'];
			}
			
			$array_temp = $this->post_model->get_array($_GET);
			foreach ($array_temp as $row) {
				$array[] = array( 'id' => $row['id'], 'title_text' => $row['title_text'] );
			}
		}
		
		echo json_encode($array);
		exit;
	}
}