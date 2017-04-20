<?php
/**
 * pager_inc.php stores Pager class for paging records
 *
 * The Pager class creates simple records paging by deconstructing the existing
 * SQL statement and adding MySQL limits to the statement.
 *
 * Once the Pager object is loaded with the SQL statement, a method named 'showTotal()'
 * returns the possible number of records, and another named 'showNav()' places the
 * Paging Nav (next & previous arrows, etc.) on the page.
 *
 * @package itc280
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 2.1 2009/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 */

class Pager
{
  /**
   * encapsulates an easy to use, query string based records paging system
   *
   * Once the Pager object is loaded with the SQL statement, a method named 'showTotal()'
   * returns the possible number of records, and another named 'showNav()' places the
   * Paging Nav (next & previous arrows, etc.) on the page.
   *
   * A pager can be instantiated minimally by declaring the number of records per page:
   *
   * <code>
   *  $myPager = new Pager(10);
   * </code>
   *
   * However for the pager to operate properly, the SQL statement to be used on the page must be
   * passed through the pager to determine the number of pages required:
   * <code>
   *  $sql = $myPager->loadSQL($sql); #adapt existing SQL statement
   * </code>
   */

  /**
   * The following variables are the default button implementations.
   * These can be overridden during instantiation of the object.
   *
   * @var string $first default character or image
   * @var string $prev default character or image
   * @var string $next default character or image
   * @var string $last default character or image
   //uncomment, to declare image default arrow implementations here:
  private $first = '&lt;&lt;' ; # internal variables are declared as private. Not available outside class
  private $prev = '&lt;' ;
  private $next = '&gt;' ;
  private $last = '&gt;&gt;' ;
  */
  private $first = '<img src="../images/arrow_first.gif" border="0" />' ;
  private $prev = '<img src="../images/arrow_prev.gif" border="0" />' ;
  private $next = '<img src="../images/arrow_next.gif" border="0" />' ;
  private $last = '<img src="../images/arrow_last.gif" border="0" />' ;

  /**
   * Constructor function identifies parameters of the pager object upon creation
   *
   * Constructor allows a simple default configuration, which applies simple text 'arrows'
   * and 10 records per page.  Upon creation the developer can identify a different number of
   * records per page, and implement images for arrows or text in any combination
   *
   * The minimal example creates the pager object with 10 records and default 'first',
   * 'prev', 'next', and 'last' arrows:
   * <code>
   *  $myPager = new pager(10);
   * </code>
   *
   * This example instantiates the pager object with 20 records and images for previous & next
   * arrows, and no first & last arrows:
   * <code>
   *  $myPager = new pager(20,'','<img src="images/arrow_prev.gif" border="0" />','<img src="images/arrow_next.gif" border="0" />','');
   * </code>
   * Note the use of single quotes, '', to indicate no 'first' or 'last' icon above
   *
   * @param integer $rowsPerPage maximum number of records per page
   * @param string $first img HTML or chars like: << (&lt;&lt;)
   * @param string $prev img HTML or chars like: < (&lt;)
   * @param string $next img HTML or chars like: > (&gt;)
   * @param string $last img HTML or chars like: >> (&gt;&gt;)
   */
  function __construct( $rowsPerPage, $first='&lt;&lt;', $prev='&lt;', $next='&gt;', $last='&gt;&gt;' )
  { // constructor sets stage by adding variables to object
    $this->rowsPerPage = $rowsPerPage ;
    if ( isset( $first ) ) { $this->first = $first ; }
    if ( isset( $prev ) ) { $this->prev = $prev ; }
    if ( isset( $next ) ) { $this->next = $next ; }
    if ( isset( $last ) ) { $this->last = $last ; }
    // use get var, 'page' to track current page
    if ( isset( $_GET['pg'] ) && is_numeric( $_GET['pg'] ) )
    { $this->pageNum = $_GET['pg'] ; }
    else
    { $this->pageNum = 1 ; }
  }

  /**
   * For the pager to work, the class must adapt the SQL statement to be used.
   *
   * Since MySQL limits the number of records returned, this function will
   * disassemble the SQL statement and re-assemble it to retrieve the total
   * number of records per page.
   *
   * The adapted SQL statement is returned to be used by the page.
   * This step is required for the Pager to operate.
   *
   * <code>
   *  $myPager = new Pager(10); # create new pager object
   *  $sql = $myPager->loadSQL($sql); # adapt existing SQL statement
   * </code>
   *
   * IMPORTANT: The pager needs to adapt the SQL BEFORE the SQL statement is used by the page.
   *
   * For version 2, the number of records is stored on the querystring so the extra SQL call is
   * removed for any pages beyond the first page.
   *
   * This function calls an internal (private) function, processSQL() to the the actual
   * database retrieval.
   *
   * @param string $sql The SQL statement to provide the number of records involved
   * @return string The adapted SQL statement to be used by the page.
   * @uses processSQL
   */
  public function loadSQL( $sql )
  { // SQL statement must be loaded to extract the numrows
    $sql = str_replace( ";", "", $sql ) ; // remove semi-colons
    if ( isset( $_GET['rc'] ) )
    {
      $numRecords = ( trim( $_GET['rc'] ) ) ;
      if ( !is_numeric( $numRecords ) ) { return $this->processSQL( $sql ) ; } # no number, process SQL
      $numRecords = (int)$numRecords ;
      if ( $numRecords > 0 )
      { // use qstring
        $this->numrows = $numRecords ;
        $myOffset = ( $this->pageNum - 1 ) * $this->rowsPerPage ; # get page offset
        return $sql . " LIMIT  " . $myOffset . ", " . $this->rowsPerPage ; # add on limiting
      }
      else
      { // get SQL statement
        return $this->processSQL( $sql ) ;
      }
    }
    else
    {
      return $this->processSQL( $sql ) ;
    }
  }

  /**
   * This internal function is called by loadSQL to disassemble the existing SQL statement and
   * hit the DB to determine the total number of possible records, so the proper number of
   * pages is available.
   *
   * Once the data is retrieved it is stored in local variable, 'numrows'.
   *
   * The original SQL statement is rebuilt with the MySQL LIMIT added, so only a page of records
   * is returned by the page.
   *
   * Control is turned back to loadSQL(), which called this function in the first place.
   *
   * @param string $sql The SQL statement to provide the number of records involved
   * @return string The adapted SQL statement to be used by the page.
   * @see loadSQL()
   */
  private function processSQL( $sql )
  { // SQL statement must be loaded to extract the numrows
    global $myConn ;
    $testsql = strtolower( $sql ) ;  # make lowercase to test for ' from '. Use original SQL to keep case
    $findFrom = strrpos( $testsql, " from " ) ; # find ' from ' in select statement
    $myFrom = substr( $sql, $findFrom + 1 ) ; # eliminate select fields so we can re-create count sql
    $rowsql = "SELECT COUNT(*) AS numrows " . $myFrom ; # rows in db
    $result = mysql_query( $rowsql, $myConn ) or die( trigger_error( mysql_error(), E_USER_ERROR ) ) ;
    list( $this->numrows ) = mysql_fetch_row( $result ) or die( trigger_error(mysql_error(), E_USER_ERROR ) ) ;
    $myOffset = ( $this->pageNum - 1 ) * $this->rowsPerPage ; # get page offset
    return $sql . " LIMIT  " . $myOffset . ", " . $this->rowsPerPage ; # add on limiting
  }

  /**
   * Public function returns total number of records.
   *
   * Can be used on page to tell user how many results are available.
   *
   * @return integer The total number of possible records available to the original SQL statement
   */
  public function showTotal()
  { // return total number of records
    return $this->numrows ;
  }

  /**
   * calling this function shows the paging 'nav' element, if there are enough records
   *
   * Will return an empty string if not enough records to meet minimum number of records to
   * require paging.
   *
   * Minimal implementation:
   * <code>
   *  $myPager->showNav();
   * </code>
   *
   * This example shows how to place our own prefix & suffix to 'wrap' the HTML and
   * apply formatting to pager Nav:
   * <code>
   *  $myPager->showNav('<span class="myClass">','</span>');
   * </code>
   *
   * @param string $prefix optional string to show up before nav, if applicable
   * @param string $suffix optional string to show up after nav, if applicable
   * @return string the adjusted SQL statement
   */
  public function showNav( $prefix='<div align="center">', $suffix='</div>' )
  { // creates the NAV icons for paging
    if ( $this->numrows > $this->rowsPerPage )
    { // show paging element, since more records than one page
      $qstr = "" ; # rebuild querystring for sorting passed on qstring, etc.
      foreach ( $_GET as $varName => $value )
      {
        switch ( $varName )
        {
          case 'pg': # don't re-add page/number of records
          case 'rc':
            break ;
          default: # rebuild rest of qstring
            $qstr .= "&" . $varName . "=" . $value ;
        }
      }
      $maxPage = ceil( $this->numrows / $this->rowsPerPage ) ; # total pages
      $self = $_SERVER['PHP_SELF'] ;
      if ( $this->pageNum > 1 )
      {
        $page = $this->pageNum - 1 ;
        $this->prev = ' <a href="' . $self . '?pg=' . $page . '&rc=' . $this->numrows  . $qstr .  '">' . $this->prev . '</a> ' ;
        if ( $this->first != '' )
        { $this->first = ' <a href="' . $self . '?pg=1' . '&rc=' . $this->numrows . $qstr . '">' . $this->first . '</a> ' ; }
      }
      else
      {
        $this->prev = '' ; # we're on page one, don't enable 'previous' link
        $this->first = '' ; # nor 'first page' link
      }
      if ( $this->pageNum < $maxPage )
      { // print 'next' link only if we're not on the last page
        $page = $this->pageNum + 1 ;
        $this->next = ' <a href="' . $self . '?pg=' . $page . '&rc=' . $this->numrows  . $qstr . '">' . $this->next . '</a> ' ;
        if ( $this->last != '' )
        { $this->last = ' <a href="'. $self . '?pg=' . $maxPage . '&rc=' . $this->numrows . $qstr . '">' . $this->last . '</a> ' ; }
      }
      else
      {
        $this->next = '' ; # we're on the last page, don't enable 'next' link
        $this->last = '' ; # nor 'last page' link
      }
      // print the page navigation link
      $myReturn = $prefix ;
      $myReturn .= $this->first . $this->prev . ' Page <strong>' . $this->pageNum . '</strong> of <strong>' . $maxPage . '</strong> ' . $this->next . $this->last ;
      $myReturn .= $suffix ;
      return $myReturn ;
    }
    else
    {
      return "" ; # return empty string
    }
  }

} # end class Pager
?>
