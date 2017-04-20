<?php
//preload.php
//use addslashes for insert, and stripslashes for display
ob_start(); //prevents header errors
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';
#include("include/utilINC1.php");  //required for redirect/myerror
#include("include/connINC.php"); //creates connection variable: $myConn
$myConn = conn() ;
$myTable = "mjense11.tblCustomers";  //change to match your db/table
//-----------------------------------------------------------
if (isset($_GET['id'])) //isset determines if var has valid contents
{//if var is set, prepare to load page
   $myID = strip_tags(trim($_GET['id']));  //strip hacker bits, trim white space
   $idField = strip_tags(trim($_GET['fld']));  //name of ID field
   if(!is_numeric($myID)){myRedirect("first_table2.php");} //if not a number, redirect

}else{ 
   myRedirect("first_table2.php");
}
?>
<html>
<body>
<h1 align="center">Update Data from <?=$myTable;?></h1>
<div align="center">
<form action="preload_update.php" method="post">
<?
//individual record sql statement
$selSQL = "select * from " . $myTable . " where " . $idField . " = " . $myID;
$myData = @mysql_query($selSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); 

//get number of columns to identify how many TDs we'll need
$numColumns = @mysql_num_fields($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error()));

$aFields = array(); //array to store field names
$aFieldType = array(); //array to store field data types

for($x = 0; $x < $numColumns; $x++)
{
  //grab field name into an array
  $aFields[$x] = mysql_field_name($myData,$x);
  $aFieldType[$x] = mysql_field_type($myData,$x);
}
$x = 0;//reset as counter
while($row = mysql_fetch_row($myData))
{  //pull data from db array
   for($x = 0; $x < $numColumns; $x++)
   { //print out data
     if($x != 0)
     {//create update link for primary key
        print '<b>' . $aFields[$x] . ": </b>";
     	print '<input type="text" name="' . $aFields[$x] .'" ' . ' value="' . $row[$x] . '" /><br />';
     	print '<input type="hidden" name="*' . $aFields[$x] . '"' . ' value="' . $aFieldType[$x] . '">';
     }
   }
}
?>
<input type="hidden" name="id" value="<? print $myID;?>" />
<input type="hidden" name="idField" value="<? print $idField;?>" />
<input type="hidden" name="tbl" value="<? print $myTable;?>" />
<input type="submit" value="Update Data">
</form>
</div>
</body>
</html>
<?
@mysql_free_result($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //clears resources
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
ob_flush();
?>
