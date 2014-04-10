<?php

class home extends TRIP_Controller {
	function __construct() {
		parent::__construct();
	}
	
	function index() {
		$is_login = $this->user_model->is_login();
		if ($is_login) {
			$this->load->view( 'panel/home');
		} else {
			$this->load->view( 'panel/login');
		}
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'login') {
			// editor
			$result = $this->user_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
			
			// member
			if (! $result['status']) {
				$result = $this->member_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
			}
			
			// traveler
			if (! $result['status']) {
				$result = $this->traveler_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
			}
		} else if ($action == 'get_notify' && $this->user_model->is_login()) {
			$user = $this->user_model->get_session();
			$result['count'] = $this->User_Contact_model->get_unread_count(array( 'user_id' => $user['id'] ));
			$result['array_user_contact'] = $this->User_Contact_model->get_array(array( 'user_id' => $user['id'], 'is_read' => 0, 'limit' => 5 ));
			
			// check active user
			$user = $this->user_model->get_by_id(array( 'id' => $user['id'] ));
			if (empty($user['is_active'])) {
				$this->user_model->del_session();
				$result['reload'] = true;
			}
		}
		
		echo json_encode($result);
		exit;
	}
	
	function logout() {
		$this->user_model->del_session();
		header("Location: ".base_url());
		exit;
	}
}