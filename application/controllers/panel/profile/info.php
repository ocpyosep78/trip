<?php
class info extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/profile/info' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user_session = $this->user_model->get_session();
		$model_name = ($user_session['user_type_id'] == USER_TYPE_MEMBER) ? 'member_model' : 'traveler_model';
		
		$result = array();
		if ($action == 'update_info') {
			$result = $this->$model_name->update($_POST);
		}
		
		echo json_encode($result);
	}
}