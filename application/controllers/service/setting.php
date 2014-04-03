<?php
class setting extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array( 'status' => false );
		if ($action == 'change_language') {
			$result['status'] = true;
			$this->language_model->set_session($_POST['code']);
		}
		
		echo json_encode($result);
    }
}