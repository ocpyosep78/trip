<?php
class membership extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/profile/membership' );
    }
	
	function grid() {
		$_POST['column'] = array( 'title', 'duration_time' );
		$_POST['is_custom'] = '<i class="cursor-button tool-tip fa fa-thumbs-up btn-request" title="Request Membership"></i> ';
		
		$array = $this->membership_model->get_array($_POST);
		$count = $this->membership_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// member
		$user_session = $this->user_model->get_session();
		$member = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
		
		$result = array();
		if ($action == 'request') {
			$param_update['member_id'] = $member['id'];
			$param_update['membership_id'] = $_POST['id'];
			$param_update['request_time'] = $this->config->item('current_datetime');
			$param_update['status'] = 'pending';
			$result = $this->user_membership_model->update($param_update);
		} else if ($action == 'cancel_request') {
			$param_delete['member_id'] = $member['id'];
			$param_delete['status'] = 'pending';
			$result = $this->user_membership_model->delete($param_delete);
		}
		
		echo json_encode($result);
	}
}