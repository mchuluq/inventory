<script type="text/javascript">
$(document).ready( function() {	
	$("table.ch-table tbody tr").contextMenu({
		menu: 'myMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="create"){
			document.location='<?=base_url()?>suplier/create';
		}
		else if(act=="update"){
			document.location='<?=base_url()?>suplier/update/'+$(el).attr('id');				
		}
		else if(act=="ref"){
			reloadData();				
		}
		else if(act=="delete"){
			x = confirm("apakah anda yakin menghapus suplier ini ?"); 
			if(x == 1){ 
				document.location='<?=base_url()?>suplier/delete/'+$(el).attr('id');	
		    }						
		}
		else if(act=="view"){
			view($(el).attr('id'));				
		}
	});
});
function reloadData(){
	  $("input#search-box").val('');
	  $.ajax({
    url: "<?=base_url()?>data/suplier/",
		success:function(data)
		{
			$('#divPageData').html(data);
		}
  });
}
function my_pagination(page){
	var cari = $("input#search-box").val();
  $.ajax({
    url: "<?=base_url()?>data/suplier/"+ page +"/"+ cari,
		success:function(data)
		{
			$('#divPageData').html(data);
		}
  });
}
function view(id)
{
	$.ajax({
    url: "<?=base_url()?>suplier/view/"+id,
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
		<th>alamat</th>
	</tr>
</thead>
<tbody>
<?php 
	$count = 1 ; 
	if(empty($data)) { echo"<tr><td colspan=\"2\">tidak ada data</td></tr>";};
	foreach($data as $sp): 	
	if($count % 2 == 0)$class='even'; else $class='odd' ;
?>
	<tr class="<?=$class?>" id="<?=$sp['sp_id']?>">
		<td><?=$sp['sp_nama']?></td>
		<td>
			<?=$sp['sp_alamat']?> <br/>
			<?=$sp['sp_kota']?>
		</td>
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