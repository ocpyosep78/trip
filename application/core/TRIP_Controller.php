<?php

class TRIP_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->user_model->sign_active();
		$this->ip_log_model->check_request();
    }
}

class PANEL_Controller extends TRIP_Controller {
    function __construct() {
        parent::__construct();
		$this->user_model->required_login();
    }
}