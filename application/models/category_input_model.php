<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_Input_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'parent_id', 'input_type_id', 'advert_type_sub_id', 'title', 'label', 'is_required', 'is_searchable', 'max_length', 'value', 'order_no',
			'is_numeric', 'is_letter', 'no_uppercase', 'no_special_char'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, CATEGORY_INPUT);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, CATEGORY_INPUT);
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
				SELECT CategoryInput.*, CategoryParent.title parent_title
				FROM ".CATEGORY_INPUT." CategoryInput
				LEFT JOIN ".CATEGORY_INPUT." CategoryParent ON CategoryParent.id = CategoryInput.parent_id
				WHERE CategoryInput.id = '".$param['id']."'
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
		$param['advert_type_sub_id'] = (isset($param['advert_type_sub_id'])) ? $param['advert_type_sub_id'] : 0;
		
		$string_namelike = (!empty($param['namelike'])) ? "AND CategoryInput.label LIKE '%".$param['namelike']."%'" : '';
		$string_parent = (isset($param['parent_id'])) ? "AND CategoryInput.parent_id = '".$param['parent_id']."'" : '';
		$string_searchable = (isset($param['is_searchable'])) ? "AND CategoryInput.is_searchable = '".$param['is_searchable']."'" : '';
		$string_advert_type_sub = "AND CategoryInput.advert_type_sub_id = '".$param['advert_type_sub_id']."'";
		
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'order_no ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS CategoryInput.*, InputType.name input_type_name
			FROM ".CATEGORY_INPUT." CategoryInput
			LEFT JOIN ".INPUT_TYPE." InputType ON InputType.id = CategoryInput.input_type_id
			WHERE 1 $string_namelike $string_parent $string_searchable $string_advert_type_sub $string_filter
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
	
	function get_tree($param = array()) {
		$param['parent_id'] = (isset($param['parent_id'])) ? $param['parent_id'] : 0;
		
		$result = array();
		$array_input = $this->get_array($param);
		foreach ($array_input as $key => $row) {
			$param_child['parent_id'] = $row['id'];
			$param_child['advert_type_sub_id'] = $param['advert_type_sub_id'];
			$array_child = $this->get_tree($param_child);
			
			$array = array(
				'id' => $row['id'],
				'label' => $row['label'],
				'title' => $row['title'],
				'value' => $row['value'],
				'max_length' => $row['max_length'],
				'is_required' => $row['is_required'],
				'is_numeric' => $row['is_numeric'],
				'is_letter' => $row['is_letter'],
				'no_uppercase' => $row['no_uppercase'],
				'no_special_char' => $row['no_special_char'],
				'input_type_name' => $row['input_type_name']
			);
			if (count($array_child) > 0) {
				$array['child'] = $array_child;
			}
			$result[] = $array;
		}
		
		return $result;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".CATEGORY_INPUT." WHERE id = '".$param['id']."' LIMIT 1";
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