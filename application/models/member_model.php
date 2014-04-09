<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'city_id', 'email', 'alias', 'first_name', 'last_name', 'passwd', 'passwd_reset_key', 'address', 'phone', 'postal_code',
			'user_about', 'user_info', 'register_date', 'membership_date', 'verify_email', 'verify_email_key', 'verify_address', 'thumbnail',
			'provider', 'is_active', 'bb_pin'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, MEMBER);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, MEMBER);
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
				SELECT member.*,
					region.id region_id, region.country_id
				FROM ".MEMBER." member
				LEFT JOIN ".CITY." city on city.id = member.city_id
				LEFT JOIN ".REGION." region on region.id = city.region_id
				LEFT JOIN ".COUNTRY." country on country.id = region.country_id
				WHERE member.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['email'])) {
            $select_query  = "
				SELECT member.*
				FROM ".MEMBER." member
				WHERE member.email = '".$param['email']."'
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
		
		$string_namelike = (!empty($param['namelike'])) ? "AND (member.first_name LIKE '%".$param['namelike']."%' OR member.last_name LIKE '%".$param['namelike']."%')" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'member.first_name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS member.*
			FROM ".MEMBER." member
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
		$param['query'] = (isset($param['query'])) ? $param['query'] : false;
		if ($param['query']) {
			$select_query = "SELECT COUNT(*) total FROM ".MEMBER;
		} else {
			$select_query = "SELECT FOUND_ROWS() total";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$total = $row['total'];
		
		return $total;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".MEMBER." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'membership_date' ));
		
		// user type
		$row['user_type_id'] = USER_TYPE_MEMBER;
		$row['user_type_title'] = 'Member';
		
		// thumbnail
		$row['thumbnail_link'] = base_url('static/img/avatar.jpg');
		if (isset($row['thumbnail'])) {
			$file_path = $this->config->item('base_path').'/static/upload/'.$row['thumbnail'];
			if (file_exists($file_path) && isset($row['thumbnail']) && !empty($row['thumbnail'])) {
				$row['thumbnail_link'] = base_url('static/upload/'.$row['thumbnail']);
			}
		}
		
		if (isset($row['first_name']) && isset($row['last_name'])) {
			$row['full_name'] = $row['first_name'].' '.$row['last_name'];
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function sign_in($param = array()) {
		$member = $this->get_by_id(array( 'email' => $param['email'], 'with_passwd' => true ));
		
		$result = array( 'status' => false, 'message' => '' );
		if (count($member) == 0) {
			$result['message'] = 'Sorry, Email cannot be found.';
		} else if ($member['is_active'] == 0) {
			$result['message'] = 'Sorry, your user is inactive';
		} else if ($member['passwd'] != EncriptPassword($param['passwd'])) {
			$result['message'] = 'Sorry, password did not match.';
		} else if ($member['passwd'] == EncriptPassword($param['passwd'])) {
			// update last login
			$param['member_id'] = $member['id'];
			$param['log_time'] = $this->config->item('current_datetime');
			$param['ip_remote'] = $_SERVER['REMOTE_ADDR'];
			$param['location'] = $this->city_ip_model->get_location(array( 'ip' => $_SERVER['REMOTE_ADDR'] ));
			$result = $this->user_log_model->update($param);
			
			// set session
			$member['user_type_id'] = USER_TYPE_MEMBER;
			$this->user_model->set_session($member);
			
			// set result
			$result['status'] = true;
			$result['redirect_link'] = base_url('panel');
		}
		
		return $result;
	}
}