<ul class="last-act">
<?php $myquery = mysql_query("SELECT * FROM view_log ORDER BY log_time DESC LIMIT 0, 10");
	$ws = now(); 
	while($act = mysql_fetch_assoc($myquery)) { ?>
		<li>
			<?=$act['log_content']." <b>".$act['brg_nama']."</b> oleh <b>".$act['user_name']."</b>";?><br/>
			<span><?=timespan($act['log_time'],$ws); ?> yang lalu</span>
		</li>				
<?php }	?>
</ul> 
