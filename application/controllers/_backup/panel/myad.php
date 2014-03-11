<?php
class myad extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$user = $this->User_model->get_session();
		$this->load->view( 'panel/manage/advert', array( 'user_id' => $user['id'] ) );
    }
}