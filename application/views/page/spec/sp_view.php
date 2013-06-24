<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript">
function loadData()
{
	$.ajax({
	url: "<?=base_url()?>data/suplier",
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
		<h1><?=$detil_sp['sp_nama']?></h1> <br/>
		 alamat : <em><b><?=$detil_sp['sp_alamat']?></b></em> | <em><b><?=$detil_sp['sp_kota']?></b></em>
	</td>
</tr>
<tr class="desc">
	<td><?=$detil_sp['sp_keterangan']?></td>
</tr>
<tr>
	<td>email : <b><a href="mailto:<?=$detil_sp['sp_email']?>"><?=$detil_sp['sp_email']?></a></b> &bull; url : <b><a href="<?=$detil_sp['sp_url']?>"><?=$detil_sp['sp_url']?></a></b> </td>
</tr>
<tr>
	<td><a onclick="javascript:loadData()" class="k-button">semua data</a> <a href="<?=base_url('suplier/update/'.$detil_sp['sp_id'])?>" class="k-button">Ubah</a></td>
</tr>
</table>



