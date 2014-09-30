<?php

class traveler extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// check action
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		if (!empty($action)) {
			unset($_POST['action']);
			$this->action($action);
		}
		
		// page data
		$traveler = $this->traveler_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
		if (count($traveler) == 0) {
			header("Location: ".base_url());
			exit;
		}
		
		if (!empty($this->uri->segments[3])) {
			if ($this->uri->segments[3] == 'my-traveling') {
				$this->load->view( 'website/travelling_detail' );
			} else {
				$this->load->view( 'website/timeline_detail' );
			}
		} else if (count($traveler) > 0) {
			$this->load->view( 'website/timeline' );
		}
    }
	
	function action($value) {
		if ($value == 'load_more_timeline') {
			$array_timeline = $this->traveler_model->get_array_timeline($_POST);
			$view = $this->load->view( 'website/timeline_list', array( 'array_timeline' => $array_timeline ), true );
			echo $view; exit;
		}
	}
}