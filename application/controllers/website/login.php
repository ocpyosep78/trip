<?php

class login extends TRIP_Controller {
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
			$this->load->view( 'website/login_member' );
		}
    }
	
	function member() {
		$this->load->view( 'website/login_member' );
	}
	
	function traveler() {
		if (!empty($this->uri->segments[3])) {
			// load library
			$this->load->library('oathlogin');
			
			if ($this->uri->segments[3] == 'fb') {
				$this->login_fb('traveler');
			}
		} else {
			$this->load->view( 'website/login_traveler' );
		}
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'login_member') {
			$result = $this->member_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
		} else if ($action == 'login_traveler') {
			$result = $this->traveler_model->sign_in(array( 'email' => $_POST['email'], 'passwd' => $_POST['passwd']));
		}
		
		echo json_encode($result);
	}
	
	function login_fb($user_type) {
		// fb config
		$facebook_appid = '674480649266643';
		$facebook_app_secret = '596a165dad8c22cfa86706877ca41554';
		$facebook_scope = 'email,user_birthday'; // Don't modify this
		$facebook = new Facebook(array( 'appId'  => $facebook_appid, 'secret' => $facebook_app_secret ));
		
		// user model
		if ($user_type == 'traveler') {
			$model_name = 'traveler_model';
		}
		
		// Connection...
		$fb_user_id = $facebook->getUser();
		
		if (!empty($fb_user_id)) {
			$logoutUrl = $facebook->getLogoutUrl();
			
			// get user detail
			try {
				$user = $facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
				$user = array();
			}
			
			// user detail success
			if (count($user) > 0) {
				$result = $this->oathlogin->user_signup($user, 'facebook', $user_type);
				if ($result['status']) {
					// set session
					$result = $this->$model_name->sign_in(array( 'email' => $result['user']['email'], 'login_facebook' => true ));
					header('Location: '.$result['redirect_link']);
					exit;
				} else {
					echo 'error login';
				}
			}
			
			// user detail fail
			else {
				echo 'error get user detail';
			}
		} else {
			$loginUrl = $facebook->getLoginUrl(array( 'scope' => $facebook_scope));
			header("Location:$loginUrl");
		}
	}
}