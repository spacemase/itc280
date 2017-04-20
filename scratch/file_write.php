<?php
//file_write.php tests read/write/execute permissions for a folder

$fileName = "data.txt" ;
$myStr = "File entry created: " . date( "d F Y - h:i:s A" ) . "\n" ;
//w+, write and/or create, a+ append and/or create
//r, read, r+ read/write
$myMode = "a+" ;

//run function to write to file
$bWorked = fileWrite( $fileName, $myMode, $myStr ) ;

//if it worked, report it to the browser
if( $bWorked )
{
  print "Wrote to file!<br>" ;
}
else
{
print "It didn't work!<br>" ;
}

//run the "fileRead" function
fileRead( $fileName ) ;

//***************************************
//*
//*  fileWrite write $myStr to $fileName
//*
//***************************************
function fileWrite( $fileName, $myMode, $myStr )
{
  $isOpen = fopen( $fileName, $myMode ) ;
  if( $isOpen )
  {
	fwrite( $isOpen, $myStr ) ;
	fclose( $isOpen ) ;
	$bItWorked = TRUE ;
  }
  else
  {
	$bItWorked = FALSE ;
  }
  return $bItWorked ;
} //end of fileWrite

//***************************************
//*
//*  fileRead will print contents of $fileName
//*
//***************************************
function fileRead( $fileName )
{
  $myArray = file( $fileName ) ;
  if( $myArray != FALSE )
  {
	for( $x=0; $x<count($myArray); $x++ )
	{
	  print $myArray[$x] . "<br>" ;
	}
  }
  else
  {
	print "No info in file" ;
  }
} //end of fileRead

?>
