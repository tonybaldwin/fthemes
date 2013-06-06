<?php
/**
 * Theme settings
 */



function theme_content(&$a){
	if(!local_user())
		return;		
	
	$resize = get_pconfig(local_user(), 'hippy', 'resize' );
	$color = get_pconfig(local_user(), 'hippy', 'color' );
       $font_size = get_pconfig(local_user(), 'hippy', 'font_size' );
	$theme_width= get_pconfig(local_user(), 'hippy', 'theme_width' );
	
	return hippy_form($a,$color,$font_size,$resize,$theme_width);
}

function theme_post(&$a){
	if(! local_user())
		return;
	
	if (isset($_POST['hippy-settings-submit'])){
		set_pconfig(local_user(), 'hippy', 'resize', $_POST['hippy_resize']);	
		set_pconfig(local_user(), 'hippy', 'color', $_POST['hippy_color']);
		set_pconfig(local_user(), 'hippy', 'font_size', $_POST['hippy_font_size']);
		set_pconfig(local_user(), 'hippy', 'theme_width', $_POST['hippy_theme_width']);
	}
}


function theme_admin(&$a){
	$resize = get_config('hippy', 'resize' );
	$color = get_config('hippy', 'color' );
	$font_size = get_config('hippy', 'font_size' );
	$theme_width= get_config('hippy', 'theme_width' );
	return hippy_form($a,$color,$font_size,$resize,$theme_width);
}

function theme_admin_post(&$a){
	if (isset($_POST['hippy-settings-submit'])){
		set_config('hippy', 'resize', $_POST['hippy_resize']);
		set_config('hippy', 'color', $_POST['hippy_color']);
		set_config('hippy', 'font_size', $_POST['hippy_font_size']);
		set_config('hippy', 'theme_width', $_POST['hippy_theme_width']);

	}
}


function hippy_form(&$a, $color,$font_size,$resize,$theme_width){
	$colors = array(
		"hippy"=>"hippy", 
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
	 	
	 	
	 	$o .= replace_macros($t, array(
		'$submit' => t('Submit'),
		'$baseurl' => $a->get_baseurl(),
		'$title' => t("Theme settings"),
		'$resize' => array('hippy_resize',t ('Set resize level for images in posts and comments (width and height)'),$resize,'',$resizes),
		'$font_size' => array('hippy_font_size', t('Set font-size for posts and comments'), $font_size, '', $font_sizes),
		'$theme_width' => array('hippy_theme_width', t('Set theme width'), $theme_width, '', $theme_widths),
		'$color' => array('hippy_color', t('Color scheme'), $color, '', $colors),
	));
	return $o;
}
