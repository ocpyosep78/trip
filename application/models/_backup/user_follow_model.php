<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Follow_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'user_id', 'follow_id', 'follow_time' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, USER_FOLLOW);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, USER_FOLLOW);
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
            $select_query  = "SELECT * FROM ".USER_FOLLOW." WHERE id = '".$param['id']."' LIMIT 1";
        } else if (isset($param['user_id']) && isset($param['follow_id'])) {
            $select_query  = "SELECT * FROM ".USER_FOLLOW." WHERE user_id = '".$param['user_id']."' AND follow_id = '".$param['follow_id']."' LIMIT 1";
        }
		
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_namelike = (!empty($param['namelike'])) ? "AND UserFollow.name LIKE '%".$param['namelike']."%'" : '';
		$string_user = (isset($param['user_id'])) ? "AND UserFollow.user_id = '".$param['user_id']."'" : '';
		$string_follow = (isset($param['follow_id'])) ? "AND UserFollow.follow_id = '".$param['follow_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'follow_time ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS UserFollow.*,
				User.email, User.first_name, User.last_name
			FROM ".USER_FOLLOW." UserFollow
			LEFT JOIN ".USER." User ON User.id = UserFollow.user_id
			WHERE 1 $string_namelike $string_user $string_follow $string_filter
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
	
    function get_detail($param = array()) {
		$select_query = "
			SELECT
				(SELECT COUNT(*) FROM ".USER_FOLLOW." WHERE follow_id = '".$param['user_id']."') follower,
				(SELECT COUNT(*) FROM ".USER_FOLLOW." WHERE user_id = '".$param['user_id']."') following,
				(SELECT COUNT(*) FROM ".ADVERT." WHERE user_id = '".$param['user_id']."') advert
		";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$result = mysql_fetch_assoc($select_result);
		
		return $result;
    }
	
    function delete($param) {
		if (isset($param['user_id']) && isset($param['follow_id'])) {
			$delete_query  = "DELETE FROM ".USER_FOLLOW." WHERE user_id = '".$param['user_id']."' AND follow_id = '".$param['follow_id']."'";
		} else {
			$delete_query  = "DELETE FROM ".USER_FOLLOW." WHERE id = '".$param['id']."' LIMIT 1";
		}
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// fullname
		if (isset($row['first_name']) && isset($row['last_name'])) {
			$row['fullname'] = $row['first_name'].' '.$row['last_name'];
		}
		
		// decript email
		if (isset($row['email'])) {
			$row['email'] = mcrypt_decode($row['email']);
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function is_follow($param) {
		$check_follow = $this->User_Follow_model->get_by_id(array( 'user_id' => $param['user_id'], 'follow_id' => $param['follow_id'] ));
		$result = (count($check_follow) > 0) ? true : false;
		
		return $result;
	}
}