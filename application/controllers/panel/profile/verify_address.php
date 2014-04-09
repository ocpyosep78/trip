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
		
		// member
		$user_session = $this->user_model->get_session();
		$member = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
		
		$result = array();
		if ($action == 'request') {
			$allow_request = $this->verify_address_model->allow_request(array( 'member_id' => $member['id'] ));
			if ($allow_request) {
				$_POST['id'] = 0;
				$_POST['member_id'] = $member['id'];
				$_POST['request_time'] = $this->config->item('current_datetime');
				$_POST['code'] = rand(1000,9999).'-'.rand(1000,9999).'-'.rand(1000,9999);
				$_POST['status'] = 'pending';
				$result = $this->verify_address_model->update($_POST);
				$result['message'] = 'Your request will be deliver, please wait until you receive the code.';
			} else {
				$result['status'] = '0';
				$result['message'] = 'You can request again in next 30 days.';
			}
		} else if ($action == 'submit_code') {
			$result = $this->verify_address_model->sent_code(array( 'code' => $_POST['code'], 'member_id' => $member['id'] ));
		}
		
		echo json_encode($result);
	}
}