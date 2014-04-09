<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_membership_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'member_id', 'membership_id', 'request_time', 'status' );
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
				SELECT user_membership.*, membership.duration_time,
					member.email, member.first_name, member.last_name, member.membership_date member_membership_date
				FROM ".USER_MEMBERSHIP." user_membership
				LEFT JOIN ".MEMBER." member ON member.id = user_membership.member_id
				LEFT JOIN ".MEMBERSHIP." membership ON membership.id = user_membership.membership_id
				WHERE user_membership.id = '".$param['id']."'
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
		
		$string_namelike = (!empty($param['namelike'])) ? "AND user_membership.name LIKE '%".$param['namelike']."%'" : '';
		$string_user = (isset($param['user_id'])) ? "AND user_membership.user_id = '".$param['user_id']."'" : '';
		$string_status = (isset($param['status'])) ? "AND user_membership.status = '".$param['status']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'request_time DESC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS
				user_membership.*, membership.title membership_title, membership.duration_time,
				member.email, member.first_name, member.last_name, member.membership_date member_membership_date
			FROM ".USER_MEMBERSHIP." user_membership
			LEFT JOIN ".MEMBER." member ON member.id = user_membership.member_id
			LEFT JOIN ".MEMBERSHIP." membership ON membership.id = user_membership.membership_id
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
		$select_query = "SELECT FOUND_ROWS() total";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$total = $row['total'];
		
		return $total;
    }
	
    function delete($param) {
		if (isset($param['member_id']) && isset($param['status'])) {
			$delete_query  = "DELETE FROM ".USER_MEMBERSHIP." WHERE member_id = '".$param['member_id']."' AND status = '".$param['status']."'";
		} else {
			$delete_query  = "DELETE FROM ".USER_MEMBERSHIP." WHERE id = '".$param['id']."' LIMIT 1";
		}
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'member_membership_date' ));
		
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
		$member = $this->member_model->get_by_id(array( 'id' => $param['member_id'] ));
		$membership = $this->membership_model->get_by_id(array( 'id' => $param['membership_id'] ));
		
		// member id
		$param_update['id'] = $param['member_id'];
		
		// add membership date
		if (empty($member['membership_date'])) {
			$start_date = date("Y-m-d");
		} else if (ConvertToUnixTime(date("Y-m-d")) > ConvertToUnixTime($member['membership_date'])) {
			$start_date = date("Y-m-d");
		} else {
			$start_date = $member['membership_date'];
		}
		$membership_date = date("Y-m-d", strtotime($start_date . ' + '.$membership['duration_time']));
		$param_update['membership_date'] = $membership_date;
		
		// execute
		$this->member_model->update($param_update);
	}
	
	function has_request($param = array()) {
		$param_membership['member_id'] = $param['member_id'];
		$param_membership['status'] = 'pending';
		$array_membership = $this->get_array($param_membership);
		
		$result['status'] = (count($array_membership) > 0) ? true : false;
		if ($result['status']) {
			$result['array'] = $array_membership[0];
		}
		return $result;
	}
}