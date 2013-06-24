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

<!-- kendo ui embedding -->
<link href="<?=base_url()?>assets/kendoui/css/kendo.common.css" rel="stylesheet"/>
<link href="<?=base_url()?>assets/kendoui/css/kendo.default.css" rel="stylesheet"/>
<script type="text/javascript" src="<?=base_url()?>assets/kendoui/js/kendo.web.min.js"></script>

<!-- main style -->
<link href="<?=base_url()?>assets/styles/front-gate.css" rel="stylesheet"/>

</head>
<body>
<section id="head-bar">
<form id="signin-form" method="post" action="<?=base_url()?>front/sign_in">
	<fieldset>
	<span class="k-textbox"><input title="username" maxlength="20" type="text" name="username" placeholder="username..." required/></span>
	<span class="k-textbox"><input title="password" maxlength="20" type="password" name="password" placeholder="password..." required/></span>
	<input class="k-button" type="submit" value="login"/>
	</fieldset>
</form>
</section>
<div id="main-container">
	<section class="zone" id="empty-zone">
	
	</section>
	<section class="zone" id="signup-zone">
		<form method="post" action="<?=base_url()?>front/sign_up" id="signup-form">
		<table>
			<tr>
				<td><label for="fullname">nama lengkap :</label></td>
				<td><span class="k-textbox"><input maxlength="100" type="text" name="fullname" required/></span></td>
			</tr>
			<tr>
				<td><label for="username">nama pengguna :</label></td>
				<td><span class="k-textbox"><input maxlength="20" type="text" name="username" required/></span></td>
			</tr>
			<tr>
				<td><label for="pass">password :</label></td>
				<td><span class="k-textbox"><input maxlength="20" type="password" name="pass" required/></span></td>
			</tr>
			<tr>
				<td><label for="re-pass">ulangi password :</label></td>
				<td><span class="k-textbox"><input maxlength="20" type="password" name="re-pass" required/></span></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="Sign Up" class="k-button"/></td>
			</tr>
		</table>
		</form>
	</section>
</div>
</body>
</html>