<?php
/**
 * book_view.php along with book_categories.php and book_list.php provides a sample web application
 *
 *
 * book_categories.php feeds a CategoryID via the querystring to book_list.php.
 * 
 * The text of the Category itself is also passed (encoded) on the querystring, 
 * saving a database query.
 *
 * 
 * @package nmCategories
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.0 2009/05/18
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see book_categories.php
 * @see book_list.php 
 * @todo none
 */
 
/**
 * If FALSE, will show errors on page, instead of making errors private.    
 * This constant can be over-ridden by HIDE_ALL_ERRORS in config_inc.php
 */
define('HIDE_PAGE_ERRORS', FALSE); # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS

/**
 * @var string Allows unique page title for each page. If left empty, will default 
 * to $PageTitle inside header_inc.php
 */
$PageTitle = 'So many books, so little time!';


if(isset($_GET['cid'])){$CategoryID = $_GET['cid'];}else{$CategoryID =0;}
if(isset($_GET['cat'])){$Category = urldecode($_GET['cat']);}else{$Category="";}

//check variable of item passed in on querystring
if(isset($_GET['id'])){
	$myID = intval($_GET['id']); #Convert to integer, will equate to zero if fails
	if($myID < 1){myRedirect('book_list.php?cid=' . $CategoryID . '&cat=' . urlencode($Category));}
}else{
	myRedirect('book_list.php?cid=' . $CategoryID . '&cat=' . urlencode($Category)); # Nothing on querystring, redirect
}

$selSQL = "select BookTitle, Description, Price from Books where BookID = " . $myID;
//print $selSQL;
//die();

//END CONFIG AREA ---------------------------------------------------------- 

/**
 * Provides 'myerror()' for error handling, and conn() for db connection. 
 */
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';

require_once INCLUDE_PATH . 'header_inc.php';
?>
<h3 align="center">book_view.php</h3>

<p align="center">This page, along with book_categories.php and book_list.php demonstrates a Category/List/View web application with record paging.</p>
<?php

# create connection to MySQL
$myConn = conn();
   
# $result stores data object in memory
$result = mysql_query($selSQL,$myConn) or die(trigger_error(mysql_error(), E_USER_ERROR));

if (mysql_num_rows($result) > 0)//at least one record!
{//show results
	while ($row = mysql_fetch_array($result))
	{
	     $BookTitle = dbOut($row['BookTitle']);
	     $Description = dbOut($row['Description']);
	     $Price = dbOut($row['Price']);
	}
?>    
	<table align="center">
		<tr>
			<td><img src="upload/B<?php echo $myID; ?>.jpg" /></td>
			<td><h2><b>Book: <font color="blue"><?php echo $BookTitle; ?></font><b></h2></td>
		</tr>
		<tr>
			<td colspan="2">
				<blockquote><?php echo $Description; ?></blockquote>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<h3><i>ONLY!!:</i> <font color="red">$<?php echo money_format('%(#10n',$Price)?></font></h3>
			</td>
		</tr>
	</table>
<?    
}else{//no records
	echo '<div align="center">There is no such book!</div>';
}
?>
<div align="center"><a href="book_list.php?cid=<?php echo $CategoryID;?>&cat=<?php echo urlencode($Category);?>">More <?php echo $Category;?> Books!</a></div>
<div align="center"><a href="book_categories.php">Back To Categories</a></div>
<?
@mysql_free_result($result); # clears resources
@mysql_close($myConn); # close db connection

require_once INCLUDE_PATH . 'footer_inc.php';
?>
