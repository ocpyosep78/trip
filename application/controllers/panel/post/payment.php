<?php
class payment extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/payment' );
    }
	
	function grid() {
		$_POST['grid_type'] = 'editor';
		$_POST['column'] = array( 'post_title', 'email', 'sender', 'transfer_date', 'status' );
		
		$array = $this->payment_model->get_array($_POST);
		$count = $this->payment_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update_status') {
			$result = $this->payment_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->payment_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->payment_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}