<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_tag_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'tag_id', 'post_id' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, POST_TAG);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, POST_TAG);
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
            $select_query  = "SELECT * FROM ".POST_TAG." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$string_tag = (isset($param['tag_id'])) ? "AND post_tag.tag_id = '".$param['tag_id']."'" : '';
		$string_post = (isset($param['post_id'])) ? "AND post_tag.post_id = '".$param['post_id']."'" : '';
		$string_post_status = (isset($param['post_status'])) ? "AND post.post_status = '".$param['post_status']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS post_tag.*, post.*,
				tag.alias tag_alias, tag.title tag_title,
				category.id category_id, category.title category_title, category.alias category_alias,
				category_sub.title category_sub_title, category_sub.alias category_sub_alias,
				city.title city_title, city.alias city_alias,
				region.id region_id, region.title region_title, region.alias region_alias,
				country.id country_id
			FROM ".POST_TAG." post_tag
			LEFT JOIN ".TAG." tag ON tag.id = post_tag.tag_id
			LEFT JOIN ".POST." post ON post.id = post_tag.post_id
			LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
			LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
			LEFT JOIN ".CITY." city ON city.id = post.city_id
			LEFT JOIN ".REGION." region ON region.id = city.region_id
			LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
			WHERE 1 $string_tag $string_post $string_post_status $string_filter
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
		if (isset($param['post_id'])) {
			$delete_query  = "DELETE FROM ".POST_TAG." WHERE post_id = '".$param['post_id']."'";
			$delete_result = mysql_query($delete_query) or die(mysql_error());
		} else {
			$delete_query  = "DELETE FROM ".POST_TAG." WHERE id = '".$param['id']."' LIMIT 1";
			$delete_result = mysql_query($delete_query) or die(mysql_error());
		}
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// language
		$row = get_row_language($row, array( 'title', 'desc_01', 'desc_02', 'desc_03', 'field_01', 'map' ));
		
		// link
		$row['link_thumbnail'] = base_url('static/theme/forest/images/post-default.jpg');
		$row['link_thumbnail_small'] = base_url('static/theme/forest/images/post-default.jpg');
		if (! empty($row['thumbnail'])) {
			$row['link_thumbnail'] = base_url('static/upload/'.$row['thumbnail']);
			$row['link_thumbnail_small'] = preg_replace('/\.(jpg|jpeg|png|gif)/i', '_s.$1', $row['link_thumbnail']);
		}
		if (!empty($row['category_alias']) && !empty($row['region_alias']) && !empty($row['city_alias']) && !empty($row['alias'])) {
			$row['link_post'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias']);
			$row['link_post_review'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias'].'/review');
			$row['link_post_upload'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias'].'/upload');
			$row['link_post_gallery'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias'].'/gallery');
			$row['link_category'] = base_url($row['category_alias']);
			$row['link_region'] = base_url($row['category_alias'].'/'.$row['region_alias']);
			$row['link_city'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias']);
		}
		
		// member fullname
		if (isset($row['first_name']) && isset($row['last_name'])) {
			$row['full_name'] = $row['first_name'].' '.$row['last_name'];
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}