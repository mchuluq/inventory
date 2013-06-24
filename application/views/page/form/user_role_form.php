<form class="ch-form" id="myform" method="POST" action="<?=base_url()?>users/add_role">
<fieldset>
<legend>Tambah Role</legend>
<table>
<tr>
	<td><label for="group_name">group : </label></td>
	<td>
		<select name="group_name" id="group_select">
		<?php foreach($group as $gn) :?>
			<option value="<?=$gn['group_name']?>"><?=$gn['group_name']?></option>			
		<?php endforeach ?>	
		</select>
	</td>
</tr>
<tr>
	<td><label for="user_role">role : </label></td>
	<td>
		<select name="rule_class_method" id="role_select">
		<?php foreach($rule as $ru) :?>
			<option value="<?=$ru['rule_class'].'.'.$ru['rule_method']?>"><?=$ru['rule_class'].'.'.$ru['rule_method']?></option>			
		<?php endforeach ?>	
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
		 $("#role_select").kendoDropDownList();
		 $('#form-closer').click(function(){
				$('#formData').hide('blind');
			});
    });
</script>
