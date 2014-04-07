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
		
		$result = array();
		if ($action == 'update') {
			$_POST['verify_address'] = 0;
			$result = $this->User_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}