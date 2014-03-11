<?php

class forget_password extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2]) && method_exists($this, $this->uri->segments[2])) {
			$method_name = $this->uri->segments[2];
			$this->$method_name();
		} else {
			$this->load->view( 'website/forget_password' );
		}
    }
	
	function action() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'reset_password') {
			$user = $this->User_model->get_by_id(array( 'email' => $_POST['email'] ));
			if (count($user) == 0) {
				$result['status'] = 0;
				$result['message'] = 'Email not found.';
			} else {
				$passwd_reset_key_raw = mcrypt_encode($this->config->item('current_datetime'));
				$passwd_reset_key_raw = preg_replace('/[^a-z0-9]/i', '', $passwd_reset_key_raw);
				
				// update user
				$param_update['id'] = $user['id'];
				$param_update['passwd_reset_key'] = $passwd_reset_key_raw;
				$result = $this->User_model->update($param_update);
				$result['message'] = 'Please check your email to reset your password.';
				
				// sent mail
				$param_mail['to'] = $user['email'];
				$param_mail['subject']  = WEBSITE_TITLE.' - Reset Password';
				$param_mail['message']  = 'You have request reset password, clink link below to reset your password or ignore this email if you not request your password for this email.<br /><br /><br />';
				$param_mail['message'] .= '<a href="'.base_url('reset/'.$param_update['passwd_reset_key']).'">Reset Password</a>';
				sent_mail($param_mail);
			}
		}
		
		echo json_encode($result);
	}
}