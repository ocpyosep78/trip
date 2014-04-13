<?php

class selector extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$member = $this->member_model->get_by_id(array( 'alias' => $this->uri->segments[1] ));
		$page_static = $this->page_static_model->get_by_id(array( 'alias' => $this->uri->segments[1] ));
		
		if (count($member) > 0) {
			$this->load->view( 'website/info_member' );
		} else if (count($page_static) > 0) {
			$this->load->view( 'website/page_static' );
		}
    }
}