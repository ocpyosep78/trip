<?php

class login extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// load library
		$this->load->library('oathlogin');
		
		if (!empty($this->uri->segments[2])) {
			if (method_exists($this, $this->uri->segments[2])) {
				$method_name = $this->uri->segments[2];
				$this->$method_name();
			}
		} else {
			$this->load->view( 'website/login_member' );
		}
    }
	
	function member() {
		$this->load->view( 'website/login_member' );
	}
	
	function traveler() {
		if (!empty($this->uri->segments[3])) {
			if ($this->uri->segments[3] == 'fb') {
				$this->login_fb('traveler');
			}
		} else {
			$this->load->view( 'website/login_traveler' );
		}
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'login_member') {
			$result = $this->member_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
		} else if ($action == 'login_traveler') {
			$result = $this->traveler_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
		}
		
		echo json_encode($result);
	}
	
	function login_fb($user_type) {
		// user
		$user = $_SESSION['user_facebook'];
		
		// user model
		if (!empty($user['user_type'])) {
			$model_name = $user['user_type'].'_model';
		} else {
			$model_name = 'traveler_model';
		}
		
		// user detail success
		if (count($user) > 0) {
			$result = $this->oathlogin->user_signup($user, 'facebook', $user_type);
			if ($result['status']) {
				// delete old session
				unset($_SESSION['user_facebook']);
				
				// set session
				$result = $this->$model_name->sign_in(array( 'email' => $result['user']['email'], 'login_facebook' => true ));
				header('Location: '.$result['redirect_link']);
				exit;
			} else {
				echo 'error login';
			}
		}
		
		// user detail fail
		else {
			echo 'error get user detail';
		}
	}
}