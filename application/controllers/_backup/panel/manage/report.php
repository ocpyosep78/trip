<?php
class report extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/manage/report' );
    }
	
	function grid() {
		$_POST['is_manage'] = 'admin';
		$_POST['column'] = array( 'report_type_name', 'detail', 'post_time' );
		
		$array = $this->Report_model->get_array($_POST);
		$count = $this->Report_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'get_by_id') {
			$result = $this->Report_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->Report_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}