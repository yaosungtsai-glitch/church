<?php
/**
* Company: 
* Program: members.php
* Author:  Ken Tsai
* Date:    2026.04.09
* Version: 2.0
* Description: 會友管理
*/

Header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
if (!preg_match('/'.ADMINPAGE.'/', $_SERVER['PHP_SELF'])) { die ("Access Denied"); }
include_once("admin/language/members-".DEFAULTLANGUAGE.".php");
include_once("lib/dbpager.inc.php");
/*
系統管理menu
*/
function membersmenu()
{
	include_once("header.php");
	GraphicAdmin();
	OpenTable();
	echo "<center class='toptitle'>"._MEMBERSADMIN."</center>\n";
	echo "<br>";
	echo "<a href='".$_SERVER['PHP_SELF']."?op=members&op2=membersadd'>"._MEMBERSADD."</a>|";
	echo "<a href='".$_SERVER['PHP_SELF']."?op=members&op2=memberslist'>"._MEMBERSLIST."</a>&nbsp&nbsp";
	CloseTable();
	echo "<br>";
}

/**
 *  身份證需檢核列表 
 **/

function memberslist(){
	membersmenu();
	OpenTable();
	echo "<center><font class='undertitle'>"._MEMBERSLIST."</font></center>\n";
//會友身份 0:慕道友 1:已入籍會友 2:未入會籍 3:已轉出會籍 4:新朋友(受洗）5:新朋友(未受洗)
	$sql="select id,username,   case membership 
								when 0 then '"._MEMBERSHIP0."' 
								when 1 then '"._MEMBERSHIP1."' 
								when 2 then '"._MEMBERSHIP2."' 
								when 3 then '"._MEMBERSHIP3."' 
								when 4 then '"._MEMBERSHIP4."' 
								when 5 then '"._MEMBERSHIP5."' 
								else '"._MEMBERSHIP0."' end 
	from ".ADOPREFIX."_user order by id DESC";
    $colnames= array(_ID,_NAME,_MEMBERSHIP,_FUNCTIONS);
    $links[0]['link']="op=members&op2=membersedit";
    $links[0]['label']=_EDIT;    
	$links[1]['link']="op=members&op2=membersrecord";
    $links[1]['label']=_LOGINRECORD;  
    $rows=dbpage($GLOBALS['adoconn'],$sql,$colnames,$links);
	CloseTable();
	include_once("footer.php");
	/*
    OpenTable();
   	include_once("lib/dbpager.inc.php");
	echo "<center><font class='undertitle'>"._MEMBERSLIST."</font></center>\n";
	$sql="select id from ".ADOPREFIX."_members order by id DESC";
    echo $sql;
	$colnames= array(_ID,_FUNCTIONS);
	$links[0]['link']  ="op=members&op2=membersedit";
	$links[0]['label'] =_AUDITING;  
    $rows=dbpage($GLOBALS['adoconn_ocr'],$sql,$colnames,$links);
	CloseTable();
	echo "<br>";
	include_once("footer.php");
	*/

}
function  membersrecord(){
	membersmenu();
	OpenTable();
	echo "<center><font class='undertitle'>"._LOGINRECORD."</font></center>\n";
    $colnames= array(_ID,_NAME,_MEMBERSHIP,_FUNCTIONS);
	$sql="select a.id,b.username,a.arrive_time from ".ADOPREFIX."_user_checkin a ,".ADOPREFIX."_user b where a.userid='".$_GET['pkid']."' and b.id=a.userid order by a.id DESC";
	$rows=dbpage($GLOBALS['adoconn'],$sql,$colnames,0,0);
	CloseTable();
	echo "<br>";
	include_once("footer.php");


}

/*

function strtoimg($data){
	$imgtype = array('data:image/jpeg;base64,', 'data:image/png;base64,');
	$imgdata=str_replace($imgtype,'',$data);
	echo $imgdata;
	/*
	$imgdata = base64_decode($imgdata);
	$im = imagecreatefromstring($imgdata);
	if ($im !== false) {
    	header('Content-Type: image/jpeg');
    	imagepng($im);
    	imagedestroy($im);
	}
	else {
    	echo '_IDCARDERR';
	}

}
*/
$op='members';
include_opdir($op);
if ($_REQUEST['op']==$op && isAuthority($_SESSION['aid'],$_REQUEST['op']))
{	
	switch ($_REQUEST['op2'])
	{
		
		case "membersrecord":	
			membersrecord();
		break;
		case "membersedit":
			membersedit();
		break;
		case "memberslist":	
			memberslist();
		break;
		default:
			 membersmenu();
			 include_once("footer.php");
		break;

	}
}
?>