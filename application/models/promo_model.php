<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class promo_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'post_id', 'promo_duration_id', 'title', 'content', 'keyword', 'publish_date', 'close_date', 'promo_status' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, PROMO);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, PROMO);
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
				SELECT promo.*,
					post.title post_title, promo_duration.title promo_duration_title, promo_duration.duration promo_duration,
					member.first_name member_first_name, member.last_name member_last_name, member.email member_email
				FROM ".PROMO." promo
				LEFT JOIN ".POST." post on post.id = promo.post_id
				LEFT JOIN ".PROMO_DURATION." promo_duration on promo_duration.id = promo.promo_duration_id
				LEFT JOIN ".MEMBER." member on member.id = post.member_id
				WHERE promo.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['post_id']) && isset($param['promo_status'])) {
            $select_query  = "
				SELECT promo.*,
					post.title post_title, promo_duration.title promo_duration_title, promo_duration.duration promo_duration,
					member.first_name member_first_name, member.last_name member_last_name, member.email member_email
				FROM ".PROMO." promo
				LEFT JOIN ".POST." post on post.id = promo.post_id
				LEFT JOIN ".PROMO_DURATION." promo_duration on promo_duration.id = promo.promo_duration_id
				LEFT JOIN ".MEMBER." member on member.id = post.member_id
				WHERE promo.post_id = '".$param['post_id']."'
					AND promo.promo_status = '".$param['promo_status']."'
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
		
		$param['field_replace']['post_title_text'] = 'post.title';
		$param['field_replace']['close_date_swap'] = 'promo.close_date';
		$param['field_replace']['publish_date_swap'] = 'promo.publish_date';
		$param['field_replace']['promo_duration_title_text'] = 'promo_duration.title';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND promo.title LIKE '%".$param['namelike']."%'" : '';
		$string_member = (isset($param['member_id'])) ? "AND post.member_id = '".$param['member_id']."'" : '';
		$string_close_date = (isset($param['close_date'])) ? "AND promo.close_date = '".$param['close_date']."'" : '';
		$string_between_date = (isset($param['between_date'])) ? "AND (promo.publish_date <= '".$param['between_date']."' AND promo.close_date >= '".$param['between_date']."')" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS promo.*,
				post.title post_title, member.email member_email,
				promo_duration.title promo_duration_title, promo_duration.duration promo_duration
			FROM ".PROMO." promo
			LEFT JOIN ".POST." post on post.id = promo.post_id
			LEFT JOIN ".PROMO_DURATION." promo_duration on promo_duration.id = promo.promo_duration_id
			LEFT JOIN ".MEMBER." member on member.id = post.member_id
			WHERE 1 $string_namelike $string_member $string_close_date $string_between_date $string_filter
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
		$delete_query  = "DELETE FROM ".PROMO." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'close_date' ));
		
		// language
		$row = get_row_language($row, array( 'title', 'content', 'post_title' ));
		
		// full name
		if (isset($row['member_first_name']) && isset($row['member_last_name'])) {
			$row['member_full_name'] = $row['member_first_name'].' '.$row['member_last_name'];
		}
		
		if (isset($row['publish_date'])) {
			$row['publish_date_swap'] = GetFormatDate($row['publish_date']);
		}
		if (isset($row['close_date'])) {
			$row['close_date_swap'] = GetFormatDate($row['close_date']);
		}
		
		// label
		if (isset($row['promo_duration_title']) && isset($row['promo_duration'])) {
			$row['promo_duration_title_text'] = $row['promo_duration_title'].' - '.$row['promo_duration'];
		}
		
		if (count(@$param['column']) > 0) {
			if (isset($param['grid_type']) && $param['grid_type'] == 'editor') {
                $param['is_custom']  = '<i class="cursor-button tool-tip fa fa-pencil btn-edit" title="Edit"></i> ';
				
				if (in_array($param['user_type_id'], array(USER_TYPE_ADMINISTRATOR, USER_TYPE_EDITOR)) && $row['promo_status'] == 'request approve') {
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-check btn-approve" title="Approve"></i> ';
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-times btn-reject" title="Reject"></i> ';
				}
				
                $param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-delete" title="Delete"></i> ';
			}
			
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}