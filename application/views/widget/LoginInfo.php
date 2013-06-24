<table class="log-info">
<tr>
	<td>User Name :</td>
	<td><b><?=$this->session->userdata('user_name')?></b></td>
</tr>
<tr>
	<td>Access Level :</td>
	<td><b><?=$this->session->userdata('group_name')?></b></td>
</tr>
<tr>
	<td>Browser :</td>
	<td><b><?=$this->agent->browser()?></b> versi <b><?=$this->agent->version()?></b></td>
</tr>
<tr>
	<td>O.S :</td>
	<td><b><?=$this->agent->platform()?></b></td>
</tr>
<tr>
	<td>No. IP :</td>
	<td><b><?=$_SERVER['REMOTE_ADDR']?></b></td>
</tr>
</table>
