<?
//arrayTest.php Will post back info to same page
if (isset($_POST['nameStr'])) //isset determines if var has valid contents
{//if var is set, show what it contains
      $arrName = $_POST['nameStr']; //copy to new variable for security
      $aName = explode(",",$arrName);  //split str into an array
      $arrColor = $_POST['colorStr'];
      $aColor = explode(",",$arrColor);
      $arrCloth = $_POST['clothStr'];
      $aCloth = explode(",",$arrCloth);
      $arrPlace = $_POST['placeStr'];
      $aPlace = explode(",",$arrPlace);
      $arrEmo = $_POST['emoStr'];
      $aEmo = explode(",",$arrEmo);

      for($x = 0;$x < count($aName); $x++)
      {
         print "<div align=\"center\"><h1><font color=\"". $aColor[$x] ."\">". $aName[$x];
         print "'s " . $aColor[$x]." ". $aCloth[$x];
         print " at the ". $aPlace[$x] ." made me ". $aEmo[$x] ."!</font></h1></div>";
      }
      unset($_POST['nameStr']);//unset vars to keep from coming back
      unset($_POST['colorStr']);
      unset($_POST['clothStr']);
      unset($_POST['placeStr']);
      unset($_POST['emoStr']);
        //put link on page to reset form
      print "<br><a href=" . $_SERVER['PHP_SELF'] . ">Reset page</a>";
}else{ //show form
?>
       <html>
       <body>
       <!--Note the server variable indicating the page we are on -->
       <div align="center"><h1>Array Test</h1></div>
       <p>Enter comma separated (delineated?) (concatenated?) strings of stuff, OR ELSE!<p>
       <form action="<? print $_SERVER['PHP_SELF']; ?>" method="post">
       Enter Names:<input type="text" name="nameStr" maxlength="120" size="80"><br>
       Enter Colors:<input type="text" name="colorStr" maxlength="120" size="80"><br>
       Enter Clothing:<input type="text" name="clothStr" maxlength="120" size="80"><br>
       Enter Places(events):<input type="text" name="placeStr" maxlength="120" size="80"><br>
       Enter Emotions:<input type="text" name="emoStr" maxlength="120" size="80"><br>
       <input type="submit" value="Show me the Arrays!">
       </form>
       </body>
       </html>
<?
}
?>
