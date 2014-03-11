<?php
class announce extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/manage/announce' );
    }
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'name', 'post_time', 'update_time' );
		
		$array = $this->Announce_model->get_array($_POST);
		$count = $this->Announce_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			// set time
			$_POST['update_time'] = $this->config->item('current_datetime');
			if (empty($_POST['id'])) {
				$_POST['post_time'] = $this->config->item('current_datetime');
			}
			
			$result = $this->Announce_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->Announce_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->Announce_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}