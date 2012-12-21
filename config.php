<?php
$eplug_admin = TRUE;
require_once('../../class2.php');
if (!getperms('4')) { header('location:'.e_BASE.'index.php'); exit ;}
include_lan(e_PLUGIN.'canvas/languages/'.e_LANGUAGE.'.php');
require_once(e_ADMIN.'auth.php');
define("CANVAS", e_PLUGIN."canvas/images/canvas/");

if(isset($_POST['updatesettings']))
{
	$pref['canvas_title'] 	= $tp->toDB($_POST['title']);
	$pref['canvas_image']	= $tp->toDB($_POST['image']);
	$pref['canvas_size']	= $tp->toDB(str_replace(" ", "", $_POST['size']));
	save_prefs();
	$message = CANVAS_CONFIG_01;
}

if(isset($message)){ $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>"); }

$size = explode("x", (!empty($pref['canvas_size']) ? $pref['canvas_size'] : "100x100"));

$text = "
<div style='text-align:center;'>
	<form action='".e_SELF."' method='post'>
		<table style='width:85%;' class='fborder'>
			
			<tr>
				<td style='width:30%;' class='forumheader3'>".CANVAS_CONFIG_02."</td>
				<td style='width:70%;' class='forumheader3'>
					<input type='text' class='tbox' name='title' value='".$pref['canvas_title']."' />
				</td>
			</tr>

			<tr>
				<td style='width:30%;' class='forumheader3'>".CANVAS_CONFIG_03."</td>
				<td style='width:70%;' class='forumheader3'>
					<input type='radio' name='image' value='none'".($pref['canvas_image'] == "none" ? " checked" : "")." /> ".CANVAS_CONFIG_04."<br />
					<input type='radio' name='image' value='random'".($pref['canvas_image'] == "random" ? " checked" : "")." /> ".CANVAS_CONFIG_05."<br />
					<div style='height:200px; overflow:auto;'>";

					foreach(glob("{".CANVAS."*.jpg,".CANVAS."*.gif,".CANVAS."*.png}", GLOB_BRACE) as $image_file)
					{
						$text .= "<input type='radio' name='image' value='".str_replace(CANVAS, "", $image_file)."'".($pref['canvas_image'] == str_replace(CANVAS, "", $image_file) ? " checked" : "")." /> <img src='".$image_file."' style='width:".$size[0]."px; height:".$size[1]."px;' /><br />";
					}
					
					$text .= "	
					</div>
				</td>
			</tr>

			<tr>
				<td style='width:30%;' class='forumheader3'>".CANVAS_CONFIG_06."</td>
				<td style='width:70%;' class='forumheader3'>
					<input type='text' class='tbox' name='size' value='".$pref['canvas_size']."' />
				</td>
			</tr>

			<tr>
				<td colspan='2' class='forumheader' style='text-align:center;'><input class='button' type='submit' name='updatesettings' value='".CANVAS_CONFIG_07."' /></td>
			</tr>
		</table>
	</form>
</div>";

$ns->tablerender(CANVAS_CONFIG_08, $text);
require_once(e_ADMIN.'footer.php');
?>