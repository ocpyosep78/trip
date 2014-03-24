<?php
class traveler extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/user/traveler' );
    }
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'email', 'first_name', 'last_name', 'phone' );
		
		$array = $this->traveler_model->get_array($_POST);
		$count = $this->traveler_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (isset($_POST['passwd'])) {
				if (empty($_POST['passwd'])) {
					unset($_POST['passwd']);
				} else {
					$_POST['passwd'] = EncriptPassword($_POST['passwd']);
				}
			}
			
			$result = $this->traveler_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->traveler_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->traveler_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}