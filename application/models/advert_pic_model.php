<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advert_Pic_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'advert_id', 'thumbnail' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, ADVERT_PIC);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, ADVERT_PIC);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
		
		$this->resize_image($param);
		
        return $result;
    }

    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "SELECT * FROM ".ADVERT_PIC." WHERE id = '".$param['id']."' LIMIT 1";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
       
        return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		$param['advert_id'] = (!empty($param['advert_id'])) ? $param['advert_id'] : 0;
		
		$string_advert = "AND AdvertPic.advert_id = '".$param['advert_id']."'";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'thumbnail ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS AdvertPic.*
			FROM ".ADVERT_PIC." AdvertPic
			WHERE 1 $string_advert $string_filter
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
		if (isset($param['advert_id'])) {
			$delete_query  = "DELETE FROM ".ADVERT_PIC." WHERE advert_id = '".$param['advert_id']."'";
		} else {
			$delete_query  = "DELETE FROM ".ADVERT_PIC." WHERE id = '".$param['id']."' LIMIT 1";
		}
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row);
		$row['thumbnail_link'] = base_url('static/upload/'.$row['thumbnail']);
		$row['thumbnail_link_show'] = preg_replace('/\.(jpg|jpeg|png|gif)/i', '_s.$1', $row['thumbnail_link']);
		
		if (count(@$param['column']) > 0) {
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
	
	function resize_image($param) {
		$file_path_source = $this->config->item('base_path').'/static/upload/'.$param['thumbnail'];
		$file_path_output = preg_replace('/\.(jpg|jpeg|png|gif)/i', '_s.$1', $file_path_source);
		$file_path_stamp = $this->config->item('base_path').'/'.IMAGE_ADVERT_STAMP;
		$image_info = @getimagesize($file_path_source);
		
		// resize image
		ImageResize($file_path_source, $file_path_output, 650, 400, 0);
		
		// watermark
		watermark($file_path_output, $file_path_stamp, $file_path_output);
	}
}