<?php

class redirect extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// check uri
		preg_match('/action$/i', $_SERVER['REQUEST_URI'], $match);
		
		// action
		if (!empty($match[0]) && method_exists($this, $match[0])) {
			$method_name = $match[0];
			$this->$method_name();
		} else {
			$this->load->view( 'website/redirect' );
		}
    }
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'broken_link') {
			if ($_POST['redirect_type'] == 'hotel-booking') {
				$hotel_booking = $this->hotel_booking_model->get_by_id(array( 'id' => $_POST['redirect_id'] ));
				$post = $this->post_model->get_by_id(array( 'id' => $hotel_booking['post_id'] ));
				
				// admin mail
				$widget_admin_mail = $this->widget_model->get_by_id(array( 'alias' => 'admin-email' ));
				
				// sent mail
				$param_mail['email'] = $widget_admin_mail['content'];
				$param_mail['subject'] = 'Broken Link Report';
				$param_mail['message'] = '
					Some user sent broken link, please read detail below :<br />
					Post Title : '.$post['title_default'].'<br />
					Post Link : '.$post['link_post'].'<br />
					Booking Title : '.$hotel_booking['title'].'<br />
					Booking Link : '.$hotel_booking['link'].'
				';
				sent_mail($param_mail);
			}
			
			// set result
			$result['status'] = '1';
			$result['message'] = 'Thank you, your report will be check soon.';
		}
		
		echo json_encode($result);
	}
}