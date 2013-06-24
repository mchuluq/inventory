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
	<form class="ch-form" id="myform" method="post" action="">
	<fieldset>
	<legend>detil konfigurasi</legend>
	<table>
		<tr>
			<td><label for="data_per_page">tampilan data perhalaman : </label></td>
			<td><input name="data_per_page" style="width:260px" id="slider" class="balSlider" value="<?=$conf['data_per_page']?>" /></td>
		</tr>
		<tr>
			<td><label for="default_group" title="default group untuk pengguna baru">default group : </label></td>
			<td>
				<select name="default_group" id="group_select">
				<?php foreach($group as $gn) :?>
					<option value="<?=$gn['group_name']?>" <?php if($gn['group_name']==$conf['default_group']) echo"selected";?> ><?=$gn['group_name']?></option>			
				<?php endforeach ?>	
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="company_name">nama perusahaan : </label></td>
			<td><input class="k-textbox" type="text" name="company_name" placeholder="jenis barang..." value="<?=$conf['company_name']?>" required validationMessage="harap masukkan nama perusahaan"/></td>
		</tr>
		<tr>
			<td><input type="hidden" name="config_id" value="<?=$conf['config_id']?>"/></td>
			<td class="status"></td>
		</tr>
		<tr>
			<td><input type="submit" id="submiter"value="simpan" class="k-button"/></td>
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
