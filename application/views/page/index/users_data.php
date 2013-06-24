<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Inventory :: <?=$title?></title>

<?=$_embed?>
<script type="text/javascript">
$(function(){ 
$("a.edit").click(function(){
		page=$(this).attr("href");
		$("#divFormContent").load(page);
		$("#divFormContent").show();
		return false;
	});
});
$(document).ready(function(){	
  function loadUser(id){
	  $.ajax({
      url: "<?=base_url()?>users/update_user/"+id,
  		success:function(data)
  		{
  			$('#formData').html(data);
  			$('#formData').show('blind');
  		}
    });
  }
  
  function addRole(){
	  $.ajax({
      url: "<?=base_url()?>users/add_role/",
  		success:function(data)
  		{
  			$('#formData').html(data);
  			$('#formData').show('blind');
  		}
    });
  }
  function createGroup(){
	  $.ajax({
      url: "<?=base_url()?>users/create_group/",
  		success:function(data)
  		{
  			$('#formData').html(data);
  			$('#formData').show('blind');
  		}
    });
  }
  function updateGroup(id){
	  $.ajax({
      url: "<?=base_url()?>users/update_group/"+id,
  		success:function(data)
  		{
  			$('#formData').html(data);
  			$('#formData').show('blind');
  		}
    });
  }

//context menu for user-list
  $("li.ug-list").contextMenu({
		menu: 'usersMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="update"){
			loadUser($(el).attr('id'));
		}
		else if(act=="status"){
		document.location="<?=base_url()?>users/status_user/"+$(el).attr('id');				
		}
		else if(act=="delete"){
			x = confirm("apakah anda yakin menghapus user ini ?"); 
			if(x == 1){ 
				document.location="<?=base_url()?>users/delete_user/"+$(el).attr('id');
		    }	
		}
	});
//context menu for group-list
  $("li.group-list").contextMenu({
		menu: 'groupMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="add"){
			createGroup();
		}else if(act=="update"){
			updateGroup($(el).attr('g_id'));		
		}
		else if(act=="delete"){
			x = confirm("apakah anda yakin menghapus group ini ?"); 
			if(x == 1){ 
				document.location="<?=base_url()?>users/delete_group/"+$(el).attr('id');
		    }	
		}
	});
	//context menu for role-list
  $("li.role-list").contextMenu({
		menu: 'roleMenu'
	}, function(action, el, pos) {
		var act = action;
		if (act=="add"){
			addRole();
		}
		else if(act=="delete"){
			x = confirm("apakah anda yakin menghapus role ini ?"); 
			if(x == 1){ 
				document.location="<?=base_url()?>users/delete_role/"+$(el).attr('id');
		    }	
		}
	});
 
});
</script>
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
	<header><h3><?=$title?></h3></header>
	<div id="formData" style="display:none;"></div>
	<div id="tabstrip">
		<ul>
			<li class="k-state-active">User-Group</li>
			<li>Group-Role</li>
		</ul>
	<div class="user-group-list">
	<ul class="panelbar">
	<?php 
	$g_query = mysql_query("SELECT * FROM user_group");
	while($group=mysql_fetch_array($g_query)) {?>
		<li class="group-list" g_id="<?=$group['group_id']?>"><?=$group['group_name']?>
			<div style="padding:5px;"><?=$group['group_description']?>
			<ul>
				<li><b>Member :</b>
					<ul>
					<?php 
					$u_query = mysql_query("SELECT * FROM user_member WHERE group_name ='".$group['group_name']."'");
					while($users=mysql_fetch_array($u_query)) { ?>
						<li class="ug-list" id="<?=$users['user_id']?>" >
							<img src="<?=base_url()?>storage/profile/<?=$users['user_photo']?>"/>
							<b><?=$users['user_name']?></b><br/>
							<?=$users['user_fullname']?><br/>
							last login : <?=$users['user_last_login']?> &bull; <?=$users['user_status']?>
						</li>
					<?php }?>
					</ul>
				</li>
			</ul>
			</div>
		</li>		
	<?php }	?>	
	</ul>	
	</div>
	<div class="user-role-list">
	<ul class="panelbar">
	<?php 
	$r_query = mysql_query("SELECT DISTINCT group_name FROM user_role ORDER BY group_name");
	while($role=mysql_fetch_array($r_query)) { ?>
	<li>
		<?=$role['group_name']?>
		<ul>
		<?php 
		$ru_query = mysql_query("SELECT * FROM user_role WHERE group_name ='".$role['group_name']."'");
		while($rule=mysql_fetch_array($ru_query)) { ?>			
			<li class="role-list" id="<?=$rule['role_id']?>"><?=$rule['rule_class_method']?></li>
		<?php } ?>
		</ul>		
	</li>
	<?php } ?>
	</ul>	
	</div>
	</div>
	</article>
	<div class="footer-section"><?=$_footer?></div>
	</section>	
</div>
<ul id="usersMenu" class="contextMenu">
	<li><a href="#update">Ubah</a></li>
	<li><a href="#status">Ubah Status</a></li>
	<li><a href="#delete">Hapus</a></li>
</ul>
<ul id="roleMenu" class="contextMenu">
	<li><a href="#add">Tambah Role</a></li>
	<li><a href="#delete">Hapus</a></li>
</ul>
<ul id="groupMenu" class="contextMenu">
	<li><a href="#add">Tambah Group</a></li>
	<li><a href="#update">Ubah</a></li>
	<li><a href="#delete">Hapus</a></li>
</ul>
<?=$_alert?>
<script>
	$(document).ready(function() {
    	$("#k-menu").kendoMenu();
    	$("#k-panel").kendoPanelBar();
    	$(".panelbar").kendoPanelBar();
    	$("#tabstrip").kendoTabStrip({animation:{open:{effects: "fadeIn"}}});
    });
</script>
</body>
</html>