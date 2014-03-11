<?php

class rss extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// advert
		$param_advert['advert_status_id'] = ADVERT_STATUS_APPROVE;
		$param_advert['sort'] = '[{"property":"post_time","direction":"DESC"}]';
		$param_advert['limit'] = 25;
		$array_advert = $this->Advert_model->get_array($param_advert);
		
		$rss_param['link'] = base_url('rss');
		$rss_param['title'] = WEBSITE_TITLE.' - RSS';
		$rss_param['array_item'] = $array_advert;
		$rss_param['description'] = $rss_param['title'];
		$this->load->view( 'website/common/rss', $rss_param );
    }
}