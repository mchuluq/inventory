<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Inventory :: <?=$title?></title>

<?=$_embed?>

</head>
<body>
<section id="first-bar">
	<?=$_header?>
</section>
<section id="second-bar">
	<div class="breadcrumbs_container">
		<article class="breadcrumbs"><?=$_bc?></article>
	</div>
</section>
<div id="main-container">
	<aside id="leftsider">
		<?=$_sider?>
	</aside>
	<section id="rightcontent">
	<article class="module">
	<header><h3>Profile dan Password Anda</h3></header>
	<div class="art-content">
	<?php echo validation_errors()?>
	<form class="ch-form" method="post" action="<?=base_url('profile/update_profile')?>">
	<fieldset>
	<legend>profile anda</legend>
	<table>
		<tr>
			<td><label for="user_fullname">nama lengkap : </label></td>
			<td><span class="k-textbox"><input type="text" name="user_fullname" placeholder="nama lengkap" value="<?=$det_prof['user_fullname']?>" required/></span></td>
		</tr>
		<tr>
			<td><label for="user_name">username : </label></td>
			<td><span class="k-textbox"><input type="text" name="user_name" placeholder="username" value="<?=$det_prof['user_name']?>" required/></span></td>
		</tr>
		<tr>
			<td><label for="user_theme">tema : </label></td>
			<td>
				<select name="user_theme" id="theme_select">
				<?php foreach($theme as $th) :?>
					<option value="<?=$th?>" <?php if($th==$det_prof['user_theme']) echo"selected";?>><?=$th?></option>			
				<?php endforeach ?>
				</select>
			</td>
		</tr>		
		<tr>
			<td><input type="submit" id="submiter"value="simpan" class="k-button"/></td>
			<td></td>
		</tr>
	</table>
	</fieldset>
	</form>
	
	<form class="ch-form" method="post" action="<?=base_url('profile/update_password')?>">
	<fieldset>
	<legend>password anda</legend>
	<table>
		<tr>
			<td><label for="old_pass">password lama : </label></td>
			<td><span class="k-textbox"><input type="password" name="old_pass" placeholder="password lama" required/></span></td>
		</tr>
		<tr>
			<td><label for="new_pass_1">password baru : </label></td>
			<td><span class="k-textbox"><input type="password" name="new_pass_1" placeholder="password baru" required/></span></td>
		</tr>
		<tr>
			<td><label for="new_pass_2">ulangi password baru : </label></td>
			<td><span class="k-textbox"><input type="password" name="new_pass_2" placeholder="ulangi password baru" required/></span></td>
		</tr>
		<tr>
			<td><input type="submit" id="submiter"value="simpan" class="k-button"/></td>
			<td></td>
		</tr>
	</table>
	</fieldset>
	</form>
	</div>
	</article>
	
	<article class="module">
	<header><h3>Foto Anda</h3></header>
	<div class="art-content">
	<form class="ch-form" method="post" action="<?=base_url('profile/update_photo')?>" enctype="multipart/form-data">	
	<fieldset>
	<legend>Upload foto</legend>
	<table>
		<tr>
			<td><label for="userfile">File</label></td>
			<td><input type="file" name="userfile" id="userfile"/></td>
		</tr>
		<tr>
			<td><input type="submit" name="SubmitFile" value="upload" class="k-button" /></td>
			<td></td>
		</tr>
	</table>
	</fieldset>		
	</form>
	</div>
	</article>
	<div class="footer-section"><?=$_footer?></div>
	</section>	
</div>
<?=$_alert?>
<script>
	$(document).ready(function() {
    	$("#k-menu").kendoMenu();
    	$("#k-panel").kendoPanelBar();
    	$("#theme_select").kendoDropDownList();
    });
</script>
</body>
</html>

