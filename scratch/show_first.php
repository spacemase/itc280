<?php
//show_first.php
//Will show first names with loaded links
//works with preloadFirst.php & updateFirst.php
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
#include("include/utilINC1.php");  //required for redirect/myerror
#include("include/connINC.php");  //MAKE SURE PATH IS CORRECT FOR YOUR INC FOLDER
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';

$selSQL = "select FirstName, CustomerID from mjense11.tblCustomers";  //ADJUST TO YOUR DB/TABLE
//-----------------------------------------------------------
?>
<html>
<body>
<h1 align="center">show_first.php</h1>
<?
$myConn = conn();
$myData = @mysql_query($selSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error()));
$numRows = mysql_num_rows($myData);
if ($numRows > 0)
{//must be records
   while ($row = mysql_fetch_array($myData))
   {
         $FirstName = stripslashes(trim($row['FirstName'])); 
         $CustomerID = stripslashes(trim($row['CustomerID']));
         print '<div align="center"><a href="preload_first.php?id=' . $CustomerID . '">' . $FirstName . '</a></div>';
    }
}else{//no records
    print '<b>No Customers in this table</b>';
}
?>
</body>
</html>
<?php
@mysql_free_result($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //clears resources
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
?>
