<?php
class membership extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/profile/membership' );
    }
	
	function grid() {
		$_POST['column'] = array( 'title', 'advert_count', 'advert_time' );
		$_POST['is_custom'] = '<i class="cursor-button tool-tip fa fa-thumbs-up btn-request" title="Request Membership"></i> ';
		
		$array = $this->Membership_model->get_array($_POST);
		$count = $this->Membership_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user = $this->User_model->get_session();
		
		$result = array();
		if ($action == 'request') {
			$param_update['user_id'] = $user['id'];
			$param_update['membership_id'] = $_POST['id'];
			$param_update['request_time'] = $this->config->item('current_datetime');
			$param_update['status'] = 'pending';
			$result = $this->User_Membership_model->update($param_update);
		} else if ($action == 'cancel_request') {
			$param_delete['user_id'] = $user['id'];
			$param_delete['status'] = 'pending';
			$result = $this->User_Membership_model->delete($param_delete);
		}
		
		echo json_encode($result);
	}
}