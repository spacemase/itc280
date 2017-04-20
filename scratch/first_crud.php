<?php
/**
 * first_crud.php is a single page web application that allows us to view and edit
 * a customer's first name.
 *
 * This page is a model on which to demonstrate fundamentals of single page, postback
 * web applications.
 *
 * @package ITC280
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 1.0 2009/06/01
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @todo JS for FirstName field busted - needs fixing
 */

/**
 * If FALSE, will show errors on page, instead of making errors private.
 * This constant can be over-ridden by HIDE_ALL_ERRORS in config_inc.php
 */
define( 'HIDE_PAGE_ERRORS', FALSE ) ; # FALSE = CURRENTLY ENABLING VISIBILITY OF PAGE ERRORS

/**
 * @var string Allows unique page title for each page. If left empty, will default
 * to $PageTitle inside header_inc.php
 */
$PageTitle = 'First CRUD' ;
//END CONFIG AREA ----------------------------------------------------------

/**
 * Provides 'myerror()' for error handling, and conn() for db connection.
 */
require_once '/home/classes/mjense11/inc_itc280/config_inc.php' ;

# Read the value of 'action' whether it is passed via $_POST or $_GET with $_REQUEST
if( isset( $_REQUEST['act'] ) )
{
  $myAction = ( trim( $_REQUEST['act'] ) ) ;
}
else
{
  $myAction = "" ;
}

include_once INCLUDE_PATH . 'header_inc.php' ;

switch ( $myAction )
{ //check for type of process
  case "edit": //2) show password change form
    editDisplay() ;
    break ;
  case "update": //3) Change customer's first name
    updateExecute() ;
    break ;
  default: //1)Select Customer from list
    selectFirst() ;
}
foreach ( $_GET as $varName ) { unset( $varName ) ; } //unset post & get vars.  Still need it??
foreach ( $_POST as $varName ) { unset( $varName ) ; }

include_once INCLUDE_PATH . 'footer_inc.php' ;

function selectFirst()
{ //Select Customer
  $feedback = "" ; //init var
  if ( isset( $_GET['msg'] ) )
  { //feedback is provided - perhaps data was entered improperly
    switch ( $_GET['msg'] )
    {
      case 1:
        $feedback = "A required form element was not provided" ;
        break ;
      case 2:
        $feedback = "Data submitted in the wrong format" ;
        break ;
      case 3:
        $feedback = "First Name Successfully Changed!" ;
        break ;
      case 4:
        $feedback = "First Name NOT CHANGED!!" ;
        break ;
      default:
        $feedback = "" ;
    } //end switch
  } //end if

  if ( $feedback != "" ) #Fill out feedback HTML
  { $feedback = '<div align="center"><h3><font color="red">' . $feedback . '</font></h3></div>' ; }
  echo '<script type="text/javascript" src="include/util.js"></script>
        <script type="text/javascript">
          function checkForm( thisForm )
          { //check form data for valid info
            if ( !checkRadio( thisForm.CustomerID, "Please Select a Customer." ) )
            { return false ; }
            return true ; //if all is passed, submit!
          }
        </script>
        <h3 align="center">first_crud.php</h3>' ;
  echo $feedback ; #feedback, if any, provided here
  $myConn = conn() ;
  $selSQL = "select CustomerID,FirstName,LastName,Email from tblCustomers" ;
  $result = @mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
  if ( mysql_num_rows( $result ) > 0 ) //at least one record!
  { //show results
    echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post" onsubmit="return checkForm(this);">' ;
    echo '<table align="center" border="1" style="border-collapse:collapse" cellpadding="3" cellspacing="3">' ;
    echo '<tr><th>CustomerID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>' ;
    while ( $row = mysql_fetch_assoc( $result ) )
    { //dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
      echo '<tr><td>' ;
      echo '<input type="radio" name="CustomerID" value="' . dbOut( $row['CustomerID'] ) . '">' ;
      echo dbOut( $row['CustomerID'] ) . '</td>' ;
      echo '<td>' . dbOut( $row['FirstName'] ) . ' ' . dbOut( $row['LastName'] ) . '</td>' ;
      echo '<td>' . dbOut( $row['LastName'] ) . '</td>' ;
      echo '<td>' . dbOut( $row['Email'] ) . '</td></tr>' ;
    }
    echo '<input type="hidden" name="act" value="edit" />' ;
    echo '<tr><td align="center" colspan="4"><input type="submit" value="Choose Customer!"></em></td></tr>' ;
    echo '</table></form>' ;
  }
  else
  { //no records, put links on page to reset form, exit
    echo '<div align="center"><h3>Currently No Customers in Database.</h3></div>' ;
  }
  @mysql_free_result( $result ) ; //free resources
  @mysql_close() ; //close connection to db
}

function editDisplay()
{ # shows details from a single customer, and preloads their first name in a form.
  if ( !is_numeric( $_POST['CustomerID'] ) )
  { myRedirect( basename( $_SERVER['PHP_SELF'] ) . "?msg=2" ) ; } #redirect for feedback on invalid data
  $myID = (int)$_POST['CustomerID'] ; //forcibly convert to integer
  $myConn = conn() ;
  $selSQL = sprintf( "select CustomerID,FirstName,LastName,Email from tblCustomers WHERE CustomerID=%d", $myID ) ;
  $result = @mysql_query( $selSQL, $myConn ) or die ( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
  if ( mysql_num_rows( $result ) > 0 ) //at least one record!
  { //show results
    while ( $row = mysql_fetch_array( $result ) )
    { //dbOut() function is a 'wrapper' designed to strip slashes, etc. of data leaving db
      $Name = dbOut( $row['FirstName'] ) . ' ' . dbOut( $row['LastName'] ) ;
      $First = dbOut( $row['FirstName'] ) ;
      $Email = dbOut( $row['Email'] ) ;
    }
  }
  else
  { //no records, put links on page to reset form, exit
    echo '<div align="center"><h3>No such Customer</h3></div>' ;
    echo '<div align="center"><a href="' . $_SERVER['PHP_SELF'] . '">Try Again?</a></div>' ;
  }
?>
  <script type="text/javascript" src="include/util.js"></script>
  <script type="text/javascript">
    function checkForm(thisForm)
    { //check form data for valid info
      if ( !checkText( thisForm.FirstName, "Please Enter Customer's First Name" ) )
      { return false ; }
      return false ;
    }
    return true ; //if all is passed, submit!
    }
  </script>
  <h3 align="center">Update Customer's Name</h3>
  <p align="center">Customer: <font color="red"><b><?php echo $Name;?></b> Email: <font color="red"><b><?php echo $Email;?></b></font>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return checkForm(this);">
  <table align="center">
    <tr><td align="right">First Name</td><td><input type="text" name="FirstName" value="<?php echo $First;?>"><font color="red"><b>*</b></font> <em>(alphabetic only)</em></td></tr>
      <input type="hidden" name="CustomerID" value="<?php echo $myID;?>" />
      <input type="hidden" name="act" value="update" />
    <tr><td align="center" colspan="2"><input type="submit" value="Update First Name!"><em>(<font color="red"><b>*</b> required field</font>)</em></td></tr>
  </table>
  </form>
<?
  print '<div align="center"><a href="' . $_SERVER['PHP_SELF'] . '">Exit Without Update</a></div>' ;
  @mysql_free_result( $result ) ; //free resources
  @mysql_close( $myConn ) ; //close connection to db
}

function updateExecute()
{
  if ( !is_numeric( $_POST['CustomerID'] ) )
  { myRedirect( basename( $_SERVER['PHP_SELF'] ) . "?msg=2" ) ; } #Invalid data posted
  if ( !onlyAlpha( $_POST['FirstName'] ) )
  { myRedirect( basename( $_SERVER['PHP_SELF'] ) . "?msg=2" ) ; }

  $myConn = conn() ;
  $redirect = basename( $_SERVER['PHP_SELF'] ) . "?msg=1" ; //global var used for following formReq redirection on failure

  $CustomerID = form_Req( $_POST['CustomerID'], $redirect ) ; //calls dbIn internally, to check form data
  $FirstName = form_Req( $_POST['FirstName'], $redirect ) ;

  # sprintf() allows us to filter (parameterize) form data
  $updateSQL = sprintf( "UPDATE tblCustomers set FirstName='%s' WHERE CustomerID=%d", $FirstName, $CustomerID ) ;

  @mysql_query( $updateSQL, $myConn ) or die ( trigger_error( mysql_error(), E_USER_ERROR ) ) ;

  #feedback success or failure of update
  if ( mysql_affected_rows( $myConn ) > 0 )
  { //success!  provide feedback, chance to change another!
    myRedirect( basename( $_SERVER['PHP_SELF'] ) . "?msg=3" ) ;
  }
  else
  { //Problem!  Provide feedback!
    myRedirect( basename( $_SERVER['PHP_SELF'] ) . "?msg=4" ) ;
  }
}
/**
 * Checks data for alphanumeric characters using PHP regular expression.
 *
 * Returns true if matches pattern.  Returns false if it doesn't.
 * It's advised not to trust any user data that fails this test.
 *
 * @param string $str data as entered by user
 * @return boolean returns true if matches pattern.
 * @todo REMOVE FROM THIS FILE, AND ADD TO common_inc.php!!
function onlyAlpha($myString)
{
  $myReturn = eregi( "[^a-zA-Z]", $myString ) ;
  if ( $myReturn )
  { return false ; }
  else
  { return true ; }
}
 */

/**
 * Requires data submitted as isset() and passes dat to
 * dbIn() which processes per MySQL standards, adding slashes and
 * attempting to prevent SQL injection.
 * Upon failure, user is forcibly redirected to global variable,
 * $redirect, which is applied just before checking a series of form values.
 *
 * $redirect stores page to redirect user to upon failure
 * This variable is declared in the page, just before the form fields are tested.
 *
 * @global string $redirect
 *
 *<code>
 * $redirect = "feedback.php?msg=3"; //global redirect
 * $myVar = formReq($_POST['myVar']);
 * $otherVar = formReq($_POST['otherVar']);
 *</code>
 *
 * @uses dbIn()
 * @param string $var data as entered by user
 * @return string returns data filtered by MySQL, adding slashes, etc.
 * @todo none
function form_Req($var,$redirect)
{
  if(empty($var))
  { myRedirect( $redirect ) ; }
  else
  { return dbIn( $var ) ; }
}
 */

/**
 * Filters data per MySQL standards before entering database.
 *
 * Adds slashes and helps prevent SQL injection per MySQL standards.
 * Function enclosed in 'wrapper' function to add further functionality when
 * as vulnerabilities emerge.
 *
 * @param string $var data as entered by user
 * @return string returns data filtered by MySQL, adding slashes, etc.
 * @see dbOut()
 * @see idbIn()
 * @todo none
 */
function db_In($var)
{
  global $myConn;//checks data against active DB connection

  if ( isset( $var ) && $var != "" )
  { return mysql_real_escape_string( $var ) ; }
  else
  { return "" ; }
} #End db_In()

?>
