<!-- untuk alert, notifikasi, dan ajax animation loader -->
<div id="chraven-alert-container">
	<?php if(validation_errors()){?>
	<div class="chv-alert warning">
		<span class="closer">x</span>
		<strong>Warning</strong><br/><?=validation_errors()?>
	</div>
	<?php }?>
	<?php if($this->session->flashdata('warning')){?>
	<div class="chv-alert warning">
		<span class="closer">x</span>
		<strong>Warning</strong><br/><?=$this->session->flashdata('warning')?>
	</div>
	<?php }?>
	<?php if($this->session->flashdata('success')){?>
	<div class="chv-alert success">
		<span class="closer">x</span>
		<strong>Success</strong><br/><?=$this->session->flashdata('success')?>
	</div>
	<?php }?>
	<?php if($this->session->flashdata('info')){?>
	<div class="chv-alert info">
		<span class="closer">x</span>
		<strong>Information</strong><br/><?=$this->session->flashdata('info')?>
	</div>
	<?php }?>
	<?php if($this->session->flashdata('error')){?>
	<div class="chv-alert error">
		<span class="closer">x</span>
		<strong>Error</strong><br/><?=$this->session->flashdata('error')?>
	</div>
	<?php }?>
</div>
<div id="chraven-loader"></div>
<!-- end -->
