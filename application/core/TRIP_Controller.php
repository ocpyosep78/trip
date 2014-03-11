<?php

class TRIP_Controller extends CI_Controller {
    function __construct() {
        parent::__construct();
		$this->user_model->sign_active();
    }
}

class PANEL_Controller extends TRIP_Controller {
    function __construct() {
        parent::__construct();
		$this->user_model->required_login();
    }
}