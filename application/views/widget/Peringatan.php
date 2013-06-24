<ul class="dash-alert">
<?php 
$query_alert = mysql_query("CALL alert_min_stok()");
$alert_num = mysql_num_rows($query_alert);
while($alert = mysql_fetch_array($query_alert)){ ?>
	<li class="alert">Stok <?="<b>".$alert['brg_nama'].'</b> &raquo; '.$alert['brg_stok']?> buah</li>
<?php } ; 
if($alert_num == 0) { ?>
	<li class="no-alert">tidak ada peringatan</li>
<?php } ?>
</ul> 
