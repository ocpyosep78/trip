<?php

class advert extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2]) && method_exists($this, $this->uri->segments[2])) {
			$method_name = $this->uri->segments[2];
			$this->$method_name();
		} else {
			$this->load->view( 'website/advert' );
		}
    }
	
	function action() {
		$action = (!empty($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'get_template_view') {
			$alias = $_POST['alias'];
			$library_name = 'input_'.$_POST['alias'];
			$this->load->library($library_name);
			$result = $this->$library_name->get_display($_POST);
			echo $result; exit;
		}
		else if ($action == 'sent_to_friend') {
			$advert = $this->Advert_model->get_by_id(array( 'id' => $_POST['advert_id'] ));
			$is_login = $this->User_model->is_login();
			if ($is_login) {
				$user = $this->User_model->get_session();
				$_POST['email_from'] = $user['email'];
			}
			
			$param_mail['to'] = $_POST['email_to'];
			$param_mail['message'] = $_POST['message'];
			$param_mail['subject'] = 'Iklan - '.$advert['name'];
			sent_mail($param_mail);
			
            $result['status'] = '1';
            $result['message'] = 'Email berhasil dikirim';
		}
		else if ($action == 'advert_report') {
			if ($_SESSION['captha'] != $_POST['captcha']) {
				$result['status'] = '0';
				$result['message'] = 'Wrong captcha.';
			} else {
				// data
				$advert = $this->Advert_model->get_by_id(array( 'id' => $_POST['advert_id'] ));
				$report_type = $this->Report_Type_model->get_by_id(array( 'id' => $_POST['report_type_id'] ));
				
				// sent mail
				$param_mail['to'] = $advert['email'];
				$param_mail['subject'] = 'Report Advert';
				$param_mail['message'] = $report_type['name'].'<br /><br />'.$_POST['detail'].'<br /><br /><a href="'.$advert['advert_link'].'">'.$advert['advert_link'].'</a>';
				$param_mail['header']  = 'Cc: ' . EMAIL_CC_ADMIN . "\r\n";
				sent_mail($param_mail);
				
				// insert to db
				$_POST['post_time'] = $this->config->item('current_datetime');
				$result = $this->Report_model->update($_POST);
			}
		}
		else if ($action == 'contact_advertiser') {
			$advert = $this->Advert_model->get_by_id(array( 'id' => $_POST['advert_id'] ));
			
			// sent mail
			$param_mail['to'] = $advert['email'];
			$param_mail['subject']  = 'Some user sent message to you';
			$param_mail['message']  = 'Message from '.WEBSITE_TITLE.', some user sent message :<br /><br />';
			$param_mail['message'] .= '<a href="'.base_url('login').'">Read now ....</a>';
			$param_mail['header']   = 'Cc: ' . EMAIL_CC_ADMIN . "\r\n";
			sent_mail($param_mail);
			
			// insert to db
			$_POST['user_id'] = $advert['user_id'];
			$_POST['post_time'] = $this->config->item('current_datetime');
			$_POST['ip_address'] = $_SERVER['REMOTE_ADDR'];
			$_POST['city'] = $this->City_Ip_model->get_location(array( 'ip' => $_SERVER['REMOTE_ADDR'] ));
			$result = $this->User_Contact_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}