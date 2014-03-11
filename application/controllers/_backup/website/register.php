<?php

class register extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2]) && method_exists($this, $this->uri->segments[2])) {
			$method_name = $this->uri->segments[2];
			$this->$method_name();
		} else {
			$this->load->view( 'website/register' );
		}
    }
	
	function action() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->User_model->register($_POST);
		}
		
		echo json_encode($result);
	}
}