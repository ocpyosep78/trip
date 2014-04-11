<?php
class destination extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/destination' );
    }
	
	function grid() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		if ($action == 'post') {
			$_POST['grid_type'] = 'member';
			$_POST['category_id'] = CATEGORY_DESTINATION;
			$_POST['column'] = array( 'category_title', 'category_sub_title', 'title_text', 'post_update', 'post_status' );
			
			// param member
			$user_session = $this->user_model->get_session();
			if (! in_array($user_session['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR))) {
				$_POST['member_id'] = $user_session['id'];
			}
			
			$array = $this->post_model->get_array($_POST);
			$count = $this->post_model->get_count();
			$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		} else if ($action == 'post_facility') {
			$_POST['is_delete'] = '1';
			$_POST['column'] = array( 'facility_title_text' );
			
			$array = $this->post_facility_model->get_array($_POST);
			$count = $this->post_facility_model->get_count();
			$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		} else if ($action == 'post_gallery') {
			$_POST['column'] = array( 'title' );
			
			$array = $this->post_gallery_model->get_array($_POST);
			$count = $this->post_gallery_model->get_count();
			$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		}
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			// add update time
			if (empty($_POST['id'])) {
				$_POST['post_update'] = $this->config->item('current_datetime');
			}
			
			$result = $this->post_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->post_model->get_by_id(array( 'id' => $_POST['id'], 'tag_include' => @$_POST['tag_include'] ));
		} else if ($action == 'delete') {
			$result = $this->post_model->delete($_POST);
		}
		
		// facility
		else if ($action == 'facility_update') {
			$result = $this->post_facility_model->update($_POST);
		} else if ($action == 'facility_delete') {
			$result = $this->post_facility_model->delete($_POST);
		}
		
		// gallery
		else if ($action == 'gallery_update') {
			$result = $this->post_gallery_model->update($_POST);
		} else if ($action == 'gallery_get_by_id') {
			$result = $this->post_gallery_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'gallery_delete') {
			$result = $this->post_gallery_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}