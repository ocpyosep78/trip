<?php
class message extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/message' );
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->User_Contact_model->update($_POST);
		} else if ($action == 'delete') {
			$result = $this->User_Contact_model->delete($_POST);
		} else if ($action == 'sent_reply') {
			$user_contact = $this->User_Contact_model->get_by_id(array( 'id' => $_POST['id'] ));
			
			// sent mail
			$param_mail['to'] = $user_contact['email'];
			$param_mail['subject'] = $_POST['title'];
			$param_mail['message'] = $_POST['content'];
			sent_mail($param_mail);
			
            $result['status'] = '1';
            $result['message'] = 'Email sent.';
		}
		
		echo json_encode($result);
	}
	
	function view() {
		if ($_POST['template'] == 'message_list') {
			$this->load->view( 'panel/message_list' );
		}
	}
}