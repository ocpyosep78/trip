<?php
class advert extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/manage/advert' );
    }
	
	function grid() {
		$_POST['is_manage'] = 'admin';
		$_POST['column'] = array( 'category_name', 'category_sub_name', 'name', 'post_time', 'sold_time', 'advert_status_name' );
		
		// set previlege
		$user = $this->User_model->get_session();
		if ($user['user_type_id'] == USER_TYPE_MEMBER || isset($_POST['user_id'])) {
			$_POST['is_manage'] = 'member';
		}
		
		$array = $this->Advert_model->get_array($_POST);
		$count = $this->Advert_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			if (isset($_POST['advert_status_id']) && $_POST['advert_status_id'] == ADVERT_STATUS_APPROVE) {
				$advert = $this->Advert_model->get_by_id(array( 'id' => $_POST['id'] ));
				$advert_user = $this->User_model->get_by_id(array( 'id' => $advert['user_id'] ));
				$array_follower = $this->User_Follow_model->get_array(array( 'follow_id' => $advert['user_id'], 'limit' => MAXIMUM_SENDING_MAIL ));
				
				// admin message
				$_POST['admin_message'] = (isset($_POST['admin_message'])) ? $_POST['admin_message'] : '';
				
				// sent mail for owner
				$param_mail['to'] = $advert_user['email'];
				$param_mail['subject']  = 'Advert Approved '.$advert['name'];
				$param_mail['message']  = 'Hi '.$advert_user['fullname'].',

Terima kasih telah menggunakan '.WEBSITE_DOMAIN.' sebagai media iklan online Anda.

ID: '.$advert['code'].'
Judul: '.$advert['name'].'

'.$_POST['admin_message'].'Saat ini iklan Anda belum dapat ditayangkan karena terdapat unsur-unsur yang dapat mengurangi kualitas produk/jasa yang ditawarkan oleh '.WEBSITE_DOMAIN.' dan kurang dapat dipertanggungjawabkan keberadaan maupun kualitasnya.

Salam hangat,

'.WEBSITE_DOMAIN;
				$param_mail['message'] = nl2br($param_mail['message']);
				sent_mail($param_mail);
				
				// sent mail to follower
				foreach ($array_follower as $follower) {
					$param_mail['to'] = $follower['email'];
					$param_mail['subject']  = 'Notification Follow - '.$advert_user['fullname'];
					$param_mail['message']  = $advert_user['fullname'].' has post new advert, click link below to check detail.<br /><br />';
					$param_mail['message'] .= '<a href="'.$advert['advert_link'].'">'.$advert['name'].'</a>';
					sent_mail($param_mail);
				}
			}
			
			$result = $this->Advert_model->update($_POST);
		}
		else if ($action == 'get_by_id') {
			$result = $this->Advert_model->get_by_id(array( 'id' => $_POST['id'] ));
		}
		else if ($action == 'resubmit') {
			$_POST['post_time'] = $this->config->item('current_datetime');
			$_POST['advert_status_id'] = ADVERT_STATUS_REVIEW;
			$result = $this->Advert_model->update($_POST);
		}
		else if ($action == 'sold') {
			$_POST['sold_time'] = $this->config->item('current_datetime');
			$result = $this->Advert_model->update($_POST);
		}
		else if ($action == 'delete') {
			$_POST['is_delete'] = 1;
			$result = $this->Advert_model->update($_POST);
		}
		
		echo json_encode($result);
	}
}