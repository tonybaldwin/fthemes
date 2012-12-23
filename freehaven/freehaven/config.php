<?php
/**
 * Theme settings
 */



function theme_content(&$a){
	if(!local_user())
		return;		
	
	$resize = get_pconfig(local_user(), 'freehaven', 'resize' );
	$color = get_pconfig(local_user(), 'freehaven', 'color' );
       $font_size = get_pconfig(local_user(), 'freehaven', 'font_size' );
	$theme_width= get_pconfig(local_user(), 'freehaven', 'theme_width' );
	
	return freehaven_form($a,$color,$font_size,$resize,$theme_width);
}

function theme_post(&$a){
	if(! local_user())
		return;
	
	if (isset($_POST['freehaven-settings-submit'])){
		set_pconfig(local_user(), 'freehaven', 'resize', $_POST['freehaven_resize']);	
		set_pconfig(local_user(), 'freehaven', 'color', $_POST['freehaven_color']);
		set_pconfig(local_user(), 'freehaven', 'font_size', $_POST['freehaven_font_size']);
		set_pconfig(local_user(), 'freehaven', 'theme_width', $_POST['freehaven_theme_width']);
	}
}


function theme_admin(&$a){
	$resize = get_config('freehaven', 'resize' );
	$color = get_config('freehaven', 'color' );
	$font_size = get_config('freehaven', 'font_size' );
	$theme_width= get_config('freehaven', 'theme_width' );
	return freehaven_form($a,$color,$font_size,$resize,$theme_width);
}

function theme_admin_post(&$a){
	if (isset($_POST['freehaven-settings-submit'])){
		set_config('freehaven', 'resize', $_POST['freehaven_resize']);
		set_config('freehaven', 'color', $_POST['freehaven_color']);
		set_config('freehaven', 'font_size', $_POST['freehaven_font_size']);
		set_config('freehaven', 'theme_width', $_POST['freehaven_theme_width']);

	}
}


function freehaven_form(&$a, $color,$font_size,$resize,$theme_width){
	$colors = array(
		"freehaven"=>"freehaven", 
	);
	$font_sizes = array(
		'12'=>'12',
		"---"=>"---",
		"16"=>"16",		
		"14"=>"14",
		'10'=>'10',
		);
	$resizes = array(
		"0"=>"0 (no resizing)",
		"600"=>"1 (600px)",
		"300"=>"2 (300px)",
		"250"=>"3 (250px)",
		"150"=>"4 (150px)",
	       );
	$theme_widths =array (
		"standard"=>"standard",
		"narrow"=>"narrow",
		"wide"=>"wide",
		);

$t = get_markup_template("theme_settings.tpl" );
	 	
	 	$includes = array(
	 	'$field_select' => 'field_select.tpl',
	 	);
	 	$includes = set_template_includes($a->theme['template_engine'], $includes);
	 	
	 	$o .= replace_macros($t, $includes + array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$resize' => array('freehaven_resize',t ('Set resize level for images in posts and comments (width and height)'),$resize,'',$resizes),
		'$font_size' => array('freehaven_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$theme_width' => array('freehaven_theme_width', t('Set theme width'), $theme_width, '', $theme_widths),
		'$color' => array('freehaven_color', t('Color scheme'), $color, '', $colors),
	));
	return $o;
}
