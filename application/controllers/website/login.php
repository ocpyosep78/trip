<?php

class login extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$user_type = (empty($this->uri->segments[2])) ? 'member' : $this->uri->segments[2];
		
		if ($user_type == 'member') {
			$this->load->view( 'website/login_member' );
		} else {
			$this->load->view( 'website/login_traveler' );
		}
    }
}