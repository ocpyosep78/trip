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
		$user = $this->User_model->get_session();
		
		$result = array();
		if ($action == 'update') {
			$param['user_id'] = $user['id'];
			$param['email_follow'] = $_POST['email_follow'];
			$param['email_notify'] = $_POST['email_notify'];
			$result = $this->User_Setting_model->update_by_user($param);
		}
		
		echo json_encode($result);
	}
}