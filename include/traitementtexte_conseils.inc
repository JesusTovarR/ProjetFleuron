<!-- TinyMCE -->
<script type="text/javascript" src="scripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull",
		theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons3 : "bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,cleanup,code,|,forecolor,backcolor",
		theme_advanced_buttons4 : "tablecontrols,|,hr,removeformat,visualaid,|,print,|,fullscreen",
		theme_advanced_buttons5 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_default_background_color : "#f6f5ed",
		theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;",
		theme_advanced_font_sizes : "10px,12px,14px,16px,24px",

		// Example content CSS (should be your site CSS)
		content_css : "styles/styles.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->