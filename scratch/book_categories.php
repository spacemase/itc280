<?php
/**
 * book_categories.php along with book_list.php and book_view.php provides a sample web application
 *
 * This page is a second version of muffin_list.php which addes the 'Pager' class.
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
 * @see book_view.php
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
$PageTitle = 'So many categories of books, so little time!';

# SQL statement
$selSQL = "select CategoryID, Category, Description from Categories order by Category asc";

//END CONFIG AREA ---------------------------------------------------------- 

/**
 * Provides 'myerror()' for error handling, and conn() for db connection. 
 */
require_once '/home/classes/mjense11/inc_itc280/config_inc.php';

require_once INCLUDE_PATH . 'header_inc.php';
?>
<h3 align="center">book_categories.php (with Paging)</h3>

<p align="center">This page, along with book_list.php and book_view.php demonstrates a Category/List/View web application with record paging.</p>
<?php

# create connection to MySQL
$myConn = conn();

# Create instance of new 'pager' class
$myPager = new Pager(2,'','<img src="../images/arrow_prev.gif" border="0" />','<img src="../images/arrow_next.gif" border="0" />','');
$selSQL = $myPager->loadSQL($selSQL);  //load SQL, add offset
   
# $result stores data object in memory
$result = mysql_query($selSQL,$myConn) or die(trigger_error(mysql_error(), E_USER_ERROR));

if (mysql_num_rows($result) > 0)//at least one record!
{//show results
   echo '<div align="center">We have a total of ' . $myPager->showTotal() . ' categories!</div>';
   while ($row = mysql_fetch_array($result))
   {//dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
         echo '<div align="center">';
         echo '<a href="book_list.php?cid=' . dbOut($row['CategoryID']) . '&cat=' . urlencode(dbOut($row['Category'])) . '">';
         echo dbOut($row['Category']) . '</a>';
         echo '<em> ' . dbOut($row['Description']) . '</em>';
         echo '</div>';
    }
	echo $myPager->showNav(); //will show paging nav, only if enough records	
}else{//no records
    echo "<div align=center>What! No categories?  There must be a mistake!!</div>";
}
@mysql_free_result($result); # clears resources
@mysql_close($myConn); # close db connection

require_once INCLUDE_PATH . 'footer_inc.php';
?>
