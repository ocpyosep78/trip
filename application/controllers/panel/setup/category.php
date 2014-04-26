<?php
class category extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/setup/category' );
    }
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'title', 'alias', 'content' );
		
		$array = $this->category_model->get_array($_POST);
		$count = $this->category_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->category_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->category_model->get_by_id(array( 'id' => $_POST['id'], 'tag_include' => @$_POST['tag_include'] ));
		} else if ($action == 'delete') {
			$result = $this->category_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}