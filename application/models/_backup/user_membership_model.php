<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Membership_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'user_id', 'membership_id', 'request_time', 'status' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, USER_MEMBERSHIP);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, USER_MEMBERSHIP);
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
				SELECT SQL_CALC_FOUND_ROWS UserMembership.*,
					User.email, User.first_name, User.last_name, User.advert_count user_advert_count, User.membership_date user_membership_date,
					Membership.advert_count, Membership.advert_time
				FROM ".USER_MEMBERSHIP." UserMembership
				LEFT JOIN ".USER." User ON User.id = UserMembership.user_id
				LEFT JOIN ".MEMBERSHIP." Membership ON Membership.id = UserMembership.membership_id
				WHERE UserMembership.id = '".$param['id']."'
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
		
		$string_namelike = (!empty($param['namelike'])) ? "AND UserMembership.name LIKE '%".$param['namelike']."%'" : '';
		$string_user = (isset($param['user_id'])) ? "AND UserMembership.user_id = '".$param['user_id']."'" : '';
		$string_status = (isset($param['status'])) ? "AND UserMembership.status = '".$param['status']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'request_time DESC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS UserMembership.*,
				User.email, User.first_name, User.last_name,
				Membership.advert_count, Membership.advert_time, Membership.title
			FROM ".USER_MEMBERSHIP." UserMembership
			LEFT JOIN ".USER." User ON User.id = UserMembership.user_id
			LEFT JOIN ".MEMBERSHIP." Membership ON Membership.id = UserMembership.membership_id
			WHERE 1 $string_namelike $string_user $string_status $string_filter
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
		if (isset($param['user_id']) && isset($param['status'])) {
			$delete_query  = "DELETE FROM ".USER_MEMBERSHIP." WHERE user_id = '".$param['user_id']."' AND status = '".$param['status']."'";
		} else {
			$delete_query  = "DELETE FROM ".USER_MEMBERSHIP." WHERE id = '".$param['id']."' LIMIT 1";
		}
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'user_membership_date' ));
		
		// decript email
		if (isset($row['email'])) {
			$row['email'] = mcrypt_decode($row['email']);
		}
		
		if (count(@$param['column']) > 0) {
			// user membership
			if (isset($param['user_membership']) && $param['user_membership']) {
				if ($row['status'] == 'pending') {
					$param['is_custom']  = '<i class="cursor-button tool-tip fa fa-check btn-approve" title="Approve"></i> ';
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-reject" title="Reject"></i> ';
				} else {
					$param['is_custom']  = '&nbsp;';
				}
			}
			
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function renew_membership($param) {
		$user = $this->User_model->get_by_id(array( 'id' => $param['user_id'] ));
		$membership = $this->Membership_model->get_by_id(array( 'id' => $param['membership_id'] ));
		
		// user id
		$param_update['id'] = $param['user_id'];
		
		// add advert count
		$param_update['advert_count'] = $user['advert_count'] + $membership['advert_count'];
		
		// add membership date
		if (empty($user['membership_date'])) {
			$start_date = date("Y-m-d");
		} else if (ConvertToUnixTime(date("Y-m-d")) > ConvertToUnixTime($user['membership_date'])) {
			$start_date = date("Y-m-d");
		} else {
			$start_date = $user['membership_date'];
		}
		$membership_date = date("Y-m-d", strtotime($start_date . ' + '.$membership['advert_time']));
		$param_update['membership_date'] = $membership_date;
		
		// execute
		$this->User_model->update($param_update);
	}
	
	function has_request($param = array()) {
		$param_membership['user_id'] = $param['user_id'];
		$param_membership['status'] = 'pending';
		$array_membership = $this->get_array($param_membership);
		
		$result['status'] = (count($array_membership) > 0) ? true : false;
		if ($result['status']) {
			$result['array'] = $array_membership[0];
		}
		return $result;
	}
}