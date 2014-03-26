<?php

class destination extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		if (!empty($this->uri->segments[2])) {
			if ($this->uri->segments[2] == 'review') {
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
}