<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify_Address_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'user_id', 'request_time', 'code', 'status' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, VERIFY_ADDRESS);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, VERIFY_ADDRESS);
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
            $select_query  = "SELECT * FROM ".VERIFY_ADDRESS." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['fullname'] = 'User.first_name';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND VerifyAddress.name LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS VerifyAddress.*,
				User.first_name, User.last_name
			FROM ".VERIFY_ADDRESS." VerifyAddress
			LEFT JOIN ".USER." User ON User.id = VerifyAddress.user_id
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
		if (isset($param['user_id'])) {
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".VERIFY_ADDRESS." WHERE user_id = '".$param['user_id']."'";
		} else if (isset($param['total_verify_pending'])) {
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".VERIFY_ADDRESS." WHERE status = 'pending'";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".VERIFY_ADDRESS." WHERE id = '".$param['id']."' LIMIT 1";
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
		
		if (count(@$param['column']) > 0) {
			if (isset($param['grid_view'])) {
				if ($param['grid_view'] == 'manage_user') {
					$param['is_custom']  = '&nbsp;';
					if ($row['status'] == 'pending') {
						$param['is_custom'] = '<i class="cursor-button tool-tip fa fa-check btn-approve" title="Approve"></i> ';
					}
				}
			}
			
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function allow_request($param = array()) {
		$count = 0;
		$limit_date = date("Y-m-d", strtotime("-1 Month"));
		
        $select_query = "
			SELECT COUNT(*) count
			FROM ".VERIFY_ADDRESS." VerifyAddress
			WHERE
				request_time >= '$limit_date'
				AND user_id = '".$param['user_id']."'
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		if ( $row = mysql_fetch_assoc( $select_result ) ) {
			$count = $row['count'];
		}
		
		$result = ($count == 0) ? true : false;
        return $result;
	}
	
	function sent_code($param = array()) {
		$count = 0;
        $select_query = "
			SELECT *
			FROM ".VERIFY_ADDRESS." VerifyAddress
			WHERE
				code = '".$param['code']."'
				AND user_id = '".$param['user_id']."'
				AND status = 'deliver'
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		if ( $row = mysql_fetch_assoc( $select_result ) ) {
			$count = 1;
			$verify = $row;
		}
		
		if ($count == 0) {
            $result['status'] = 0;
            $result['message'] = 'Sorry, code did not match.';
		} else {
			// update user
			$update_user['id'] = $param['user_id'];
			$update_user['verify_address'] = 1;
			$this->User_model->update($update_user);
			
			// update verify
			$update_verify['id'] = $verify['id'];
			$update_verify['status'] = 'confirm';
			$result = $this->update($update_verify);
			$result['message'] = 'Congratulation, your address has been verify.';
		}
		
        return $result;
	}
	
}