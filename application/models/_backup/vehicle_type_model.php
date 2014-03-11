<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle_Type_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'vehicle_brand_id', 'name', 'alias' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, VEHICLE_TYPE);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, VEHICLE_TYPE);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
       
        return $result;
    }

    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "
				SELECT VehicleType.*, VehicleBrand.name vehicle_brand_name
				FROM ".VEHICLE_TYPE." VehicleType
				LEFT JOIN ".VEHICLE_BRAND." VehicleBrand ON VehicleBrand.id = VehicleType.vehicle_brand_id
				WHERE VehicleType.id = '".$param['id']."'
				LIMIT 1
			";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['name'] = 'VehicleType.name';
		$param['field_replace']['alias'] = 'VehicleType.alias';
		$param['field_replace']['vehicle_brand_name'] = 'VehicleBrand.name';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND VehicleType.name LIKE '%".$param['namelike']."%'" : '';
		$string_brand = (isset($param['vehicle_brand_id'])) ? "AND VehicleType.vehicle_brand_id = '".$param['vehicle_brand_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS VehicleType.*, VehicleBrand.name vehicle_brand_name
			FROM ".VEHICLE_TYPE." VehicleType
			LEFT JOIN ".VEHICLE_BRAND." VehicleBrand ON VehicleBrand.id = VehicleType.vehicle_brand_id
			WHERE 1 $string_namelike $string_brand $string_filter
			ORDER BY $string_sorting
			LIMIT $string_limit
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array[] = $this->sync($row, $param);
		}
		
        return $array;
    }

    function get_count($param = array()) {
		$select_query = "SELECT FOUND_ROWS() TotalRecord";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".VEHICLE_TYPE." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}