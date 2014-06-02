<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class category_sub_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'category_id', 'alias', 'title', 'content', 'link', 'thumbnail' );
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
       
		// update category detail
		$param['id'] = $result['id'];
		$this->update_tag($param);
		
        return $result;
    }

	function update_tag($param = array()) {
		if (isset($param['tag_content'])) {
			$this->category_sub_tag_model->delete(array( 'category_sub_id' => $param['id'] ));
			$array_tag = explode(',', $param['tag_content']);
			foreach ($array_tag as $tag_queue) {
				$tag_name = trim($tag_queue);
				if (empty($tag_name)) {
					continue;
				}
				
				$tag_alias = $this->tag_model->get_name($tag_name);
				$tag = $this->tag_model->get_by_id(array( 'alias' => $tag_alias, 'title' => $tag_name, 'force_insert' => true ));
				
				// insert
				$param_tag['tag_id'] = $tag['id'];
				$param_tag['category_sub_id'] = $param['id'];
				$this->category_sub_tag_model->update($param_tag);
			}
		}
	}

    function get_by_id($param) {
        $array = array();
		$param['tag_include'] = (isset($param['tag_include'])) ? $param['tag_include'] : false;
		
        if (isset($param['id'])) {
            $select_query  = "
				SELECT category_sub.*,
					category.alias category_alias, category.title category_title, category.link category_link
				FROM ".CATEGORY_SUB." category_sub
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				WHERE category_sub.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "
				SELECT category_sub.*,
					category.alias category_alias, category.title category_title, category.link category_link
				FROM ".CATEGORY_SUB." category_sub
				LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
				WHERE category_sub.alias = '".$param['alias']."'
				LIMIT 1
			";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
		if ($param['tag_include']) {
			$array['array_tag'] = $this->category_sub_tag_model->get_array(array( 'category_sub_id' => $array['id'] ));
			$array['tag_content'] = $this->tag_model->get_string($array['array_tag']);
		}
		
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		
		$param['field_replace']['title'] = 'category_sub.title';
		$param['field_replace']['alias'] = 'category_sub.alias';
		$param['field_replace']['category_title'] = 'category.title';
		
		$string_category_id = (isset($param['category_id'])) ? "AND category_sub.category_id = '".$param['category_id']."'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'title ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS category_sub.*,
				category.alias category_alias, category.title category_title, category.link category_link
			FROM ".CATEGORY_SUB." category_sub
			LEFT JOIN ".CATEGORY." category ON category.id = category_sub.category_id
			WHERE 1 $string_category_id $string_filter
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
		
		// link
		if (!empty($row['category_alias'])) {
			$row['link_category'] = base_url($row['category_alias']);
		}
		if (!empty($row['category_alias']) && !empty($row['alias'])) {
			$row['link_category_sub'] = base_url($row['category_alias'].'/'.$row['alias']);
		}
		
		// overwrite link
		if (!empty($row['category_link'])) {
			$row['link_category'] = $row['category_link'];
		}
		if (!empty($row['link'])) {
			$row['link_category_sub'] = $row['link'];
		}
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}