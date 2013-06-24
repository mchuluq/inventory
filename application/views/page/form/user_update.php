<form class="ch-form" id="myform" method="POST" action="<?=base_url()?>users/update_user/<?=$user['user_id']?>">
<fieldset>
<legend>Ubah User</legend>
<table>
<tr>
	<td><label for="user_name">nama : </label></td>
	<td>
		<span class="k-textbox"><input type="text" name="user_name" value="<?=$user['user_name']?>" readonly/></span>
		<input type="hidden" name="user_id" value="<?=$user['user_id']?>"/>
	</td>
</tr>
<tr>
	<td><label for="group_name">group : </label></td>
	<td>
		<select name="group_name" id="group_select">
		<?php foreach($group as $gn) :?>
			<option value="<?=$gn['group_name']?>" <?php if($gn['group_name']==$user['group_name']) echo"selected";?> ><?=$gn['group_name']?></option>			
		<?php endforeach ?>	
		</select>
	</td>
</tr>
<tr>
	<td><label for="user_status">status : </label></td>
	<td>
		<select name="user_status" id="status_select">
			<option value="enable" <?php if($user['user_status'] =='enable') echo"selected";?>>enable</option>	
			<option value="disable" <?php if($user['user_status'] =='disable') echo"selected";?>>disable</option>			
		</select>
	</td>
</tr>
<tr>
	<td><input type="submit" id="submiter"value="simpan" class="k-button"/></td>
	<td><a id="form-closer" class="k-button">cancel</a></td>
</tr>
</table>
</fieldset>
</form>
<script>
	$(document).ready(function() {
		 $("#group_select").kendoDropDownList();
		 $("#status_select").kendoDropDownList();
		 $('#form-closer').click(function(){
				$('#formData').hide('blind');
			});
    });
</script>
