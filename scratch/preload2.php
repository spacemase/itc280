<?php
//preload2.php
//Works with preload_update2.php & first_table3.php
//will update or addition form
ob_start(); //prevents header errors
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';
#include("include/utilINC1.php");  //required for redirect/myerror
#include("include/connINC.php"); //creates connection variable: $myConn
$myConn = conn() ;
$redPage = "first_table3.php";  //main table page, for redirection
//-----------------------------------------------------------
$myNew = "";
if (isset($_GET['id'])) //isset determines if var has valid contents
{//if var is set, prepare to load page
   $myID = strip_tags(trim($_GET['id']));  //strip hacker bits, trim white space
   if(!is_numeric($myID)){myRedirect($redPage);} //if not a number, redirect
   $myTable = strip_tags(trim($_GET['tbl']));
    $tableHeader = "Update Record from " . $myTable;
    $submitValue = "Update Record";
}else{  //Could be new record!  check var:
    if(isset($_GET['nw']))
    {
       $myNew = strip_tags(trim($_GET['nw']));  //strip hacker bits, trim white space
       if($myNew != "y"){myRedirect($redPage);} //letter "y" for yes
       $myTable = strip_tags(trim($_GET['tbl']));
       $tableHeader = "Add Record to " . $myTable;
   	   $submitValue = "Add Record";
   	   $myID = 0; //placeholder
    }else{ //not new, no id, redirect
      myRedirect($redPage);
    }
}
$idField = strip_tags(trim($_GET['fld']));  //name of ID field
?>
<html>
<body>
<h1 align="center"><?=$tableHeader;?></h1>
<div align="center">
<form action="preload_update2.php" method="post">
<?

//individual record sql statement
if($myNew=="y")
{
	$selSQL = "select * from " . $myTable . " limit 1";
}else{
	$selSQL = "select * from " . $myTable . " where " . $idField . " = " . $myID;	
}

$myData = @mysql_query($selSQL,$myConn)  or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); 
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

if($myNew == "y")
{//no data necessary

   for($x = 0; $x < $numColumns; $x++)
   { //print out data
     if($x != 0)
     {//create update link for primary key
        print '<b>' . $aFields[$x] . ": </b>";
     	print '<input type="text" name="' . $aFields[$x] .'" ' . ' value="" /><br />';
     	print '<input type="hidden" name="*' . $aFields[$x] . '"' . ' value="' . $aFieldType[$x] . '">';
     }
   }

}else{
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
}

?>
<input type="hidden" name="nw" value="<?=@$myNew;?>" />
<input type="hidden" name="id" value="<? print $myID;?>" />
<input type="hidden" name="idField" value="<? print $idField;?>" />
<input type="hidden" name="tbl" value="<? print $myTable;?>" />
<input type="submit" value="<?=$submitValue;?>">
</form>
</body>
</html>
<?
@mysql_free_result($myData) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //clears resources
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
ob_flush();
?>
