<?php
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN.'uniform_menu/languages/'.e_LANGUAGE.'.php');

$text = UFM_MENU_01." ".date("F jS, Y", strtotime($pref['ufm_date']))."<br />";

if($pref['ufm_uniform'] != "nil")
{
	$text .= "<img src='".e_PLUGIN."uniform_menu/images/uniform/".$pref['ufm_uniform'].".png' />";
}
else
{
	$text .= "<div style='text-align:center;'>".UFM_MENU_02."</div>";
}

$ns->tablerender(UFM_MENU_03, $text, 'uniform');
?>