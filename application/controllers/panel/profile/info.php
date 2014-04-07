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
		
		$result = array();
		
		if ($action == 'update_info') {
			$result = $this->User_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}