<?php
class membership extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/user/membership' );
    }
	
	function grid() {
		$_POST['user_membership'] = true;
		$_POST['column'] = array( 'email', 'first_name', 'last_name', 'advert_count', 'advert_time', 'request_time', 'status' );
		
		$array = $this->User_Membership_model->get_array($_POST);
		$count = $this->User_Membership_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (isset($_POST['status']) && $_POST['status'] == 'approve') {
				$row = $this->User_Membership_model->get_by_id(array( 'id' => $_POST['id'] ));
				
				// update membership
				$param_membership['user_id'] = $row['user_id'];
				$param_membership['membership_id'] = $row['membership_id'];
				$this->User_Membership_model->renew_membership($param_membership);
			}
			
			$result = $this->User_Membership_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->User_Membership_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->User_Membership_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}