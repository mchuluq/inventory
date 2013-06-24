<script type="text/javascript">
$(document).ready( function() {	
	$("table.ch-table tbody tr").contextMenu({
		menu: 'myMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="create"){
			document.location='jenis_barang/create';
		}
		else if(act=="update"){
			document.location='jenis_barang/update/'+$(el).attr('id');				
		}
		else if(act=="ref"){
			reloadData();				
		}
		else if(act=="delete"){
			x = confirm("apakah anda yakin menghapus jenis barang ini ?"); 
			if(x == 1){ 
				document.location='jenis_barang/delete/'+$(el).attr('id');	
		    }						
		}
	});
});
function reloadData(){
	  $("input#search-box").val('');
	  $.ajax({
    url: "<?=base_url()?>data/jenis_barang/",
		success:function(data)
		{
			$('#divPageData').html(data);
		}
  });
}
function my_pagination(page){
	var cari = $("input#search-box").val();
  $.ajax({
    url: "<?=base_url()?>data/jenis_barang/"+ page +"/"+ cari,
		success:function(data)
		{
			$('#divPageData').html(data);
		}
  });
}
  function loadData(){
	  $.ajax({
      url: "<?=base_url()?>data/jenis_barang",
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
		<th>nama</th>
		<th>deskripsi</th>
	</tr>
</thead>
<tbody>
<?php 
	$count = 1 ; 
	if(empty($data)) { echo"<tr><td colspan=\"2\">tidak ada data</td></tr>";};
	foreach($data as $jb): 	
	if($count % 2 == 0)$class='even'; else $class='odd' ;
?>
	<tr class="<?=$class?>" id="<?=$jb['jb_id']?>">
		<td><?=$jb['jb_nama']?></td>
		<td><?=$jb['jb_deskripsi']?></td>
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
	<li><a href="#update">Ubah</a></li>
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