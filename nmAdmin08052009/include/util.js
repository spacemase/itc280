/**
 * util.js stores utility JavaScript functions
 *
 * This file stores functions for validating data before entering DB.
 * On a public page, JS should NOT be the only means of validating data
 *
 * @package ITC281
 * @author Mason Jensen <mason.jensen@hotmail.com>
 * @version 1.0 2008/06/30
 * @link http://www.spacemase.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see adminAdd.php
 */

/**
 * Checks a textbox 'type' form element
 *
 * Requires some sort of data entry (any string data, any type) of
 * input type=text, password or textarea objects.
 *
 * <code>
 *  if(!checkText(thisForm.myName,"Please Enter Name.")){return false;}
 * </code>
 *
 * @param object $fObj input type="text", "password" or textarea object
 * @param string $msg feedback to user, based on data required of form element
 * @return true If true, continue to check other items.  If false, do not continue
 * @see checkRadio()
 * @see checkSelect()
 */
function checkText( fObj, msg )
{ // will take in a text and check for input
  if ( fObj.value == "" )
  {
    alert( msg ) ;
    fObj.focus() ;
    return false ;
  }
  else
  {
    return true ;
  }
}

/**
 * Checks a radio or checkbox 'type' form element
 *
 * Requires an item to be 'checked', for any
 * input type=radio or checkbox objects.
 *
 * <code>
 *  if(!checkRadio(thisForm.Gender,"Gender is required.")){return false;}
 * </code>
 *
 * @param object $fObj input type="radio" or "checkbox"
 * @param string $msg feedback to user, based on data required of form element
 * @return true If true, continue to check other items.  If false, do not continue
 * @see checkText()
 * @see checkSelect()
 */
function checkRadio( fObj, msg )
{ // will take in a radio button or checkbox and check for input
  isArray = false ;
  if ( fObj.length != undefined )
  { // if length is defined, more than one element. Treat as an array
    isArray = true ;
    for ( x=0; x<fObj.length; x++ )
    {
      if ( fObj[x].checked ) { return true ; }
    }
  }
  else
  { // if undefined, only one element
    if ( fObj.checked ) { return true ; }
  }

  alert( msg ) ;
  // focus only works cross browser on first element of array of named elements
  if ( isArray ) { fObj[0].focus() ; }
  return false ;
}

/**
 * Checks a select form element
 *
 * Requires selection of an option in a select element.
 * The first option of the select must not be a valid option.
 * View the code sample to see how the first option is not valid option.
 *
 * <code>
 *  <select name="State">
 *   <option value="">Please pick a state</option>
 *   <option value="CA">California</option>
 *   <option value="OR">Oregon</option>
 *   <option value="WA">Washington</option>
 *  </select>
 * </code>
 *
 * Below is an example of checking for a valid option in the above select:
 *
 * <code>
 *  if(!checkSelect(thisForm.State,"Please select a state!")){return false;}
 * </code>
 *
 * @param object $fObj input type="radio" or "checkbox"
 * @param string $msg feedback to user, based on data required of form element
 * @return true If true, continue to check other items.  If false, do not continue
 * @see checkText()
 * @see checkRadio()
 */
function checkSelect( fObj, msg )
{ // will take in a select object and check that zero item not selected
  if ( fObj.options[0].selected )
  {
    alert( msg ) ;
    fObj.options[0].focus() ;
    return false ;
  }
  else
  {
    return true ;
  }
}

/**
 * Uses a regular expression to require a valid email
 *
 * <code>
 * if(!isEmail(thisForm.Email,"Please enter a valid Email Address")){return false;}
 * </code>
 *
 * @param object $fObj input type="text" requiring an email
 * @return true If true, continue to check other items.  If false, do not continue
 * @see isAlpha()
 */
function isEmail( fObj, msg )
{ // uses regular expression for email check
  var rePattern = /^[a-zA-Z0-9\-]+\@[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,6})$/ ;
  if ( rePattern.test( fObj.value ) )
  {
    return true ;
  }
  else
  {
    alert( msg ) ;
    fObj.value = "" ;
    fObj.focus() ;
    return false ;
  }
}

/**
 * Uses a regular expression to require alphabetic data
 *
 * Requires alphabetic or numerical data for each character.  Will not
 * accept a space, or any other special character. Good for passwords.
 *
 * <code>
 *  if(!isAlpha(thisForm.Password,"Only alphabetic characters are allowed for passwords.")){return false;}
 * </code>
 *
 * @param object $fObj input type="text" requiring alphabetic data
 * @return true If true, continue to check other items.  If false, do not continue
 * @see isAlphanumeric()
 * @see correctLength()
 */
function isAlpha( fObj, msg )
{ // uses regular expression for email check
  var rePattern = /^[a-zA-Z]+$/ ;
  if ( rePattern.test( fObj.value ) )
  {
    return true ;
  }
  else
  {
    alert( msg ) ;
    fObj.value = "" ;
    fObj.focus() ;
    return false ;
  }
}

/**
 * Uses a regular expression to require alphanumeric data
 *
 * Requires alphabetic or numerical data for each character.  Will not
 * accept a space, or any other special character. Good for passwords.
 *
 * <code>
 *  if(!isAlphanumeric(thisForm.Password,"Only alphanumeric characters are allowed for passwords.")){return false;}
 * </code>
 *
 * @param object $fObj input type="text" requiring alphanumeric data
 * @return true If true, continue to check other items.  If false, do not continue
 * @see isAlpha()
 * @see correctLength()
 */
function isAlphanumeric( fObj, msg )
{ // uses regular expression for alphabetic check
  var rePattern = /^[a-zA-Z0-9]+$/ ;
  if ( rePattern.test( fObj.value ) )
  {
    return true ;
  }
  else
  {
    alert( msg ) ;
    fObj.value = "" ;
    fObj.focus() ;
    return false ;
  }
}

/**
 * Ensures minimum & maximum length for text
 *
 * Requires minimum and maximum data entry (any string data, any type) of
 * input type=text, password or textarea objects.
 *
 * <code>
 *  if(!correctLength(thisForm.Password,6,20,"Password does not meet the following requirements:")){return false;}
 * </code>
 *
 * @param object $fObj input type="text" requiring alphanumeric data
 * @return true If true, continue to check other items.  If false, do not continue
 * @see isAlpha()
 * @see isAlphanumeric()
 */
function correctLength( fObj, min, max, msg )
{ // uses regular expression for email check
  var rePattern = /^[a-zA-Z]+$/ ;
  if ( ( fObj.value.length >= min ) && ( fObj.value.length <= max ) )
  {
    return true ;
  }
  else
  {
    alert( msg + "\n Minimum characters: " + min + " Maximum characters: " + max ) ;
    fObj.value = "" ;
    fObj.focus() ;
    return false ;
  }
}
