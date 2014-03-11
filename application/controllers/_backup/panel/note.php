<?php
class note extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/note' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user = $this->User_model->get_session();
		
		$result = array();
		if ($action == 'update') {
			$_POST['user_id'] = $user['id'];
			$_POST['note_update'] = $this->config->item('current_datetime');
			$result = $this->User_Note_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->User_Note_model->get_by_id($_POST);
		} else if ($action == 'get_array') {
			$_POST['user_id'] = $user['id'];
			$result['array'] = $this->User_Note_model->get_array($_POST);
		} else if ($action == 'delete') {
			$result = $this->User_Note_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}