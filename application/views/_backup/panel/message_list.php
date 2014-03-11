<?php
	$user = $this->User_model->get_session();
	
	// array user contact
	$param_user_contact['user_id'] = $user['id'];
	$param_user_contact['namelike'] = $_POST['namelike'];
	$param_user_contact['start'] = (isset($_POST['start'])) ? $_POST['start'] : 25;
	if (isset($_POST['is_read'])) {
		$param_user_contact['is_read'] = $_POST['is_read'];
	}
	$array_user_contact = $this->User_Contact_model->get_array($param_user_contact);
	$count_user_contact = $this->User_Contact_model->get_count($param_user_contact);
?>
<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-alt list-group-lg" data-count="<?php echo $count_user_contact; ?>">
	<?php foreach ($array_user_contact as $row) { ?>
	<?php $class_name = (empty($row['is_read'])) ? 'animated fadeInRightBig' : ''; ?>
	<?php $style_name = (empty($row['is_read'])) ? 'style="font-style: italic;"' : ''; ?>
	<li class="list-group-item <?php echo $class_name; ?>" id="user-contact-<?php echo $row['id']; ?>">
		<span class="hide record"><?php echo json_encode($row); ?></span>
		<a class="cursor thumb-xs pull-left m-r-sm">
			<img src="<?php echo $row['sender_thumbnail_profile_link']; ?>" class="img-circle" />
		</a>
		<a class="cursor clear" <?php echo $style_name; ?>>
			<small class="pull-right text-muted"><?php echo $row['post_time_text']; ?></small>
			<strong><?php echo $row['name']; ?></strong>
			<span><?php echo $row['title']; ?></span>
		</a>
	</li>
	<?php } ?>
</ul>