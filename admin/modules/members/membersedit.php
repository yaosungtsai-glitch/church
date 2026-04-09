<?php
/**
* Company: 
* Program: membersedit.php
* Author:  Ken Tsai
* Date:    2023.05.25
* Version: 2.0
*/
function membersedit(){

membersmenu();
OpenTable();
$sql="SELECT id ,userNo, userID, mobileNo, name ,createDate from ".ADOPREFIX."_user where id='".$_GET['pkid']."' and status='2' order by id DESC";
$rs = $GLOBALS['adoconn_ocr']->Execute($sql);
$sql="SELECT * from ".ADOPREFIX_OCR."_pic where member_id='".$_GET['pkid']."' order by id DESC";
$rs_pic = $GLOBALS['adoconn_ocr']->Execute($sql);
echo "<center><font class='undertitle'>"._AUDITING."</font></center>\n";
echo "<table>\n";
echo "<form active='".$_SERVER['PHP_SELF']."' method='post'>\n";
echo "<input type='hidden' name='op' value='members'>\n";
echo "<input type='hidden' name='op2' value='memberseditting'>\n";
echo "<input type='hidden' name='pkid' value='".$rs->fields['id']."'>\n";
echo "<tr><td>"._USERNAME.":</td><td>".$rs->fields['name']."</td></tr>\n";
echo "<tr><td>"._CELLPHONE.":</td><td>".$rs->fields['mobileNo']."</td></tr>\n";
echo "<tr><td>"._USERID.":</td><td>".$rs->fields['userID']."</td></tr>\n";
echo "<tr><td>"._IDCARDUP.":</td><td>".strtoimg($rs_pic->fields['idCard_front_org'])."</td></tr>\n";
echo "<tr><td></td><td><input type='submit' value='"._OK."'></td></tr>\n";
echo "</form>\n";
echo "</table>\n";

CloseTable();
echo "<br>";
include_once("footer.php");
}


?>
