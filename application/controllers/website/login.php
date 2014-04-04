<?php

class login extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
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
		$this->load->view( 'website/login_traveler' );
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
}