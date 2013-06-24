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
	<legend>detil barang</legend>
	<table>
		<tr>
			<td><label class="required" for="brg_nama">nama barang : </label></td>
			<td><input title="max. 100 karakter" maxlength="100" class="k-textbox" type="text" name="brg_nama" placeholder="nama barang" value="<?=$detil_brg['brg_nama']?>" required validationMessage="harap masukkan nama barang"/></td>

			<td><label class="required" for="brg_vendor">vendor : </label></td>
			<td><input title="max. 100 karakter" maxlength="100" class="k-textbox" type="text" name="brg_vendor" placeholder="vendor" value="<?=$detil_brg['brg_vendor']?>" required validationMessage="harap masukkan vendor"/></td>
		</tr>
		<tr>
			<td><label class="required" for="brg_kode">kode barang : </label></td>
			<td><input title="max. 20 karakter" maxlength="20" class="k-textbox" type="text" name="brg_kode" placeholder="kode" value="<?=$detil_brg['brg_kode']?>" required validationMessage="harap masukkan kode barang"/></td>
			
			<td><label class="required" for="jb_id">jenis barang : </label></td>
			<td>
				<select name="jb_id" id="jb_select">
				<?php foreach($jenis as $jb) :?>
					<option value="<?=$jb['jb_id']?>" <?php if($jb['jb_id']==$detil_brg['jb_id']) echo"selected";?> ><?=$jb['jb_nama']?></option>			
				<?php endforeach ?>	
				</select>
				<a href="<?=base_url('jenis_barang/create/brg')?>" class="k-button">tambah jenis barang</a>
			</td>
		</tr>
		<tr>
			<td><label class="required" for="brg_harga_satuan">harga satuan : </label></td>
			<td><input title="format 15.2" max="99999999999999.99" class="k-textbox" type="number" name="brg_harga_satuan" placeholder="harga" value="<?=$detil_brg['brg_harga_satuan']?>" required validationMessage="harap masukkan harga"/></td>
			
			<td><label class="required" for="sp_id">suplier : </label></td>
			<td>
				<select name="sp_id" id="sp_select">
				<?php foreach($suplier as $sp) :?>
					<option value="<?=$sp['sp_id']?>" <?php if($sp['sp_id']==$detil_brg['sp_id']) echo"selected";?> ><?=$sp['sp_nama']?></option>			
				<?php endforeach ?>	
				</select>
				<a href="<?=base_url('suplier/create/brg')?>" class="k-button">tambah suplier</a>
			</td>
		</tr>
		<tr>
			<td><label for="brg_min_stok">stok minimal : </label></td>
			<td colspan="3"><input type="number" class="k-textbox" name="brg_min_stok" min="1" value="<?=$detil_brg['brg_min_stok']?>" required validationMessage="harap masukkan stok minimal"/></td>
		</tr>
		<tr>
			<td><label for="brg_deskripsi">deskripsi : </label></td>
			<td colspan="3"><textarea style="width:100%;" name="brg_deskripsi"><?=$detil_brg['brg_deskripsi']?></textarea></td>
		</tr>
		<tr>
			<td><input type="hidden" name="brg_id" value="<?=$detil_brg['brg_id']?>"/></td>
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
    	$("#sp_select").kendoDropDownList();
    	$("#jb_select").kendoDropDownList();
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
