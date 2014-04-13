<?php
class setting extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array( 'status' => false );
		if ($action == 'change_language') {
			$result['status'] = true;
			$this->language_model->set_session($_POST['code']);
		} else if ($action == 'subscribe_newsletter') {
			$check = $this->newsletter_model->get_by_id(array( 'email' => $_POST['email'] ));
			if (count($check) == 0) {
				$param_update['email'] = $_POST['email'];
				$param_update['status'] = 'active';
				$result = $this->newsletter_model->update($param_update);
				
				$result['message'] = 'Thanks, you have subcribe our newsletter.';
			} else if ($check['status'] == 'inactive') {
				$param_update['id'] = $check['id'];
				$param_update['status'] = 'active';
				$result = $this->newsletter_model->update($param_update);
				
				$result['message'] = 'Thanks, you have subcribe our newsletter.';
			} else {
				$result['status'] = '0';
				$result['message'] = 'You email already subcribe our newsletter.';
			}
		}
		
		echo json_encode($result);
    }
}