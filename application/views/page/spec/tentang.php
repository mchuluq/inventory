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
	<h1>Inventory Information System</h1>
	<p>Aplikasi ini dibuat untuk memenuhi Tugas Mata kuliah Manajemen Proyek Di Fakultas Teknik Program Studi Teknik Informatika <a href="http"//www.yudharta.ac.id" target="_blank"> Universitas Yudharta Pasuruan</a> Tahun Angkatan 2009.</p>
	<p>Aplikasi ini dibangun dengan Bahasa Scripting PHP (PHP : Hypertext Preprocessor) dengan basis data MySQL server untuk mengelolah persediaan barang di sebuah gudang.</p>
	<h3>Kebutuhan System Minimal</h3>
	<h4>Server</h4>
	<ul style="list-style:circle;padding:0 10px">
		<li>Processor Intel Pentium E Dual Core, atau setara</li>
		<li>1GB Memory</li>
		<li>50 MB Ruang Hard Disk</li>
		<li>PHP versi 5.4.7</li>
		<li>MySQL Server versi 5.5.27</li>
		<li>GD support Enabled untuk PHP</li>
	</ul>
	<h4>Client</h4>
	<ul style="list-style:circle;padding:0 10px">
		<li>Processor Intel Pentium 4, atau setara</li>
		<li>512MB Memory</li>
		<li>HTML 5 support, CSS 3 support, Javascript Enabled ex: Mozilla Firefox 4.0, Google Chrome 4, Internet Explore 7, Opera 10, Safari 5</li>
	</ul>
	<h3>Tim Pengembang</h3>
	<ul style="list-style:circle;padding:0 10px">
		<li>Mokh. Ansori, Project Manager</li>
		<li>Wahyu Hidayatullah, System Analyst</li>
		<li>Mochammad Chusnul Chuluq, Programming</li>
		<li>Wahyu Alfarisya, Designer</li>
		<li>Syaroni, Testing</li>
		<li>Siti Qomariyah, Documentation</li>
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
