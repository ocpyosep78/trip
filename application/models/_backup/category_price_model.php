<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_Price_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'category_sub_id', 'price_type', 'price' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, CATEGORY_PRICE);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, CATEGORY_PRICE);
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
            $select_query  = "SELECT * FROM ".CATEGORY_PRICE." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['price_text'] = 'CategoryPrice.price';
		$param['with_default'] = (isset($param['with_default'])) ? $param['with_default'] : true;
		
		$string_price_type = (!empty($param['price_type'])) ? "AND CategoryPrice.price_type = '".$param['price_type']."'" : '';
		$string_category_sub = (isset($param['category_sub_id'])) ? "AND CategoryPrice.category_sub_id = '".$param['category_sub_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'price ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS CategoryPrice.*
			FROM ".CATEGORY_PRICE." CategoryPrice
			WHERE 1 $string_price_type $string_category_sub $string_filter
			ORDER BY $string_sorting
			LIMIT $string_limit
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array[] = $this->sync($row, $param);
		}
		
		
		if ($param['with_default'] && count($array) == 0 && $param['price_type'] == 1) {
			foreach (array(100000, 500000, 1000000, 5000000, 10000000, 50000000) as $key => $value) {
				$array[] = array( 'id' => $key + 1, 'category_sub_id' => 0, 'price_type' => 1, 'price' => $value, 'price_text' => MoneyFormat($value) );
			}
		} else if ($param['with_default'] && count($array) == 0 && $param['price_type'] == 2) {
			foreach (array(500000, 1000000, 5000000, 10000000, 50000000, 100000000) as $key => $value) {
				$array[] = array( 'id' => $key + 1, 'category_sub_id' => 0, 'price_type' => 1, 'price' => $value, 'price_text' => MoneyFormat($value) );
			}
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
		$delete_query  = "DELETE FROM ".CATEGORY_PRICE." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		$row['price_text'] = MoneyFormat($row['price']);
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}