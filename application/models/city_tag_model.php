<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class city_tag_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'tag_id', 'city_id' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, CITY_TAG);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, CITY_TAG);
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
            $select_query  = "SELECT * FROM ".CITY_TAG." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_category = (isset($param['city_id'])) ? "AND city_tag.city_id = '".$param['city_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS city_tag.*,
				tag.alias tag_alias, tag.title tag_title
			FROM ".CITY_TAG." city_tag
			LEFT JOIN ".TAG." tag ON tag.id = city_tag.tag_id
			WHERE 1 $string_category $string_filter
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
		if (isset($param['city_id'])) {
			$delete_query  = "DELETE FROM ".CITY_TAG." WHERE city_id = '".$param['city_id']."'";
			$delete_result = mysql_query($delete_query) or die(mysql_error());
		} else {
			$delete_query  = "DELETE FROM ".CITY_TAG." WHERE id = '".$param['id']."' LIMIT 1";
			$delete_result = mysql_query($delete_query) or die(mysql_error());
		}
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// link
		if (isset($row['tag_alias'])) {
			$row['tag_link'] = base_url('tag/'.$row['tag_alias']);
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}