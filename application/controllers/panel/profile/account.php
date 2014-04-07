<?php
class account extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/profile/account' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$user = $this->User_model->get_session();
		$user = $this->User_model->get_by_id(array( 'id' => $user['id'], 'with_passwd' => true ));
		
		$result = array( 'status' => false, 'message' => '' );
		if ($action == 'update_mail') {
			if ($user['passwd'] == EncriptPassword($_POST['passwd'])) {
				$result = $this->User_model->update(array( 'id' => $user['id'], 'email' => $_POST['email'] ));
				$result['message'] = 'Email successfully updated.';
			} else {
				$result['message'] = 'Sorry, password did not match.';
			}
		} else if ($action == 'update_password') {
			if ($user['passwd'] == EncriptPassword($_POST['passwd_old'])) {
				$result = $this->User_model->update(array( 'id' => $user['id'], 'passwd' => EncriptPassword($_POST['passwd']) ));
				$result['message'] = 'Password has been changed.';
			} else {
				$result['message'] = 'Sorry, password did not match.';
			}
		}
		
		echo json_encode($result);
	}
}