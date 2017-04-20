<?php
//preload_first.php
//Will load first name into 'value' of textbox
//works with showFirst.php & updateFirst.php'
ob_start(); //prevents header errors
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
#include("include/utilINC1.php");  //required for redirect/myerror
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';

//-----------------------------------------------------------

if(isset($_GET['id'])){
        $myID = trim($_GET['id']);
         if(!is_numeric($myID)){myRedirect("show_first.php");}  //No such ID!
}else{
         myRedirect("show_first.php");  //Requires ID to preload!
}
?>
<html>
<body>
<form action="update_first.php" method="post">
<h1 align="center">preload_first.php</h1>
<div align="center">
<?
#include("include/connINC.php");  //MAKE SURE PATH IS CORRECT FOR YOUR INC FOLDER
$selSQL = "select FirstName from mjense11.tblCustomers where CustomerID=" . $myID;
$myConn = conn();
$myData = @mysql_query($selSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error()));
$numRows = mysql_num_rows($myData);
if ($numRows > 0)
{//must be records
   while ($row = mysql_fetch_array($myData))
   {
         $FirstName = stripslashes(trim($row['FirstName'])); 
         print '<div align="center">First Name: <input type="text" name="FirstName" value="' . $FirstName . '" /></div>';
    }
}else{//no records
     myRedirect("show_first.php");  //Requires VALID id
}
print '<input type="hidden" name="CustomerID" value="' . $myID . '" />';
?>
<input type="submit" name="submit" value="Update First!" />
</div>
</form>
</body>
</html>
<?
@mysql_free_result($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //clears resources
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
ob_flush(); //for header errors
?>
