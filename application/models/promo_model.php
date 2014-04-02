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
					post.title post_title, promo_duration.title promo_duration_title, promo_duration.duration promo_duration
				FROM ".PROMO." promo
				LEFT JOIN ".POST." post on post.id = promo.post_id
				LEFT JOIN ".PROMO_DURATION." promo_duration on promo_duration.id = promo.promo_duration_id
				WHERE promo.id = '".$param['id']."'
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
		$param['field_replace']['promo_duration_title'] = 'promo_duration.title';
		$param['field_replace']['publish_date_swap'] = '';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND promo.title LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS promo.*,
				post.title post_title, promo_duration.title promo_duration_title
			FROM ".PROMO." promo
			LEFT JOIN ".POST." post on post.id = promo.post_id
			LEFT JOIN ".PROMO_DURATION." promo_duration on promo_duration.id = promo.promo_duration_id
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
		$delete_query  = "DELETE FROM ".PROMO." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'close_date' ));
		
		if (isset($row['post_title'])) {
			$temp = json_to_array($row['post_title']);
			$row['post_title_text'] = (isset($temp[LANGUAGE_DEFAULT])) ? $temp[LANGUAGE_DEFAULT] : '';
		}
		if (isset($row['publish_date'])) {
			$row['publish_date_swap'] = GetFormatDate($row['publish_date']);
		}
		
		if (count(@$param['column']) > 0) {
			if (isset($param['grid_type']) && $param['grid_type'] == 'editor') {
                $param['is_custom']  = '<i class="cursor-button tool-tip fa fa-pencil btn-edit" title="Edit"></i> ';
				
				if ($row['promo_status'] == 'request approve') {
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