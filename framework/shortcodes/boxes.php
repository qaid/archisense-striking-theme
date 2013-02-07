<?php

function theme_shortcode_message($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'align' => false,
	), $atts));
	$align = $align?' '.$align:'';
	return '<div class="' .apply_filters( 'theme_css_class', $code ). $align . '"><div class="message_box_content">' . do_shortcode($content) . '</div><div class="clearboth"></div></div>';
}

add_shortcode('info','theme_shortcode_message');
add_shortcode('success','theme_shortcode_message');
add_shortcode('error','theme_shortcode_message');
add_shortcode('error_msg','theme_shortcode_message');
add_shortcode('notice','theme_shortcode_message');


function theme_shortcode_framed_box($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '',
		'bgcolor' => '',
		'textcolor' => '',
		'rounded' => 'false',
		'align' => false,
	), $atts));
	
	if($width){
		if(is_numeric($width)){
			$width = $width.'px';
		}
		$width = 'width:'.$width.';';
	}else{
		$width = '';
	}
	if($height){
		if(is_numeric($height)){
			$height = $height.'px';
		}
		$height = 'height:'.$height.';';
	}else{
		$height = '';
	}
	
	if(!empty($width)){
		$style = ' style="'.$width.'"';
	}else{
		$style = '';
	}
	$align = $align?' align'.$align:'';
	$bgcolor = $bgcolor?'background-color:'.$bgcolor.';':'';
	$textcolor = $textcolor?'color:'.$textcolor:'';
	$rounded = ($rounded == 'true')?' rounded':'';
	if( !empty($height) || !empty($bgcolor) || !empty($textcolor)){
		$content_style = ' style="'.$height.$bgcolor.$textcolor.'"';
	}else{
		$content_style = '';
	}
	if(!preg_match("/<[^>]*>/",$content)){
		$content = "<p>".trim($content)."</p>";
	}
	return '<div class="' .$code.$rounded.$align. '"'.$style.'><div class="framed_box_content"'.$content_style.'>' . do_shortcode($content) . '<div class="clearboth"></div></div></div>';
}
add_shortcode('framed_box','theme_shortcode_framed_box');

function theme_shortcode_note($atts, $content = null) {
	extract(shortcode_atts(array(
		'align' => false,
		'title' => '',
		'width' => false,
	), $atts));
	$align = $align?' align'.$align:'';
	$width = $width?' style="width:'.(int)$width.'px"':'';
	if(!empty($title)){
		$title = '<h4 class="'.apply_filters( 'theme_css_class', 'note_title' ).'">'.$title.'</h4>';
	}
	return '<div class="' .apply_filters( 'theme_css_class', 'note' ). $align . '"'.$width.'>'.$title.'<div class="'.apply_filters( 'theme_css_class', 'note_content' ).'">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('note','theme_shortcode_note');