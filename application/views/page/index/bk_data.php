<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title><?=$title?></title>

<?=$_embed?>
<script type="text/javascript">
$(document).ready(function(){

	loadData();

  function loadData(){
	  var cari = $("input#search-box").val();
	  $.ajax({
      url: "<?=base_url()?>data/barang_keluar/0/"+ cari,
  		success:function(data)
  		{
  			$('#divPageData').html(data);
  		}
    });
  }
  
  $("form#form-search").submit(function(){ 
    var cari = $("input#search-box").val();
    if (cari.replace(/\s/g,"") != ""){
        loadData();
    }
    else if ((cari.replace(/\s/g,"") == "")){
      alert("Sorry, Please fill out the search box!");
      $("input#search-box").focus();
    }
    else{
      loadData();
    }
    return false;
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
	<header>
		<form id="form-search">
			<input maxlength="10" type="text" id="search-box" name="search-box" placeholder="search box..."/><input type="submit" value="search"/>
		</form>
	</header>
	<div id="divPageData">
	
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
    });
</script>
</body>
</html>