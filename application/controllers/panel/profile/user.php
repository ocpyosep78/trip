<?php
class user extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/profile/user' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user_session = $this->user_model->get_session();
		$model_name = ($user_session['user_type_id'] == USER_TYPE_MEMBER) ? 'member_model' : 'traveler_model';
		
		$result = array();
		if ($action == 'update') {
			$_POST['verify_address'] = 0;
			$result = $this->$model_name->update($_POST);
		}
		
		echo json_encode($result);
	}
}