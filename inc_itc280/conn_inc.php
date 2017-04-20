<?php
/**
 * conn_inc.php creates connection to database
 *
 * MySQL credentials are stored inside a function named conn()
 *  which allows up to 5 levels of access.
 *
 * The function conn() returns an active connection to the DB.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 */

/**
 * Provides active connection to MySQL DB.
 *
 * One of 5 MySQL credentials are passed to the function
 * as one of the following strings:
 *
 * 1 admin
 * 2 delete
 * 3 insert
 * 4 update
 * 5 select
 *
 * Each level of access should include the capabilities of those below it.
 * MySQL accounts must be setup for each level, with 'select' account only able
 * to access db via 'select' command, and update able to 'select' and 'update' etc.
 * Each credential set must exist in MySQL before it can be used.
 *
 * The function returns an active connection to the DB.
 * If no data is entered into conn() function when it is called, the default access is 'admin':
 * <code>
 *  $myConn = conn();
 * </code>
 *
 * If only one credential is available, place it in the 'admin' position, and no parameter is required.
 * If you create multiple MySQL users and have a 'select only' user, you can create a 'select only' connection:
 * <code>
 *  $myConn = conn("select");
 * </code>
 *
 * you can also create an 'improved' (mysqli) connection by declaring TRUE as a second optional argument:
 * <code>
 *  $iConn = conn("select",TRUE);
 * </code>
 *
 * @param string $access represents level of access
 * @param boolean $improved If TRUE, uses mysqli improved connection
 * @return object Returns active connection to MySQL db.
 */
function conn( $access = 'admin', $improved = FALSE )
{
  // @var string MySQL database server name - use 'localhost' on Zephir or your local machine
  $myHostName = 'mysql10.000webhost.com' ;

  // Identify database name - eliminates multiple attempts to create constant
  if ( !defined( 'MYDATABASE' ) ) { define( 'MYDATABASE', 'a5001834_9t' ) ; }

  // Determine current access level requested - if empty, defaults to 'admin'
  switch( strtolower( $access ) )
  {
    case 'admin':
      $myUserName = 'a5001834_9tadmin' ; # your MySQL username
      $myPassword = 'AMae*9t' ; # your MySQL password
      break ;
    case 'delete':
      $myUserName = 'horsey01' ;
      $myPassword = 'xxxxxx';
      break ;
    case 'insert':
      $myUserName = 'horsey01' ;
      $myPassword = 'xxxxxx' ;
      break ;
    case 'update':
      $myUserName = 'horsey01' ;
      $myPassword = 'xxxxxx' ;
      break ;
    case 'select':
      $myUserName = 'horsey01' ;
      $myPassword = 'xxxxxx' ;
      break ;
  }

  if ( $improved )
  { // create mysqli improved connection
    $myConn = mysqli_connect( $myHostName, $myUserName, $myPassword, MYDATABASE)
            or die( trigger_error( mysqli_connect_error(), E_USER_ERROR ) ) ;
  }
  else
  { // create standard connection
    /**
     * Optionally provide database for all SQL calls.
     * If left blank (quotes only, string of zero length), assumes you will fully qualify all databases used in SQL:
     * <code>
     *  select * from myDB.myTable ;
     * </code>
     */
    $myConn = @mysql_connect( $myHostName, $myUserName, $myPassword )
            or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
    if ( MYDATABASE != '' )
    { // selectDB, if identified in $myDatabase above:
      mysql_select_db( MYDATABASE, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
    }
  }

  return $myConn ;
}
?>
