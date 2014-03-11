<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advert_model extends CI_Model {
    function __construct() {
        parent::__construct();
		
        $this->field = array(
			'id', 'user_id', 'city_id', 'condition_id', 'advert_type_id', 'advert_status_id', 'category_sub_id', 'name', 'code', 'content', 'address', 'price',
			'negotiable', 'metadata', 'thumbnail', 'post_time', 'sold_time', 'is_delete', 'view_count', 'alias'
		);
    }

    function update($param) {
        $result = array();
       
        if (empty($param['id'])) {
            $insert_query  = GenerateInsertQuery($this->field, $param, ADVERT);
            $insert_result = mysql_query($insert_query) or die(mysql_error());
           
            $result['id'] = mysql_insert_id();
            $result['status'] = '1';
            $result['message'] = 'Data successfully saved.';
        } else {
            $update_query  = GenerateUpdateQuery($this->field, $param, ADVERT);
            $update_result = mysql_query($update_query) or die(mysql_error());
           
            $result['id'] = $param['id'];
            $result['status'] = '1';
            $result['message'] = 'Data successfully updated.';
        }
		
		$param['id'] = $result['id'];
		$this->resize_image($param);
		
        return $result;
    }

    function get_by_id($param) {
        $array = array();
       
        if (isset($param['id'])) {
            $select_query  = "
				SELECT Advert.*,
					User.email, User.first_name, User.last_name,
					City.region_id, City.name city_name, Region.name region_name,
					Category.name category_name, Category.alias category_alias, AdvertType.name advert_type_name,
					CategorySub.category_id, CategorySub.name category_sub_name, CategorySub.alias category_sub_alias
				FROM ".ADVERT." Advert
				LEFT JOIN ".USER." User ON User.id = Advert.user_id
				LEFT JOIN ".CATEGORY_SUB." CategorySub ON CategorySub.id = Advert.category_sub_id
				LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
				LEFT JOIN ".CITY." City ON City.id = Advert.city_id
				LEFT JOIN ".REGION." Region ON Region.id = City.region_id
				LEFT JOIN ".ADVERT_TYPE." AdvertType ON AdvertType.id = Advert.advert_type_id
				WHERE Advert.id = '".$param['id']."'
				LIMIT 1
			";
        } else if (isset($param['code'])) {
            $select_query  = "
				SELECT Advert.*,
					User.email, User.first_name, User.last_name,
					City.region_id, City.name city_name, Region.name region_name,
					Category.name category_name, Category.alias category_alias, AdvertType.name advert_type_name,
					CategorySub.category_id, CategorySub.name category_sub_name, CategorySub.alias category_sub_alias
				FROM ".ADVERT." Advert
				LEFT JOIN ".USER." User ON User.id = Advert.user_id
				LEFT JOIN ".CATEGORY_SUB." CategorySub ON CategorySub.id = Advert.category_sub_id
				LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
				LEFT JOIN ".CITY." City ON City.id = Advert.city_id
				LEFT JOIN ".REGION." Region ON Region.id = City.region_id
				LEFT JOIN ".ADVERT_TYPE." AdvertType ON AdvertType.id = Advert.advert_type_id
				WHERE Advert.code = '".$param['code']."'
				LIMIT 1
			";
        } else if (isset($param['alias'])) {
            $select_query  = "
				SELECT Advert.*,
					User.email, User.first_name, User.last_name,
					City.region_id, City.name city_name, Region.name region_name,
					Category.name category_name, Category.alias category_alias, AdvertType.name advert_type_name,
					CategorySub.category_id, CategorySub.name category_sub_name, CategorySub.alias category_sub_alias
				FROM ".ADVERT." Advert
				LEFT JOIN ".USER." User ON User.id = Advert.user_id
				LEFT JOIN ".CATEGORY_SUB." CategorySub ON CategorySub.id = Advert.category_sub_id
				LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
				LEFT JOIN ".CITY." City ON City.id = Advert.city_id
				LEFT JOIN ".REGION." Region ON Region.id = City.region_id
				LEFT JOIN ".ADVERT_TYPE." AdvertType ON AdvertType.id = Advert.advert_type_id
				WHERE Advert.alias = '".$param['alias']."'
				LIMIT 1
			";
        } else if (isset($param['user_id']) && isset($param['name'])) {
            $select_query  = "
				SELECT Advert.*,
					User.email, User.first_name, User.last_name,
					City.region_id, City.name city_name, Region.name region_name,
					Category.name category_name, Category.alias category_alias, AdvertType.name advert_type_name,
					CategorySub.category_id, CategorySub.name category_sub_name, CategorySub.alias category_sub_alias
				FROM ".ADVERT." Advert
				LEFT JOIN ".USER." User ON User.id = Advert.user_id
				LEFT JOIN ".CATEGORY_SUB." CategorySub ON CategorySub.id = Advert.category_sub_id
				LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
				LEFT JOIN ".CITY." City ON City.id = Advert.city_id
				LEFT JOIN ".REGION." Region ON Region.id = City.region_id
				LEFT JOIN ".ADVERT_TYPE." AdvertType ON AdvertType.id = Advert.advert_type_id
				WHERE
					Advert.name = '".$param['name']."'
					AND Advert.user_id = '".$param['user_id']."'
				LIMIT 1
			";
        } 
       
        $select_result = mysql_query($select_query) or die(mysql_error());
        if (false !== $row = mysql_fetch_assoc($select_result)) {
            $array = $this->sync($row);
        }
		
		// add advert type sub
		if (count($array) > 0) {
			$advert_type_sub = $this->Advert_Type_Sub_model->get_by_id(array( 'advert_type_id' => $array['advert_type_id'], 'category_sub_id' => $array['category_sub_id'] ));
			$array['advert_type_sub_id'] = (isset($advert_type_sub['id'])) ? $advert_type_sub['id'] : 0;
		}
		
		return $array;
    }
	
    function get_array($param = array()) {
        $array = array();
		$param['is_delete'] = (isset($param['is_delete'])) ? $param['is_delete'] : '0';
		
		$param['field_replace']['name'] = 'Advert.name';
		$param['field_replace']['category_name'] = 'Category.name';
		$param['field_replace']['category_sub_name'] = 'CategorySub.name';
		$param['field_replace']['advert_status_name'] = 'AdvertStatus.name';
		
		$string_namelike = (!empty($param['namelike'])) ? "AND Advert.name LIKE '%".$param['namelike']."%'" : '';
		$string_user = (!empty($param['user_id'])) ? "AND Advert.user_id = '".$param['user_id']."'" : '';
		$string_city = (!empty($param['city_id'])) ? "AND Advert.city_id = '".$param['city_id']."'" : '';
		$string_region = (!empty($param['region_id'])) ? "AND City.region_id = '".$param['region_id']."'" : '';
		$string_price_min = (!empty($param['price_min'])) ? "AND Advert.price >= '".$param['price_min']."'" : '';
		$string_price_max = (!empty($param['price_max'])) ? "AND Advert.price <= '".$param['price_max']."'" : '';
		$string_category = (!empty($param['category_id'])) ? "AND CategorySub.category_id = '".$param['category_id']."'" : '';
		$string_category_sub = (!empty($param['category_sub_id'])) ? "AND Advert.category_sub_id = '".$param['category_sub_id']."'" : '';
		$string_advert_type = (!empty($param['advert_type_id'])) ? "AND Advert.advert_type_id = '".$param['advert_type_id']."'" : '';
		$string_active = (isset($param['is_active'])) ? "AND User.is_active = '".$param['is_active']."'" : '';
		$string_verify_email = (isset($param['verify_email'])) ? "AND User.verify_email = '".$param['verify_email']."'" : '';
		$string_advert_status = (!empty($param['advert_status_id'])) ? "AND Advert.advert_status_id = '".$param['advert_status_id']."'" : '';
		$string_category_input = (isset($param['category_input_search'])) ? get_query_category_input($param['category_input_search']) : '';
		$string_delete = "AND (Advert.is_delete = '".$param['is_delete']."' OR 'x' = '".$param['is_delete']."')";
		$string_filter = GetStringFilter($param, @$param['column']);
		$string_sorting = GetStringSorting($param, @$param['column'], 'name ASC');
		$string_limit = GetStringLimit($param);
		
		// condition
		$string_condition = '';
		if (!empty($param['condition'])) {
			$string_condition = "AND Advert.metadata LIKE '%[PATTERN]%'";
			$string_replace = '"condition":"'.$param['condition'].'"';
			$string_condition = str_replace('[PATTERN]', $string_replace, $string_condition);
		}
		
		$select_query = "
			SELECT SQL_CALC_FOUND_ROWS Advert.*,
				User.email, User.first_name, User.last_name,
				AdvertStatus.name advert_status_name, City.name city_name, Region.name region_name,
				Category.name category_name, Category.thumbnail category_thumbnail, CategorySub.name category_sub_name
			FROM ".ADVERT." Advert
			LEFT JOIN ".USER." User ON User.id = Advert.user_id
			LEFT JOIN ".CITY." City ON City.id = Advert.city_id
			LEFT JOIN ".REGION." Region ON Region.id = City.region_id
			LEFT JOIN ".CATEGORY_SUB." CategorySub ON CategorySub.id = Advert.category_sub_id
			LEFT JOIN ".CATEGORY." Category ON Category.id = CategorySub.category_id
			LEFT JOIN ".ADVERT_STATUS." AdvertStatus ON AdvertStatus.id = Advert.advert_status_id
			WHERE 1 $string_namelike
				$string_user $string_city $string_region
				$string_category $string_category_sub
				$string_price_min $string_price_max
				$string_advert_type $string_active $string_verify_email $string_advert_status $string_category_input
				$string_condition $string_delete $string_filter
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
		if (isset($param['total_user'])) {
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".ADVERT;
		} else if (isset($param['user_id'])) {
			$select_query = "SELECT COUNT(*) TotalRecord FROM ".ADVERT." WHERE user_id = '".$param['user_id']."'";
		} else {
			$select_query = "SELECT FOUND_ROWS() TotalRecord";
		}
		
		$select_result = mysql_query($select_query) or die(mysql_error());
		$row = mysql_fetch_assoc($select_result);
		$TotalRecord = $row['TotalRecord'];
		
		return $TotalRecord;
    }
	
	function get_array_sort() {
		$result[] = array( 'value' => '[{"property":"post_time","direction":"DESC"},{"property":"Advert.id","direction":"DESC"}]', 'label' => 'Default' );
		$result[] = array( 'value' => '[{"property":"price","direction":"ASC"}]', 'label' => 'Price (Low &gt; High)' );
		$result[] = array( 'value' => '[{"property":"price","direction":"DESC"}]', 'label' => 'Price (High &gt; Low)' );
		$result[] = array( 'value' => '[{"property":"post_time","direction":"DESC"}]', 'label' => 'Lastest Advert' );
		$result[] = array( 'value' => '[{"property":"post_time","direction":"ASC"}]', 'label' => 'Oldest Advert' );
		
		return $result;
	}
	
	function get_array_limit() {
		$result = array(
			array( 'value' => 4 ),
			array( 'value' => 8 ),
			array( 'value' => 12 ),
			array( 'value' => 25 ),
			array( 'value' => 50 ),
			array( 'value' => 75 ),
			array( 'value' => 100 )
		);
		
		return $result;
	}
	
    function delete($param) {
		$delete_query  = "DELETE FROM ".ADVERT." WHERE id = '".$param['id']."' LIMIT 1";
		$delete_result = mysql_query($delete_query) or die(mysql_error());
		
		$result['status'] = '1';
		$result['message'] = 'Data successfully deleted.';

        return $result;
    }
	
	function sync($row, $param = array()) {
		$row = StripArray($row, array( 'post_time', 'sold_time' ));
		
		if (isset($row['content'])) {
			$row['content_limit'] = get_length_char($row['content'], 150, ' ...');
		}
		
		// common link
		$row['edit_link'] = base_url('post/'.$row['id']);
		if (isset($row['category_alias'])) {
			$row['category_link'] = base_url($row['category_alias']);
		}
		if (isset($row['category_alias']) && isset($row['category_sub_alias'])) {
			$row['category_sub_link'] = base_url($row['category_alias'].'/'.$row['category_sub_alias']);
		}
		
		// advert link
		if (!empty($row['alias'])) {
			$row['advert_link'] = base_url('advert/'.$row['alias']);
		} else if (!empty($row['code'])) {
			$row['advert_link'] = base_url('advert/'.$row['code']);
		} else {
			$row['advert_link'] = base_url('advert/'.$row['id']);
		}
		
		// thumbnail
		$file_path = $this->config->item('base_path').'/static/upload/'.$row['thumbnail'];
		if (file_exists($file_path) && !empty($row['thumbnail'])) {
			$thumbnail_small = preg_replace('/\.(jpg|jpeg|png|gif)/i', '_s.$1', $row['thumbnail']);
			$row['thumbnail_link'] = base_url('static/upload/'.$thumbnail_small);
		} else if (!empty($row['category_thumbnail'])) {
			$row['thumbnail_link'] = base_url('static/upload/'.$row['category_thumbnail']);
		} else {
			$row['thumbnail_link'] = base_url('static/img/no-image.png');
		}
		
		// label
		$row['price_text'] = MoneyFormat($row['price'], true);
		$row['post_time_text'] = show_time_diff($row['post_time']);
		
		// meta data
		if (isset($row['metadata'])) {
			$array_metadata = object_to_array(json_decode($row['metadata']));
			$row = array_merge($row, $array_metadata);
			unset($row['metadata']);
		}
		
		// fullname
		if (isset($row['first_name']) && isset($row['last_name'])) {
			$row['fullname'] = trim($row['first_name'].' '.$row['last_name']);
		}
		
		// decript email
		if (isset($row['email'])) {
			$row['email'] = mcrypt_decode($row['email']);
		}
		
		if (count(@$param['column']) > 0) {
			$param['is_custom'] = (isset($param['is_custom'])) ? $param['is_custom'] : '';
			
			if (!empty($param['is_manage'])) {
				if ($param['is_manage'] == 'admin') {
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-pencil btn-edit" title="Edit Category"></i> ';
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-list-alt btn-hyperlink" title="Edit Detail"></i> ';
					$param['is_custom'] .= '<a class="cursor-button tool-tip fa fa-link" href="'.$row['advert_link'].'" target="_blank" title="Preview"></a> ';
					
					if (in_array($row['advert_status_id'], array( ADVERT_STATUS_REVIEW, ADVERT_STATUS_RE_REVIEW ))) {
						$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-check btn-approve" title="Approve"></i> ';
						$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-times btn-reject" title="Reject"></i> ';
					}
					
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-delete" title="Delete"></i> ';
				} else if ($param['is_manage'] == 'member') {
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-list-alt btn-hyperlink" title="Edit Detail"></i> ';
					$param['is_custom'] .= '<a class="cursor-button tool-tip fa fa-link" href="'.$row['advert_link'].'" target="_blank" title="Preview"></a> ';
					
					if ($row['advert_status_id'] == ADVERT_STATUS_APPROVE && empty($row['sold_time'])) {
						$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-dollar btn-sold" title="Sold"></i> ';
					} else if ($row['advert_status_id'] == ADVERT_STATUS_RE_SUBMIT) {
						$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-refresh btn-resubmit" title="Resubmit"></i> ';
					}
					
					$param['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-delete" title="Delete"></i> ';
				}
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
			$image_small = preg_replace('/\.(jpg|jpeg|png|gif)/i', '_s.$1', $image_result);
			
			ImageResize($image_source, $image_small, 300, 240, 1);
		}
	}
}