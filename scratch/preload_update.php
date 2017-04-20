<?php
//preload_update.php
//Works with preload.php to update users data, redirects to firstTable2.php to show table
ob_start(); //prevents header errors
$myDebug = 1; //myDebug=1 shows developer/user errors!
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';
#include("include/utilINC1.php");  //required for redirect/myerror
#include("include/connINC.php"); //creates connection variable: $myConn
$myConn = conn() ;

//-----------------------------------------------------------
if (isset($_POST['id'])) //isset determines if var has valid contents
{//page relies upon valid ID
   $myID = strip_tags(trim($_POST['id']));  //strip hacker bits, trim white space
   if(!is_numeric($myID)){myRedirect("first_table2.php");} //if not a number, redirect
   $idField = addslashes(strip_tags(trim($_POST['idField'])));
   $myTable = addslashes(strip_tags(trim($_POST['tbl'])));
}else{ 
   myRedirect("first_table2.php");
}
$nStr = ""; //declare ahead
 foreach ($_POST as $varName=> $value)
 {
    switch($varName)
    {
     case "idField":  //do nothing for these
     case "id":
     case "tbl":
     break;
     default:   //put data into variable for edit
         $strTest = substr($varName,0,1);  //check first char for *
         if($strTest != "*") //do NOT test asterisk
         {
	         $testType = "*" . $varName;
	         $testTypeValue = (trim($_POST[$testType]));
             switch ($testTypeValue)
             {
             case "string":
             case "text":
             case "blob":
             case "date":
             case "time":
             case "timestamp":
             case "datetime":
                  $value = addslashes($value);
                  $nStr .= $varName . " = '" . $value . "', ";
                  break;
             default:
                  $nStr .= $varName . " = " . $value . ", ";
             }
         }
    }
 }
$upSQL = substr($nStr,0,strlen($nStr)- 2);
$upSQL = "update " . $myTable . " set " . $upSQL . " where " . $idField . " = " . $myID;
@mysql_query($upSQL,$myConn) or die(myerror($myDebug,__FILE__,__LINE__,mysql_error()));
@mysql_close() or die(myerror($myDebug,__FILE__,__LINE__,mysql_error())); //close connection to db
myRedirect("first_table2.php");
ob_flush();
?>
