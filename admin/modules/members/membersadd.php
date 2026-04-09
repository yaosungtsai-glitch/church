<?php
/**
* Company: 
* Program: membersedit.php
* Author:  Ken Tsai
* Date:    2023.05.25
* Version: 2.0
*/
function membersadd(){
    membersmenu();
	OpenTable();
	echo "<center class='toptitle'>"._MEMBERSADD."</center>\n";
    CloseTable();
	echo "<br>";
    OpenTable();
    echo "<table>\n";
    echo "<form active='".$_SERVER['PHP_SELF']."' method='post'>\n";
    echo "<input type='hidden' name='op' value='members'>\n";
    echo "<input type='hidden' name='op2' value='membersadding'>\n";
    echo "<tr><td>"._NAME."*</td><td><input type='text' name='name' required></td></tr>\n";
    echo "<tr><td>"._CELLPHONE."*</td><td><input type='text' name='cellphone' required>";
    echo "<input type='number' name='dash' value='0' size='1' required></td></tr>\n";
    echo "<tr><td>"._EMAIL."*</td><td><input type='email' name='email' required></td></tr>\n";
    //echo "<tr><td>"._USERID."</td><td><input type='text' name='userid'></td></tr>\n";
    echo "<tr><td>"._USERIMG."</td><td><input type='file' name='picture'></td></tr>\n";
    echo "<tr><td>"._USERGENDER."</td><td><input type='radio' name='gender' value='1' required >"._MAN."\n";
    echo "<input type='radio' name='gender' value='0'>"._WOMAN."</td></tr>\n";
    //echo "<tr><td>"._IDCARDUP.":</td><td>".strtoimg($rs_pic->fields['idCard_front_org'])."</td></tr>\n";
    echo "<tr><td></td><td><input type='submit' value='"._OK."'></td></tr>\n";
    echo "</form>\n";
    echo "</table>\n";
    CloseTable();
    echo "<br>";
    include_once("footer.php");
    }

function membersadding(){
    if($_POST['dash']!='0')

    $sql="insert into ".ADOPREFIX."_user(username,gender,email,address,cellphone,) values()";

}


if ($_REQUEST['op']==$op && isAuthority($_SESSION['aid'],$_REQUEST['op']))
    {	
        switch ($_REQUEST['op2'])
        {
            case "membersadd":
                membersadd();
                exit();
            break;
            case "membersadding":
                membersadding();
                exit();
            break;
    
        }
    }

?>