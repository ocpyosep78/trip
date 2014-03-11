<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ip_Log_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'ip_address', 'request_time' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, IP_LOG);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, IP_LOG);
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
            $select_query  = "SELECT * FROM ".IP_LOG." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS IpRequest.*
			FROM ".IP_LOG." IpRequest
			WHERE 1 $string_filter
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
		if (isset($param['ip_address']) && isset($param['request_time'])) {
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".IP_LOG." WHERE ip_address = '".$param['ip_address']."' AND request_time >= '".$param['request_time']."'";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".IP_LOG." WHERE id = '".$param['id']."' LIMIT 1";
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
	
	function check_request() {
		// check ip
		$is_pass = $this->Ip_Pass_model->is_pass(array( 'ip_address' => $_SERVER['REMOTE_ADDR'] ));
		if (! $is_pass) {
			$is_banned = $this->Ip_Banned_model->is_banned(array( 'ip_address' => $_SERVER['REMOTE_ADDR'] ));
			
			if ($is_banned) {
				echo 'Sorry, your request has been disabled.';
				exit;
			}
		}
		
		// log ip
		$param['ip_address'] = $_SERVER['REMOTE_ADDR'];
		$param['request_time'] = $this->config->item('current_datetime');
		$this->update($param);
		
		// get count
		$param_count['ip_address'] = $_SERVER['REMOTE_ADDR'];
		$param_count['request_time'] = date("Y-m-d H:i:s", strtotime("-1 Hours"));
		$count = $this->get_count($param_count);
		if ($count > MAXIMUM_IP_ACCESS_PER_HOUR) {
			$this->Ip_Banned_model->update(array( 'ip_address' => $_SERVER['REMOTE_ADDR'] ));
		}
	}
}