<?php
class category_input extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/setup/category_input' );
    }
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'price_text' );
		
		$array = $this->Category_Input_model->get_array($_POST);
		$count = $this->Category_Input_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Category_Input_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->Category_Input_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->Category_Input_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
	
	function view() {
		$view_name = (isset($_POST['view_name'])) ? $_POST['view_name'] : 'form_tree';
		unset($_POST['view_name']);
		
		$this->load->view( 'panel/common/'.$view_name );
	}
}