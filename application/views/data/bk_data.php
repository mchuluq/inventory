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
			x = confirm("apakah anda yakin menghapus data barang keluar ini ?"); 
			if(x == 1){ 
				document.location='<?=base_url()?>barang_keluar/delete/'+$(el).attr('id');	
		    }						
		}else if(act=="ref"){
			reloadData();
		}
	});
});

function reloadData(){
	  $("input#search-box").val('');
	  $.ajax({
    url: "<?=base_url()?>data/barang_keluar/",
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
    url: "<?=base_url()?>data/barang_keluar/"+ page +"/"+ cari,
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
	foreach($data as $bk): 	
	if($count % 2 == 0)$class='even'; else $class='odd' ;
?>
	<tr class="<?=$class?>" id="<?=$bk['bk_id']?>">
		<td>
			<?=$bk['bk_kode']?> &raquo; <b><?=$bk['brg_nama']?></b> <br/>
			tanggal : <?=$bk['bk_tgl']?> &bull; <?=timespan($bk['bk_time'],$ws); ?> yang lalu &bull; oleh : <?=$bk['user_name']?>
		</td>
		<td><?=$bk['bk_jumlah']?></td>
		<td><?=$bk['bk_keterangan']?></td>
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