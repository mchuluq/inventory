<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Inventory :: <?=$title?></title>

<?=$_embed?>

</head>
<body>
<section id="first-bar">
	<?=$_header?>
</section>
<section id="second-bar">
	<div class="breadcrumbs_container">
		<article class="breadcrumbs"><?=$_bc?></article>
	</div>
</section>
<div id="main-container">
	<aside id="leftsider">
		<?=$_sider?>
	</aside>
	<section id="rightcontent">
	<article class="module">
	<header><h3><?=$title?></h3></header>
	<div class="art-content">
	<ul id="r-panel">
		<?php $type="date";foreach($file as $f): ?>
			<li><?=$f?>
				<ul>
					<li><a href="<?=base_url('storage/report/'.$f)?>">unduh</a></li>
					<li><?="last access : <b>".date("D-M-Y H:i:s",fileatime('./storage/report/'.$f))."</b> | ukuran : <b>".filesize('./storage/report/'.$f)." KB </b>"?></li>
				</ul>				
			</li>
		<?php endforeach ?>
	</ul>
	</div>
	</article>
	<div class="footer-section"><?=$_footer?></div>
	</section>	
</div>

<?=$_alert?>
<script>
	$(document).ready(function() {
    	$("#k-menu").kendoMenu();
    	$("#k-panel").kendoPanelBar();
    	$("#r-panel").kendoPanelBar({
            expandMode: "single"
        });
    });
</script>
</body>
</html>