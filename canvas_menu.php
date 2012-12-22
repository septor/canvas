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

	if(isset($pref['canvas_flickr']))
	{
		$flickr = simplexml_load_file("http://api.flickr.com/services/feeds/photos_public.gne?id=".$pref['canvas_flickr']."&lang=en-us&format=rss_200");
		$flickrdoc = new DOMDocument();
		foreach($flickr->channel->item as $item)
		{
			$flickrdoc->loadHTML($item->description);
			$tags = $flickrdoc->getElementsByTagName('img');

			foreach($tags as $tag)
			{
				array_push($images, $tag->getAttribute('src'));
			}
		}

	}

	$image = $images[array_rand($images)];
	$text .= "<a href='".$image."' target='_blank'><img src='".$image."' style='width:".$size[0]."px; height:".$size[1]."px; border:0;'></a>";
}
else if($pref['canvas_image'] == "none")
{
	$text .= CANVAS_MENU_01;
}
else
{
	$text .= "<a href='".$pref['canvas_image']."' target='_blank'><img src='".$pref['canvas_image']."' style='width:".$size[0]."px; height:".$size[1]."px; border:0;'></a>";
}

$text .= "</div>";

$ns->tablerender($title, $text, 'canvas');
?>