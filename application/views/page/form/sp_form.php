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
	<legend>detil suplier</legend>
	<table>
		<tr>
			<td><label class="required" for="sp_nama">nama suplier : </label></td>
			<td><input title="max. 100 karakter" maxlength="100" class="k-textbox" type="text" name="sp_nama" placeholder="nama suplier" value="<?=$detil_sp['sp_nama']?>" required validationMessage="harap masukkan nama suplier"/></td>
			<td><label for="sp_fax">fax : </label></td>
			<td><input title="max. 20 karakter" maxlength="20" class="k-textbox" type="text" id="fax" name="sp_fax" placeholder="fax" value="<?=$detil_sp['sp_fax']?>" /></td>
		</tr>
		<tr>
			<td><label class="required" for="sp_alamat">alamat : </label></td>
			<td><input title="max. 100 karakter" maxlength="100" class="k-textbox" type="text" name="sp_alamat" placeholder="alamat" value="<?=$detil_sp['sp_alamat']?>" required validationMessage="harap masukkan alamat suplier"/></td>
			<td><label for="sp_email">email : </label></td>
			<td><input title="max. 50 karakter" maxlength="50" class="k-textbox" type="email" name="sp_email" placeholder="email" value="<?=$detil_sp['sp_email']?>"/></td>
		</tr>
		<tr>
			<td><label class="required" for="sp_kota">kota : </label></td>
			<td><input title="max. 50 karakter" maxlength="50" class="k-textbox" type="text" name="sp_kota" placeholder="kota" value="<?=$detil_sp['sp_kota']?>" required validationMessage="harap masukkan nama kota"/></td>
			<td><label for="sp_url">weblink : </label></td>
			<td><input title="max. 50 karakter" maxlength="50" class="k-textbox" type="text" name="sp_url" placeholder="http://" value="<?=$detil_sp['sp_url']?>"/></td>
		</tr>
		<tr>
			<td><label for="sp_telp">telepon : </label></td>
			<td><input title="max. 20 karakter" maxlength="20" class="k-textbox" id="telpon" type="text" name="sp_telp" placeholder="telepon" value="<?=$detil_sp['sp_telp']?>"/></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td><label for="sp_keterangan">keterangan : </label></td>
			<td colspan="3"><textarea style="width:100%;" name="sp_keterangan"><?=$detil_sp['sp_keterangan']?></textarea></td>
		</tr>
		<tr>
			<td><input type="hidden" name="sp_id" value="<?=$detil_sp['sp_id']?>"/></td>
			<td colspan="3"><div class="status"></div></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" id="submiter"value="simpan" class="k-button"/>
				<input type="reset" id="reseting"value="kosongkan" class="k-button"/>
				<button onclick="history.back(-1)" class="k-button">batal</button></td>
			<td></td>
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
