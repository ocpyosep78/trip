<?php
class advert_type_sub extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/setup/advert_type_sub' );
    }
	
	function grid() {
		$_POST['is_edit'] = 1;
		$_POST['column'] = array( 'category_name', 'category_sub_name', 'advert_type_name' );
		
		$array = $this->Advert_Type_Sub_model->get_array($_POST);
		$count = $this->Advert_Type_Sub_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->Advert_Type_Sub_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->Advert_Type_Sub_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->Advert_Type_Sub_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}