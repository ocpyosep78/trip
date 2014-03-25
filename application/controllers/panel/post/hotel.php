<?php
class hotel extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/hotel' );
    }
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['category_id'] = CATEGORY_HOTEL;
		$_POST['column'] = array( 'category_title', 'category_sub_title', 'title_text', 'post_status' );
		
		$array = $this->post_model->get_array($_POST);
		$count = $this->post_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->post_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->post_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->post_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}