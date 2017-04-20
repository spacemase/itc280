<?
//arraySort.php
//Will post back info to same page, and display array "sorts"
if (isset($_POST['sortStr'])) ////if var is set, show what it contains
{
      $arrSort = $_POST['sortStr']; //copy to new variable
      $aSort = explode(",",$arrSort);  //split str into an array

      print "<div align=center><h1>We have " . count($aSort) . " elements in our array.</h1></div>";
      $clr = "red";
      print "<div align=center><h1>Unsorted Array: ";
      for($x = 0;$x < count($aSort); $x++)
      {
         print "<font color=". $clr.">". $aSort[$x] ." </font>";
         if($clr=="red"){$clr = "blue";}else{$clr = "red";} //color rotation
      }
      print "</h1></div>";

        function printArray($aArray,$clr1,$clr2,$msg,$funk)
      {//pass in array, 2 colors, a message to define the array, and which sort function to perform
          $evalStr = $funk . "(" . "\$aArray" . ");";  //create string to be evaluated
          eval($evalStr);   //process evaluation string
          $clr = $clr1;   //start with a color
          print "<div align=center><h1>". $msg . ": ";
          for($x = 0;$x < count($aArray); $x++)
          {
            print "<font color=". $clr.">". $aArray[$x] ." </font>";
            //rotate colors
            if($clr==$clr1){$clr = $clr2;}else{$clr = $clr1;}
          }
          print "</h1></div>";
      }
      function myUpper(&$str)  //pass by ref (&) to change array elements
      {
      $str = strtoupper($str);
      return $str;
      }
      //call functions to display all sorts!
     printArray($aSort,"green","orange","Sorted Array","sort");
     printArray($aSort,"purple","yellow","Reversed Array","rsort");
     printArray($aSort,"magenta","pink","Shuffled Array","shuffle");
     //change all to upper case
     array_walk($aSort,"myUpper"); //note str upper function is a string, no parens
     printArray($aSort,"red","green","Shuffled, Caps Array","shuffle");
     unset($_POST['sortStr']);//unset var to keep from coming back
     //put link on page to reset form
     print "<br><a href=" . $_SERVER['PHP_SELF'] . ">Reset page</a>";

}else{ //show form
?>
       <html>
       <body>
       <!--Note the server variable indicating the page we are on -->
       <div align="center"><h1>Array Sort</h1></div>
       <p>Enter comma separated (delineated?) (concatenated?) strings of stuff, OR ELSE!<p>
       <form action="<? print $_SERVER['PHP_SELF']; ?>" method="post">
       Enter Names:<input type="text" name="sortStr" maxlength="120" size="80" value="Bill,Ted,Jenny,Eustace,MiMi,Peabody"><br>
       <input type="submit" value="Show me the Arrays!">
       </form>
       </body>
       </html>
<?
}
?>
