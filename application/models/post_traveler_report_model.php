<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_traveler_report_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'post_traveler_photo_id', 'name', 'email', 'topic', 'content', 'post_date', 'status' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, POST_TRAVELER_REPORT);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, POST_TRAVELER_REPORT);
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
				SELECT post_traveler_report.*
				FROM ".POST_TRAVELER_REPORT." post_traveler_report
				WHERE post_traveler_report.id = '".$param['id']."'
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
		
		$string_namelike = (!empty($param['namelike'])) ? "AND post_traveler_report.topic LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'topic ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS post_traveler_report.*,
				post_traveler_photo.alias, post.alias post_alias,
				city.alias city_alias, region.alias region_alias,
				category.alias category_alias, category_sub.alias category_sub_alias
			FROM ".POST_TRAVELER_REPORT." post_traveler_report
			LEFT JOIN ".POST_TRAVELER_PHOTO." post_traveler_photo ON post_traveler_photo.id = post_traveler_report.post_traveler_photo_id
			LEFT JOIN ".POST." post ON post.id = post_traveler_photo.post_id
			LEFT JOIN ".CITY." city ON city.id = post.city_id
			LEFT JOIN ".REGION." region ON region.id = city.region_id
			LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
			LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
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
		$select_query = "SELECT FOUND_ROWS() total";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$total = $row['total'];
		
		return $total;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".POST_TRAVELER_REPORT." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// link
		if (isset($row['category_alias']) && isset($row['region_alias']) && isset($row['city_alias']) && isset($row['post_alias']) && isset($row['alias'])) {
			$row['link_traveler_report'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['post_alias'].'/gallery/'.$row['alias'].'/');
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}