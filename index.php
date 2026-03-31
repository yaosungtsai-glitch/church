<?php
include_once('mainfile.php');
include_once("language/index-".DEFAULTLANGUAGE.".php");

function menu(){
    include_once('header.php');

}
function checkin() {
    menu();
    OpenTable();
    if(!isset($_POST['chkid']))
        echo _PLEASECHECKIN;
    elseif($_POST['chkid']!='nouser'){
        echo $_POST['chkid']._ARRIVEAT;
    }else{
        echo _NOUSER;
    }
    CloseTable();
    echo "</br>".PHP_EOL;
    OpenTable();
    echo "<h1>"._CHECKIN."</h1>".PHP_EOL;
    echo "<form action='".$SERVER['PHP_SELF']."' method='post'>".PHP_EOL;
    echo "<input type='hidden' name='op' value='checkinexec'>".PHP_EOL;
    echo "<input type='text' name='chkid' autofocus required >".PHP_EOL;
    echo "<input type='submit' value='"._OK."'>".PHP_EOL;
    echo "</form>".PHP_EOL;
    CloseTable();
    echo "</br>".PHP_EOL;
    include_once('footer.php');
}
function checkinexec() {
    if (isset($_REQUEST['chkid'])) {
        $sql="select count(id) as count,id,cellphone from ".ADOPREFIX."_user where enable='1' and cellphone=?";
        $handle=$GLOBALS['adoconn']->prepare($sql);
        $bindVariables = array(0=>$_REQUEST['chkid']);
        $rs = $GLOBALS['adoconn']->execute($handle, $bindVariables);
        if($rs->fields['count']>0){
            $sql="insert into ".ADOPREFIX."_user_checkin(userid,arrive_time) values('".$rs->fields['id']."','".date('Y-m-d H:i:s')."')";
            //echo $sql;exit;
            $GLOBALS['adoconn']->execute($sql);
            $fields['chkid']=$_REQUEST['chkid'];
           // header("Location: ".$_SERVER['PHP_SELF']."?op=checkin&chkid=".$_REQUEST['chkid']);    
        }else
            $fields['chkid']='nouser';
            //header("Location: ".$_SERVER['PHP_SELF']."?op=checkin&msg="._NOUSER);
    }
    $fields['op'];
    POSTFORM($_SERVER['PHP_SELF'],$fields); 
}


switch ($_REQUEST['op']) {
    default:
	case 'checkin':
		checkin();
		break;
	case 'checkinexec':
		checkinexec();
		break;
}

?>