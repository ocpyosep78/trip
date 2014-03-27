<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class category_facility_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'facility_id', 'category_id', 'searchable' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, CATEGORY_FACILITY);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, CATEGORY_FACILITY);
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
            $select_query  = "SELECT * FROM ".CATEGORY_FACILITY." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['category_title'] = 'category.title';
		$param['field_replace']['facility_title'] = 'facility.title';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND category.title LIKE '%".$param['namelike']."%'" : '';
		$string_category = (isset($param['category_id'])) ? "AND category_facility.category_id = '".$param['category_id']."'" : '';
		$string_searchable = (isset($param['searchable'])) ? "AND category_facility.searchable = '".$param['searchable']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'category.title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS category_facility.*,
				category.title category_title, facility.title facility_title
			FROM ".CATEGORY_FACILITY." category_facility
			LEFT JOIN ".CATEGORY." category ON category.id = category_facility.category_id
			LEFT JOIN ".FACILITY." facility ON facility.id = category_facility.facility_id
			WHERE 1 $string_namelike $string_category $string_searchable $string_filter
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
		$delete_query  = "DELETE FROM ".CATEGORY_FACILITY." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		if (isset($row['facility_title'])) {
			$temp = json_to_array($row['facility_title']);
			$row['facility_text'] = $temp[LANGUAGE_DEFAULT];
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}