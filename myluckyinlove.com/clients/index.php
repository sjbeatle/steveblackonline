<?
session_start();
require("config.php");

if (isset ($_SESSION['loggedin']) && isset ($_SESSION['time']))
{
	$intClientID = $_SESSION['loggedin'];
	require ("client_header.php");
?>
<style type="text/css">
	<!--
	div#box div input {
		margin-left: 30px;
		float:left;
		height: 13px;
		font-size: 10px;
		color:#666666;
		width:220px;
		background-image: url(input_bkg.png);
		background-repeat: repeat-y;
		background-position: right;
		border: 1px solid #cccccc;
		padding:2px;
	}
	-->
</style>
<?
$strQueryPrimary = "select first_name,
													 middle_name,
													 last_name,
													 address_1,
													 address_2,
													 city,
													 state,
													 zip_code,
													 day_phone,
													 evening_phone,
													 cell_phone,
													 e_mail
													 from LIL_contact_info
													 where client_ID=$intClientID
													 and primary_contact=1
													 limit 1;";
$qryPrimary = mysql_query($strQueryPrimary);
$arrPrimary = mysql_fetch_array($qryPrimary, MYSQL_ASSOC);
$strQuerySecondary = "select first_name,
													 middle_name,
													 last_name,
													 address_1,
													 address_2,
													 city,
													 state,
													 zip_code,
													 day_phone,
													 evening_phone,
													 cell_phone,
													 e_mail
													 from LIL_contact_info
													 where client_ID=$intClientID
													 and primary_contact=0
													 limit 1;";
$qrySecondary = mysql_query($strQuerySecondary);
$arrSecondary = mysql_fetch_array($qrySecondary, MYSQL_ASSOC);
?>
			<h2><img src="http://www.myluckyinlove.com/images/lscroll.gif" alt="" /> Your Lucky in Love <img src="http://www.myluckyinlove.com/images/scroll.gif" alt="" /></h2>
			<h2 style="text-align: left !important;margin-bottom:0px !important;">Contact Information</h2>
			<p>Click on the current information to edit it.</p>
			<fieldset>
				<legend>Primary Contact</legend>
				<div style="float:left;width:80px;margin-left:10px;"><img src="images/primary.png" width="80" height="123" border="0" />
					<div id="success_popup_1" name="success_popup" style="display:none;text-align:center;color:#009900;font-weight:bold;">Update Successful</div>
					<div id="error_popup_1" name="error_popup" style="display:none;text-align:center;color:#cc0000;font-weight:bold;"><p>Update Error!</p><p>Please Try Again Later</p></div>
				</div>
				<div style="float:right;width:475px;">
<?
if ($arrPrimary)
{
	$i=0;
	$j=count($arrPrimary);
	$arrKeys = array_keys($arrPrimary);
	$arrLabels = array("First Name","Middle Name","Last Name","Address Line 1","Address Line 2","City","State","Zip Code","Day Phone","Evening Phone","Cell Phone","E-mail");
	while ($i < $j)
	{
		$strFieldValue = $arrPrimary[$arrKeys[$i]];
		$strFieldName = $arrKeys[$i];
		$strLabel = $arrLabels[$i];
		$blnOdd = false;
		if ( $i&1 ) { $blnOdd = false; } else { $blnOdd = true; } 
?>
				<div <? if ($blnOdd) { echo "class=\"odd\""; } ?>>
					<label><? echo $strLabel; ?>:</label>
					<span class="inputDisplay" style="display:inline<? if (!$strFieldValue) { echo ";color:#666666"; } ?>" id="contact_<? echo $strFieldName; ?>_1" onclick="showHideInput('<? echo $strFieldName; ?>_1',true,false);"><? if ($strFieldValue) { echo $strFieldValue; } else { echo "click here to add"; } ?></span>
					<span id="<? echo $strFieldName; ?>_1" style="display:none; background-image: url(images/edit.png); background-repeat: no-repeat; background-position: 0px 50%;">
						<form name="<? echo $strFieldName; ?>_1" method="post" action="javascript:updateField(document.<? echo $strFieldName; ?>_1.<? echo $strFieldName; ?>.value, 'LIL_contact_info', '<? echo $strFieldName; ?>', <? echo $intClientID; ?>, 1);showHideInput('<? echo $strFieldName; ?>_1',false,true);">
							<input type="text" name="<? echo $strFieldName; ?>" value="" />
						</form>
						<a href="#" class="btn_confirm" onclick="javascript:updateField(document.<? echo $strFieldName; ?>_1.<? echo $strFieldName; ?>.value, 'LIL_contact_info', '<? echo $strFieldName; ?>', <? echo $intClientID; ?>, 1);showHideInput('<? echo $strFieldName; ?>_1',false,true);return false;"></a>
						<a href="#" class="btn_cancel" onclick="showHideInput('<? echo $strFieldName; ?>_1',false,false);return false;"></a>
					</span>
					<div style="height:0px;clear:both;padding:0px;"></div>
				</div>
<?
		$i = $i + 1;
	}
}
?>
				</div>
			</fieldset>

			<fieldset>
				<legend>Secondary Contact</legend>
				<div style="float:left;width:80px;margin-left:10px;"><img src="images/secondary.png" width="80" height="123" border="0" />
					<div id="success_popup_2" name="success_popup" style="display:none;text-align:center;color:#009900;font-weight:bold;">Update Successful</div>
					<div id="error_popup_2" name="error_popup" style="display:none;text-align:center;color:#cc0000;font-weight:bold;"><p>Update Error!</p><p>Please Try Again Later</p></div>				</div>
				<div style="float:right;width:475px;">
<?
if ($arrSecondary)
{
	$i=0;
	$j=count($arrSecondary);
	$arrKeys = array_keys($arrSecondary);
	$arrLabels = array("First Name","Middle Name","Last Name","Address Line 1","Address Line 2","City","State","Zip Code","Day Phone","Evening Phone","Cell Phone","E-mail");
	while ($i < $j)
	{
		$strFieldValue = $arrSecondary[$arrKeys[$i]];
		$strFieldName = $arrKeys[$i];
		$strLabel = $arrLabels[$i];
		$blnOdd = false;
		if ( $i&1 ) { $blnOdd = false; } else { $blnOdd = true; } 
?>
				<div <? if ($blnOdd) { echo "class=\"odd\""; } ?>>
					<label><? echo $strLabel; ?>:</label>
					<span class="inputDisplay" style="display:inline<? if (!$strFieldValue) { echo ";color:#666666"; } ?>" id="contact_<? echo $strFieldName; ?>_2" onclick="showHideInput('<? echo $strFieldName; ?>_2',true,false);"><? if ($strFieldValue) { echo $strFieldValue; } else { echo "click here to add"; } ?></span>
					<span id="<? echo $strFieldName; ?>_2" style="display:none; background-image: url(images/edit.png); background-repeat: no-repeat; background-position: 0px 50%;">
						<form name="<? echo $strFieldName; ?>_2" method="post" action="javascript:updateField(document.<? echo $strFieldName; ?>_2.<? echo $strFieldName; ?>.value, 'LIL_contact_info', '<? echo $strFieldName; ?>', <? echo $intClientID; ?>, 0);showHideInput('<? echo $strFieldName; ?>_2',false,true);">
							<input type="text" name="<? echo $strFieldName; ?>" value="" />
						</form>
						<a href="#" class="btn_confirm" onclick="javascript:updateField(document.<? echo $strFieldName; ?>_2.<? echo $strFieldName; ?>.value, 'LIL_contact_info', '<? echo $strFieldName; ?>', <? echo $intClientID; ?>, 0);showHideInput('<? echo $strFieldName; ?>_2',false,true);return false;"></a>
						<a href="#" class="btn_cancel" onclick="showHideInput('<? echo $strFieldName; ?>_2',false,false);return false;"></a>
					</span>
					<div style="height:0px;clear:both;padding:0px;"></div>
				</div>
<?
		$i = $i + 1;
	}
}
?>
			</div>
			</fieldset>
<?
	require("client_footer.php");
}
//if user is not logged in
else
{
echo $_SESSION['loggedin'];
	require("login.php");
}
mysql_close();
?>