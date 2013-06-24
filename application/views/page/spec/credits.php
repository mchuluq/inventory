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
	<div style="padding:5px 10px;">
	<ul style="list-style-type: circle;margin-left:20px;">
		<li>Eclipse For PHP Developers, version 3.0.2 | <a href="http://www.eclipse.org">eclipse</a></li>
		<li>XAMPP, version 1.8.1 | <a href="http://www.apachefriends.org/en/">apachefriends.org</a></li>
		<li>Codeigniter, version 2.1.3 | <a href="http://codeigniter.com/">Ellislab, Inc.</a> </li>
		<li>PHPExcel, version 1.7.8 | <a href="http://www.codeplex.com/PHPExcel">Codeplex</a> </li>
		<li>jQuery, version 1.8.2 | <a href="http://jquery.com/">jquery javascript library</a> </li>
		<li>jQuery-UI, version 1.8.24 | <a href="http://jqueryui.com/">jquery-ui</a></li>
		<li>Kendo UI Web v2012.3.1114 | <a href="http://kendoui.com">Telerik AD.</a></li>
		<li>Tiny MCE, version 3.5.7 | <a href="http://www.moxiecode.com/" target="_blank">Moxiecode Systems AB</a></li>
		<li>jQuery Context Menu Plugin, version 1.01 | <a href="http://abeautifulsite.net/2008/09/jquery-context-menu-plugin/">Cory S.N. LaViska</a></li>
	</ul>
	</div>
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
    	 $("#group_select").kendoDropDownList();
    	var slider = $("#slider").kendoSlider({
            increaseButtonTitle: "Right",
            decreaseButtonTitle: "Left",
            min: 0,
            max: 20,
            smallStep: 1,
            largeStep: 2
        }).data("kendoSlider");
    });

	var validator = $("#myform").kendoValidator().data("kendoValidator"),
    status = $(".status");

    $("input#submiter").click(function() {
        if (validator.validate()) {
            status.text("Data segera disimpan").addClass("valid");
            } else {
            status.text("Oops! ada yang salah dengan data masukan.").addClass("invalid");
        }
    });
</script>
</body>
</html>
