<?php
	$web['base'] = base_url();
	
	$html_class = (!empty($html_class)) ? $html_class : 'app';
?>
<!DOCTYPE html>
<html lang="en" class="<?php echo $html_class; ?>">
<head>
	<meta charset="utf-8" />
	<title>Tripdomestik.com | Dashboard</title>
	<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<link rel="stylesheet" href="<?php echo base_url('static/css/bootstrap.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/css/animate.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/css/font-awesome.min.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/css/font.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/js/calendar/bootstrap_calendar.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/js/datatables/datatables.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/js/datepicker/datepicker.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/css/tree.css'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url('static/css/app.css'); ?>" type="text/css" />
	
	<script type="text/javascript">var web = <?php echo json_encode($web); ?></script>
	<script src="<?php echo base_url('static/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/js/bootstrap.js'); ?>"></script>
	
	<!--[if lt IE 9]>
	<script src="<?php echo base_url('static/js/ie/html5shiv.js'); ?>"></script>
	<script src="<?php echo base_url('static/js/ie/respond.min.js'); ?>"></script>
	<script src="<?php echo base_url('static/js/ie/excanvas.js'); ?>"></script>
	<![endif]-->
</head>