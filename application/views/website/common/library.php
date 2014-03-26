<?php
	$carouFredSel = (isset($carouFredSel)) ? $carouFredSel : false;
	$js_add = (isset($js_add)) ? $js_add : array();
?>

<!-- This page JS -->
<script src="<?php echo base_url('static/theme/forest/js/js-index3.js'); ?>"></script>

<!-- Custom functions -->
<script src="<?php echo base_url('static/theme/forest/js/functions.js'); ?>"></script>

<!-- Picker UI-->	
<script src="<?php echo base_url('static/theme/forest/js/jquery-ui.js'); ?>"></script>

<!-- Easing -->
<script src="<?php echo base_url('static/theme/forest/js/jquery.easing.js'); ?>"></script>

<!-- jQuery KenBurn Slider  -->
<script type="text/javascript" src="<?php echo base_url('static/theme/forest/lib/rs-plugin/js/jquery.themepunch.revolution.min.js'); ?>"></script>

<!-- Nicescroll  -->
<script src="<?php echo base_url('static/theme/forest/js/jquery.nicescroll.min.js'); ?>"></script>

<?php if ($carouFredSel || true) { ?>
<!-- CarouFredSel -->
<script src="<?php echo base_url('static/theme/forest/js/jquery.carouFredSel-6.2.1-packed.js'); ?>"></script>
<script src="<?php echo base_url('static/theme/forest/js/helper-plugins/jquery.touchSwipe.min.js'); ?>"></script>
<script src="<?php echo base_url('static/theme/forest/js/helper-plugins/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo base_url('static/theme/forest/js/helper-plugins/jquery.transit.min.js'); ?>"></script>
<script src="<?php echo base_url('static/theme/forest/js/helper-plugins/jquery.ba-throttle-debounce.min.js'); ?>"></script>
<?php } ?>

<!-- Load Animo -->
<script src="<?php echo base_url('static/theme/forest/lib/animo/animo.js'); ?>"></script>

<!-- typeahead -->
<script src="<?php echo base_url('static/theme/forest/lib/typeahead/handlebars.js'); ?>"></script>
<script src="<?php echo base_url('static/theme/forest/lib/typeahead/typeahead.bundle.js'); ?>"></script>
<script src="<?php echo base_url('static/theme/forest/lib/typeahead/examples.js'); ?>"></script>

<!-- Custom Select -->
<script src="<?php echo base_url('static/theme/forest/js/jquery.customSelect.js'); ?>"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('static/theme/forest/js/bootstrap.min.js'); ?>"></script>


<?php foreach ($js_add as $item) { ?>
<script src="<?php echo base_url('static/theme/forest/js/'.$item); ?>"></script>	
<?php } ?>

<script src="<?php echo base_url('static/js/common.js'); ?>"></script>
<script src="<?php echo base_url('static/theme/forest/js/public.js'); ?>"></script>