<?php

class rss extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// array post
		$param_post['sort'] = '[{"property":"post_update","direction":"DESC"}]';
		$array_post = $this->post_model->get_array($param_post);
		
		// rss link
		$rss_param['link'] = base_url('rss');
		
		// rss title
		$rss_param['title']  = 'Trip Domestik - RSS';
		
		// rss description
		$rss_param['description'] = 'Trip Domestik - RSS';
		
		// rss item
		$rss_param['array_item'] = $array_post;
		
		// render it
		$this->load->view( 'website/rss', $rss_param );
	}
}