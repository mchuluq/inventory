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
	<legend>detil barang masuk</legend>
	<table>
		<tr>
			<td><label for="brg_nama">barang : </label></td>
			<td><span class="k-textbox"><input type="text" name="brg_kode" value="<?=$detil_brg['brg_kode']?>" required readonly/></span></td>			
			<td><input type="hidden" name="brg_id" value="<?=$detil_brg['brg_id']?>" required/></td>
			<td><span class="k-textbox"><input type="text" name="brg_nama" value="<?=$detil_brg['brg_nama']?>" required readonly/></span></td>
		</tr>
		<tr>
			<td><label class="required" for="bk_kode">kode barang keluar : </label></td>
			<td><input title="max. 20 karakter" maxlength="20" class="k-textbox" type="text" name="bk_kode" placeholder="kode" required validationMessage="dibutuhkan kode barang keluar"/></td>			
			<td><label class="required" for="bk_tgl">tanggal : </label></td>
			<td><input id="datepicker" type="date" name="bk_tgl" value="<?=date('Y-m-d')?>" placeholder="tttt-bb-hh" required validationMessage="dibutuhkan tanggal"/></td>	
		</tr>
		<tr>
			<td><label for="bk_jumlah">jumlah keluar : </label></td>			
			<td colspan="3">
				<input type="number" class="k-textbox" placeholder="jumlah keluar" name="bk_jumlah" min="1" max="<?=$detil_brg['brg_stok']?>" required validationMessage="jumlah keluar tidak boleh kosong" data-max-msg="masukkan data antara 1 sampai <?=$detil_brg['brg_stok']?>"/><span class="k-invalid-msg" data-for="bk-jumlah"></span>
				<a class="k-button" href="<?=base_url('barang_masuk/create/'.$detil_brg['brg_id'])?>">tambah stok "<?=$detil_brg['brg_nama']?>"</a>
			</td>			
		</tr>
		<tr>
			<td><label for="bk_keterangan">keterangan : </label></td>
			<td colspan="3"><textarea style="width:100%;" name="bk_keterangan"></textarea></td>
		</tr>
		<tr>
			<td colspan="4"><div class="status"></div></td>
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
    	$("#datepicker").kendoDatePicker({format: "yyyy-MM-dd"});
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
