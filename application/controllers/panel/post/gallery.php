<?php
class gallery extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/gallery' );
    }
	
	function grid() {
		$_POST['grid_type'] = 'admin_view';
		$_POST['column'] = array( 'post_title_default', 'title', 'post_date', 'post_status' );
		
		$array = $this->post_traveler_photo_model->get_array($_POST);
		$count = $this->post_traveler_photo_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$_POST['alias'] = get_name($_POST['title']);
			$result = $this->post_traveler_photo_model->update($_POST);
		} else if ($action == 'update_status') {
			$result = $this->post_traveler_photo_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->post_traveler_photo_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->post_traveler_photo_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}