<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_Sub_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'category_id', 'alias', 'name', 'link_override' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, CATEGORY_SUB);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, CATEGORY_SUB);
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
				SELECT CategorySub.*, Category.alias category_alias
				FROM ".CATEGORY_SUB." CategorySub
				LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
				WHERE CategorySub.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['category_id']) && isset($param['alias'])) {
            $select_query  = "
				SELECT CategorySub.*, Category.alias category_alias
				FROM ".CATEGORY_SUB." CategorySub
				LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
				WHERE
					CategorySub.category_id = '".$param['category_id']."'
					AND CategorySub.alias = '".$param['alias']."'
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
		
		$param['field_replace']['name'] = 'CategorySub.name';
		$param['field_replace']['alias'] = 'CategorySub.alias';
		$param['field_replace']['category_name'] = 'Category.name';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND CategorySub.name LIKE '%".$param['namelike']."%'" : '';
		$string_category = (!empty($param['category_id'])) ? "AND CategorySub.category_id = '".$param['category_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS CategorySub.*, Category.name category_name, Category.alias category_alias
			FROM ".CATEGORY_SUB." CategorySub
			LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
			WHERE 1 $string_namelike $string_category $string_filter
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
		$delete_query  = "DELETE FROM ".CATEGORY_SUB." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		$row['category_sub_link'] = base_url($row['category_alias'].'/'.$row['alias']);
		
		if (!empty($row['link_override'])) {
			$row['category_sub_link'] = $row['link_override'];
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}