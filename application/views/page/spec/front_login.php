<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title><?=$title?></title>

<link rel="icon" href="<?=base_url()?>yudha.ico">

<!-- html5 reset style and script -->
<link href="<?=base_url()?>assets/styles/style-reset.css" rel="stylesheet"/>
<script src="<?=base_url()?>assets/scripts/html5shiv-printshiv.js" type="text/javascript" ></script>

<!-- jquery framework and ui -->
<script src="<?=base_url()?>assets/scripts/jquery-1.8.2.min.js" type="text/javascript" ></script>
<script src="<?=base_url()?>assets/scripts/jquery-ui-1.8.24.custom.min.js" type="text/javascript" ></script>
<link href="<?=base_url()?>assets/styles/chraven-animation.css" rel="stylesheet"/>

<!-- kendo ui embedding -->
<link href="<?=base_url()?>assets/kendoui/css/kendo.common.css" rel="stylesheet"/>
<link href="<?=base_url()?>assets/kendoui/css/kendo.uniform.css" rel="stylesheet"/>
<script type="text/javascript" src="<?=base_url()?>assets/kendoui/js/kendo.web.min.js"></script>

<!-- main style -->
<link href="<?=base_url()?>assets/styles/front-gate.css" rel="stylesheet"/>
<script type="text/javascript">
function showLogin()
{
	$('.login-shield').show();
	$('.error-shield').hide();
}
function showError()
{
	$('.error-shield').show();
	$('.login-shield').hide();
	options = {distance: 30, times: 3};					
	$('.error-shield').effect('shake', options, 120, function() {});
}
$(document).ready(function() {
	<?php if($this->session->flashdata('log_stat')) {?>
		showError();
	<?php } else { ?>
		showLogin();
	<?php } ?>
});
</script>
</head>
</head>
<body>
<section id="head-bar">

</section>
<section id="login-container">
<?php if($this->session->flashdata('sign_stat')) {?>
<div class="log_stat">
<?=$this->session->flashdata('sign_stat')?>
</div>
<?php }?>
<?=validation_errors()?>
<article class="login-shield">
<div id="tabstrip">
	<ul>
		<li class="k-state-active">Login</li>
		<li>Sign Up</li>
	</ul>
<div>
<form method="post" action="<?=base_url()?>front/sign_in">
<table>
	<tr>
		<td><label for="username">username : </label></td>
		<td><input maxlength="20" type="text" name="username" placeholder="username" required/></td>
	</tr>
	<tr>
		<td><label for="password">password : </label></td>
		<td><input maxlength="20" type="password" name="password" placeholder="password" required/></td>
	</tr>
	<tr>
		<td><input type="submit" name="submiter" value="login"/></td>
		<td></td>
	</tr>
</table>
</form>
</div>
<div>
<form method="post" action="<?=base_url()?>front/sign_up">
		<table>
			<tr>
				<td><label for="fullname">nama lengkap : </label></td>
				<td><input title="max. 100 karakter" maxlength="100" type="text" name="fullname" placeholder="nama lengkap" required/></td>
			</tr>
			<tr>
				<td><label for="username">username : </label></td>
				<td><input title="max. 20 karakter" maxlength="20" type="text" name="username" placeholder="username" required/></td>
			</tr>
			<tr>
				<td><label for="username">password : </label></td>
				<td><input title="max. 20 karakter" maxlength="20" type="password" name="pass" placeholder="password" required/></td>
			</tr>
			<tr>
				<td><label for="username">ulangi password : </label></td>
				<td><input title="max. 20 karakter" maxlength="20" type="password" name="re-pass" placeholder="ulangi password" required/></td>
			</tr>
			<tr>
				<td><input type="submit" value="Sign Up"/></td>
				<td></td>
			</tr>
		</table>
		</form>
</div>
</div>

</article>
<article class="error-shield">

<?php if($this->session->flashdata('log_stat')) {?>
	<div id="alert">
		<strong>Error</strong><br/>
		<span><?=$this->session->flashdata('log_stat')?></span>
	</div>
	<button class="re-log" onclick="javascript:showLogin()">Ok</button>
<?php } ?>

</article>
</section>
<script>
$(document).ready(function() {
	$("#tabstrip").kendoTabStrip({
		animation:{open:{effects: "fadeIn"}}
	});
});
</script>
</body>
</html>