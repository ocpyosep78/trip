<?php

class selector extends KEDAI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$array_segment = $this->uri->segments;
		$category = $category_sub = $region = $city = $page_static = $user = array();
		
		// cheking
		foreach ($array_segment as $alias) {
			// category
			$check = $this->Category_model->get_by_id(array( 'alias' => $alias ));
			if (count($check) > 0) {
				$category = $check;
				continue;
			}
			
			// category sub
			if (count($category) > 0) {
				$check = $this->Category_Sub_model->get_by_id(array( 'category_id' => $category['id'], 'alias' => $alias ));
				if (count($check) > 0) {
					$category_sub = $check;
					continue;
				}
			}
			
			// region
			$check = $this->Region_model->get_by_id(array( 'alias' => $alias ));
			if (count($check) > 0) {
				$region = $check;
				continue;
			}
			
			// city
			if (count($region) > 0) {
				$check = $this->City_model->get_by_id(array( 'region_id' => $region['id'], 'alias' => $alias ));
				if (count($check) > 0) {
					$city = $check;
					continue;
				}
			}
			
			// page static
			$check = $this->Page_Static_model->get_by_id(array( 'alias' => $alias ));
			if (count($check) > 0) {
				$page_static = $check;
				continue;
			}
			
			// user
			$check = $this->User_model->get_by_id(array( 'alias' => $alias ));
			if (count($check) > 0) {
				$user = $check;
				continue;
			}
		}
		
		if (count($category) > 0) {
			if (count($category_sub) > 0) {
				$array_view['category'] = $category;
				$array_view['category_sub'] = $category_sub;
				$this->load->view( 'website/category_sub_list', $array_view );
			} else {
				$array_view['category'] = $category;
				$this->load->view( 'website/category_list', $array_view );
			}
		} else if (count($region) > 0) {
			if (count($city) > 0) {
				$array_view['city'] = $city;
				$array_view['region'] = $region;
				$this->load->view( 'website/region_city_list', $array_view );
			} else {
				$array_view['region'] = $region;
				$this->load->view( 'website/region_list', $array_view );
			}
		} else if (count($page_static) > 0) {
			$array_view['page_static'] = $page_static;
			$this->load->view( 'website/page_static', $array_view );
		} else if (count($user) > 0) {
			$this->load->view( 'website/user' );
		} else {
			$this->load->view( 'website/home' );
		}
    }
}