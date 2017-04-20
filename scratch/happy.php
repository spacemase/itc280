<?php

define ( "MY_PAY", 60000 ) ;
$bobs_pay = 50000 ;
$steves_pay = 40000 ;
$eds_pay = 35000 ;
$marks_pay = 25000 ;

$myOutput = "MY_PAY:  " . areYouHappy( MY_PAY ) ;
echo areYouHappy( $bobs_pay ) ;
areYouHappy( $steves_pay ) ;
areYouHappy( $eds_pay ) ;
areYouHappy( $marks_pay ) ;
areYouHappy( 33000 ) ;

echo $myOutput ;

/*
switch ( MY_PAY )
{
	case 40000:
	echo "you make \$40,000<br />" ;
	break ;
	
	case 30000:
	echo "you make \$30,000<br />" ;
	break ;
	
	default:
	echo "I don't know what you make.<br />" ;
}
*/

function areYouHappy ( $my_pay )
{
	if ( $my_pay > 40000 )
	{
		return "I'm happy!<br />" ;
	}
	elseif ( $my_pay > 30000 )
	{
		return "Relatively happy.<br />" ;
	}
	else
	{
		return "Not so happy....<br />" ;
	}
}//end areYouHappy

?>