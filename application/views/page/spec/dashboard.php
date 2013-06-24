<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>inventory :: <?=$title?></title>

<?=$_embed;?>

<script type="text/javascript">
//MAIN STAGE DRAGGABLE BOXES
$(function(){
	$('.dragbox')
	.each(function(){
		$(this).hover(function(){
			$(this).find('h2').addClass('collapse');
		}, function(){
		$(this).find('h2').removeClass('collapse');
		})
		.find('h2').hover(function(){
			$(this).find('.configure').css('visibility', 'visible');
		}, function(){
			$(this).find('.configure').css('visibility', 'hidden');
		})
		.click(function(){
			$(this).siblings('.dragbox-content').toggle('blind');
			updateWidgetData();
		})
		.end()
		.find('.configure').css('visibility', 'hidden');
	});
    
	$('.column').sortable({
		connectWith: '.column',
		handle: 'h2',
		cursor: 'move',
		placeholder: 'placeholder',
		forcePlaceholderSize: true,
		opacity: 0.4,
		start: function(event, ui){
			//Firefox, Safari/Chrome fire click event after drag is complete, fix for that
			if($.browser.mozilla || $.browser.safari) 
				$(ui.item).find('.dragbox-content').toggle('blind');
		},
		stop: function(event, ui){
			$(ui.item).find('h2').click();
			var sortorder='';
			$('.column').each(function(){
				var itemorder=$(this).sortable('toArray');
				var columnId=$(this).attr('id');
				sortorder+=columnId+'='+itemorder.toString()+'&';
			});
			//alert('SortOrder: '+sortorder);
			updateWidgetData();
		}
	})
	.disableSelection();
});

function updateWidgetData(){
	var items=[];
	$('.column').each(function(){
		var columnId=$(this).attr('id');
		$('.dragbox', this).each(function(i){
			var collapsed=0;
			if($(this).find('.dragbox-content').css('display')=="none")
				collapsed=1;
			var item={
				id: $(this).attr('id'),
				collapsed: collapsed,
				order : i,
				column: columnId
			};
			items.push(item);
		});
	});
	var sortorder={ items: items };			
	//Pass sortorder variable to server using ajax to save state
	$.post('<?=base_url()?>dashboard/update_widget', 'data='+$.toJSON(sortorder), function(response){
		if(response=="success")
			$("#console").html('<span class="success">Saved</span>').hide().fadeIn(500);
		setTimeout(function(){
			$('#console').fadeOut(500);
		}, 1000);
	});
}
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
	<article class="module_dash">
	<div class="art-content">
	<?php
		$columns=mysql_query('SELECT DISTINCT column_id FROM i_widget ORDER BY column_id');
		$new_col= 1;
			while($column=mysql_fetch_array($columns))
			{ if($column['column_id']==1) { $new_col= 0; } elseif($column['column_id']==0) { $new_col= 1;  } ?>
				<div class="column" id="column<?=$column['column_id']?>" >
				<?php $items=mysql_query("SELECT * FROM i_widget WHERE column_id='".$column['column_id']."' ORDER BY sort_no");
				while($widget=mysql_fetch_array($items))
				{ ?>
					<div class="dragbox" id="item<?=$widget['id']?>">
						<h2><?=$widget['title']?></h2>
							<div class="dragbox-content" <?php if($widget['collapsed']==1)	echo 'style="display:none;"'?>>
								<?=get_widget($widget['title'])?>
							</div>
					</div>
				<?php }	?></div>
		<?php }	?>
		<?php 
		$num = mysql_num_rows($columns);
		if($num==1){
		?>
		<div class="column" id="column<?=$new_col?>">
		
		</div>
		<?php }	?>
	</div>
	</article>
	</section>	
	<div class="footer-section"><?=$_footer?></div>
</div>
<?=$_alert?>
<script>
	$(document).ready(function() {
    	$("#k-menu").kendoMenu();
    	$("#k-panel").kendoPanelBar();
    });
	 $("#quick-access a").hover(
		        function(e) {
		            var div = $(e.currentTarget);
		            kendo.fx(div.find(".description").css("display", "block")).tile("left", div.find(".icon")).play();
		        },

		       function(e) {
		            var div = $(e.currentTarget);
		            kendo.fx(div.find(".description")).tile("left", div.find(".icon")).reverse();
		    });
</script>
</body>
</html>