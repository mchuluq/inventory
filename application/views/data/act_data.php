<script type="text/javascript">
$(document).ready( function() {	
	$("table.ch-table tbody tr").contextMenu({
		menu: 'myMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="data"){
			document.location='<?=base_url()?>barang';
		}
		else if(act=="ref"){
			reloadData();
		}
	});
});

function reloadData(){
	  $("input#search-box").val('');
	  $.ajax({
    url: "<?=base_url()?>data/aktifitas/",
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
    url: "<?=base_url()?>data/aktifitas/"+ page +"/"+ cari,
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
		<th>aktifitas</th>
	</tr>
</thead>
<tbody>
<?php 
	$count = 1 ; 
	$ws = now();
	if(empty($data)) { echo"<tr><td>tidak ada data</td></tr>";};
	foreach($data as $act): 	
	if($count % 2 == 0)$class='even'; else $class='odd' ;
?>
	<tr class="<?=$class?>">
		<td>
			<?=$act['log_content']." <b>".$act['brg_nama']."</b> oleh <b>".$act['user_name']."</b>";?><br/>
			<span><?=timespan($act['log_time'],$ws); ?> yang lalu</span>
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