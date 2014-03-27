<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hotel_star_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	
    function get_array($param = array()) {
        $array = array(
			array( 'id' => 1, 'title' => '1 Star' ),
			array( 'id' => 2, 'title' => '2 Star' ),
			array( 'id' => 3, 'title' => '3 Star' ),
			array( 'id' => 4, 'title' => '4 Star' ),
			array( 'id' => 4, 'title' => '5 Star' )
		);
		
        return $array;
    }
}