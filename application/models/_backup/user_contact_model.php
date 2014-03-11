<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Contact_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'user_id', 'sender_id', 'advert_id', 'name', 'email', 'phone', 'message', 'post_time', 'is_read', 'title', 'ip_address', 'city'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, USER_CONTACT);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, USER_CONTACT);
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
				SELECT UserContact.*,
					UserSender.thumbnail_profile sender_thumbnail_profile,
					Advert.id adver_id
				FROM ".USER_CONTACT." UserContact
				LEFT JOIN ".USER." UserSender ON UserSender.id = UserContact.sender_id
				LEFT JOIN ".ADVERT." Advert ON Advert.id = UserContact.advert_id
				WHERE UserContact.id = '".$param['id']."'
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
		
		$string_namelike = (!empty($param['namelike'])) ? "AND UserContact.title LIKE '%".$param['namelike']."%'" : '';
		$string_user = (!empty($param['user_id'])) ? "AND UserContact.user_id = '".$param['user_id']."'" : '';
		$string_is_read = (isset($param['is_read'])) ? "AND UserContact.is_read = '".$param['is_read']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'post_time DESC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS UserContact.*,
				UserSender.thumbnail_profile sender_thumbnail_profile,
				Advert.id adver_id
			FROM ".USER_CONTACT." UserContact
			LEFT JOIN ".USER." UserSender ON UserSender.id = UserContact.sender_id
			LEFT JOIN ".ADVERT." Advert ON Advert.id = UserContact.advert_id
			WHERE 1 $string_namelike $string_user $string_is_read $string_filter
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
	
	function get_unread_count($param = array()) {
		$result = 0;
		$select_query = "
			SELECT COUNT(*) record_count
			FROM ".USER_CONTACT." UserContact
			WHERE
				user_id = '".$param['user_id']."'
				AND is_read = '0'
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		if ( $row = mysql_fetch_assoc( $select_result ) ) {
			$result = $row['record_count'];
		}
		
		return $result;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".USER_CONTACT." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// thumbnail
		if (isset($row['sender_thumbnail_profile']) && !empty($row['sender_thumbnail_profile'])) {
			$row['sender_thumbnail_profile_link'] = base_url('static/upload/'.$row['sender_thumbnail_profile']);
		} else {
			$row['sender_thumbnail_profile_link'] = base_url('static/img/avatar.jpg');
		}
		
		// label
		$row['post_time_text'] = show_time_diff($row['post_time']);
		
		// decript email
		if (isset($row['sender_email'])) {
			$row['sender_email'] = mcrypt_decode($row['sender_email']);
		}
		
		// advert
		$row['advert_link'] = base_url('advert/'.$row['adver_id']);
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}