<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_traveler_photo_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'post_id', 'traveler_id', 'title', 'alias', 'content', 'thumbnail', 'post_date', 'post_status' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, POST_TRAVELER_PHOTO);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, POST_TRAVELER_PHOTO);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
       
		// update size
		$this->resize_image($param);
		
        return $result;
    }

    function get_by_id($param) {
        $array = array();
		
        if (isset($param['id'])) {
            $select_query  = "
				SELECT post_traveler_photo.*, post.title post_title
				FROM ".POST_TRAVELER_PHOTO." post_traveler_photo
				LEFT JOIN ".POST." post ON post.id = post_traveler_photo.post_id
				WHERE post_traveler_photo.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['alias']) && isset($param['post_id'])) {
            $select_query  = "
				SELECT
					post_traveler_photo.*,
					post.title post_title, post.alias post_alias,
					city.alias city_alias, region.alias region_alias,
					category.alias category_alias, category_sub.alias category_sub_alias,
					traveler.first_name traveler_first_name, traveler.last_name traveler_last_name, traveler.alias traveler_alias
				FROM ".POST_TRAVELER_PHOTO." post_traveler_photo
				LEFT JOIN ".POST." post ON post.id = post_traveler_photo.post_id
				LEFT JOIN ".CITY." city ON city.id = post.city_id
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				LEFT JOIN ".TRAVELER." traveler ON traveler.id = post_traveler_photo.traveler_id
				WHERE
					post_traveler_photo.alias = '".$param['alias']."'
					AND post_traveler_photo.post_id = '".$param['post_id']."'
				ORDER BY post_traveler_photo.post_date DESC
				LIMIT 1
			";
        } else if (isset($param['latest_photo']) && isset($param['post_id'])) {
            $select_query  = "
				SELECT
					post_traveler_photo.*,
					post.title post_title, post.alias post_alias,
					city.alias city_alias, region.alias region_alias,
					category.alias category_alias, category_sub.alias category_sub_alias,
					traveler.first_name traveler_first_name, traveler.last_name traveler_last_name, traveler.alias traveler_alias
				FROM ".POST_TRAVELER_PHOTO." post_traveler_photo
				LEFT JOIN ".POST." post ON post.id = post_traveler_photo.post_id
				LEFT JOIN ".CITY." city ON city.id = post.city_id
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				LEFT JOIN ".TRAVELER." traveler ON traveler.id = post_traveler_photo.traveler_id
				WHERE
					post_traveler_photo.post_status = 'approve'
					AND post_traveler_photo.post_id = '".$param['post_id']."'
				ORDER BY post_traveler_photo.post_date DESC
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
		
		$param['field_replace']['title'] = 'post_traveler_photo.title';
		$param['field_replace']['post_status'] = 'post_traveler_photo.post_status';
		$param['field_replace']['post_title_default'] = 'post.title';
		
		$string_post = (isset($param['post_id'])) ? "AND post_traveler_photo.post_id = '".$param['post_id']."'" : '';
		$string_traveler = (isset($param['traveler_id'])) ? "AND post_traveler_photo.traveler_id = '".$param['traveler_id']."'" : '';
		$string_post_status = (isset($param['post_status'])) ? "AND post_traveler_photo.post_status = '".$param['post_status']."'" : '';
		$string_post_date_max = (isset($param['post_date_max'])) ? "AND post_traveler_photo.post_date < '".$param['post_date_max']."'" : '';
		$string_post_date_min = (isset($param['post_date_min'])) ? "AND post_traveler_photo.post_date > '".$param['post_date_min']."'" : '';
		$string_namelike = (!empty($param['namelike'])) ? "AND post_traveler_photo.title LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS post_traveler_photo.*,
				post.title post_title, post.alias post_alias,
				city.alias city_alias, region.alias region_alias,
				category.alias category_alias, category_sub.alias category_sub_alias
			FROM ".POST_TRAVELER_PHOTO." post_traveler_photo
			LEFT JOIN ".POST." post ON post.id = post_traveler_photo.post_id
			LEFT JOIN ".CITY." city ON city.id = post.city_id
			LEFT JOIN ".REGION." region ON region.id = city.region_id
			LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
			LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
			WHERE 1
				$string_namelike $string_filter
				$string_post $string_traveler $string_post_status
				$string_post_date_min $string_post_date_max
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
		$delete_query  = "DELETE FROM ".POST_TRAVELER_PHOTO." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// fullname
		if (isset($row['traveler_first_name']) && isset($row['traveler_last_name'])) {
			$row['traveler_full_name'] = $row['traveler_first_name'].' '.$row['traveler_last_name'];
		}
		
		// link
		if (!empty($row['thumbnail'])) {
			$row['thumbnail_link'] = base_url('static/upload/'.$row['thumbnail']);
		}
		if (isset($row['category_alias']) && isset($row['region_alias']) && isset($row['city_alias']) && isset($row['post_alias']) && isset($row['alias'])) {
			$row['link_traveler_photo'] = base_url($row['category_alias'].'/'.$row['post_alias'].'/gallery/'.$row['alias'].'/');
			
			if (isset($row['traveler_alias'])) {
				$row['link_timeline'] = base_url('t/'.$row['traveler_alias'].'/'.$row['category_alias'].'/'.$row['post_alias'].'/gallery/'.$row['alias'].'/');
			}
		}
		
		// language
		$row = get_row_language($row, array( 'post_title' ));
		
		if (count(@$param['column']) > 0) {
			if (!empty($param['grid_type']) && $param['grid_type'] == 'admin_view') {
				$param['is_custom']  = '<i class="cursor-button tool-tip fa fa-pencil btn-edit" title="Edit"></i> ';
				
				if ($row['post_status'] == 'pending') {
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-check btn-approve" title="Approve"></i> ';
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-times btn-reject" title="Reject"></i> ';
				}
				
				$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-delete" title="Delete"></i> ';
			}
			
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function resize_image($param) {
		if (!empty($param['thumbnail'])) {
			$image_path = $this->config->item('base_path') . '/static/upload/';
			$image_source = $image_path . $param['thumbnail'];
			$image_result = $image_source;
			
			ImageResize($image_source, $image_result, 750, 475, 1);
		}
	}
	
	function get_timeline($param = array()) {
		$result = array(
			'type' => 'gallery',
			'title' => $param['title'],
			'traveler_id' => $param['traveler_id'],
			'content' => $param['content'],
			'thumbnail_link' => $param['thumbnail_link'],
			'link_source' => $param['link_traveler_photo']
		);
		
		return $result;
	}
}