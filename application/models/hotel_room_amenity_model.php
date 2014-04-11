<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class hotel_room_amenity_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'post_id', 'room_amenity_id' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, HOTEL_ROOM_AMENITY);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, HOTEL_ROOM_AMENITY);
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
            $select_query  = "SELECT * FROM ".HOTEL_ROOM_AMENITY." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['title_default'] = 'room_amenity.title';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND room_amenity.title LIKE '%".$param['namelike']."%'" : '';
		$string_post = (isset($param['post_id'])) ? "AND hotel_room_amenity.post_id = '".$param['post_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS hotel_room_amenity.*, room_amenity.title
			FROM ".HOTEL_ROOM_AMENITY." hotel_room_amenity
			LEFT JOIN ".ROOM_AMENITY." room_amenity ON room_amenity.id = hotel_room_amenity.room_amenity_id
			WHERE 1 $string_namelike $string_post $string_filter
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
		$delete_query  = "DELETE FROM ".HOTEL_ROOM_AMENITY." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// language
		$row = get_row_language($row, array( 'title' ));
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}