<?php
include_lan(e_PLUGIN.'canvas/languages/'.e_LANGUAGE.'.php');

// -- [ PLUGIN INFO ]
$eplug_name			= "Canvas";
$eplug_version		= "0.1.0";
$eplug_author		= "Patrick Weaver"; 
$eplug_url			= "http://trickmod.com/";
$eplug_email		= "patrickweaver@gmail.com";
$eplug_description	= UFM_PLUGIN_01;
$eplug_compatible	= "e107 v1.0+";
$eplug_readme		= "";
$eplug_compliant	= TRUE;
$eplug_folder		= "uniform_menu";
$eplug_menu_name	= "uniform_menu";
$eplug_conffile		= "config.php";
$eplug_icon			= $eplug_folder."/images/icon.png";
$eplug_icon_small	= $eplug_icon;
$eplug_caption		= UFM_PLUGIN_02; 

// -- [ DEFAULT PREFERENCES ]
$eplug_prefs = array(
    "ufm_date" => '',
    "ufm_uniform" => '',
    "ufm_notes" => ''
);

// -- [ MYSQL TABLES ]
$eplug_table_names = "";
$eplug_tables = "";

// -- [ MAIN SITE LINK ]
$eplug_link			= FALSE;
$eplug_link_name	= "";
$eplug_link_url		= "";

// -- [ INSTALLED MESSAGE ]
$eplug_done = $eplug_name.UFM_PLUGIN_03;

// -- [ UPGRADE INFORMATION ]
$upgrade_add_prefs    = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done   = $eplug_name.UFM_PLUGIN_04;
?>