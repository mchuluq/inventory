<script type="text/javascript">
$(document).ready( function() {	
	$("table.ch-table tbody tr").contextMenu({
		menu: 'myMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="data"){
			document.location='<?=base_url()?>barang';
		}
		else if(act=="delete"){
			x = confirm("apakah anda yakin menghapus data barang masuk ini ?"); 
			if(x == 1){ 
				document.location='<?=base_url()?>barang_masuk/delete/'+$(el).attr('id');	
		    }						
		}
		else if(act=="ref"){
			reloadData();
		}
	});
});
function reloadData(){
	  $("input#search-box").val('');
	  $.ajax({
    url: "<?=base_url()?>data/barang_masuk/",
		success:function(data)
		{
			$('#divPageData').html(data);
		}
  });
}
function my_pagination(page)
{
	var cari = $("input#search-box").val();
	$.ajax({
    url: "<?=base_url()?>data/barang_masuk/"+ page +"/"+ cari,
		success:function(data)
		{
			$('#divPageData').html(data);
		}
  });
}
</script>
<div class="art-content">
<div class="data-container">
<table class="ch-table">
<thead>
	<tr>
		<th>barang</th>
		<th>jumlah</th>
		<th>keterangan</th>
	</tr>
</thead>
<tbody>
<?php 
	$count = 1 ; 
	$ws = now();
	if(empty($data)) { echo"<tr><td colspan=\"3\">tidak ada data</td></tr>";};
	foreach($data as $bm): 	
	if($count % 2 == 0)$class='even'; else $class='odd' ;
?>
	<tr class="<?=$class?>" id="<?=$bm['bm_id']?>">
		<td>
			<?=$bm['bm_kode']?> &raquo; <b><?=$bm['brg_nama']?></b> <br/>
			tanggal : <?=$bm['bm_tgl']?> &bull; <?=timespan($bm['bm_time'],$ws); ?> yang lalu &bull; oleh : <?=$bm['user_name']?>
		</td>
		<td><?=$bm['bm_jumlah']?></td>
		<td><?=$bm['bm_keterangan']?></td>
	</tr>
<?php 
	$count++;
	endforeach 
?>
</tbody>
</table>
<!-- context menu item -->
<ul id="myMenu" class="contextMenu">
	<li><a href="#data">Data Barang</a></li>
	<li><a href="#delete">Hapus</a></li>
	<li><a href="#ref">Refresh</a></li>
</ul>
</div>
	</div>
	<footer>
	<table class="data-add">
		<tr>
			<td>
				<?php echo $pagination; ?>
			</td>
			<td>
				<div class="data-prop">
					<span><?=$stat?></span>
				</div>
			</td>
		</tr>
		</table>		
	</footer>