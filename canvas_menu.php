<?php
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN.'canvas/languages/'.e_LANGUAGE.'.php');
define("CANVAS", e_PLUGIN."canvas/images/canvas/");

$text = "<div style='text-align:center;'>";

$size = explode("x", (!empty($pref['canvas_size']) ? $pref['canvas_size'] : "100x100"));
$title = ($pref['canvas_title'] == "CANVAS_TITLE" || empty($pref['canvas_title']) ? CANVAS_TITLE : $pref['canvas_title']);

if($pref['canvas_image'] == "random")
{
	$images = array();
	foreach(glob("{".CANVAS."*.jpg,".CANVAS."*.gif,".CANVAS."*.png}", GLOB_BRACE) as $image_file){
		array_push($images, str_replace(CANVAS, "", $image_file));
	}

	$image = $images[array_rand($images)];
	$text .= "<a href='".CANVAS.$image."' target='_blank'><img src='".CANVAS.$image."' style='width:".$size[0]."px; height:".$size[1]."px; border:0;'></a>";
}
else if($pref['canvas_image'] == "none")
{
	$text .= CANVAS_MENU_01;
}
else
{
	$text .= "<a href='".CANVAS.$pref['canvas_image']."' target='_blank'><img src='".CANVAS.$pref['canvas_image']."' style='width:".$size[0]."px; height:".$size[1]."px; border:0;'></a>";
}

$text .= "</div>";

$ns->tablerender($title, $text, 'canvas');
?>