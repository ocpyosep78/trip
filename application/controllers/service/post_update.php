<?php
class post_update extends CI_Controller {
    function __construct() {
        parent::__construct();
    }
    
    function index() {
		/*   region reminder promo   */
		
		// data
		$close_date = date('Y-m-d', strtotime( PROMO_REMINDER ));
		$widget = $this->widget_model->get_by_id(array( 'alias' => 'promo-reminder' ));
		$message = str_replace('[DATE_EXPIRED]', GetFormatDate($close_date), $widget['content']);
		
		$param_promo = array(
			'close_date' => $close_date,
			'limit' => 1000
		);
		$array_promo = $this->promo_model->get_array($param_promo);
		foreach ($array_promo as $row) {
			$param_mail = array(
				'to' => $row['member_email'],
				'subject' => 'Promo Reminder',
				'message' => $message,
			);
			sent_mail($param_mail);
		}
		
		/*   end region reminder promo   */
		
		
		
		/*   region update post   */
		
		// make all status having promo = 0
		$select_query = "UPDATE ".POST." SET having_promo = 0";
        $select_result = mysql_query($select_query) or die(mysql_error());
		
		// update post that having promo
		$param_promo = array(
			'between_date' => $this->config->item('current_date'),
			'limit' => 1000
		);
		$array_promo = $this->promo_model->get_array($param_promo);
		foreach ($array_promo as $row) {
			$param_update = array( 'id' => $row['post_id'], 'having_promo' => 1 );
			$this->post_model->update($param_update);
		}
		
		/*   end region update post   */
    }
}