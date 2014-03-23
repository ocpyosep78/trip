<?php
class ip_log extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/log/ip_log' );
    }
	
	function grid() {
		$_POST['is_custom'] = '&nbsp;';
		$_POST['column'] = array( 'ip_address', 'request_time' );
		
		$array = $this->ip_log_model->get_array($_POST);
		$count = $this->ip_log_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'clear') {
			$result = $this->ip_log_model->clear_table();
		}
		
		echo json_encode($result);
	}
}