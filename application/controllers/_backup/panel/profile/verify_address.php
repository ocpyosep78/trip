<?php
class verify_address extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/profile/verify_address' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$user = $this->User_model->get_session();
		
		$result = array();
		if ($action == 'request') {
			$allow_request = $this->Verify_Address_model->allow_request(array( 'user_id' => $user['id'] ));
			if ($allow_request) {
				$_POST['id'] = 0;
				$_POST['user_id'] = $user['id'];
				$_POST['request_time'] = $this->config->item('current_datetime');
				$_POST['code'] = rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999);
				$_POST['status'] = 'pending';
				$result = $this->Verify_Address_model->update($_POST);
				$result['message'] = 'Your request will be deliver, please wait until you receive the code.';
			} else {
				$result['status'] = '0';
				$result['message'] = 'You can request again in next 30 days.';
			}
		} else if ($action == 'submit_code') {
			$result = $this->Verify_Address_model->sent_code(array( 'code' => $_POST['code'], 'user_id' => $user['id'] ));
		}
		
		echo json_encode($result);
	}
}