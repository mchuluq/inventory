<script type="text/javascript">
$(document).ready( function() {	
	$("table.ch-table tbody tr").contextMenu({
		menu: 'myMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="create"){
			document.location='<?=base_url()?>barang/create';
		}
		else if(act=="add"){
			document.location='<?=base_url()?>barang_masuk/create/'+$(el).attr('id');				
		}
		else if(act=="min"){
			document.location='<?=base_url()?>barang_keluar/create/'+$(el).attr('id');				
		}
		else if(act=="update"){
			document.location='<?=base_url()?>barang/update/'+$(el).attr('id');				
		}
		else if(act=="delete"){
			x = confirm("apakah anda yakin menghapus barang ini ?"); 
			if(x == 1){ 
				document.location='<?=base_url()?>barang/delete/'+$(el).attr('id');
		    }							
		}
		else if(act=="view"){
			view($(el).attr('id'));				
		}
		else if(act=="ref"){
			reloadData();				
		}
	});
});
function reloadData(){
	$("input#search-box").val('');
	  $.ajax({
    	url: "<?=base_url()?>data/barang/",
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
    url: "<?=base_url()?>data/barang/"+ page +"/"+ cari,
		success:function(data)
		{
			$('#divPageData').html(data);
		}
  });
}
function view(id)
{
	$.ajax({
    url: "<?=base_url()?>barang/view/"+id,
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
		<th>jenis</th>
		<th>vendor</th>
		<th>suplier</th>
	</tr>
</thead>
<tbody>
<?php 
	$count = 1 ; 
	if(empty($data)) { echo"<tr><td colspan=\"4\">tidak ada data</td></tr>";};
	foreach($data as $brg): 	
	if($count % 2 == 0)$class='even'; else $class='odd' ;
?>
	<tr class="<?=$class?>" id="<?=$brg['brg_id']?>">
		<td>
			<?=$brg['brg_nama']?> &bull; <?=$brg['brg_kode']?> <br/>
			harga : <?=$brg['brg_harga_satuan']?> &bull; stok : <?=$brg['brg_stok']?> / <?=$brg['brg_min_stok']?>
		</td>
		<td><?=$brg['jb_nama']?></td>
		<td><?=$brg['brg_vendor']?></td>
		<td><?=$brg['sp_nama']?></td>
	</tr>
<?php 
	$count++;
	endforeach 
?>
</tbody>
</table>
<!-- context menu item -->
<ul id="myMenu" class="contextMenu">
	<li><a href="#create">Tambah Baru</a></li>
	<li><a href="#add">Tambah Stok</a></li>
	<li><a href="#min">Ambil Stok</a></li>
	<li><a href="#update">Ubah</a></li>
	<li><a href="#delete">Hapus</a></li>
	<li><a href="#view">Lihat</a></li>
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
<div id="window"></div>