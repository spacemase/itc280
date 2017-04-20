<?php
/*
 * rte_inc.php provides the wiring of the fckeditor Rich Text Editor (RTE)
 *
 * rteINC() function allows multiple RTE edit points on a page.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see rte_exit_inc.php
 * @see rteINC()
 */

/**
 * Provides session protected wiring of fckeditor Rich Text Editor.
 * If not logged in, shows data on page only.  If logged in, shows 'edit'
 * button for each RTE, and allows RTE editing of data.
 *
 * <code>
 *  rteINC(1); //mimimum, id of RTE only
 *  rteINC(2,'50%','300','Default'); //all but border identified
 *  rteINC(3,'300','400','Basic',TRUE);  //full implementation
 * </code>
 *
 * @param int $RTEID id number of RTE field to store data
 * @param str $Width width in percent or pixels of RTE edit box
 * @param str $Height height in pixels of RTE edit box
 * @param str $ToolBar configured in fckconfig.js, our implementations include "Default" & "Basic"
 * @param boolean $showBorder true will place a border around the entire RTE area and edit button
 * @return void
 */
function rteINC( $RTEID, $Width='100%', $Height='400', $ToolBar='Basic', $showBorder=FALSE )
{
  /**
   * Provide path from web root to fckeditor directory
   *
   * Note the path is VIRTUAL, meaning it's to be viewed by JavaScript, externally from the
   * web page.  In Zephir, we actually use the tilde, since it's seen by the browser.  We need to
   * identify the full path to the fckeditor directory, as if we were viewing the file via the
   * browser.
   *
   * We've indicated the virtual path
   */
  //Zephir example of the path to fckEditor
  //$FCKPath = '/itc280/fckeditor/';
  $FCKPath = VIRTUAL_PATH . 'fckeditor/' ;

  global $myConn ; # re-use db connection
  if ( !isset( $myConn ) ) { $myConn = conn() ; }

  /**
   * fckeditor.php is the PHP implementation of RTE.
   * We reference but make no changes to that file.
   */
  include_once PHYSICAL_PATH . 'fckeditor/fckeditor.php' ; # Required. FCKEditor is not in include folder!

  if ( isset( $_REQUEST['tb'] ) ) { $ToolBar = $_REQUEST['tb'] ; } # toolbar setting comes from one of 2 places, POST or GET
  if ( isset( $_POST['edit'] ) ) { $edit = $_POST['edit'] ; }
  else { $edit = '' ; }

  $thisPage = basename( $_SERVER['PHP_SELF'] ) ; # current page, for postback effect
  startSession() ; # session_start() wrapper
  if ( isset( $_SESSION['AdminID'] ) && is_numeric( $_SESSION['AdminID'] ) )
  { // only admins can see edit fields
    print '<div align="center"><form name="exitForm" action="' . ADMIN_DASHBOARD . '" method="get">' ;
    print '<input type="submit" value="EXIT TO ADMIN" /></div></form>' ;

    if ( isset( $_POST['submitForm'] ) && $_POST['submitForm'] == 1 )
    { // If an administrator submits the form, update the page's RTEText.
      if ( $RTEID == $_POST['RTEID'] )
      { // only try to update if matches current RTEID
        $RTEText = mysql_real_escape_string( trim( $_POST['FCKeditor'] ) ) ;
        // Double check to see if this
        $selSQL = sprintf( "select Files from RTE WHERE RTEID = %d", $_POST['RTEID'] ) ;
        $result = @mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
        $myPages = '' ; # init
        if ( mysql_num_rows( $result ) > 0 )
        { // update!
          while ( $row = mysql_fetch_assoc( $result ) )
          { // pull data from db array
            $myPages = strip_tags( $row['Files'] ) ;
          }

          $addFile = TRUE ; # if matches, WILL NOT add current file!
          if ( $myPages != '' )
          { // If the field is not currently empty - check to see if it's already listed
            $aPages = explode( ',', $myPages ) ; # Split array of pages
            if ( is_array( $aPages ) )
            {
              for( $x=0; $x<count($aPages); $x++ )
              {
                if ( $aPages[$x] == $thisPage ) { $addFile = FALSE ; } # File already present, no need to add
              }
            }
            else
            { // not array, but matches!
              if ( $myPages == $thisPage ) { $addFile = FALSE ; }
            }
            if ( $addFile )
            { // Add current page to existing pages
              $myPages .= ',' . $thisPage ;
            }
          }
          else
          { // No RTE including files, update with current page
            $myPages = $thisPage ;
          }
          $sql = sprintf( "UPDATE RTE SET RTEText = '%s', Files = '%s' WHERE RTEID = %d", $RTEText, $myPages, $_POST['RTEID'] ) ;
        }
        else
        { // insert!
          print 'this page:' . $thisPage . '<br />' ;
          print 'this page (strip tags):' . strip_tags( $thisPage ) . '<br />' ;
          die() ;
          $sql = sprintf( "INSERT INTO RTE (RTEText,Files) VALUES('%s','%s')", $RTEText, strip_tags( $thisPage ) ) ;
        }
        $result = @mysql_query($sql, $myConn) or die(trigger_error(mysql_error(), E_USER_ERROR));
      }
    }
  }

  $selSQL = sprintf( "SELECT RTEText FROM RTE WHERE RTEID = %d", $RTEID ) ; # select data to show, or place in edit box
  $result = mysql_query( $selSQL, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
  $row = mysql_fetch_array( $result ) ;
  $RTEText = stripslashes( $row['RTEText'] ) ;

  if ( isset( $_SESSION['AdminID'] ) )
  {
    if ( isset( $_POST['RTEID'] ) && $RTEID == $_POST['RTEID'] )
    { // only load editor info for current story
      if ( $edit == 'yes' )
      { // clicked edit, open RTE for editing
        print '<div class="rte"><form action="' . $thisPage . '" method="post">' ;
        print '<input type="hidden" name="RTEID" value="' . $RTEID . '" />' ;
        print '<input type="hidden" name="submitForm" value="1" />' ;
        $oFCKeditor = new FCKeditor( 'FCKeditor' ) ;
        $oFCKeditor->BasePath = $FCKPath ;
        $oFCKeditor->Width = $Width ;
        $oFCKeditor->Height = $Height ;
        $oFCKeditor->ToolbarSet = $ToolBar ;
        $oFCKeditor -> Value = $RTEText ;
        print $oFCKeditor->CreateHtml() ;
        print '<input type="hidden" name="tb" value="' . $ToolBar . '" /><br />' ;
        print '<input type="submit" value="SAVE CHANGES to #'. $RTEID . '" /></form>' ;
        print '<form name="backForm" action="' . $thisPage . '" method="post" >' ;
        print '<input type="hidden" name="tb" value="' . $ToolBar . '" />' ;
        print '<input type="hidden" name="edit" value="no" />' ;
        print '<div align="center"><input type="button" value="EXIT WITHOUT CHANGES" onclick="document.backForm.submit();" /></div></form></div>' ;
      }
      else
      { // show with edit button
        if ( $showBorder )
        { print '<div style="border-width:thin; border-style:solid;">' ; }
        print $RTEText ;
        print '<div class="rte"><form name="editForm' . $RTEID . '" action="' . $thisPage . '" method="post" >' ;
        print '<input type="hidden" name="tb" value="' . $ToolBar . '" />' ;
        print '<input type="hidden" name="edit" value="yes" />' ;
        print '<input type="hidden" name="RTEID" value="' . $RTEID . '" />' ;
        print '<div align="center"><input type="button" value=" &nbsp; EDIT #' . $RTEID
            . ' &nbsp; " onclick="document.editForm' . $RTEID . '.submit();" /></div></form></div>' ;
        if ( $showBorder ) { print '</div>' ; }
      }
    }
    else
    {
      if ( $showBorder ) { print '<div style="border-width:thin; border-style:solid;">' ; }
      print $RTEText ;
      print '<div class="rte"><form name="editForm' . $RTEID . '" action="' . $thisPage . '" method="post" >' ;
      print '<input type="hidden" name="tb" value="' . $ToolBar . '" />' ;
      print '<input type="hidden" name="edit" value="yes" />' ;
      print '<input type="hidden" name="RTEID" value="' . $RTEID . '" />' ;
      print '<div align="center"><input type="button" value=" &nbsp; EDIT #' . $RTEID
          . ' &nbsp; " onclick="document.editForm' . $RTEID . '.submit();" /></div></form></div>' ;
      if ( $showBorder ) { print '</div>' ; }
    }
  }
  else
  { // not admin, show feedback
    print $RTEText ;
  }

  if ( isset( $_REQUEST['tb'] ) ) { unset( $_REQUEST['tb'] ) ; } # reset request var, prevents cascade to next RTE on page
}
?>
