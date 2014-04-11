<?php
class promo extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/promo' );
    }
	
	function grid() {
		$_POST['grid_type'] = 'editor';
		$_POST['column'] = array( 'post_title_text', 'promo_duration_title_text', 'publish_date_swap', 'close_date_swap', 'promo_status' );
		
		// param member
		$user_session = $this->user_model->get_session();
		$_POST['user_type_id'] = $user_session['user_type_id'];
		if (! in_array($user_session['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR))) {
			$_POST['member_id'] = $user_session['id'];
		}
		
		$array = $this->promo_model->get_array($_POST);
		$count = $this->promo_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if ($_POST['promo_status'] == 'request approve') {
				$post = $this->post_model->get_by_id(array( 'id' => $_POST['post_id'] ));
				$member = $this->member_model->get_by_id(array( 'id' => $post['member_id'] ));
				$promo_duration = $this->promo_duration_model->get_by_id(array( 'id' => $_POST['promo_duration_id'] ));
				
				// get message
				$widget = $this->widget_model->get_by_id(array( 'alias' => 'promo-request-approve' ));
				$message = str_replace('[#full_name#]', $member['full_name'], $widget['content']);
				$message = str_replace('[#post_title#]', $post['title_text'], $message);
				$message = str_replace('[#promo_duration_title#]', $promo_duration['title'], $message);
				$message = str_replace('[#promo_duration#]', $promo_duration['duration'], $message);
				$message = str_replace('[#promo_cost#]', $promo_duration['cost_text'], $message);
				
				// sent mail
				$param_mail['to'] = $member['email'];
				$param_mail['subject'] = 'Promo - '.$post['title_text'];
				$param_mail['message'] = $message;
				sent_mail($param_mail);
			}
			
			$result = $this->promo_model->update($_POST);
		} else if ($action == 'update_status') {
			// param update
			$param_update['id'] = $_POST['id'];
			$param_update['promo_status'] = $_POST['promo_status'];
			
			// approve
			if ($_POST['promo_status'] == 'approve') {
				$promo = $this->promo_model->get_by_id(array( 'id' => $_POST['id'] ));
				
				// set param
				$param_update['publish_date'] = $promo['publish_date'];
				$param_update['close_date'] = AddDate($promo['publish_date'], $promo['promo_duration']);
			}
			
			// update
			$result = $this->promo_model->update($param_update);
		} else if ($action == 'get_by_id') {
			$result = $this->promo_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->promo_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}