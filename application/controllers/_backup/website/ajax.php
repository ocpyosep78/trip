<?php

class ajax extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'follow') {
			$is_login = $this->User_model->is_login();
			if (!$is_login) {
				$result['status'] = 0;
				$result['message'] = 'Please login to follow this user.';
				echo json_encode($result);
				exit;
			}
			
			// user
			$user = $this->User_model->get_session();
			
			// no follow her / his self
			if ($user['id'] == $_POST['user_id']) {
				$result['status'] = 0;
				$result['message'] = 'You cannot follow your self.';
				echo json_encode($result);
				exit;
			}
			
			// check if user already follow
			$is_follow = $this->User_Follow_model->is_follow(array( 'user_id' => $user['id'], 'follow_id' => $_POST['user_id'] ));
			if ($is_follow) {
				$result['status'] = 0;
				$result['message'] = 'You already follow this user.';
				echo json_encode($result);
				exit;
			}
			
			// follow
			$param_follow['user_id'] = $user['id'];
			$param_follow['follow_id'] = $_POST['user_id'];
			$param_follow['follow_time'] = $this->config->item('current_datetime');
			$result = $this->User_Follow_model->update($param_follow);
			$result['message'] = 'You has follow this user.';
		} else if ($action == 'unfollow') {
			// user
			$user = $this->User_model->get_session();
			
			$result = $this->User_Follow_model->delete(array( 'user_id' => $user['id'], 'follow_id' => $_POST['user_id'] ));
			$result['message'] = 'You has unfollow this user.';
		}
		
		echo json_encode($result);
    }
}