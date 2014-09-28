<?php

class traveling extends TRIP_Controller {
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
		
		$this->load->view( 'website/travelling' );
    }
	
	function action($value) {
		if ($value == 'load_more_timeline') {
			$array_traveling = $this->my_travelling_model->get_array($_POST);
			$view = $this->load->view( 'website/timeline_list', array( 'array_timeline' => $array_traveling ), true );
			echo $view; exit;
		}
	}
}