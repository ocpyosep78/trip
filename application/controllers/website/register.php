<?php

class register extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2])) {
			if (method_exists($this, $this->uri->segments[2])) {
				$method_name = $this->uri->segments[2];
				$this->$method_name();
			}
		} else {
			$this->load->view( 'website/register_member' );
		}
    }
	
	function member() {
		$this->load->view( 'website/register_member' );
	}
	
	function traveler() {
		$this->load->view( 'website/register_traveler' );
	}
	
	function confirm() {
		$this->load->view( 'website/register_confirm' );
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'register_member' || $action == 'register_traveler') {
			$model_name = ($action == 'register_member') ? 'member_model' : 'traveler_model';
			
			// check alias
			$check = $this->$model_name->get_by_id(array( 'alias' => $_POST['alias'] ));
			if (count($check) > 0) {
				$result['status'] = 0;
				$result['message'] = 'Sorry, alias already taken.';
				echo json_encode($result);
				exit;
			}
			
			// check email
			$check = $this->$model_name->get_by_id(array( 'email' => $_POST['email'] ));
			if (count($check) > 0) {
				$result['status'] = 0;
				$result['message'] = $_POST['email'].' already register, please login.';
				echo json_encode($result);
				exit;
			}
			
			// insert
			$param_update = $_POST;
			$param_update['provider'] = WEBSITE_ALIAS;
			$param_update['passwd'] = EncriptPassword($param_update['passwd']);
			$param_update['register_date'] = $this->config->item('current_datetime');
			$param_update['verify_email_key'] = EncriptPassword($this->config->item('current_datetime'));
			$result = $this->$model_name->update($param_update);
			
			// sent mail
			$link_confirmation = base_url('register/confirm/'.$param_update['verify_email_key']);
			$message  = 'Dear '.$param_update['first_name'].' '.$param_update['last_name'].',<br /><br />';
			$message .= 'Please click link below to complete your registration :<br />';
			$message .= '<a href="'.$link_confirmation.'">Link Email Confirmation</a><br /><br />';
			$message .= 'or copy text link below and paste on your web browser.<br />';
			$message .= $link_confirmation;
			$param_mail = array( 'to' => $_POST['email'], 'subject' => WEBSITE_TITLE.' - Email Validation', 'message' => $message );
			sent_mail($param_mail);
			
			// set message
			$result['message'] = 'Please check your email you confirm your email registration.';
		}
		
		echo json_encode($result);
	}
}