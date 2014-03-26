<?php

class hotel extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2])) {
			$this->load->view( 'website/hotel_detail' );
		} else {
			$this->load->view( 'website/hotel' );
		}
    }
}