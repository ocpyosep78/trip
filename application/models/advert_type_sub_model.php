<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advert_Type_Sub_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'advert_type_id', 'category_sub_id' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, ADVERT_TYPE_SUB);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, ADVERT_TYPE_SUB);
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
				SELECT AdvertTypeSub.*,
					AdvertType.name advert_type_name,
					Category.name category_name, Category.id category_id,
					CategorySub.name category_sub_name, CategorySub.id category_sub_id
				FROM ".ADVERT_TYPE_SUB." AdvertTypeSub
				LEFT JOIN ".ADVERT_TYPE." AdvertType ON AdvertType.id = AdvertTypeSub.advert_type_id
				LEFT JOIN ".CATEGORY_SUB." CategorySub ON CategorySub.id = AdvertTypeSub.category_sub_id
				LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
				WHERE AdvertTypeSub.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['advert_type_id']) && isset($param['category_sub_id'])) {
			$select_query  = "
				SELECT AdvertTypeSub.*
				FROM ".ADVERT_TYPE_SUB." AdvertTypeSub
				WHERE
					AdvertTypeSub.advert_type_id = '".$param['advert_type_id']."'
					AND AdvertTypeSub.category_sub_id = '".$param['category_sub_id']."'
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
		
		$param['field_replace']['category_name'] = 'Category.name';
		$param['field_replace']['advert_type_name'] = 'AdvertType.name';
		$param['field_replace']['category_sub_name'] = 'CategorySub.name';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND AdvertTypeSub.name LIKE '%".$param['namelike']."%'" : '';
		$string_category_sub = (isset($param['category_sub_id'])) ? "AND AdvertTypeSub.category_sub_id = '".$param['category_sub_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'AdvertType.name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS AdvertTypeSub.*,
				AdvertType.name advert_type_name,
				Category.name category_name, Category.id category_id,
				CategorySub.name category_sub_name, CategorySub.id category_sub_id
			FROM ".ADVERT_TYPE_SUB." AdvertTypeSub
			LEFT JOIN ".ADVERT_TYPE." AdvertType ON AdvertType.id = AdvertTypeSub.advert_type_id
			LEFT JOIN ".CATEGORY_SUB." CategorySub ON CategorySub.id = AdvertTypeSub.category_sub_id
			LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
			WHERE 1 $string_namelike $string_category_sub $string_filter
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
		$delete_query  = "DELETE FROM ".ADVERT_TYPE_SUB." WHERE id = '".$param['id']."' LIMIT 1";
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