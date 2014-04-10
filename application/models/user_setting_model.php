<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_setting_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'member_id', 'traveler_id', 'email_notify' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, USER_SETTING);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, USER_SETTING);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
       
        return $result;
    }

	function update_by_user($param) {
		if (!empty($param['member_id'])) {
			$record = $this->get_by_id(array( 'member_id' => $param['member_id'] ));
		} else if (!empty($param['traveler_id'])) {
			$record = $this->get_by_id(array( 'traveler_id' => $param['traveler_id'] ));
		}
		
		if (count($record) == 0) {
			$result = $this->update($param);
		} else {
			$param_update['id'] = $record['id'];
			$param_update['email_notify'] = $param['email_notify'];
			$result = $this->update($param_update);
		}
		
		return $result;
	}
	
    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "SELECT * FROM ".USER_SETTING." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['member_id'])) {
            $select_query  = "SELECT * FROM ".USER_SETTING." WHERE member_id = '".$param['member_id']."' LIMIT 1";
        } else if (isset($param['traveler_id'])) {
            $select_query  = "SELECT * FROM ".USER_SETTING." WHERE traveler_id = '".$param['traveler_id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_namelike = (!empty($param['namelike'])) ? "AND user_setting.name LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS user_setting.*
			FROM ".USER_SETTING." user_setting
			WHERE 1 $string_namelike $string_filter
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
		$delete_query  = "DELETE FROM ".USER_SETTING." WHERE id = '".$param['id']."' LIMIT 1";
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