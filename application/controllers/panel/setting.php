<?php
class setting extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/setting' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user_session = $this->user_model->get_session();
		
		$result = array();
		if ($action == 'update') {
			// member or traveler
			if ($user_session['user_type_id'] == USER_TYPE_MEMBER) {
				$param['member_id'] = $user_session['id'];
			} else if ($user_session['user_type_id'] == USER_TYPE_TRAVELER) {
				$param['traveler_id'] = $user_session['id'];
			}
			
			// update
			$param['email_notify'] = $_POST['email_notify'];
			$result = $this->user_setting_model->update_by_user($param);
		}
		
		echo json_encode($result);
	}
}