<?php
//array_practice.php
$arrFruit = array("cherry","orange","pineapple") ;
var_dump( $arrFruit ) ;
echo "<br />" ;
for( $i=0; $i < count($arrFruit); $i++ )
{
	echo $arrFruit[$i] . "<br />" ;
}

echo "<br /><br />" ;
$arrCheese = array() ;
$arrCheese[0] = "cheddar" ;
$arrCheese[1] = "swiss" ;
$arrCheese[2] = "gouda" ;
var_dump( $arrCheese ) ;
echo "<br />" ;
foreach( $arrCheese as $cheese )
{
	echo $cheese . "<br />" ;
}

echo "<br /><br />" ;
$arrPicnic = array( "sandwich"=>"club", 
					"salad"=>"fruit", 
					"dessert"=>"brownie"
					) ;
var_dump( $arrPicnic ) ;
echo "<br />" ;
foreach( $arrPicnic as $myKey => $myValue )
{
	echo $myKey . ":  " . $myValue . "<br />" ;
}

echo "<br /><br />" ;

print_r("<pre>" . $arrPicnic["dessert"] . "</pre>") ;

echo "<br /><br />" ;
var_dump($arrPicnic) ;
die() ;
?>