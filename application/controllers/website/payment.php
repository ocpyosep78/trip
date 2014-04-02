<?php

class payment extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2]) && method_exists($this, $this->uri->segments[2])) {
			$method_name = $this->uri->segments[2];
			$this->$method_name();
		} else {
			echo 'request empty.';
		}
    }
	
	function confirmation() {
		$this->load->view( 'website/payment_confirmation' );
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'payment_update') {
			$_POST['status'] = 'pending';
			$_POST['update_time'] = $this->config->item('current_datetime');
			$result = $this->payment_model->update($_POST);
			$result['message'] = 'Confirmation succesful, please wait until admin approve your request.';
		}
		
		echo json_encode($result);
	}
}