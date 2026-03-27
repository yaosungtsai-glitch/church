<?php
include_once('mainfile.php');
include_once("language/index-".DEFAULTLANGUAGE.".php");

function menu(){
    include_once('header.php');

}
function checkin() {
    menu();
    OpenTable();
    if(isset($_REQUEST['msg'])){
        echo _NOUSER;
        /*
        ?>
        <script language="javaScript">
        function myrefresh()
        {
            window.location.reload();
        }
        setTimeout('myrefresh()',1000); //指定1秒刷新一次
        </script>
        <?php*/
    }else{
        echo "<h1>Checkin</h1>".PHP_EOL;
        echo "<form action='".$SERVER['PHP_SELF']."' method='post'>".PHP_EOL;
        echo "<input type='hidden' name='op' value='checkinexec'>".PHP_EOL;
        echo "<input type='text' name='chkid' autofocus required >".PHP_EOL;
        echo "<input type='submit' value='"._OK."'>".PHP_EOL;
        echo "</form>".PHP_EOL;
    }
    CloseTable();
    echo "</br>";
    include_once('footer.php');
}
function checkinexec() {
    if (isset($_REQUEST['chkid'])) {
        $sql="select count(id) as count,id,cellphone from ".ADOPREFIX."_user where enable='1' and cellphone=?";
        $handle=$GLOBALS['adoconn']->prepare($sql);
        $bindVariables = array(0=>$_REQUEST['chkid']);
        $rs= $GLOBALS['adoconn']->execute($handle, $bindVariables);
        if($rs->fields['count']>0){
            $sql="insert into ".ADOPREFIX."_checkin(userid,cellphone,create_time) values('".$rs->fields['id']."','".$rs->fields['cellphone']."','".date('Y-m-d H:i:s')."')";
            $rs= $GLOBALS['adoconn']->execute($sql);
            header("Location: ".$_SERVER['PHP_SELF']."?op=checkin&chkid=".$_REQUEST['chkid']);    
        }else
            header("Location: ".$_SERVER['PHP_SELF']."?op=checkin&msg="._NOUSER);
    }

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