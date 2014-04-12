<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_facility_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'post_id', 'facility_id' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, POST_FACILITY);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, POST_FACILITY);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
		
		// update post detail
		$this->update_facility($param);
		
        return $result;
    }

	function update_facility($param = array()) {
		$string_facility = '';
		$array_facility = $this->get_array(array( 'post_id' => $param['post_id'] ));
		foreach ($array_facility as $row) {
			$string_facility .= (empty($string_facility)) ? ';'.$row['facility_id'].';' : $row['facility_id'].';';
		}
		
		$param_update = array( 'id' => $param['post_id'], 'facility' => $string_facility );
		$this->post_model->update($param_update);
	}
	
    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "SELECT * FROM ".POST_FACILITY." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['facility_title_text'] = 'facility.title';
		
		$string_post = (isset($param['post_id'])) ? "AND post_facility.post_id = '".$param['post_id']."'" : '';
		$string_namelike = (!empty($param['namelike'])) ? "AND post_facility.name LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'facility.title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS post_facility.*,
				facility.title facility_title, facility.css_icon facility_css_icon
			FROM ".POST_FACILITY." post_facility
			LEFT JOIN ".FACILITY." facility ON facility.id = post_facility.facility_id
			WHERE 1 $string_post $string_namelike $string_filter
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
		// record
		$record = $this->get_by_id($param);
		
		// delete it
		$delete_query  = "DELETE FROM ".POST_FACILITY." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		// update post detail
		$this->update_facility(array( 'post_id' => $record['post_id'] ));
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		if (isset($row['facility_title'])) {
			$temp = json_to_array($row['facility_title']);
			$row['facility_title_text'] = $temp[LANGUAGE_DEFAULT];
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}