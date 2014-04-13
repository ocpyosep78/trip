<?php
class gallery extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/gallery' );
    }
	
	function grid() {
		// user
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
		
		$_POST['traveler_id'] = $user['id'];
		$_POST['column'] = array( 'post_title_default', 'title', 'post_date', 'post_status' );
		$_POST['is_custom']  = '<i class="cursor-button tool-tip fa fa-eye btn-preview" title="Preview"></i> ';
		$_POST['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-delete" title="Delete"></i> ';
		
		$array = $this->post_traveler_photo_model->get_array($_POST);
		$count = $this->post_traveler_photo_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'get_by_id') {
			$result = $this->post_traveler_photo_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->post_traveler_photo_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}