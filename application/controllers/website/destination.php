<?php

class destination extends TRIP_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// check uri
		preg_match('/(action|rss)$/i', $_SERVER['REQUEST_URI'], $match);
		
		// action
		if (!empty($match[0]) && method_exists($this, $match[0])) {
			$method_name = $match[0];
			$this->$method_name();
		}
		
		// review
		else if (!empty($this->uri->segments[5]) && $this->uri->segments[5] == 'review') {
			$method_name = $this->uri->segments[2];
			$this->review();
		}
		
		// gallery
		else if (!empty($this->uri->segments[5]) && $this->uri->segments[5] == 'gallery') {
			$method_name = $this->uri->segments[2];
			$this->gallery();
		}
		
		// upload
		else if (!empty($this->uri->segments[5]) && $this->uri->segments[5] == 'upload') {
			$method_name = $this->uri->segments[2];
			$this->upload();
		}
		
		// index
		else if (!empty($this->uri->segments[2])) {
			if (method_exists($this, $this->uri->segments[2])) {
				$method_name = $this->uri->segments[2];
				$this->$method_name();
			} else if ($this->uri->segments[2] == 'review') {
				$this->load->view( 'website/destination_review' );
			} else if ($this->uri->segments[2] == 'gallery') {
				$this->load->view( 'website/destination_gallery' );
			} else if (count($this->uri->segments) >= 4) {
				$this->load->view( 'website/post_detail' );
			} else {
				$this->load->view( 'website/destination' );
			}
		} else {
			$this->load->view( 'website/destination' );
		}
    }
	
	function view() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		$result = '';
		if ($action == 'get_post_view') {
			$result = $this->load->view( 'website/common/template_post_public', array(), true );
			
			$result_check = trim(strip_tags($result));
			if (empty($result_check)) {
				$result = '<div style="padding: 0 20px;">Sorry, there is no post that match with your criteria.</div>';
			}
		}
		
		echo $result;
	}
	
	function review() {
		$this->load->view( 'website/post_review' );
	}
	
	function gallery() {
		$this->load->view( 'website/post_gallery' );
	}
	
	function upload() {
		$this->load->view( 'website/post_upload' );
	}
	
	function action() {
		$action = (isset($_POST['action'])) ? $_POST['action'] : '';
		unset($_POST['action']);
		
		// user
		$user_session = $this->user_model->get_session();
		$user = $this->user_model->get_by_id(array( 'user_type_id' => $user_session['user_type_id'], 'id' => $user_session['id'] ));
		
		$result = array();
		if ($action == 'review_update') {
			$param_update = $_POST;
			$param_update['post_status'] = 'pending';
			$param_update['traveler_id'] = $user['id'];
			$param_update['alias'] = get_name($param_update['title']);
			$param_update['post_date'] = $this->config->item('current_datetime');
			$result = $this->post_traveler_review_model->update($param_update);
			
			$result['message'] = 'Thank you, your review will be check soon.';
		} else if ($action == 'traveler_photo_update') {
			$param_update = $_POST;
			$param_update['post_status'] = 'pending';
			$param_update['traveler_id'] = $user['id'];
			$param_update['alias'] = get_name($param_update['title']);
			$param_update['post_date'] = $this->config->item('current_datetime');
			$result = $this->post_traveler_photo_model->update($param_update);
			
			$result['message'] = 'Thank you, your photo will be check soon.';
		} else if ($action == 'report_traveler_photo') {
			$_POST['status'] = 'pending';
			$_POST['post_date'] = $this->config->item('current_datetime');
			$result = $this->post_traveler_report_model->update($_POST);
			
			$result['message'] = 'Thank you for your report, we will check your report soon.';
		}
		
		echo json_encode($result);
	}
	
	function rss() {
		// default data
		$category = $category_sub = array();
		
		// set data
		$category = $this->category_model->get_by_id(array( 'alias' => $this->uri->segments[1] ));
		if (count($category) > 0) {
			$category_sub = $this->category_sub_model->get_by_id(array( 'alias' => $this->uri->segments[2] ));
		}
		
		// param post
		$param_post['sort'] = '[{"property":"post_update","direction":"DESC"}]';
		
		// param additional
		if (count($category) > 0) {
			$param_post['category_id'] = $category['id'];
		}
		if (count($category_sub) > 0) {
			$param_post['category_sub_id'] = $category_sub['id'];
		}
		
		// array post
		$array_post = $this->post_model->get_array($param_post);
		
		// rss link
		$rss_param['link'] = $category['link_category'];
		$rss_param['link'] = (count($category_sub) > 0) ? $category_sub['link_category_sub'] : $category['link_category'];
		$rss_param['link'] = $rss_param['link'].'/rss';
		
		// rss title
		$rss_param['title']  = 'Trip Domestik - '.$category['title'];
		$rss_param['title'] .= (count($category_sub) > 0) ? ' - '.$category_sub['title'] : '';
		
		// rss description
		$rss_param['description'] = $category['title'];
		$rss_param['description'] .= (count($category_sub) > 0) ? ' - '.$category_sub['title'] : '';
		
		// rss item
		$rss_param['array_item'] = $array_post;
		
		// render it
		$this->load->view( 'website/rss', $rss_param );
	}
}