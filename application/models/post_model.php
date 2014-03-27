<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'city_id', 'member_id', 'category_sub_id', 'alias', 'title', 'address', 'desc_01', 'desc_02', 'desc_03', 'field_01', 'map', 'star', 'post_status'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, POST);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, POST);
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
				SELECT post.*,
					category_sub.title category_sub_title, category.id category_id, category.title category_title,
					city.region_id, region.country_id
				FROM ".POST." post
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				LEFT JOIN ".CITY." city ON city.id = post.city_id
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
				WHERE post.id = '".$param['id']."'
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
		
		$param['field_replace']['alias'] = 'post.alias';
		$param['field_replace']['title_text'] = 'post.title';
		$param['field_replace']['category_title'] = 'category.title';
		$param['field_replace']['category_sub_title'] = 'category_sub.title';
		
		$string_category = (isset($param['category_id'])) ? "AND category_sub.category_id = '".$param['category_id']."'" : '';
		$string_category_not_in = (isset($param['category_not_in'])) ? "AND category_sub.category_id NOT IN (".$param['category_not_in'].")" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS post.*,
				category_sub.title category_sub_title, category.id category_id, category.title category_title,
				city.region_id, region.country_id
			FROM ".POST." post
			LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
			LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
			LEFT JOIN ".CITY." city ON city.id = post.city_id
			LEFT JOIN ".REGION." region ON region.id = city.region_id
			LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
			WHERE 1 $string_category $string_category_not_in $string_filter
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
		$param['query'] = (isset($param['query'])) ? $param['query'] : false;
		if ($param['query']) {
			$string_category = (isset($param['category_id'])) ? "AND category_sub.category_id = '".$param['category_id']."'" : '';
			
			$select_query = "
				SELECT COUNT(*) total
				FROM ".POST." post
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				WHERE 1 $string_category
			";
		} else {
			$select_query = "SELECT FOUND_ROWS() total";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		
		$row = mysql_fetch_assoc($select_result);
		$total = $row['total'];
		
		return $total;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".POST." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		if (isset($row['title'])) {
			$temp = json_to_array($row['title']);
			$row['title_text'] = $temp[LANGUAGE_DEFAULT];
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}