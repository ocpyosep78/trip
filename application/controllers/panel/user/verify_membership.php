<?php
class verify_membership extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/user/verify_membership' );
    }
	
	function grid() {
		$_POST['user_membership'] = true;
		$_POST['column'] = array( 'email', 'first_name', 'last_name', 'duration_time', 'request_time', 'status' );
		
		$array = $this->user_membership_model->get_array($_POST);
		$count = $this->user_membership_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (isset($_POST['status']) && $_POST['status'] == 'approve') {
				$row = $this->user_membership_model->get_by_id(array( 'id' => $_POST['id'] ));
				
				// update membership
				$param_membership['member_id'] = $row['member_id'];
				$param_membership['membership_id'] = $row['membership_id'];
				$this->user_membership_model->renew_membership($param_membership);
			}
			
			$result = $this->user_membership_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->user_membership_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->user_membership_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}