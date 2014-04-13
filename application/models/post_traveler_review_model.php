<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post_traveler_review_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'post_id', 'traveler_id', 'language_id', 'alias', 'title', 'rating', 'content', 'evaluation', 'post_date', 'post_status',
			'visit_date'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, POST_TRAVELER_REVIEW);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, POST_TRAVELER_REVIEW);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
		
		// update post
		$this->post_model->update_review(array( 'post_traveler_review_id' => $result['id'] ));
		
        return $result;
    }

    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "
				SELECT post_traveler_review.*,
					post.title post_title, language.title language_title
				FROM ".POST_TRAVELER_REVIEW." post_traveler_review
				LEFT JOIN ".POST." post ON post.id = post_traveler_review.post_id
				LEFT JOIN ".LANGUAGE." language ON language.id = post_traveler_review.language_id
				WHERE post_traveler_review.id = '".$param['id']."'
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
		
		$param['field_replace']['title'] = 'post_traveler_review.title';
		$param['field_replace']['post_status'] = 'post_traveler_review.post_status';
		$param['field_replace']['language_title'] = 'language.title';
		$param['field_replace']['post_title_default'] = 'post.title';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND post_traveler_review.title LIKE '%".$param['namelike']."%'" : '';
		$string_post = (isset($param['post_id'])) ? "AND post_traveler_review.post_id = '".$param['post_id']."'" : '';
		$string_traveler = (isset($param['traveler_id'])) ? "AND post_traveler_review.traveler_id = '".$param['traveler_id']."'" : '';
		$string_language = (isset($param['language_id'])) ? "AND post_traveler_review.language_id = '".$param['language_id']."'" : '';
		$string_post_status = (isset($param['post_status'])) ? "AND post_traveler_review.post_status = '".$param['post_status']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS post_traveler_review.*,
				post.title post_title, language.title language_title,
				traveler.first_name traveler_first_name, traveler.last_name traveler_last_name, traveler.thumbnail traveler_thumbnail,
				city.title city_title, country.title country_title
			FROM ".POST_TRAVELER_REVIEW." post_traveler_review
			LEFT JOIN ".POST." post ON post.id = post_traveler_review.post_id
			LEFT JOIN ".LANGUAGE." language ON language.id = post_traveler_review.language_id
			LEFT JOIN ".TRAVELER." traveler ON traveler.id = post_traveler_review.traveler_id
			LEFT JOIN ".CITY." city ON city.id = traveler.city_id
			LEFT JOIN ".REGION." region ON region.id = city.region_id
			LEFT JOIN ".COUNTRY." country ON country.id = region.country_id
			WHERE 1 $string_namelike $string_post $string_traveler $string_language $string_post_status $string_filter
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
		if (isset($param['post_id'])) {
			$select_query = "SELECT COUNT(*) total FROM ".POST_TRAVELER_REVIEW." WHERE post_id = '".$param['post_id']."' AND post_status = 'approve'";
		} else {
			$select_query = "SELECT FOUND_ROWS() total";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$total = $row['total'];
		
		return $total;
    }
	
	function get_rating($param = array()) {
		// array review
		$array_review = $this->get_array(array( 'post_id' => $param['post_id'], 'post_status' => 'approve', 'limit' => 1000 ));
		
		// count rating
		$rating = 0;
		foreach ($array_review as $row) {
			$rating += $row['rating'];
		}
		
		// result
		$result = 0;
		if (!empty($rating)) {
			$result = ceil($rating / count($array_review));
		}
		
		return $result;
	}
	
    function delete($param) {
		// record
		$record = $this->get_by_id(array( 'id' => $param['id'] ));
		
		$delete_query  = "DELETE FROM ".POST_TRAVELER_REVIEW." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';
		
		// update post
		$this->post_model->update_review(array( 'post_id' => $record['post_id'] ));
		
        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		
		// language
		$row = get_row_language($row, array( 'post_title' ));
		
		// fullname
		if (isset($row['traveler_first_name']) && isset($row['traveler_last_name'])) {
			$row['traveler_full_name'] = $row['traveler_first_name'].' '.$row['traveler_last_name'];
		}
		
		// link
		$row['traveler_thumbnail_link'] = base_url('static/img/avatar.jpg');
		if (isset($row['traveler_thumbnail'])) {
			$file_path = $this->config->item('base_path').'/static/upload/'.$row['traveler_thumbnail'];
			if (file_exists($file_path) && !empty($row['traveler_thumbnail'])) {
				$row['traveler_thumbnail_link'] = base_url('static/upload/'.$row['traveler_thumbnail']);
			}
		}
		if (isset($row['rating'])) {
			$row['rating_link'] = ($row['rating'] >= 3) ?
				base_url('static/theme/forest/images/check.png') :
				base_url('static/theme/forest/images/delete_old.png');
		}
		
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
}