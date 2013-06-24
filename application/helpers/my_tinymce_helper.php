<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function embed_tinymce($theme)
{
	switch ($theme){
		case "silver":
			$tinymce_skin = 'theme : "advanced",	skin : "o2k7",skin_variant : "silver",';
			break;
		case "black":
			$tinymce_skin = 'theme : "advanced",skin : "o2k7",skin_variant : "black",';
			break;
		case "metroblack":
			$tinymce_skin = 'theme : "advanced",skin : "o2k7",skin_variant : "black",';
			break;
		case "moonlight":
			$tinymce_skin = 'theme : "advanced",skin : "o2k7",skin_variant : "black",';
			break;
		case "highcontrast":
			$tinymce_skin = 'theme : "advanced",skin : "o2k7",skin_variant : "black",';
			break;
		case "uniform":
			$tinymce_skin = 'theme : "advanced",';
			break;
		case "default":
			$tinymce_skin = 'theme : "advanced",';
			break;
		case "boostrap":
			$tinymce_skin = 'theme : "advanced",';
			break;
		case "blueopal":
			$tinymce_skin = 'theme : "advanced",skin : "o2k7",';
			break;
		case "metro":
			$tinymce_skin = 'theme : "advanced",	skin : "o2k7",skin_variant : "silver",';
			break;
		default :
			$tinymce_skin = 'theme : "advanced",';
			break;
	}
	ob_start();
	?>
	<script type="text/javascript" src="<?=base_url()?>assets/scripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		<?php echo $tinymce_skin; ?>
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,help,code,|,insertdate,inserttime,preview,|,hr,removeformat,visualaid,|,sub,sup",
		theme_advanced_buttons3 : "charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
	</script>
	<?php $r = ob_get_contents();
	ob_end_clean();
	return $r;	
}
