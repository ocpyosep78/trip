<?php
class verify_address extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/user/verify_address' );
    }
	
	function grid() {
		$_POST['grid_view'] = 'manage_user';
		$_POST['column'] = array( 'full_name', 'request_time', 'code', 'status' );
		
		$array = $this->verify_address_model->get_array($_POST);
		$count = $this->verify_address_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->verify_address_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}