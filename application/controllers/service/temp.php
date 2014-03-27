<?php
class temp extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		/*
		$array_country = $this->country_model->get_array();
		foreach ($array_country as $row) {
			$param_update['id'] = $row['id'];
			$param_update['alias'] = get_name($row['title']);
			$this->country_model->update($param_update);
		}
		/*	*/
		
		/*
		$array_region = $this->region_model->get_array(array( 'limit' => 1500 ));
		foreach ($array_region as $row) {
			$param_update['id'] = $row['id'];
			$param_update['alias'] = get_name($row['title']);
			$this->region_model->update($param_update);
		}
		/*	*/
		
		/*
		$array_city = $this->city_model->get_array(array( 'limit' => 5000 ));
		foreach ($array_city as $row) {
			$param_update['id'] = $row['id'];
			$param_update['alias'] = get_name($row['title']);
			$this->city_model->update($param_update);
		}
		/*	*/
    }
}