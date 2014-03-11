<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class input_car {
    function __construct() {
		$this->ci =& get_instance();
    }
	
    function get_entry() {
		$array_vehicle_brand = $this->ci->Vehicle_Brand_model->get_array();
		
		$content = '
			<section>
				<label class="label">Vehicle Brand</label>
				<label class="select">
					<select name="vehicle_brand_id" required>
						'.ShowOption(array( 'Array' => $array_vehicle_brand, 'ArrayID' => 'id', 'ArrayTitle' => 'name' )).'
					</select>
					<i></i>
				</label>
			</section>
			<section>
				<label class="label">Vehicle Type</label>
				<label class="select">
					<select name="vehicle_type_id" required>
						<option>-</option>
					</select>
					<i></i>
				</label>
			</section>
		';
		
		return $content;
    }
	
	function get_display($param) {
		$vehicle_brand = $this->ci->Vehicle_Brand_model->get_by_id(array( 'id' => $_POST['vehicle_brand_id'] ));
		$vehicle_type = $this->ci->Vehicle_Type_model->get_by_id(array( 'id' => $_POST['vehicle_type_id'] ));
		
		$content = '
			<div style="margin: 8px 0;">Vehicle Brand : '.$vehicle_brand['name'].'</div>
			<div style="margin: 8px 0;">Vehicle Type : '.$vehicle_type['name'].'</div>
		';
		
		return $content;
	}
	
	function get_search($param = array()) {
		$array_vehicle_brand = $this->ci->Vehicle_Brand_model->get_array();
		$array_vehicle_type = $this->ci->Vehicle_Type_model->get_array(array( 'vehicle_brand_id' => @$param['vehicle_brand_id'] ));
		
		$content = '
			<div class="limit category-input-search">
				<span>Vehicle Type:</span>
				<select name="vehicle_type_id" class="form_submit input">
					'.ShowOption(array( 'Array' => $array_vehicle_type, 'ArrayID' => 'id', 'ArrayTitle' => 'name', 'LabelEmptySelect' => 'All Type', 'Selected' => @$param['vehicle_type_id'] )).'
				</select>
			</div>
			<div class="limit category-input-search">
				<span>Vehicle Brand:</span>
				<select name="vehicle_brand_id" class="input">
					'.ShowOption(array( 'Array' => $array_vehicle_brand, 'ArrayID' => 'id', 'ArrayTitle' => 'name', 'LabelEmptySelect' => 'All Brand', 'Selected' => @$param['vehicle_brand_id'] )).'
				</select>
			</div>
		';
		
		return $content;
	}
}