<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
function loadData()
{
	$.ajax({
	url: "<?=base_url()?>data/barang",
	success:function(data)
	{
		$('#divPageData').html(data);
	}
	});
}
</script>
<table class="det-view">
<tr>
	<td>
		<h1><?=$detil_brg['brg_nama']?></h1> <br/>
		 kode : <b><?=$detil_brg['brg_kode']?></b> | <b>jenis : <?=$detil_brg['jb_nama']?></b>
	</td>
</tr>
<tr class="desc">
	<td><?=$detil_brg['brg_deskripsi']?></td>
</tr>
<tr>
	<td>stok : <b><?=$detil_brg['brg_stok']?> / <?=$detil_brg['brg_min_stok']?></b> &bull; harga : <b><?=$detil_brg['brg_harga_satuan']?></b> </td>
</tr>
<tr>
	<td>vendor : <b><?=$detil_brg['brg_vendor']?></b> &bull; suplier : <b><?=$detil_brg['sp_nama']?></b> &bull; disimpan oleh : <b><?=$detil_brg['user_name']?></b> pada : <b><?=$detil_brg['brg_timestamp']?></b></td>
</tr>
<tr>
	<td><a onclick="javascript:loadData()" class="k-button">semua data</a> <a href="<?=base_url('barang/update/'.$detil_brg['brg_id'])?>" class="k-button">Ubah</a></td>
</tr>
</table>



