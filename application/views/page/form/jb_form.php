<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Inventory :: <?=$title?></title>

<?=$_embed?>
<?=embed_tinymce($_color)?>
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
	<legend>detil jenis barang</legend>
	<table>
		<tr>
			<td><label for="jb_nama">jenis barang : </label></td>
			<td><input title="max. 50 karakter" maxlength="50" class="k-textbox" type="text" name="jb_nama" placeholder="jenis barang..." value="<?=$detil_jb['jb_nama']?>" required validationMessage="harap masukkan nama jenis barang"/></td>
		</tr>
		<tr>
			<td><label for="jb_deskripsi">deskripsi : </label></td>
			<td><textarea style="width:100%;" name="jb_deskripsi"><?=$detil_jb['jb_deskripsi']?></textarea></td>
		</tr>
		<tr>
			<td><input type="hidden" name="jb_id" value="<?=$detil_jb['jb_id']?>"/></td>
			<td class="status"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" id="submiter"value="simpan" class="k-button"/><input type="reset" id="reseting"value="kosongkan" class="k-button"/><button onclick="history.back(-1)" class="k-button">batal</button></td>
		</tr>
</table>
</fieldset>
</form>
	</div>
	<footer>footer</footer>
	</article>
	<div class="footer-section"><?=$_footer?></div>
	</section>	
</div>
<?=$_alert?>
<script>
	$(document).ready(function() {
    	$("#k-menu").kendoMenu();
    	$("#k-panel").kendoPanelBar();
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
