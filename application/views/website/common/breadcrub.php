<div class="breadcrumbs">
<div xmlns:v="http://rdf.data-vocabulary.org/#">
 

<?php
	$array = (isset($array)) ? $array : array();
?>

<div class="container breadcrub">
	<div>
		<span typeof="v:Breadcrumb">
<a class="homebtn left" href="http://www.tripdomestik.com" property="v:title" rel="v:url"></a></span>
		<div class="left"> 
		<ul class="bcrumbs">
			<?php foreach ($array as $key => $row) { ?>
			<li>/</li>
			<li>

<span typeof="v:Breadcrumb">
<a href="<?php echo $row['link']; ?>" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" property="v:title" rel="v:url"><?php echo $row['title']; ?></a>
 
</span>
			
			
			
			
			
			</li>
			<?php } ?>
		</ul></div>
		<a class="backbtn right" href="#"></a>
	</div>
	<div class="clearfix"></div>
	<div class="brlines"></div>
</div>

</div>
</div>
 