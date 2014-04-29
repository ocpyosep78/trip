<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class city_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'region_id', 'alias', 'title', 'content' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, CITY);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, CITY);
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
				SELECT city.*,
					region.title region_title, region.alias region_alias,
					country.id country_id, country.title country_title, country.alias country_alias
				FROM ".CITY." city
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
				WHERE city.id = '".$param['id']."'
				LIMIT 1
			";
		} else if (isset($param['alias']) && isset($param['region_id'])) {
            $select_query  = "
				SELECT city.*,
					region.title region_title, region.alias region_alias,
					country.id country_id, country.title country_title, country.alias country_alias
				FROM ".CITY." city
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
				WHERE
					city.alias = '".$param['alias']."'
					AND city.region_id = '".$param['region_id']."'
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
		
		$param['field_replace']['alias'] = 'city.alias';
		$param['field_replace']['title'] = 'city.title';
		$param['field_replace']['region_title'] = 'region.title';
		$param['field_replace']['country_title'] = 'country.title';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND city.title LIKE '%".$param['namelike']."%'" : '';
		$string_region = (isset($param['region_id'])) ? "AND city.region_id = '".$param['region_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS city.*,
				region.title region_title, region.alias region_alias,
				country.title country_title, country.alias country_alias
			FROM ".CITY." city
			LEFT JOIN ".REGION." region ON region.id = city.region_id
			LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
			WHERE 1 $string_namelike $string_region $string_filter
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
		$delete_query  = "DELETE FROM ".CITY." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		if (isset($row['region_alias']) && isset($row['alias'])) {
			$row['city_link'] = base_url($row['region_alias'].'/'.$row['alias']);
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}