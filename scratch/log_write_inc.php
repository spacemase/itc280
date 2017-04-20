Writing To A Log File (Updated 10/17/2005)

The following 2 pages demonstrate a way to write to a log file to report errors on a PHP page.  To do this, include the file "logWriteINC.php" on any page which you think might need error reporting.  There are 3 functions that can be called, "logWrite" which allows you to create a custom error message and write it to the log file, and 2 functions that would only be called from a different page, one that you setup to read the error messages.  Of These 2 functions, "logRead" allows you to read the error messages that have accumulated across all pages, and "logClear" allows you to delete these messages when they take up too much space on the page.

The first page is "logWriteINC.php" which is the include file you must use to enable these functions.  The second page is a test page to both show how to use these pages in practice, and how to view the data on the error log file, called "LogWriteTest.php".

<?
//logWriteINC.php, include in a file in which you wish to write to a log file, or view error log file
//for example, on a page that may have error messages you don't want the user to see
//3 functions on this page, logWrite, which allows you to write to the log file, and logRead to read it
//logClear will clear out the file, and write a line to it indicating when it was cleared.

//Allows you to write to the log file.  Appends date and MAIN calling page, (NOT include!!)
function logWrite($myInfo)
{
	//name of the logfile where you will store the data
	$fileName = "/home/classes/horsey01/public_html/rwx/logFile.txt";  //must be in writeable folder 
	$myMode = "a+";  //a+ append and/or create
	$myStr = "----------------------------------------------------------\n"; //separator
	$myStr .= "Log entered: ". date("d F Y - h:i:s A")."\n";
	$myStr .= "Reporting Page: ". $_SERVER['PHP_SELF'] ."\n";
	$myStr .= "Info : " . $myInfo . "\n"; //info input when function is called

	$isOpen = fopen($fileName,$myMode);
	if($isOpen)
	{
	   fwrite($isOpen,$myStr);
	   fclose($isOpen);
	}
}
//Here is how to call the logWrite function:
//logWrite("Here is where my error message goes!!");

//Allows you to read the current log file.
function logRead()
{
	$fileName = "/home/classes/ horsey01/public_html/rwx/logFile.txt";
	$myArray = file($fileName);
	if ($myArray != FALSE)
	{
	   for($x=0;$x<count($myArray);$x++)
	   {
	      print $myArray[$x] . "<br>";
	   }
	}else{
	   print "No info in file";
	}
}
//Here is how to call the logRead function:
//logRead();

//Calling this function clears the log file.
function logClear()
{
	$fileName = "/home/classes/ horsey01/public_html/rwx/logFile.txt";	
	$myStr = "Log cleared: ". date("d F Y - h:i:s A")."\n";
	$myMode = "w+"; //will overwrite/create file
	$isOpen = fopen($fileName,$myMode);
	if($isOpen)
	{
	   fwrite($isOpen,$myStr);
	   fclose($isOpen);
	}
}
//Here is how to call the logClear function:
//logRead();
?>


<? 
/*
 logWriteINCTest.php
 This file demonstrates how to include the file, "logWriteINC.php", and call a function,
 'logWrite', to write to the file in case of an error, specifically because we SUPPRESSED it from the user!
 Since this is just a test file, we also READ THE ERROR back to this page, which in practice you would never do.  Normally you would read the errors in the error log inside a different file.
 */
include("logWriteINC.php"); //include log file, so we can read/write the file

if (isset($_GET['clear'])) //if resetting logfile, var will come in here!
{
      $myClear = $_GET['clear'];
      if($myClear == "yes")
      { //clear log file!
	    logClear();  
      }
}else{  //not resetting file, generate an error!!
	$myHostName = "localhost";  //this is set up to create an error
	$myUserName = "fake";
	$myPassword = "also fake";
	//"@" symbol suppresses error msg
	$myConn = @mysql_connect($myHostName,$myUserName,$myPassword);
	if (!$myConn)
	{  //Test the connection, to see if we have authorization
	    $mySQLConn = 0; //could not connect MySQL
	    logWrite("Could Not Connect to MySQL in 'logWriteINCTest.php', line 15"); 
	}else{
	    $mySQLConn = 1; //connected to MySQL
	    print "Oops, it worked?!";
	    die();
	    //we will not get here on this page, because we are purposely generating an error!!
	}
}
unset($_GET['clear']); //unset var

//Now that we have created an error, lets read it!!
//NOTE: In practice, this would be called from a DIFFERENT file, NOT the one that generates the error!!
?>
<html><h1 align=center>LOG FILE CONTENTS</h1><div align=center>(logWriteINCTest.php)</div>
<p>Start of log contents:</p><hr />
<? print logRead(); //read log file ?>
<hr /><p>End of log contents</p>
<div align=center><a href="logWriteINCTest.php">TEST AGAIN</a></div><br />
<div align=center><a href="logWriteINCTest.php?clear=yes">CLEAR LOG</a></div>
</html>
