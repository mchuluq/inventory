<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Inventory :: <?=$title?></title>

<?=$_embed?>

<script type="text/javascript">
$(document).ready(function() {
$("select#r-select").change(function(){ 
  	if ($(this).val() == "act"){
  	  $("tr#date").show();
    }
    else{
      $("tr#date").hide();
    }
	});
});
</script>
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
	<form class="ch-form" id="myform" method="post" action="">
	<fieldset>
	<legend>Excel Report</legend>
	<table>
		<tr>
			<td><label for="date_start">jenis</label></td>
			<td>
				<select id="r-select" name="report_type">
					<option value="brg">Barang</option>
					<option value="jb">Jenis Barang</option>
					<option value="sp">Suplier</option>
					<option value="act">Aktifitas Barang</option>
				</select>
			</td>
		</tr>
		<tr id="date" style="display:none;">
			<td><label for="date_start">mulai : </label><input id="start" type="date" name="date_start" placeholder="tttt-bb-hh" /></td>
			<td><label for="date_end">sampai : </label><input id="end" type="date" name="date_end" placeholder="tttt-bb-hh" /></td>
		</tr>
		<tr>
			<td><input type="submit" id="submiter"value="Buat" class="k-button"/></td>
			<td></td>
		</tr>
</table>
</fieldset>
</form>
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
    	$("#r-select").kendoDropDownList();
    });
</script>
<script type="text/javascript">
$(document).ready(function() {
	function startChange() {
		var startDate = start.value();
		if (startDate) {
			startDate = new Date(startDate);
			startDate.setDate(startDate.getDate() + 1);
			end.min(startDate);
		}
	}
	function endChange() {
		var endDate = end.value();
		if (endDate) {
			endDate = new Date(endDate);
			endDate.setDate(endDate.getDate() - 1);
			start.max(endDate);
		}
	}
	var start = $("#start").kendoDatePicker({
		change: startChange,
		format: "yyyy-MM-dd"
	}).data("kendoDatePicker");
	var end = $("#end").kendoDatePicker({
		change: endChange,
		format: "yyyy-MM-dd"
	}).data("kendoDatePicker");
	start.max(end.value());
	end.min(start.value());
});
</script>
</body>
</html>
