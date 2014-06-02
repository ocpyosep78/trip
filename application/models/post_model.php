<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'city_id', 'member_id', 'category_sub_id', 'alias', 'title', 'address', 'desc_01', 'desc_02', 'desc_03', 'field_01', 'map', 'star', 'post_status',
			'thumbnail', 'having_promo', 'review_rate', 'review_count', 'rate_per_night', 'facility', 'post_update', 'total_room', 'open_hour', 'phone', 'price'
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
       
		// update post detail
		$param['id'] = $result['id'];
		$this->update_tag($param);
		$this->resize_image($param);
	   
        return $result;
    }
	
	function update_tag($param = array()) {
		if (isset($param['tag_content'])) {
			$this->post_tag_model->delete(array( 'post_id' => $param['id'] ));
			$array_tag = explode(',', $param['tag_content']);
			foreach ($array_tag as $tag_queue) {
				$tag_name = trim($tag_queue);
				if (empty($tag_name)) {
					continue;
				}
				
				$tag_alias = $this->tag_model->get_name($tag_name);
				$tag = $this->tag_model->get_by_id(array( 'alias' => $tag_alias, 'title' => $tag_name, 'force_insert' => true ));
				
				// insert
				$param_tag['post_id'] = $param['id'];
				$param_tag['tag_id'] = $tag['id'];
				$this->post_tag_model->update($param_tag);
			}
		}
	}

	function update_review($param = array()) {
		// record
		if (isset($param['post_id'])) {
			$record = $param;
		} else if (isset($param['post_traveler_review_id'])) {
			$record = $this->post_traveler_review_model->get_by_id(array( 'id' => $param['post_traveler_review_id'] ));
		}
		
		// review count
		$total = $this->post_traveler_review_model->get_count(array( 'post_id' => $record['post_id'] ));
		
		// review rating
		$rating = $this->post_traveler_review_model->get_rating(array( 'post_id' => $record['post_id'] ));
		
		// update
		$param_update['id'] = $record['post_id'];
		$param_update['review_count'] = $total;
		$param_update['review_rate'] = $rating;
		$this->update($param_update);
	}
	
    function get_by_id($param) {
        $array = array();
		$param['tag_include'] = (isset($param['tag_include'])) ? $param['tag_include'] : false;
       
        if (isset($param['id'])) {
            $select_query  = "
				SELECT post.*,
					member.first_name, member.last_name,
					category.id category_id, category.title category_title, category.alias category_alias, category.link category_link,
					category_sub.title category_sub_title, category_sub.alias category_sub_alias,
					city.title city_title, city.alias city_alias,
					region.id region_id, region.title region_title, region.alias region_alias,
					country.id country_id
				FROM ".POST." post
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				LEFT JOIN ".CITY." city ON city.id = post.city_id
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
				LEFT JOIN ".MEMBER." member ON member.id = post.member_id
				WHERE post.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['alias']) && isset($param['city_alias'])) {
            $select_query  = "
				SELECT post.*,
					member.first_name, member.last_name,
					category.id category_id, category.title category_title, category.alias category_alias, category.link category_link,
					category_sub.title category_sub_title, category_sub.alias category_sub_alias,
					city.title city_title, city.alias city_alias,
					region.id region_id, region.title region_title, region.alias region_alias,
					country.id country_id
				FROM ".POST." post
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				LEFT JOIN ".CITY." city ON city.id = post.city_id
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
				LEFT JOIN ".MEMBER." member ON member.id = post.member_id
				WHERE
					post.alias = '".$param['alias']."'
					AND city.alias = '".$param['city_alias']."'
				LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "
				SELECT post.*,
					member.first_name, member.last_name,
					category.id category_id, category.title category_title, category.alias category_alias, category.link category_link,
					category_sub.title category_sub_title, category_sub.alias category_sub_alias,
					city.title city_title, city.alias city_alias,
					region.id region_id, region.title region_title, region.alias region_alias,
					country.id country_id
				FROM ".POST." post
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				LEFT JOIN ".CITY." city ON city.id = post.city_id
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
				LEFT JOIN ".MEMBER." member ON member.id = post.member_id
				WHERE post.alias = '".$param['alias']."'
				LIMIT 1
			";
		}
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
		
		if ($param['tag_include']) {
			$array['array_tag'] = $this->post_tag_model->get_array(array( 'post_id' => $array['id'] ));
			$array['tag_content'] = $this->tag_model->get_string($array['array_tag']);
		}
		
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['alias'] = 'post.alias';
		$param['field_replace']['title_text'] = 'post.title';
		$param['field_replace']['category_title'] = 'category.title';
		$param['field_replace']['category_sub_title'] = 'category_sub.title';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND post.title LIKE '%".$param['namelike']."%'" : '';
		$string_star = (isset($param['star'])) ? "AND post.star = '".$param['star']."'" : '';
		$string_member = (isset($param['member_id'])) ? "AND post.member_id = '".$param['member_id']."'" : '';
		$string_category = (isset($param['category_id'])) ? "AND category_sub.category_id = '".$param['category_id']."'" : '';
		$string_category_sub = (isset($param['category_sub_id'])) ? "AND post.category_sub_id = '".$param['category_sub_id']."'" : '';
		$string_category_not_in = (isset($param['category_not_in'])) ? "AND category_sub.category_id NOT IN (".$param['category_not_in'].")" : '';
		$string_city = (isset($param['city_id'])) ? "AND city.id = '".$param['city_id']."'" : '';
		$string_region = (isset($param['region_id'])) ? "AND region.id = '".$param['region_id']."'" : '';
		$string_country = (isset($param['country_id'])) ? "AND country.id = '".$param['country_id']."'" : '';
		$string_facility = (isset($param['array_facility'])) ? get_query_post_facility($param['array_facility']) : '';
		$string_price_min = (isset($param['price_min'])) ? "AND post.rate_per_night >= '".$param['price_min']."'" : '';
		$string_price_max = (isset($param['price_max'])) ? "AND post.rate_per_night <= '".$param['price_max']."'" : '';
		$string_post_status = (isset($param['post_status'])) ? "AND post.post_status = '".$param['post_status']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'post.title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS post.*,
				category.id category_id, category.title category_title, category.alias category_alias, category.link category_link,
				category_sub.title category_sub_title, category_sub.alias category_sub_alias,
				city.title city_title, city.alias city_alias,
				region.id region_id, region.title region_title, region.alias region_alias,
				country.id country_id
			FROM ".POST." post
			LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
			LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
			LEFT JOIN ".CITY." city ON city.id = post.city_id
			LEFT JOIN ".REGION." region ON region.id = city.region_id
			LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
			WHERE 1
				$string_namelike $string_star $string_member $string_filter
				$string_category $string_category_sub $string_category_not_in
				$string_city $string_region $string_country
				$string_facility $string_price_min $string_price_max $string_post_status
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
		
		// language
		$row = get_row_language($row, array( 'title', 'desc_01', 'desc_02', 'desc_03', 'field_01', 'map' ));
		
		// link
		$row['link_thumbnail'] = base_url('static/theme/forest/images/post-default.jpg');
		$row['link_thumbnail_small'] = base_url('static/theme/forest/images/post-default.jpg');
		if (! empty($row['thumbnail'])) {
			$row['link_thumbnail'] = base_url('static/upload/'.$row['thumbnail']);
			$row['link_thumbnail_small'] = preg_replace('/\.(jpg|jpeg|png|gif)/i', '_s.$1', $row['link_thumbnail']);
		}
		if (!empty($row['star'])) {
			$row['link_star'] = base_url('static/theme/forest/images/filter-rating-'.$row['star'].'.png');
		}
		if (!empty($row['review_rate'])) {
			$row['link_review_rate'] = base_url('static/theme/forest/images/user-rating-'.$row['review_rate'].'.png');
		}
		if (!empty($row['category_alias']) && !empty($row['region_alias']) && !empty($row['city_alias']) && !empty($row['alias'])) {
			// old
			// $row['link_post'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias']);
			// $row['link_post_review'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias'].'/review');
			// $row['link_post_upload'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias'].'/upload');
			// $row['link_post_gallery'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias'].'/'.$row['alias'].'/gallery');
			
			// new
			$row['link_post'] = base_url($row['category_alias'].'/'.$row['alias']);
			$row['link_post_review'] = base_url($row['category_alias'].'/'.$row['alias'].'/review');
			$row['link_post_upload'] = base_url($row['category_alias'].'/'.$row['alias'].'/upload');
			$row['link_post_gallery'] = base_url($row['category_alias'].'/'.$row['alias'].'/gallery');
			
			// other
			$row['link_category'] = base_url($row['category_alias']);
			$row['link_region'] = base_url($row['category_alias'].'/'.$row['region_alias']);
		}
		if (!empty($row['category_alias']) && !empty($row['region_alias']) && !empty($row['city_alias'])) {
			$row['link_city'] = base_url($row['category_alias'].'/'.$row['region_alias'].'/'.$row['city_alias']);
		}
		
		// overwrite link
		if (!empty($row['category_link'])) {
			$row['link_category'] = $row['category_link'];
		}
		
		// member fullname
		if (isset($row['first_name']) && isset($row['last_name'])) {
			$row['full_name'] = $row['first_name'].' '.$row['last_name'];
		}
		
		if (count(@$param['column']) > 0) {
			if (isset($param['grid_type']) && $param['grid_type'] == 'member') {
                $param['is_custom']  = '<i class="cursor-button tool-tip fa fa-pencil btn-edit" title="Edit"></i> ';
                $param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-cutlery btn-facility" title="Facility"></i> ';
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
			$image_small = preg_replace('/\.(jpg|jpeg|png|gif)/i', '_s.$1', $image_source);
			
			ImageResize($image_source, $image_small, 250, 180, 1);
		}
	}
	
	function get_rate_min() {
        $array = array();
		
		$select_query = "
			SELECT post.rate_per_night
			FROM post
			WHERE post.rate_per_night > 0
			ORDER BY post.rate_per_night ASC
			LIMIT 1
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array = $row;
		}
		
		if (count($array) == 0) {
			$array['rate_per_night'] = 0;
		}
		
        return $array;
	}
	
	function get_city_count($param = array()) {
        $array = array();
		
		$string_category = (isset($param['category_id'])) ? "AND category_sub.category_id = '".$param['category_id']."'" : '';
		$string_region = (isset($param['region_id'])) ? "AND region.id = '".$param['region_id']."'" : '';
		$string_city = (isset($param['city_id'])) ? "AND city.id = '".$param['city_id']."'" : '';
		$string_post_status = (isset($param['post_status'])) ? "AND post.post_status = '".$param['post_status']."'" : '';
		
		$select_query = "
			SELECT *
			FROM (
				SELECT COUNT(*) total,
					category.alias category_alias,
					region.alias region_alias,
					city.id city_id, city.title city_title, city.alias city_alias
				FROM ".POST." post
				LEFT JOIN ".CATEGORY_SUB." category_sub ON category_sub.id = post.category_sub_id
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				LEFT JOIN ".CITY." city ON city.id = post.city_id
				LEFT JOIN ".REGION." region ON region.id = city.region_id
				WHERE 1
					$string_category $string_region $string_city $string_post_status
				GROUP BY city.alias
				LIMIT 100
			) table_temp
			ORDER BY city_title ASC
		";
        $select_result = mysql_query($select_query) or die(mysql_error());
		while ( $row = mysql_fetch_assoc( $select_result ) ) {
			$array[] = $this->sync($row, $param);
		}
		
        return $array;
	}
	
	/*   Region Session  */
	
	function set_session($post) {
		$array_post = (isset($_SESSION['post_lastest_visit'])) ? $_SESSION['post_lastest_visit'] : array();
		
		// check duplicate
		$is_duplicate = false;
		foreach ($array_post as $record) {
			if ($record['id'] == $post['id']) {
				$is_duplicate = true;
				break;
			}
		}
		if (! $is_duplicate) {
			$array_post[] = $post;
		}
		
		// limit only 5 record
		if (count($array_post) > 5) {
			array_shift($array_post);
		}
		
		// set session
		$_SESSION['post_lastest_visit'] = $array_post;
	}
	
	function get_session() {
		$array_post = (isset($_SESSION['post_lastest_visit'])) ? $_SESSION['post_lastest_visit'] : array();
		return $array_post;
	}
	
	/*   End Region Session  */
}