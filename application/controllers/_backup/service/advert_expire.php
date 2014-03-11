<?php
class advert_expire extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		// status approve more than 60 days
		$counter_resubmit = 0;
		$string_date = date("m/d/Y", strtotime('- 60 days'));
		$param_advert_approve = array(
			'is_delete' => 'x',
			'advert_status_id' => ADVERT_STATUS_APPROVE,
			'filter' => '[{"type":"date","comparison":"lt","value":"' . $string_date . '","field":"Advert.post_time"}]',
			'limit' => 10000
		);
		$array_advert_approve = $this->Advert_model->get_array($param_advert_approve);
		foreach ($array_advert_approve as $advert) {
			$param_mail['to'] = $advert['email'];
			$param_mail['subject'] = 'Please re submit your advert';
			$param_mail['message'] = 'Please re submit your advert if you still want to show your advert.<br /><br /><a href="'.base_url('login').'">'.WEBSITE_TITLE.'</a>';
			sent_mail($param_mail);
			
			$update_advert['id'] = $advert['id'];
			$update_advert['advert_status_id'] = ADVERT_STATUS_RE_SUBMIT;
			$this->Advert_model->update($update_advert);
			
			$counter_resubmit++;
		}
		echo "$counter_resubmit advert has been change to resubmit.<br />";
		
		// status reject more than 60 days
		$counter_reject = 0;
		$string_date = date("m/d/Y", strtotime('- 60 days'));
		$param_advert_reject = array(
			'is_delete' => 'x',
			'advert_status_id' => ADVERT_STATUS_REJECT,
			'filter' => '[{"type":"date","comparison":"lt","value":"' . $string_date . '","field":"Advert.post_time"}]',
			'limit' => 10000
		);
		$array_advert_reject = $this->Advert_model->get_array($param_advert_reject);
		foreach ($array_advert_reject as $advert) {
			$this->Advert_model->delete(array( 'id' => $advert['id'] ));
			$counter_reject++;
		}
		echo "$counter_reject advert with status reject has been deleted.<br />";
    }
}