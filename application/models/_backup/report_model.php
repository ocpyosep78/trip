<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array( 'id', 'user_id', 'advert_id', 'report_type_id', 'detail', 'email', 'post_time' );
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, REPORT);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, REPORT);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
		
		$param['id'] = $result['id'];
		
        return $result;
    }

    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "
				SELECT Report.*, ReportType.name report_type_name
				FROM ".REPORT." Report
				LEFT JOIN ".REPORT_TYPE." ReportType ON ReportType.id = Report.report_type_id
				WHERE Report.id = '".$param['id']."'
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
		
		$param['field_replace']['name'] = 'Report.name';
		$param['field_replace']['report_type_name'] = 'ReportType.name';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND Report.name LIKE '%".$param['namelike']."%'" : '';
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Report.*, ReportType.name report_type_name,
				Advert.alias advert_alias, Advert.code advert_code, Advert.id advert_id
			FROM ".REPORT." Report
			LEFT JOIN ".REPORT_TYPE." ReportType ON ReportType.id = Report.report_type_id
			LEFT JOIN ".ADVERT." Advert ON Advert.id = Report.advert_id
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
		$select_query = "SELECT FOUND_ROWS() TotalRecord";
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".REPORT." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'post_time' ));
		
		// advert link
		if (!empty($row['advert_alias'])) {
			$row['advert_link'] = base_url('advert/'.$row['advert_alias']);
		} else if (!empty($row['advert_code'])) {
			$row['advert_link'] = base_url('advert/'.$row['advert_code']);
		} else {
			$row['advert_link'] = base_url('advert/'.$row['advert_id']);
		}
		
		if (count(@$param['column']) > 0) {
			if (!empty($param['is_manage'])) {
				if ($param['is_manage'] == 'admin') {
					$param['is_custom']  = '<i class="cursor-button tool-tip fa fa-list-alt btn-edit" title="View Detail"></i> ';
					$param['is_custom'] .= '<a class="cursor-button tool-tip fa fa-link" href="'.$row['advert_link'].'" target="_blank" title="View Advert"></a> ';
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-delete" title="Delete"></i> ';
				}
			}
			
			$row = dt_view_set($row, $param);
		}
		
		return $row;
	}
}