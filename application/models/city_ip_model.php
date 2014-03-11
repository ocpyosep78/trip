<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class city_ip_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'ip', 'name', 'content' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, CITY_IP);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, CITY_IP);
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
            $select_query  = "SELECT * FROM ".CITY_IP." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['ip'])) {
            $select_query  = "SELECT * FROM ".CITY_IP." WHERE ip = '".$param['ip']."' LIMIT 1";
        }
		
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_namelike = (!empty($param['namelike'])) ? "AND CityIp.name LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS CityIp.*
			FROM ".CITY_IP." CityIp
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
	
	function get_location($param = array()) {
		if ($param['ip'] == '::1') {
			return 'localhost';
		}
		
		$result = '';
		$record = $this->get_by_id(array( 'ip' => $param['ip'] ));
		if (count($record) == 0) {
			$link_source_ip = 'http://ipinfo.io/'.$param['ip'].'/json';
			$curl = new curl();
			$ip_record_raw = $curl->get($link_source_ip);
			
			// make sure no empty result
			if (!empty($ip_record_raw)) {
				$ip_record = json_decode($ip_record_raw);
				
				$result = '';
				if (!empty($ip_record->city)) {
					$result = $ip_record->city;
				} else if (!empty($ip_record->org)) {
					$result = $ip_record->org;
				} else if (!empty($ip_record->country)) {
					$result = $ip_record->country;
				}
			}
			
			// insert to db
			if (!empty($result)) {
				$param_update['ip'] = $param['ip'];
				$param_update['name'] = $result;
				$param_update['content'] = $ip_record_raw;
				$this->update($param_update);
			}
		} else {
			$result = $record['name'];
		}
		
		return $result;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".CITY_IP." WHERE id = '".$param['id']."' LIMIT 1";
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