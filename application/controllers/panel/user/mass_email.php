<?php
class mass_email extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/user/mass_email' );
    }
	
	function grid() {
		$_POST['grid_type'] = 'sent_mass_mail';
		$_POST['column'] = array( 'to', 'name', 'update_time', 'status' );
		
		$array = $this->mass_email_model->get_array($_POST);
		$count = $this->mass_email_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (empty($_POST['id'])) {
				$_POST['status'] = 'draft';
			}
			
			$_POST['update_time'] = $this->config->item('current_datetime');
			$result = $this->mass_email_model->update($_POST);
		}
		else if ($action == 'get_by_id') {
			$result = $this->mass_email_model->get_by_id(array( 'id' => $_POST['id'] ));
		}
		else if ($action == 'sent_mail') {
			/*
			$mass_email = $this->mass_email_model->get_by_id(array( 'id' => $_POST['id'] ));
			
			// callculate all user
			if (empty($mass_email['sent_limit'])) {
				$user_count = $this->user_model->get_count(array( 'total_user_mass_email' => true ));
				$mass_email['sent_limit'] = $user_count;
				
				// update mass email
				$update['id'] = $mass_email['id'];
				$update['sent_limit'] = $user_count;
				$this->mass_email_model->update($update);
			}
			
			// get array user
			$array_user = $this->user_model->get_count_mass_email(array( 'offset' => $mass_email['sent_offset'], 'limit' => $mass_email['sent_limit'] ));
			
			// sent mail
			$counter = 0;
			foreach ($array_user as $user) {
				$param_mail['subject'] = $mass_email['name'];
				$param_mail['message'] = $mass_email['content'];
				$param_mail['to'] = $user['email'];
				sent_mail($param_mail);
				$counter++;
			}
			
			// update after sending email
			$update_mail['id'] = $mass_email['id'];
			$update_mail['sent_offset'] = $mass_email['sent_offset'] + $counter;
			$this->mass_email_model->update($update_mail);
			
			// update status email if limit same with offset
			$mass_email = $this->mass_email_model->get_by_id(array( 'id' => $_POST['id'] ));
			if ($mass_email['sent_offset'] == $mass_email['sent_limit']) {
				$update_status['id'] = $mass_email['id'];
				$update_status['status'] = 'done';
				$this->mass_email_model->update($update_status);
			}
			
            $result['status'] = '1';
            $result['message'] = "$counter mail successfule deliver.";
			/*	*/
			
			$result['status'] = '0';
            $result['message'] = "continue here";
		}
		else if ($action == 'delete') {
			$result = $this->mass_email_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}