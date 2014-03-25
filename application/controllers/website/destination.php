<?php

class destination extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'website/destination' );
    }
}