<?php

class destination extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2])) {
			if (method_exists($this, $this->uri->segments[2])) {
				$method_name = $this->uri->segments[2];
				$this->$method_name();
			} else if ($this->uri->segments[2] == 'review') {
				$this->load->view( 'website/destination_review' );
			} else if ($this->uri->segments[2] == 'gallery') {
				$this->load->view( 'website/destination_gallery' );
			} else {
				$this->load->view( 'website/destination_detail' );
			}
		} else {
			$this->load->view( 'website/destination' );
		}
    }
	
	function view() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = '';
		if ($action == 'get_post_view') {
			$result = $this->load->view( 'website/common/template_post_public', array(), true );
		}
		
		echo $result;
	}
}