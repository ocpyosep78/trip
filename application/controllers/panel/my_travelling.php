<?php
class my_travelling extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/my_travelling' );
    }
	
	function grid() {
		// user
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
		
		$_POST['is_edit'] = 1;
		$_POST['traveler_id'] = $user['id'];
		$_POST['column'] = array( 'title', 'create_date_swap' );
		
		$array = $this->my_travelling_model->get_array($_POST);
		$count = $this->my_travelling_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
		
		$result = array();
		if ($action == 'update') {
			// insert
			if (empty($_POST['id'])) {
				$_POST['traveler_id'] = $user['id'];
				$_POST['create_date'] = $this->config->item('current_datetime');
			}
			
			$result = $this->my_travelling_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->my_travelling_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->my_travelling_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}