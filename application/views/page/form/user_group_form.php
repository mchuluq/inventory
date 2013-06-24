<form class="ch-form" id="myform" method="POST" action="<?=$action?>">
<fieldset>
<legend><?=$title?></legend>
<table>
<tr>
	<td><label for="group_name">nama : </label></td>
	<td>
		<span class="k-textbox"><input maxlength="20" type="text" name="group_name" value="<?=$detil_g['group_name']?>" require/></span>
		<input type="hidden" name="group_id" value="<?=$detil_g['group_id']?>"/>
	</td>
</tr>
<tr>
	<td><label for="group_description">deskripsi : </label></td>
	<td>
		<textarea name="group_description"><?=$detil_g['group_description']?></textarea>
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
