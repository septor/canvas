<?php

// This is how you should start every configuration page for a plugin.
// Most of this is covered in the wiki article so I'm not going to repeat it.
$eplug_admin = TRUE;
require_once('../../class2.php');
if (!getperms('4')) { header('location:'.e_BASE.'index.php'); exit ;}
include_lan(e_PLUGIN.'img_menu/languages/'.e_LANGUAGE.'.php');
require_once(e_ADMIN.'auth.php');


// This is where the settings are saved to the preferences table.
// Any numbers you pass to the database should be parsed with the intval() command.
// Everything else that is submitted by a user, of any userclass, should be passed through the core toDB() function.
if(isset($_POST['updatesettings']))
{
	$pref['ufm_date'] 		= $tp->toDB($_POST['month']." ".$_POST['day']." ".$_POST['year']);
	$pref['ufm_uniform']	= $tp->toDB($_POST['uniform']);
	$pref['ufm_notes']		= $tp->toDB($_POST['notes']);
	save_prefs();
	$message = UFM_CONFIG_01;
}

if(isset($message)){ $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>"); }

// Create an array that holds the months for later use.
$month = array(
	"January",
	"Feburary",
	"March",
	"April",
	"May",
	"Jun",
	"July",
	"August",
	"September",
	"October",
	"November",
	"December"
);

// Since we're saving the date as one item, we need to split it up here to fill in the form elements.
// We need to also prepare for an instance where the preference may not be set.
// In that case we'll fill the fields in with today's date.
$date = (($pref['ufm_date']) ? explode(" ", $pref['ufm_date']) : array(date("M"), date("d"), date("Y")));

$text = "
<div style='text-align:center'>
	<form action='".e_SELF."' method='post'>
		<table style='width:85%' class='fborder' >
			
			<tr>
				<td style='width:30%' class='forumheader3'>".UFM_CONFIG_02."</td>
				<td style='width:70%' class='forumheader3'>
					<select name='month' class='tbox'>";
						
						// We're going to create a foreach loop to fill in the months.
						foreach($month as $key => $value)
						{
							// This is where it gets displayed. We're also going to flag the month as selected if it matches the already saved month.
							$text .= "<option value='".$value."'".($date[0] == $value ? " selected" : "").">".$value."</option>";
						}

					$text .= "
					</select>
					<select name='day' class='tbox'>";
						
						// We're going to create a for loop to fill in the days.
						for($i = 1; $i <= 31; $i++)
						{
							// This is where it gets displayed. We're also going to flag the day as selected if it matches the already saved day.
							$text .= "<option value='".$i."'".($date[1] == $i ? " selected" : "").">".$i."</option>";
						}

					$text .= "</select>
					<input type='text' class='tbox' name='year' value='".$date[2]."' />
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".UFM_CONFIG_03."</td>
				<td style='width:70%' class='forumheader3'>
					<input type='radio' name='uniform' value='sd-2'".($pref['ufm_uniform'] == "sd-2" ? " checked" : "")." /> Service Dress<br />
					<input type='radio' name='uniform' value='dpcu-hffk-2'".($pref['ufm_uniform'] == "dpcu-hffk-2" ? " checked" : "")." /> DPCU HFFK<br />
					<input type='radio' name='uniform' value='dpcu-bush-2'".($pref['ufm_uniform'] == "dpcu-bush-2" ? " checked" : "")." /> DPCU Bush<br />
					<input type='radio' name='uniform' value='al1body'".($pref['ufm_uniform'] == "al1body" ? " checked" : "")." /> Civies<br />
					<input type='radio' name='uniform' value='nil'".($pref['ufm_uniform'] == "nil" || !($pref['ufm_uniform']) ? " checked" : "")." /> None
				</td>
			</tr>

			<tr>
				<td style='width:30%' class='forumheader3'>".UFM_CONFIG_04."</td>
				<td style='width:70%' class='forumheader3'>
					<textarea name='notes' class='tbox' style='width: 100%; height: 60px;'>".$pref['ufm_notes']."</textarea>
				</td>
			</tr>

			<tr>
				<td colspan='2' class='forumheader' style='text-align: center;'><input class='button' type='submit' name='updatesettings' value='".UFM_CONFIG_05."' /></td>
			</tr>
		</table>
	</form>
</div>";

$ns->tablerender(UFM_CONFIG_06, $text);
require_once(e_ADMIN.'footer.php');
?>