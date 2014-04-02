<?php
class promo extends PANEL_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		$this->load->view( 'panel/post/promo' );
    }
	
	function grid() {
		$_POST['grid_type'] = 'editor';
		$_POST['column'] = array( 'post_title_text', 'promo_duration_title', 'publish_date_swap', 'promo_status' );
		
		$array = $this->promo_model->get_array($_POST);
		$count = $this->promo_model->get_count();
		$grid = array( 'sEcho' => $_POST['sEcho'], 'aaData' => $array, 'iTotalRecords' => $count, 'iTotalDisplayRecords' => $count );
		
		echo json_encode($grid);
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = array();
		if ($action == 'update') {
			$result = $this->promo_model->update($_POST);
		} else if ($action == 'update_status') {
			// param update
			$param_update['id'] = $_POST['id'];
			$param_update['promo_status'] = $_POST['promo_status'];
			
			// approve
			if ($_POST['promo_status'] == 'approve') {
				$promo = $this->promo_model->get_by_id(array( 'id' => $_POST['id'] ));
				
				$param_update['publish_date'] = $promo['publish_date'];
				$param_update['close_date'] = AddDate($promo['publish_date'], $promo['promo_duration']);
			}
			
			// update
			$result = $this->promo_model->update($param_update);
		} else if ($action == 'get_by_id') {
			$result = $this->promo_model->get_by_id(array( 'id' => $_POST['id'] ));
		} else if ($action == 'delete') {
			$result = $this->promo_model->delete($_POST);
		}
		
		echo json_encode($result);
	}
}