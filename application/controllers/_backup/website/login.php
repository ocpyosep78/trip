<?php

class login extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2]) && method_exists($this, $this->uri->segments[2])) {
			$method_name = $this->uri->segments[2];
			$this->$method_name();
		} else {
			$this->load->view( 'website/login' );
		}
    }
	
	function action() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'login') {
			$result = $this->User_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
			if ($result['status']) {
				$result['panel_link'] = base_url('panel');
			}
		}
		
		echo json_encode($result);
	}
}