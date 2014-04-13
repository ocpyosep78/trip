<?php
class gallery_report extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/gallery_report' );
    }
	
	function grid() {
		$_POST['column'] = array( 'name', 'topic', 'post_date', 'status' );
		$_POST['is_custom']  = '<i class="cursor-button tool-tip fa fa-pencil btn-edit" title="Edit"></i> ';
		$_POST['is_custom'] .= '<i class="cursor-button tool-tip fa fa-link btn-link" title="Link"></i> ';
		$_POST['is_custom'] .= '<i class="cursor-button tool-tip fa fa-power-off btn-delete" title="Delete"></i> ';
		
		$array = $this->post_traveler_report_model->get_array($_POST);
		$count = $this->post_traveler_report_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->post_traveler_report_model->update($_POST);
		} else if ($action == 'get_by_id') {
			$result = $this->post_traveler_report_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->post_traveler_report_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}