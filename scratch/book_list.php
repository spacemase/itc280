<?php
/**
 * book_list.php along with book_categories.php and book_view.php provides a sample web application
 *
 *
 * book_categories.php feeds a CategoryID via the querystring to book_list.php.
 * 
 * The text of the Category itself is also passed (encoded) on the querystring, 
 * saving a database query.
 *
 * Paging has been implemented in this version, requiring a reference to pager_inc.php
 * 
 * @package nmCategories
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.0 2009/05/18
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see pager_inc.php 
 * @see book_categories.php
 * @see book_view.php 
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


//CategoryID passed in on querystring
if(isset($_GET['cid'])){
         $myID = intval($_GET['cid']); #Convert to integer, will equate to zero if fails
}else{
        $myID = 0; //zero means no category id
}

//Category comes in on encoded on querystring
if(isset($_GET['cat'])){$myCat = strip_tags(urldecode(trim($_GET['cat'])));}else{$myCat = "all";} 
$myWhere = ""; //init

switch ($myID)
{
 case 0:
    $myWhere = "";
    break;
 default:
    $myWhere = " and b.CategoryID = " . $myID;
}

//myCat will be title of page
$Title = strtoupper($myCat);

//add $myWhere to SQL statement
$selSQL = "select BookID, BookTitle, Price from Categories c inner join Books b on b.CategoryID=c.CategoryID" . $myWhere;
//print $selSQL;
//die();

# nav image buttons.  Overriding default buttons below
$first = '<img src="../images/nmfirst.gif" border="0" />';
$prev = '<img src="../images/nmprev.gif" border="0" />';
$next = '<img src="../images/nmnext.gif" border="0" />';
$last = '<img src="../images/nmlast.gif" border="0" />';

//END CONFIG AREA ---------------------------------------------------------- 

/**
 * Provides 'myerror()' for error handling, and conn() for db connection. 
 */
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';

require_once INCLUDE_PATH . 'header_inc.php';
?>
<h3 align="center"><?=$Title;?> Books (book_list.php)</h3>

<p align="center">This page, along with book_categories.php and book_view.php demonstrates a Category/List/View web application with record paging.</p>
<?php

# create connection to MySQL
$myConn = conn();

# Create instance of new 'pager' class
$myPager = new Pager(3,$first,$prev,$next,$last);
$selSQL = $myPager->loadSQL($selSQL);  #load SQL, add offset
   
# $result stores data object in memory
$result = mysql_query($selSQL,$myConn) or die(trigger_error(mysql_error(), E_USER_ERROR));

if (mysql_num_rows($result) > 0)//at least one record!
{//show results
   echo '<div align="center">We have a total of ' . $myPager->showTotal() . ' books!</div>';
   while ($row = mysql_fetch_array($result))
   {//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
         echo '<div align="center">';
         echo '<a href="book_view.php?id=' . dbOut($row['BookID']) . '&cid=' . $myID . '&cat=' . $_GET['cat'] . '">';
         echo dbOut($row['BookTitle']) . '</a>';
         echo ' <i>only</i> <font color="red">$' . money_format("%(#10n",dbOut($row['Price'])) . '</font>';
         echo '</div>';
    }
	echo $myPager->showNAV(); //show paging nav, only if enough records	
}else{//no records
    echo '<div align="center">What! No books?  There must be a mistake!!</div>';
}
echo '<div align="center"><a href="book_categories.php">Back To Categories</a></div>';
@mysql_free_result($result); # clears resources
@mysql_close($myConn); # close db connection

require_once INCLUDE_PATH . 'footer_inc.php';
?>
