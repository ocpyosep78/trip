<?php

class search extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'website/search_list' );
    }
}