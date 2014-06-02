<?php

class traveler extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
		
		if (!empty($this->uri->segments[3])) {
			$this->load->view( 'website/timeline_traveler' );
		} else if (count($traveler) > 0) {
			$this->load->view( 'website/info_traveler' );
		}
    }
}