<?php
/** phpMinAdmin - Compact MySQL management
* @link http://phpminadmin.sourceforge.net
* @author Jakub Vrana, http://php.vrana.cz
* @copyright 2007 Jakub Vrana
* @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
*/

/**
Bill's note, 12/12/2008:
Thank you, Jakub, for an awesome and easy to use tool!

This download was from version 1.9.1 of phpMinAdmin

phpMinAdmin is a stripped down version of phpMyAdmin that only requires one file, and zero configuration!

It's great for those who don't have access to an admin tool, or want a quick way to manage MySQL.

Upload the file as 'phpMinAdmin.php' and point the browser to the address of the file on the web.
If you are using Zephir (or saving session data in a special location) uncomment and edit line 19 below:

When you type in your web address, you will be prompted for the server name, your MySQL username and password.

For Zephir, the server name is 'localhost'.  If you are on a different host, you will need to type in the name of the 
server provided by your hosting company.  It can look like: 'mysql.mydomain.com', for example.

Then you provide your MySQL Username and Password.  voila!

If you are using Zephir, remember you can only edit your database, although you can see other's databases in the drop down 
box on the left side of the page. 

Be sure to logout when you're done!

Don't forget to uncomment the following line, and adjust 'horsey01' for Zephir specific session handling!
*/
ini_set('session.save_path','/home/classes/mjense11/sessions'); //LINE ADDED BY BILL, CHANGE HORSEY01 OR PATH, AND UNCOMMENT FOR ZEPHIR ONLY!!
error_reporting(E_ALL&~E_NOTICE);
if(isset($_GET["file"])){header("Expires: ".gmdate("D, d M Y H:i:s",filemtime(__FILE__)+365*24*60*60)." GMT");
if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");
echo base64_decode("AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA////AAAA/wBhTgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABEQAAAAAAERExAAAAARERExEAABERMREzMQABExMRERMRAAExMRETMRAAATERERMRAAABExERExAAAAETERExEAAAATERETERERARMRETESESEBMTETESEREQExEzESEREhETMxEREhERIREREAARISIRAAAAAAERERD/4z8A/wM/APgDAADAAwAAgAMAAIAHAACADwAAgB8AAIAfAACAAQAAAAEAAAABAAAAAAAAAAAAAAcAAAD/gQAA");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css");
?>
body { color: #000; background-color: #fff; line-height: 1.25em; font-family: Verdana, Arial, Helvetica, sans-serif; margin: 0; font-size: 90%; }
a { color: blue; }
a:visited { color: navy; }
a:hover { color: red; }
h1 { font-size: 150%; margin: 0; padding: .8em 1em; border-bottom: 1px solid #999; font-weight: normal; background: #eee; font-style: italic; }
h1 a:link, h1 a:visited { color: #777; text-decoration: none; }
h2 { font-size: 150%; margin: 0 0 20px -18px; padding: .8em 1em; border-bottom: 1px solid #000; color: #000; font-weight: normal; background: #ddf; }
h3 { font-weight: normal; font-size: 130%; margin: .8em 0; }
table { margin: 0 20px .8em 0; border: 0; border-top: 1px solid #999; border-left: 1px solid #999; font-size: 90%; }
td, th { margin-bottom: 1em; border: 0; border-right: 1px solid #999; border-bottom: 1px solid #999; padding: .2em .3em; }
th { background: #eee; }
fieldset { display: inline; vertical-align: top; padding: .5em .8em; margin: 0 .5em .5em 0; border: 1px solid #999; }
p { margin: 0 20px 1em 0; }
img { vertical-align: middle; }
code { background-color: #eee; }
.js .hidden { display: none; }
.nowrap { white-space: nowrap; }
.error { color: red; background: #fee; padding: .5em .8em; }
.message { color: green; background: #efe; padding: .5em .8em; }
.char { color: #007F00; }
.date { color: #7F007F; }
.enum { color: #007F7F; }
.binary { color: red; }
#menu { position: absolute; margin: 10px 0 0; padding: 0 0 30px 0; top: 2em; left: 0; width: 18em; overflow: auto; overflow-y: hidden; white-space: nowrap; }
#menu p { padding: .8em 1em; margin: 0; border-bottom: 1px solid #ccc; }
#menu form { margin: 0; }
#content { margin: 2em 0 0 21em; padding: 10px 20px 20px 0; }
#lang { position: absolute; top: 0; left: 0; line-height: 1.8em; padding: .3em 1em; }
#breadcrumb { position: absolute; top: 0; left: 21em; background: #eee; height: 2em; line-height: 1.8em; padding: 0 1em; margin: 0 0 0 -18px; }
#schema { margin-left: 60px; position: relative; }
#schema .table { border: 1px solid Silver; padding: 0 2px; cursor: move; position: absolute; }
#schema .references { position: absolute; }
<?php
}else{header("Content-Type: image/gif");switch($_GET["file"]){case"arrow.gif":echo
base64_decode("R0lGODlhCAAKAIAAAICAgP///yH5BAEAAAEALAAAAAAIAAoAAAIPBIJplrGLnpQRqtOy3rsAADs=");break;case"up.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACIISPqcvtD00IUU4K730T9J5hFTiKEXmaYcW2rgDH8hwXADs=");break;case"down.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACIISPqcvtD00I8cwqKb5bV/5cosdMJtmcHca2lQDH8hwXADs=");break;case"plus.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACIYSPqcvtD00I8cwqKb5v+q8pIAhxlRmhZYi17iPE8kzLBQA7");break;case"minus.gif":echo
base64_decode("R0lGODdhEgASAKEAAO7u7gAAAJmZmQAAACwAAAAAEgASAAACGYSPqcvtD6OcFIaLM8s81A+G4hgJ5ommZwEAOw==");break;}}exit;}if(!ini_get("session.auto_start")){session_name("phpMinAdmin_SID");session_set_cookie_params(ini_get("session.cookie_lifetime"),preg_replace('~\\?.*~','',$_SERVER["REQUEST_URI"]));session_start();}if(get_magic_quotes_gpc()){$process=array(&$_GET,&$_POST);while(list($key,$val)=each($process)){foreach($val
as$k=>$v){unset($process[$key][$k]);if(is_array($v)){$process[$key][stripslashes($k)]=$v;$process[]=&$process[$key][stripslashes($k)];}else{$process[$key][stripslashes($k)]=stripslashes($v);}}}unset($process);}$SELF=preg_replace('~^[^?]*/([^?]*).*~','\\1?',$_SERVER["REQUEST_URI"]).(strlen($_GET["server"])?'server='.urlencode($_GET["server"]).'&':'').(strlen($_GET["db"])?'db='.urlencode($_GET["db"]).'&':'');$TOKENS=&$_SESSION["tokens"][$_GET["server"]][$_SERVER["REQUEST_URI"]];function
idf_escape($idf){return"`".str_replace("`","``",$idf)."`";}function
idf_unescape($idf){return
str_replace("``","`",$idf);}function
bracket_escape($idf,$back=false){static$trans=array(':'=>':1',']'=>':2','['=>':3');return
strtr($idf,($back?array_flip($trans):$trans));}function
optionlist($options,$selected=null){$return="";foreach($options
as$k=>$v){if(is_array($v)){$return.='<optgroup label="'.htmlspecialchars($k).'">';}foreach((is_array($v)?$v:array($v))as$val){$return.='<option'.($val===$selected?' selected="selected"':'').'>'.htmlspecialchars($val).'</option>';}if(is_array($v)){$return.='</optgroup>';}}return$return;}function
get_vals($query){global$mysql;$return=array();$result=$mysql->query($query);if($result){while($row=$result->fetch_row()){$return[]=$row[0];}$result->free();}return$return;}function
get_databases(){$return=&$_SESSION["databases"][$_GET["server"]];if(!isset($return)){flush();$return=get_vals("SHOW DATABASES");}return$return;}function
table_status($table){global$mysql;$result=$mysql->query("SHOW TABLE STATUS LIKE '".$mysql->escape_string(addcslashes($table,"%_"))."'");return$result->fetch_assoc();}function
fields($table){global$mysql;$return=array();$result=$mysql->query("SHOW FULL COLUMNS FROM ".idf_escape($table));if($result){while($row=$result->fetch_assoc()){preg_match('~^([^(]+)(?:\\((.+)\\))?( unsigned)?( zerofill)?$~',$row["Type"],$match);$return[$row["Field"]]=array("field"=>$row["Field"],"type"=>$match[1],"length"=>$match[2],"unsigned"=>ltrim($match[3].$match[4]),"default"=>$row["Default"],"null"=>($row["Null"]=="YES"),"auto_increment"=>($row["Extra"]=="auto_increment"),"collation"=>$row["Collation"],"privileges"=>array_flip(explode(",",$row["Privileges"])),"comment"=>$row["Comment"],"primary"=>($row["Key"]=="PRI"),);}$result->free();}return$return;}function
indexes($table){global$mysql;$return=array();$result=$mysql->query("SHOW INDEX FROM ".idf_escape($table));if($result){while($row=$result->fetch_assoc()){$return[$row["Key_name"]]["type"]=($row["Key_name"]=="PRIMARY"?"PRIMARY":($row["Index_type"]=="FULLTEXT"?"FULLTEXT":($row["Non_unique"]?"INDEX":"UNIQUE")));$return[$row["Key_name"]]["columns"][$row["Seq_in_index"]]=$row["Column_name"];$return[$row["Key_name"]]["lengths"][$row["Seq_in_index"]]=$row["Sub_part"];}$result->free();}return$return;}function
foreign_keys($table){global$mysql,$on_actions;static$pattern='(?:[^`]+|``)+';$return=array();$result=$mysql->query("SHOW CREATE TABLE ".idf_escape($table));if($result){$create_table=$mysql->result($result,1);$result->free();preg_match_all("~CONSTRAINT `($pattern)` FOREIGN KEY \\(((?:`$pattern`,? ?)+)\\) REFERENCES `($pattern)`(?:\\.`($pattern)`)? \\(((?:`$pattern`,? ?)+)\\)(?: ON DELETE (".implode("|",$on_actions)."))?(?: ON UPDATE (".implode("|",$on_actions)."))?~",$create_table,$matches,PREG_SET_ORDER);foreach($matches
as$match){preg_match_all("~`($pattern)`~",$match[2],$source);preg_match_all("~`($pattern)`~",$match[5],$target);$return[$match[1]]=array("db"=>idf_unescape(strlen($match[4])?$match[3]:$match[4]),"table"=>idf_unescape(strlen($match[4])?$match[4]:$match[3]),"source"=>array_map('idf_unescape',$source[1]),"target"=>array_map('idf_unescape',$target[1]),"on_delete"=>$match[6],"on_update"=>$match[7],);}}return$return;}function
view($name){global$mysql;return
array("select"=>preg_replace('~^(?:[^`]+|`[^`]*`)* AS ~U','',$mysql->result($mysql->query("SHOW CREATE VIEW ".idf_escape($name)),1)));}function
unique_idf($row,$indexes){foreach($indexes
as$index){if($index["type"]=="PRIMARY"||$index["type"]=="UNIQUE"){$return=array();foreach($index["columns"]as$key){if(!isset($row[$key])){continue
2;}$return[]=urlencode("where[".bracket_escape($key)."]")."=".urlencode($row[$key]);}return$return;}}$return=array();foreach($row
as$key=>$val){$return[]=(isset($val)?urlencode("where[".bracket_escape($key)."]")."=".urlencode($val):"null%5B%5D=".urlencode($key));}return$return;}function
where($where){global$mysql;$return=array();foreach((array)$where["where"]as$key=>$val){$key=bracket_escape($key,"back");$return[]=(preg_match('~^[A-Z0-9_]+\\(`(?:[^`]+|``)+`\\)$~',$key)?$key:idf_escape($key))." = BINARY '".$mysql->escape_string($val)."'";}foreach((array)$where["null"]as$key){$key=bracket_escape($key,"back");$return[]=(preg_match('~^[A-Z0-9_]+\\(`(?:[^`]+|``)+`\\)$~',$key)?$key:idf_escape($key))." IS NULL";}return$return;}function
process_length($length){global$enum_length;return(preg_match("~^\\s*(?:$enum_length)(?:\\s*,\\s*(?:$enum_length))*\\s*\$~",$length)&&preg_match_all("~$enum_length~",$length,$matches)?implode(",",$matches[0]):preg_replace('~[^0-9,]~','',$length));}function
collations(){global$mysql;$return=array();$result=$mysql->query("SHOW COLLATION");while($row=$result->fetch_assoc()){if($row["Default"]&&$return[$row["Charset"]]){array_unshift($return[$row["Charset"]],$row["Collation"]);}else{$return[$row["Charset"]][]=$row["Collation"];}}$result->free();return$return;}function
token(){return($GLOBALS["TOKENS"][]=rand(1,1e6));}function
token_delete(){if($_POST["token"]&&($pos=array_search($_POST["token"],(array)$GLOBALS["TOKENS"]))!==false){unset($GLOBALS["TOKENS"][$pos]);return
true;}return
false;}function
redirect($location,$message=null){if(isset($message)){$_SESSION["messages"][]=$message;}token_delete();if(strlen(SID)){$location.=(strpos($location,"?")===false?"?":"&").SID;}header("Location: ".(strlen($location)?$location:"."));exit;}function
query_redirect($query,$location,$message,$redirect=true,$execute=true,$failed=false){global$mysql,$error,$SELF;$id="sql-".count($_SESSION["messages"]);$sql=($query?" <a href='#$id' onclick=\"return !toggle('$id');\">".lang(32)."</a><span id='$id' class='hidden'><br /><code class='jush-sql'>".htmlspecialchars($query).'</code> <a href="'.htmlspecialchars($SELF).'sql='.urlencode($query).'">'.lang(43).'</a></span>':"");if($execute){$failed=!$mysql->query($query);}if($failed){$error=htmlspecialchars($mysql->error).$sql;return
false;}if($redirect){redirect($location,$message.$sql);}return
true;}function
queries($query=null){global$mysql;static$queries=array();if(!isset($query)){return
implode(";\n",$queries);}$queries[]=$query;return$mysql->query($query);}function
remove_from_uri($param=""){$param="($param|".session_name().")";return
preg_replace("~\\?$param=[^&]*&~",'?',preg_replace("~\\?$param=[^&]*\$|&$param=[^&]*~",'',$_SERVER["REQUEST_URI"]));}function
print_page($page){echo" ".($page==$_GET["page"]?$page+1:'<a href="'.htmlspecialchars(remove_from_uri("page").($page?"&page=$page":"")).'">'.($page+1)."</a>");}function
get_file($key){if(isset($_POST["files"][$key])){$length=strlen($_POST["files"][$key]);return($length&&$length<4?intval($_POST["files"][$key]):base64_decode($_POST["files"][$key]));}return(!$_FILES[$key]||$_FILES[$key]["error"]?$_FILES[$key]["error"]:file_get_contents($_FILES[$key]["tmp_name"]));}function
select($result){global$SELF;if(!$result->num_rows){echo"<p class='message'>".lang(60)."</p>\n";}else{echo"<table border='1' cellspacing='0' cellpadding='2'>\n";$links=array();$indexes=array();$columns=array();$blobs=array();$types=array();for($i=0;$row=$result->fetch_row();$i++){if(!$i){echo"<thead><tr>";for($j=0;$j<count($row);$j++){$field=$result->fetch_field();if(strlen($field->orgtable)){if(!isset($indexes[$field->orgtable])){$indexes[$field->orgtable]=array();foreach(indexes($field->orgtable)as$index){if($index["type"]=="PRIMARY"){$indexes[$field->orgtable]=array_flip($index["columns"]);break;}}$columns[$field->orgtable]=$indexes[$field->orgtable];}if(isset($columns[$field->orgtable][$field->orgname])){unset($columns[$field->orgtable][$field->orgname]);$indexes[$field->orgtable][$field->orgname]=$j;$links[$j]=$field->orgtable;}}if($field->charsetnr==63){$blobs[$j]=true;}$types[$j]=$field->type;echo"<th>".htmlspecialchars($field->name)."</th>";}echo"</tr></thead>\n";}echo"<tr>";foreach($row
as$key=>$val){if(!isset($val)){$val="<i>NULL</i>";}else{if($blobs[$key]&&preg_match('~[\\x80-\\xFF]~',$val)){$val="<i>".lang(78,strlen($val))."</i>";}else{$val=(strlen(trim($val))?nl2br(htmlspecialchars($val)):"&nbsp;");if($types[$key]==254){$val="<code>$val</code>";}}if(isset($links[$key])&&!$columns[$links[$key]]){$link="edit=".urlencode($links[$key]);foreach($indexes[$links[$key]]as$col=>$j){$link.="&amp;where".urlencode("[".bracket_escape($col)."]")."=".urlencode($row[$j]);}$val='<a href="'.htmlspecialchars($SELF).$link.'">'.$val.'</a>';}}echo"<td>$val</td>";}echo"</tr>\n";}echo"</table>\n";}$result->free();}function
shorten_utf8($string,$length){for($i=0;$i<strlen($string);$i++){if(ord($string[$i])>=192){while(ord($string[$i+1])>=128&&ord($string[$i+1])<192){$i++;}}$length--;if($length==0){return
nl2br(htmlspecialchars(substr($string,0,$i+1)))."<em>...</em>";}}return
nl2br(htmlspecialchars($string));}function
table_comment(&$row){if($row["Engine"]=="InnoDB"){$row["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\\1',$row["Comment"]);}}function
hidden_fields($process,$ignore=array()){while(list($key,$val)=each($process)){if(is_array($val)){foreach($val
as$k=>$v){$process[$key."[$k]"]=$v;}}elseif(!in_array($key,$ignore)){echo'<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($val).'" />';}}}$langs=array('en'=>'English','cs'=>'Čeština','sk'=>'Slovenčina','nl'=>'Nederlands','es'=>'Español','de'=>'Deutsch','zh'=>'简体中文','fr'=>'Français','it'=>'Italiano','et'=>'Eesti',);function
lang($idf,$number=null){global$LANG,$translations;$translation=$translations[$idf];if(is_array($translation)&&$translation){$pos=($number==1?0:1);switch($LANG){case'cs':$pos=($number==1?0:(!$number||$number>=5?2:1));break;case'sk':$pos=($number==1?0:(!$number||$number>=5?2:1));break;}$translation=$translation[$pos];}$args=func_get_args();array_shift($args);return
vsprintf((isset($translation)?$translation:$idf),$args);}function
switch_lang(){global$LANG,$langs;echo"<form action=''>\n<div id='lang'>";hidden_fields($_GET,array('lang'));echo
lang(53).": <select name='lang' onchange='this.form.submit();'>";foreach($langs
as$lang=>$val){echo"<option value='$lang'".($LANG==$lang?" selected='selected'":"").">$val</option>";}echo"</select>\n<noscript><div style='display: inline;'><input type='submit' value='".lang(36)."' /></div></noscript>\n</div>\n</form>\n";}if(isset($_GET["lang"])){$_COOKIE["lang"]=$_GET["lang"];$_SESSION["lang"]=$_GET["lang"];}$LANG="en";if(isset($langs[$_COOKIE["lang"]])){setcookie("lang",$_GET["lang"],strtotime("+1 month"),preg_replace('~\\?.*~','',$_SERVER["REQUEST_URI"]));$LANG=$_COOKIE["lang"];}elseif(isset($langs[$_SESSION["lang"]])){$LANG=$_SESSION["lang"];}else{$accept_language=array();preg_match_all('~([-a-z_]+)(;q=([0-9.]+))?~',strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]),$matches,PREG_SET_ORDER);foreach($matches
as$match){$accept_language[str_replace("_","-",$match[1])]=(isset($match[3])?$match[3]:1);}arsort($accept_language);foreach($accept_language
as$lang=>$q){if(isset($langs[$lang])){$LANG=$lang;break;}$lang=preg_replace('~-.*~','',$lang);if(!isset($accept_language[$lang])&&isset($langs[$lang])){$LANG=$lang;break;}}}switch($LANG){case"cs":$translations=array('Přihlásit se','phpMinAdmin','Odhlášení proběhlo v pořádku.','Neplatné přihlašovací údaje.','Server','Uživatel','Heslo','Vybrat databázi','Nesprávná databáze.','Vytvořit novou databázi','Tabulka byla odstraněna.','Tabulka byla změněna.','Tabulka byla vytvořena.','Pozměnit tabulku','Vytvořit tabulku','Název tabulky','úložiště','porovnávání','Název sloupce','Typ','Délka','NULL','Auto Increment','Volby','Uložit','Odstranit','Databáze byla odstraněna.','Databáze byla vytvořena.','Databáze byla přejmenována.','Databáze byla změněna.','Pozměnit databázi','Vytvořit databázi','SQL příkaz','Export','Odhlásit','databáze','Vybrat','Žádné tabulky.','vypsat','Vytvořit novou tabulku','Položka byla smazána.','Položka byla aktualizována.','Položka byla vložena.','Upravit','Vložit','Uložit a vložit další','Smazat','Databáze','Procedury a funkce','Indexy byly změněny.','Indexy','Pozměnit indexy','Přidat další','Jazyk','Vypsat','Nová položka','Vyhledat','Setřídit','sestupně','Limit','Žádné řádky.','Akce','upravit','Stránka',array('Příkaz proběhl v pořádku, byl změněn %d záznam.','Příkaz proběhl v pořádku, byly změněny %d záznamy.','Příkaz proběhl v pořádku, bylo změněno %d záznamů.'),'Chyba v dotazu','Provést','Tabulka','Cizí klíče','Triggery','Pohled','Nepodařilo se vypsat tabulku','Neplatný token CSRF. Odešlete formulář znovu.','Komentář','Výchozí hodnoty byly nastaveny.','Výchozí hodnoty','BOOL','Zobrazit komentáře sloupců',array('%d bajt','%d bajty','%d bajtů'),'Žádné příkazy k vykonání.','Nepodařilo se nahrát soubor.','Nahrání souboru','Nahrávání souborů není povoleno.',array('Procedura byla zavolána, byl změněn %d záznam.','Procedura byla zavolána, byly změněny %d záznamy.','Procedura byla zavolána, bylo změněno %d záznamů.'),'Zavolat','Žádná MySQL extenze','Není dostupná žádná z podporovaných PHP extenzí (%s).','Session proměnné musí být povolené.','Session vypršela, přihlašte se prosím znovu.','Délka textů','Zvýrazňování syntaxe','Cizí klíč byl odstraněn.','Cizí klíč byl změněn.','Cizí klíč byl vytvořen.','Cizí klíč','Cílová tabulka','Změnit','Zdroj','Cíl','Přidat sloupec','Změnit','Přidat cizí klíč','Při smazání','Při změně','Typ indexu','Sloupec (délka)','Pohled byl odstraněn.','Pohled byl změněn.','Pohled byl vytvořen.','Pozměnit pohled','Vytvořit pohled','Název','Seznam procesů',array('Byl ukončen %d proces.','Byly ukončeny %d procesy.','Bylo ukončeno %d procesů.'),'Ukončit','IN-OUT','Název parametru','Schéma databáze','Vytvořit proceduru','Vytvořit funkci','Procedura byla odstraněna.','Procedura byla změněna.','Procedura byla vytvořena.','Změnit funkci','Změnit proceduru','Návratový typ','Přidat trigger','Trigger byl odstraněn.','Trigger byl změněn.','Trigger byl vytvořen.','Změnit trigger','Vytvořit trigger','Čas','Událost','Verze MySQL: %s přes PHP extenzi %s',array('%d řádek','%d řádky','%d řádků'),'Při změně aktuální čas','Odebrat','Opravdu?','Oprávnění','Vytvořit uživatele','Uživatel byl odstraněn.','Uživatel byl změněn.','Uživatel byl vytvořen.','Zahašované','Sloupec','Procedura','Povolit','Zakázat','Příliš velká POST data. Zmenšete data nebo zvyšte hodnotu konfigurační direktivy "post_max_size".','Přihlášen jako: %s','Přesunout nahoru','Přesunout dolů','Funkce','Agregace','Export','Výstup','otevřít','uložit','Formát','SQL','CSV','přeskočit','Tabulky','Struktura','Data','Událost byla odstraněna.','Událost byla změněna.','Událost byla vytvořena.','Pozměnit událost','Vytvořit událost','V daný čas','Každých','Události','Plán','Začátek','Konec','Stav','Po dokončení zachovat','Tabulky a pohledy','Velikost dat','Velikost indexů','Volné místo','Porovnávání','Analyzovat','Optimalizovat','Zkontrolovat','Opravit','Promazat','Tabulky byly promazány.','Řádků',' ','Tabulky byly přesunuty','Přesunout do jiné databáze','Přesunout','Úložiště','Uložit a pokračovat v editaci','klonovat','původní',array('Byl ovlivněn %d záznam.','Byly ovlivněny %d záznamy.','Bylo ovlivněno %d záznamů.'),'celý výsledek','Tabulky byla odstraněny.','Klonovat');break;case"de":$translations=array('Login','phpMinAdmin','Abmeldung erfolgreich.','Ungültige Anmelde-Informationen.','Server','Benutzer','Passwort','Datenbank auswählen','Datenbank ungültig.','Neue Datenbank','Tabelle entfernt.','Tabelle geändert.','Tabelle erstellt.','Tabelle ändern','Neue Tabelle erstellen','Name der Tabelle','Motor','Kollation','Spaltenname','Typ','Länge','NULL','Auto-Inkrement','Optionen','Speichern','Entfernen','Datenbank entfernt.','Datenbank erstellt.','Datenbank umbenannt.','Datenbank geändert.','Datenbank ändern','Neue Datenbank','SQL-Query','Export','Abmelden','Datenbank','Benutzung','Keine Tabellen.','zeigen','Neue Tabelle','Datensatz gelöscht.','Datensatz geändert.','Datensatz hinzugefügt.','Ändern','Hinzufügen','Speichern und nächsten hinzufügen','Entfernen','Datenbank','Prozeduren','Indizes geändert.','Indizes','Indizes ändern','Hinzufügen','Sprache','Daten zeigen von','Neuer Datensatz','Suchen','Ordnen','absteigend','Begrenzung','Keine Daten.','Aktion','ändern','Seite',array('Abfrage ausgeführt, %d Datensatz betroffen.','Abfrage ausgeführt, %d Datensätze betroffen.'),'Fehler in der SQL-Abfrage','Ausführen','Tabelle','Fremdschlüssel','Trigger','View','Tabelle kann nicht ausgewählt werden','CSRF Token ungültig. Bitte die Formulardaten erneut abschicken.','Kommentar','Standard Vorgabewerte sind erstellt worden.','Vorgabewerte festlegen','BOOL','Spaltenkomentare zeigen',array('%d Byte','%d Bytes'),'Kein Kommando vorhanden.','Unmöglich Dateien hochzuladen.','Datei importieren','Importieren von Dateien abgeschaltet.',array('Kommando SQL ausgeführt, %d Datensatz betroffen.','Kommando SQL ausgeführt, %d Datensätze betroffen.'),'Aufrufen','Keine MySQL-Erweiterungen installiert','Keine der unterstützten PHP-Erweiterungen (%s) ist vorhanden.','Sitzungen müssen aktiviert sein.','Sitzungsdauer abgelaufen, bitte erneut anmelden.','Textlänge','Syntax highlighting','Fremdschlüssel entfernt.','Fremdschlüssel geändert.','Fremdschlüssel erstellt.','Fremdschlüssel','Zieltabelle','Ändern','Ursprung','Ziel','Spalte hinzufügen','Ändern','Fremdschlüssel hinzufügen','ON DELETE','ON UPDATE','Index-Typ','Spalte (Länge)','View entfernt.','View geändert.','View erstellt.','View ändern','Neue View erstellen','Name','Prozessliste',array('%d Prozess gestoppt.','%d Prozesse gestoppt.'),'Anhalten','IN-OUT','Name des Parameters','Datenbankschema','Neue Prozedur','Neue Funktion','Prozedur entfernt.','Prozedur geändert.','Prozedur erstellt.','Funktion ändern','Prozedur ändern','Typ des Rückgabewertes','Trigger hinzufügen','Trigger entfernt.','Trigger geändert.','Trigger erstellt.','Trigger ändern','Trigger hinzufügen','Zeitpunkt','Ereignis','Version MySQL: %s, mit PHP-Erweiterung %s',array('%d Datensatz','%d Datensätze'),'ON UPDATE CURRENT_TIMESTAMP','Entfernen','Sind Sie sicher ?','Rechte','Neuer Benutzer','Benutzer entfernt.','Benutzer geändert.','Benutzer erstellt.','Gehashed','Spalte','Routine','Erlauben','Verbieten','POST data zu gross. Reduzieren Sie die Grösse oder vergrössern Sie den Wert "post_max_size" in der Konfiguration.','Angemeldet als: %s','Nach oben','Nach unten','Funktionen','Aggregationen','Exportieren','Ausgabe','zeigen','speichern','Format','SQL','CSV','ignorieren','Tabellen','Struktur','Daten','Ereignis entfernt.','Ereignis geändert.','Ereignis erstellt.','Ereignis ändern','Ereignis erstellen','Zur angegebenen Zeit','Jede','Ereignisse','Zeitplan','Start','Ende','Status','Nach der Ausführung erhalten','Tabellen und Views','Datengrösse','Indexgrösse','Freier Bereich','Collation','Analysieren','Optimisieren','Prüfen','Reparieren','Entleeren (truncate)','Tabellen sind entleert worden (truncate).','Datensätze',' ','Tabellen verschoben.','In andere Datenbank verschieben','Verschieben','Motor','Speichern und weiter bearbeiten','klonen','original',array('%d Artikel betroffen.','%d Artikel betroffen.'),'gesamtes Resultat','Tabellen wurden entfernt (drop).','Klonen');break;case"en":$translations=array('Login','phpMinAdmin','Logout successful.','Invalid credentials.','Server','Username','Password','Select database','Invalid database.','Create new database','Table has been dropped.','Table has been altered.','Table has been created.','Alter table','Create table','Table name','engine','collation','Column name','Type','Length','NULL','Auto Increment','Options','Save','Drop','Database has been dropped.','Database has been created.','Database has been renamed.','Database has been altered.','Alter database','Create database','SQL command','Dump','Logout','database','Use','No tables.','select','Create new table','Item has been deleted.','Item has been updated.','Item has been inserted.','Edit','Insert','Save and insert next','Delete','Database','Routines','Indexes has been altered.','Indexes','Alter indexes','Add next','Language','Select','New item','Search','Sort','DESC','Limit','No rows.','Action','edit','Page',array('Query executed OK, %d row affected.','Query executed OK, %d rows affected.'),'Error in query','Execute','Table','Foreign keys','Triggers','View','Unable to select the table','Invalid CSRF token. Send the form again.','Comment','Default values has been set.','Default values','BOOL','Show column comments',array('%d byte','%d bytes'),'No commands to execute.','Unable to upload a file.','File upload','File uploads are disabled.',array('Routine has been called, %d row affected.','Routine has been called, %d rows affected.'),'Call','No MySQL extension','None of supported PHP extensions (%s) are available.','Sessions must be enabled.','Session expired, please login again.','Text length','Syntax highlighting','Foreign key has been dropped.','Foreign key has been altered.','Foreign key has been created.','Foreign key','Target table','Change','Source','Target','Add column','Alter','Add foreign key','ON DELETE','ON UPDATE','Index Type','Column (length)','View has been dropped.','View has been altered.','View has been created.','Alter view','Create view','Name','Process list',array('%d process has been killed.','%d processes have been killed.'),'Kill','IN-OUT','Parameter name','Database schema','Create procedure','Create function','Routine has been dropped.','Routine has been altered.','Routine has been created.','Alter function','Alter procedure','Return type','Add trigger','Trigger has been dropped.','Trigger has been altered.','Trigger has been created.','Alter trigger','Create trigger','Time','Event','MySQL version: %s through PHP extension %s',array('%d row','%d rows'),'ON UPDATE CURRENT_TIMESTAMP','Remove','Are you sure?','Privileges','Create user','User has been dropped.','User has been altered.','User has been created.','Hashed','Column','Routine','Grant','Revoke','Too big POST data. Reduce the data or increase the "post_max_size" configuration directive.','Logged as: %s','Move up','Move down','Functions','Aggregation','Export','Output','open','save','Format','SQL','CSV','skip','Tables','Structure','Data','Event has been dropped.','Event has been altered.','Event has been created.','Alter event','Create event','At given time','Every','Events','Schedule','Start','End','Status','On completion preserve','Tables and views','Data Length','Index Length','Data Free','Collation','Analyze','Optimize','Check','Repair','Truncate','Tables have been truncated.','Rows',',','Tables have been moved.','Move to other database','Move','Engine','Save and continue edit','clone','original',array('%d item have been affected.','%d items have been affected.'),'whole result','Tables have been dropped.','Clone');break;case"es":$translations=array('Login','phpMinAdmin','Salida exitosa.','Autenticación fallada.','Servidor','Usuario','Contraseña','Seleccionar Base de datos','Base de datos inválida.','Nueva Base de datos','Tabla eliminada.','Tabla modificada.','Tabla creada.','Modificar tabla','Crear tabla','Nombre de tabla','motor','collation','Nombre de columna','Tipo','Longitud','NULL','Auto increment','Opciones','Guardar','Eliminar','Base de datos eliminada.','Base de datos creada.','Base de datos renombrada.','Base de datos modificada.','Modificar Base de datos','Crear Base de datos','Comando SQL','Export','Logout','base de datos','Uso','No existen tablas.','registros','Nueva tabla','Registro eliminado.','Registro modificado.','Registro insertado.','Modificar','Agregar','Guardar e insertar otro','Eliminar','Base de datos','Procedimientos','Indices modificados.','Indices','Modificar indices','Agregar','Idioma','Mostrar Registros','Nuevo Registro','Buscar','Ordenar','descendiente','Limit','No hay filas.','Acción','modificar','Página',array('Consulta ejecutada, %d registro afectado.','Consulta ejecutada, %d registros afectados.'),'Error en consulta','Ejecutar','Tabla','Claves foráneas','Triggers','Vistas','No posible seleccionar la tabla','Token CSRF inválido. Vuelva a enviar los datos del formulario.','Comentario','Valores por omisión establecidos.','Establecer valores por omisión','BOOL','Mostrar comentario de columnas',array('%d byte','%d bytes'),'No hay comando a ejecutar.','No posible subir archivos.','Importar archivo','Importación de archivos deshablilitado.',array('Consulta ejecutada, %d registro afectado.','Consulta ejecutada, %d registros afectados.'),'Llamar','No hay extension MySQL','Ninguna de las extensiones PHP soportadas (%s) está disponible.','Deben estar habilitadas las sesiones.','Sesion expirada, favor loguéese de nuevo.','Longitud de texto','Destacar Sintaxis','Clave foránea eliminada.','Clave foránea modificada.','Clave foránea creada.','Clave foránea','Tabla destino','Modificar','Origen','Destino','Agregar columna','Modificar','Agregar clave foránea','ON DELETE','ON UPDATE','Tipo de índice','Columna (longitud)','Vista eliminada.','Vista modificada.','Vista creada.','Modificar vista','Cear vista','Nombre','Lista de procesos',array('%d proceso detenido.','%d procesos detenidos.'),'Detener','IN-OUT','Nombre de Parametro','Esquema de base de datos','Crear procedimiento','Crear función','Procedimiento eliminado.','Procedimiento modificado.','Procedimiento creado.','Modificar Función','Modificar procedimiento','Tipo de valor retornado','Agregar trigger','Trigger eliminado.','Trigger modificado.','Trigger creado.','Modificar Trigger','Agregar Trigger','Tiempo','Evento','Versión MySQL: %s a través de extensión PHP %s',array('%d fila','%d filas'),'ON UPDATE CURRENT_TIMESTAMP','Eliminar','Está seguro?','Privilegios','Crear Usuario','Usuario eliminado.','Usuario modificado.','Usuario creado.','Hash','Columna','Rutina','Conceder','Impedir','POST data demasiado grande. Reduzca el tamaño o aumente la directiva de configuración "post_max_size".','Logeado como: %s','Mover arriba','Mover abajo','Funciones','Agregaciones','Exportar','Salida','mostrar','guardar','Formato','SQL','CSV','ignorar','Tablas','Estructura','Datos','Evento eliminado.','Evento modificado.','Evento creado.','Modificar Evento','Crear Evento','A hora determinada','Cada','Eventos','Agendamiento','Inicio','Fin','Estado','Al completar preservar','Tablas y vistas','Longitud de datos','Longitud de índice','Espacio libre','Collation','Analizar','Optimizar','Comprobar','Reparar','Vaciar','Tablas vaciadas (truncate).','Filas',' ','Se movieron las tablas.','mover a otra base de datos','Mover','Motor','Guardar y continuar editando','clonar','original',array('%d item afectado.','%d itemes afectados.'),'resultado completo','Las tablas fueron eliminados.','Clonar');break;case"et":$translations=array('Logi sisse','Andmebaasi haldaja','Väljalogimine õnnestus.','Ebasobivad andmed.','Server','Kasutajanimi','Parool','Vali andmebaas','Sobimatu andmebaas.','Loo uus andmebaas','Tabel on edukalt kustutatud.','Tabeli andmed on edukalt muudetud.','Tabel on edukalt loodud.','Muuda tabeli struktuuri','Loo uus tabel','Tabeli nimi','Mootor','Tähetabel','Veeru nimi','Tüüp','Pikkus','NULL','Automaatselt suurenev','Valikud','Sisesta','Kustuta','Andmebaas on edukalt kustutatud.','Andmebaas on edukalt loodud.','Andmebaas on edukalt ümber nimetatud.','Andmebaasi struktuuri uuendamine õnnestus.','Muuda andmebaasi','Loo uus andmebaas','SQL-Päring','Ekspordi','Logi välja','Andmebaas','Kasuta','Tabeleid ei leitud.','kuva','Loo uus tabel','Kustutamine õnnestus.','Uuendamine õnnestus.','Lisamine õnnestus.','Muuda','Sisesta','Sisesta ja lisa järgmine','Kustuta','Andmebaas','Protseduurid','Indeksite andmed on edukalt uuendatud.','Indeksid','Muuda indekseid','Lisa järgmine','Keel','Kuva','Lisa kirje','Otsi','Sordi','Kahanevalt','Piira kirjete hulka','Sissekanded puuduvad.','Tegevus','muuda','Lehekülg',array('Päring õnnestus, mõjutatatud ridu: %d.','Päring õnnestus, mõjutatatud ridu: %d'),'SQL-päringus esines viga','Käivita','Tabel','Võõrvõtmed (foreign key)','Päästikud (trigger)','Vaata','Tabeli valimine ebaõnnestus','Sobimatu CSRF, palun saadke vorm uuesti.','Kommentaar','Vaimimisi väärtused on edukalt määratud.','Vaikimisi väärtused','Jah/Ei (BOOL)','Kuva veeru kommentaarid',array('%d bait','%d baiti'),'Käsk puudub.','Faili üleslaadimine pole võimalik.','Faili üleslaadimine','Faili üleslaadimine on keelatud.',array('Protseduur täideti edukalt, mõjutatud ridu: %d.','Protseduur täideti edukalt, mõjutatud ridu: %d'),'Käivita','Ei leitud MySQL laiendust','Serveris pole ühtegi toetatud PHP laiendustest (%s).','Sessioonid peavad olema lubatud.','Sessioon on aegunud, palun logige uuesti sisse.','Teksti pikkus','Värvi süntaks','Võõrvõti on edukalt kustutatud.','Võõrvõtme andmed on edukalt muudetud.','Võõrvõri on edukalt loodud.','Võõrvõti','Siht-tabel','Muuda','Allikas','Sihtkoht','Lisa veerg','Muuda','Lisa võõrvõti','ON DELETE','ON UPDATE','Indeksi tüüp','Veerg (pikkus)','Vaade (VIEW) on edukalt kustutatud.','Vaade (VIEW) on edukalt muudetud.','Vaade (VIEW) on edukalt loodud.','Muuda vaadet (VIEW)','Loo uus vaade (VIEW)','Nimi','Protsesside nimekiri',array('Protsess on edukalt peatatud (%d).','Valitud protsessid (%d) on edukalt peatatud'),'Peata','IN-OUT','Parameetri nimi','Andmebaasi skeem','Loo uus protseduur','Loo uus funktsioon','Protseduur on edukalt kustutatud.','Protseduuri andmed on edukalt muudetud.','Protseduur on edukalt loodud.','Muuda funktsiooni','Muuda protseduuri','Tagastustüüp','Lisa päästik (TRIGGER)','Päästik on edukalt kustutatud.','Päästiku andmed on edukalt uuendatud.','Uus päästik on edukalt loodud.','Muuda päästiku andmeid','Loo uus päästik (TRIGGER)','Aeg','Sündmus','MySQL versioon: %s, kasutatud PHP moodul: %s',array('%d rida','%d rida'),'ON UPDATE CURRENT_TIMESTAMP','Eemalda','Kas oled kindel?','Õigused','Loo uus kasutaja','Kasutaja on edukalt kustutatud.','Kasutaja andmed on edukalt muudetud.','Kasutaja on edukalt lisatud.','Häshitud (Hashed)','Veerg','Protseduur','Anna','Eemalda','POST-andmete maht on liialt suur. Palun vähendage andmeid või suurendage "post_max_size" php-seadet.','Sisse logitud: %s','Liiguta ülespoole','Liiguta allapoole','Funktsioonid','Liitmine','Ekspordi','Väljund','näita brauseris','salvesta failina','Formaat','SQL','CSV','ignoreeri','Tabelid','Struktuur','Andmed','Sündmus on edukalt kustutatud.','Sündmuse andmed on edukalt uuendatud.','Sündmus on edukalt loodud.','Muuda sündmuse andmeid','Loo uus sündmus (EVENT)','Antud ajahetkel','Iga','Sündmused (EVENTS)','Ajakava','Alusta','Lõpeta','Staatus','Lõpetamisel jäta sündmus alles','Tabelid ja vaated','Andmete pikkus','Indeksi pikkus','Vaba ruumi','Tähetabel','Analüüsi','Optimeeri','Kontrolli','Paranda','Tühjenda','Validud tabelid on edukalt tühjendatud.','Ridu',',','Valitud tabelid on edukalt liigutatud.','Liiguta teise andmebaasi','Liiguta','Implementatsioon','Salvesta ja jätka muutmist','Klooni','originaal',array('Mõjutatud kirjeid: %d.','Mõjutatud kirjeid: %d.'),'Täielikud tulemused','Valitud tabelid on edukalt kustutatud.','Kloon');break;case"fr":$translations=array('Authentification','phpMinAdmin','Aurevoir!','Authentification échoué','Serveur','Utilisateur','Mot de passe','Selectionner la base de donnée','Base de donnée invalide','Créer une base de donnée','Table effacée','Table modifiée','Table créée.','Modifier la table','Créer une table','Nom de la table','moteur','collation','Nombre de colonne','Type','Longeur','NULL','Auto increment','Opions','Sauvegarder','Effacer','Base de données effacée.','Base de données créée.','Base de données renommée.','Base de données modifiée.','Modifier la base de données','Créer une base de données','Requête SQL','Exporter','Déconnexion','base de données','Utiliser','Aucunes tables.','select','Créer une table','Élément supprimé.','Élément modifié.','Élément inseré.','Modifier','Insérer','Sauvegarder et insérer le prochain','Effacer','Base de données','Routines','Index modifiés.','Index','Modifier les index','Ajouter le prochain','Langues','Select','Nouvel élément','Rechercher','Ordonner','DESC','Limit','Aucun résultat','Action','modifier','Page',array('Requête exécutée, %d ligne affecteé.','Requête exécutée, %d lignes affectées.'),'Erreur dans la requête','Exécuter','Table','Clé externe','Triggers','Vue','Impossible de sélectionner la table','Token CSRF invalide. Veuillez réenvoyer le formulaire.','Commentaire','Valeur par défaut établie .','Valeurs par défaut','BOOL','Voir les commentaires sur les colonnes',array('%d byte','%d bytes'),'Aucune commande   exécuter.','Impossible d\'importer le fichier.','Importer un fichier','Import de fichier désactivé.',array('Routine exécutée, %d ligne modifiée.','Routine exécutée, %d lignes modifiées.'),'Appeler','Extension MySQL introuvable','Aucune des extensions PHP supportées (%s) n\'est disponible.','Veuillez activer les sessions.','Session expiré, veuillez vous enregistrer   nouveau.','Longueur du texte','Coloration syntaxique','Clé externe effacée.','Clé externe modifiée.','Clé externe créée.','Clé externe','Table visée','Modifier','Source','Cible','Ajouter une colonne','Modifier','Ajouter une clé externe','ON DELETE','ON UPDATE','Type d\'index','Colonne (longueur)','Vue effacée.','Vue modifiée.','Vue créée.','Modifier une vue','Créer une vue','Nom','Liste de processus',array('%d processus arrêté.','%d processus arrêtés.'),'Arrêter','IN-OUT','Nom du Paramêtre','Schéma de la base de données','Créer une procédure','Créer une fonction','Procédure éliminée.','Procédure modifiée.','Procédure créée.','Modifié la fonction','Modifié la procédure','Type de retour','Ajouter un trigger','Trigger éliminé.','Trigger modifié.','Trigger créé.','Modifier un trigger','Ajouter un trigger','Temps','Évènement','Version de MySQL: %s utilisant l\'extension %s',array('%d ligne','%d lignes'),'ON UPDATE CURRENT_TIMESTAMP','Effacer','Êtes-vous certain?','Privilège','Créer un utilisateur','Utilisateur éffacé.','Utilisateur modifié.','Utilisateur créé.','Haché','Colonne','Routine','Grant','Rovoke','Donnée POST trop grande . Réduire la taille des données ou modifier le "post_max_size" dans la configuration de PHP.','Authentifié en tant que %s','Déplacer vers le haut','Déplacer vers le bas','Fonctions','Agrégation','Exporter','Sortie','ouvrir','sauvegarder','Formatter','SQL','CVS','sauter','Tables','Structure','Donnée','L\'évènement a été supprimé.','L\'évènement a été modifié.','L\'évènement a été créé.','Modifier un évènement','Créer un évènement','À un moment précis','Chaque','Évènement','Horaire','Démarrer','Terminer','Status','Conserver quand complété','Tables et vues','Longeur des données','Longeur de l\'index','Vide','Collation','Analyser','Opitimiser','Vérifier','Réparer','Tronquer','Les tables ont été tronquées','Rangés',',','Les tables ont été déplacées','Déplacer dans une autre base de données','Déplacer','Moteur','Sauvegarder et continuer l\'édition','cloner','original',array('%d élément ont été modifié.','%d éléments ont été modifié.'),'résultat entier','Les tables ont été effacées','Cloner');break;case"it":$translations=array('Autenticazione','phpMinAdmin','Uscita effettuata con successo.','Credenziali non valide.','Server','Utente','Password','Seleziona database','Database non valido.','Crea nuovo database','Tabella eliminata.','Tabella modificata.','Tabella creata.','Modifica tabella','Crea tabella','Nome tabella','motore','collazione','Nome colonna','Tipo','Lunghezza','NULL','Auto incremento','Opzioni','Salva','Elimina','Database eliminato.','Database creato.','Database rinominato.','Database modificato.','Modifica database','Crea database','Comando SQL','Dump','Esci','database','Usa','No tabelle.','seleziona','Crea nuova tabella','Elemento eliminato.','Elemento aggiornato.','Elemento inserito.','Modifica','Inserisci','Salva e inserisci un altro','Elimina','Database','Routine','Indici modificati.','Indici','Modifica indici','Aggiungi altro','Lingua','Seleziona','Nuovo elemento','Cerca','Ordina','DESC','Limite','Nessuna riga.','Azione','modifica','Pagina',array('Esecuzione della query OK, %d riga interessata.','Esecuzione della query OK, %d righe interessate.'),'Errore nella query','Esegui','Tabella','Chiavi esterne','Trigger','Vedi','Selezione della tabella non riuscita','Token CSRF non valido. Reinvia la richiesta.','Commento','Valore predefinito impostato.','Valori predefiniti','BOOL','Mostra i commenti delle colonne',array('%d byte','%d bytes'),'Nessun commando da eseguire.','Caricamento del file non riuscito.','Caricamento file','Caricamento file disabilitato.',array('Routine chiamata, %d riga interessata.','Routine chiamata, %d righe interessate.'),'Chiama','Estensioni MySQL non presenti','Nessuna delle estensioni PHP supportate (%s) disponibile.','Le sessioni devono essere abilitate.','Sessione scaduta, autenticarsi di nuovo.','Lunghezza testo','Evidenzia sintassi','Foreign key eliminata.','Foreign key modificata.','Foreign key creata.','Foreign key','Tabella obiettivo','Cambia','Sorgente','Obiettivo','Aggiungi colonna','Modifica','Aggiungi foreign key','ON DELETE','ON UPDATE','Tipo indice','Colonna (lunghezza)','Vista eliminata.','Vista modificata.','Vista creata.','Modifica vista','Crea vista','Nome','Elenco processi',array('%d processo interrotto.','%d processi interrotti.'),'Interrompi','IN-OUT','Nome parametro','Schema database','Crea procedura','Crea funzione','Routine eliminata.','Routine modificata.','Routine creata.','Modifica funzione','Modifica procedura','Return type','Aggiungi trigger','Trigger eliminato.','Trigger modificato.','Trigger creato.','Modifica trigger','Crea trigger','Orario','Evento','Versione MySQL: %s via estensione PHP %s',array('%d riga','%d righe'),'ON UPDATE CURRENT_TIMESTAMP','Rimuovi','Sicuro?','Privilegi','Crea utente','Utente eliminato.','Utente modificato.','Utente creato.','Hashed','Colonna','Routine','Permetti','Revoca','Troppi dati via POST. Ridurre i dati o aumentare la direttiva di configurazione "post_max_size".','Autenticato come: %s','Sposta su','Sposta giu','Funzioni','Aggregazione','Esporta','Risultato','apri','salva','Formato','SQL','CSV','tralascia','Tabelle','Struttura','Dati','Evento eliminato.','Evento modificato.','Evento creato.','Modifica evento','Crea evento','A tempo prestabilito','Ogni','Eventi','Pianifica','Inizio','Fine','Stato','Al termine preservare','Tabelle e viste','Lunghezza dato','Lunghezza indice','Dati liberi','Collazione','Analizza','Ottimizza','Controlla','Ripara','Svuota','Le tabelle sono state svuotate.','Righe','.','Le tabelle sono state spostate.','Sposta in altro database','Sposta','Motore','Salva e continua','clona','originale',array('Il risultato consiste in %d elemento','Il risultato consiste in %d elementi'),'intero risultato','Le tabelle sono state eliminate.','Clona');break;case"nl":$translations=array('Inloggen','phpMinAdmin','Uitloggen geslaagd.','Ongeldige logingegevens.','Server','Gebruikersnaam','Wachtwoord','Database selecteren','Ongeldige database.','Nieuwe database','Tabel verwijderd.','Tabel aangepast.','Tabel aangemaakt.','Tabel aanpassen','Tabel aanmaken','Tabelnaam','engine','collation','Kolomnaam','Type','Lengte','NULL','Auto nummering','Opties','Opslaan','Verwijderen','Database verwijderd.','Database aangemaakt.','Database hernoemd.','Database aangepast.','Database aanpassen','Database aanmaken','SQL opdracht','Exporteer','Uitloggen','database','Gebruik','Geen tabellen.','kies','Nieuwe tabel','Item verwijderd.','Item aangepast.','Item toegevoegd.','Bewerk','Toevoegen','Opslaan, daarna toevoegen','Verwijderen','Database','Procedures','Index aangepast.','Indexen','Indexen aanpassen','Volgende toevoegen','Taal','Kies','Nieuw item','Zoeken','Sorteren','Aflopend','Beperk','Geen rijen.','Acties','bewerk','Pagina',array('Query uitgevoerd, %d rij geraakt.','Query uitgevoerd, %d rijen geraakt.'),'Fout in query','Uitvoeren','Tabel','Foreign keys','Triggers','View','Onmogelijk tabel te selecteren','Ongeldig CSRF token. Verstuur het formulier opnieuw.','Commentaar','Standaard waarde ingesteld.','Standaard waarden','BOOL','Kolomcommentaar weergeven',array('%d byte','%d bytes'),'Geen opdrachten uit te voeren.','Onmogelijk bestand te uploaden.','Bestand uploaden','Bestanden uploaden is uitgeschakeld.',array('Procedure uitgevoerd, %d rij geraakt.','Procedure uitgevoerd, %d rijen geraakt.'),'Uitvoeren','Geen MySQL extensie','Geen geldige PHP extensies beschikbaar (%s).','Siessies moeten geactiveerd zijn.','Uw sessie is verlopen. Gelieve opnieuw in te loggen.','Tekst lengte','Syntax highlighting','Foreign key verwijderd.','Foreign key aangepast.','Foreign key aangemaakt.','Foreign key','Doeltabel','Veranderen','Bron','Doel','Kolom toevoegen','Aanpassen','Foreign key aanmaken','ON DELETE','ON UPDATE','Index type','Kolom (lengte)','View verwijderd.','View aangepast.','View aangemaakt.','View aanpassen','View aanmaken','Naam','Proceslijst',array('%d proces gestopt.','%d processen gestopt.'),'Stoppen','IN-OUT','Parameternaam','Database schema','Procedure aanmaken','Functie aanmaken','Procedure verwijderd.','Procedure aangepast.','Procedure aangemaakt.','Functie aanpassen','Procedure aanpassen','Return type','Trigger aanmaken','Trigger verwijderd.','Trigger aangepast.','Trigger aangemaakt.','Trigger aanpassen','Trigger aanmaken','Time','Event','MySQL versie: %s met PHP extensie %s',array('%d rij','%d rijen'),'ON UPDATE CURRENT_TIMESTAMP','Verwijderen','Weet u het zeker?','Rechten','Gebruiker aanmaken','Gebruiker verwijderd.','Gebruiker aangepast.','Gebruiker aangemaakt.','Gehashed','Kolom','Routine','Toekennen','Intrekken','POST-data is te groot. Verklein de hoeveelheid data of verhoog de "post_max_size" configuratie.','Aangemeld als: %s','Omhoog','Omlaag','Functies','Totalen','Exporteren','Uitvoer','openen','opslaan','Formaat','SQL','CSV','overslaan','Tabellen','Structuur','Data','Event werd verwijderd.','Event werd aangepast.','Event werd aangemaakt.','Event aanpassen','Event aanmaken','Op aangegeven tijd','Iedere','Events','Schedule','Start','Stop','Status','Bewaren na voltooiing','Tabellen en views','Data lengte','Index lengte','Data Vrij','Collatie','Analyseer','Optimaliseer','Controleer','Herstel','Legen','Tabellen werden geleegd.','Rijen','.','Tabellen werden verplaatst.','Verplaats naar andere database','Verplaats','Engine','Opslaan en verder bewerken','dupliceer','origineel',array('%d item aangepast.','%d items aangepast.'),'volledig resultaat','Tabellen werden verwijderd.','Dupliceer');break;case"sk":$translations=array('Prihlásiť sa','phpMinAdmin','Odhlásenie prebehlo v poriadku.','Neplatné prihlasovacie údaje.','Server','Používateľ','Heslo','Vybrať databázu','Nesprávna databáza.','Vytvoriť novú databázu','Tabuľka bola odstránená.','Tabuľka bola zmenená.','Tabuľka bola vytvorená.','Zmeniť tabuľku','Vytvoriť tabuľku','Názov tabuľky','úložisko','porovnávanie','Názov stĺpca','Typ','Dĺžka','NULL','Auto Increment','Voľby','Uložiť','Odstrániť','Databáza bola odstránená.','Databáza bola vytvorená.','Databáza bola premenovaná.','Databáza bola zmenená.','Zmeniť databázu','Vytvoriť databázu','SQL príkaz','Export','Odhlásiť','databáza','Vybrať','Žiadne tabuľky.','vypísať','Vytvoriť novú tabuľku','Položka bola vymazaná.','Položka bola aktualizovaná.','Položka bola vložená.','Upraviť','Vložiť','Uložiť a vložiť ďalší','Zmazať','Databáza','Procedúry','Indexy boli zmenené.','Indexy','Zmeniť indexy','Pridať ďalší','Jazyk','Vypísať','Nová položka','Vyhľadať','Zotriediť','zostupne','Limit','Žiadne riadky.','Akcia','upraviť','Stránka',array('Príkaz prebehol v poriadku, bol zmenený %d záznam.','Príkaz prebehol v poriadku boli zmenené %d záznamy.','Príkaz prebehol v poriadku bolo zmenených %d záznamov.'),'Chyba v dotaze','Vykonať','Tabuľka','Cudzie kľúče','Triggery','Pohľad','Tabuľku sa nepodarilo vypísať','Neplatný token CSRF. Odošlite formulár znova.','Komentár','Východzie hodnoty boli nastavené.','Východzie hodnoty','BOOL','Zobraziť komentáre stĺpcov',array('%d bajt','%d bajty','%d bajtov'),'Žiadne príkazy na vykonanie.','Súbor sa nepodarilo nahrať.','Nahranie súboru','Nahrávánie súborov nie je povolené.',array('Procedúra bola zavolaná, bol zmenený %d záznam.','Procedúra bola zavolaná, boli zmenené %d záznamy.','Procedúra bola zavolaná, bolo zmenených %d záznamov.'),'Zavolať','Žiadne MySQL rozšírenie','Nie je dostupné žiadne z podporovaných rozšírení (%s).','Session premenné musia byť povolené.','Session vypršala, prihláste sa prosím znova.','Dĺžka textov','Zvýrazňovanie syntaxe','Cudzí kľúč bol odstránený.','Cudzí kľúč bol zmenený.','Cudzí kľúč bol vytvorený.','Cudzí kľúč','Cieľová tabuľka','Zmeniť','Zdroj','Cieľ','Pridať stĺpec','Zmeniť','Pridať cudzí kľúč','ON DELETE','ON UPDATE','Typ indexu','Stĺpec (dĺžka)','Pohľad bol odstránený.','Pohľad bol zmenený.','Pohľad bol vytvorený.','Zmeniť pohľad','Vytvoriť pohľad','Názov','Zoznam procesov',array('Bol ukončený %d proces.','Boli ukončené %d procesy.','Bolo ukončených %d procesov.'),'Ukončiť','IN-OUT','Názov parametra','Schéma databázy','Vytvoriť procedúru','Vytvoriť funkciu','Procedúra bola odstránená.','Procedúra bola zmenená.','Procedúra bola vytvorená.','Zmeniť funkciu','Zmeniť procedúru','Návratový typ','Pridať trigger','Trigger bol odstránený.','Trigger bol zmenený.','Trigger bol vytvorený.','Zmeniť trigger','Vytvoriť trigger','Čas','Udalosť','Verzia MySQL: %s cez PHP rozšírenie %s',array('%d riadok','%d riadky','%d riadkov'),'Pri zmene aktuálny čas','Odobrať','Naozaj?','Oprávnenia','Vytvoriť používateľa','Používateľ bol odstránený.','Používateľ bol zmenený.','Používateľ bol vytvorený.','Zahašované','Stĺpec','Procedúra','Povoliť','Zakázať','Príliš veľké POST dáta. Zmenšite dáta alebo zvýšte hodnotu konfiguračej direktívy "post_max_size".','Prihlásený ako: %s','Presunúť hore','Presunúť dolu','Funkcie','Agregácia','Export','Výstup','otvoriť','uložiť','Formát','SQL','CSV','preskočiť','Tabuľky',' truktúra','Dáta','Udalosť bola odstránená.','Udalosť bola zmenená.','Udalosť bola vytvorená.','Upraviť udalosť','Vytvoriť udalosť','V stanovený čas','Každých','Udalosti','Plán','Začiatok','Koniec','Stav','Po dokončení zachovat','Tabuľky a pohľady','Veľkosť dát','Veľkosť indexu','Voľné miesto','Porovnávanie','Analyzovať','Optimalizovať','Skontrolovať','Opraviť','Vyprázdniť','Tabuľka bola vyprázdnená','Riadky',' ','Tabuľka bola presunutá','Presunúť do inej databázy','Presunúť','Typ','Uložiť a pokračovať v úpravách','klonovať','originál','%d položiek bolo ovplyvnených.','celý výsledok','Tabuľka bola odstránená','Klonovať');break;case"zh":$translations=array('登录','phpMinAdmin','注销成功.',' 效凭据.','服务器','用户名','密 ','选择数据库',' 效数据库.','创建新数据库','已丢弃表.','已更改表.','已创建表.','更改表','创建表','表名','引擎',' 对','列名','类型','长度','NULL','自动增量','选项','保存','丢弃','已丢弃数据库.','已创建数据库.','已重命名数据库.','已更改数据库.','更改数据库','创建数据库','SQL命令','转储','注销','数据库','使用','没有表.','选择','创建新表','已 除项目.','已更新项目.','已插入项目.','编辑','插入','保存并插入下一个',' 除','数据库','子程序','已更改索引.','索引','更改索引','添 下一个','语言','选择','新项目','搜索','排序','降序','限定','没有行.','动作','编辑','页面','执行查询OK, %d 行受影响','查询出错','执行','表','外键','触发器','视图','不能选择该表',' 效 CSRF 令牌. 重新发送表单.','注释','默认值已设置.','默认值','BOOL','显示列注释','%d 字节','没有命令执行.','不能上 文件.','文件上 ','文件上 被禁用.','子程序被调用, %d 行被影响','调用','没有MySQL扩展','没有支持的 PHP 扩展可用 (%s).','会话必须被启用.','会话已过期, 请重新登录.','文本长度','语法高亮','已 除外键.','已更改外键.','已创建外键.','外键','目 表','更改','源','目 ','增 列','更改','添 外键','ON DELETE','ON UPDATE','索引类型','列 (长度)','已丢弃视图.','已更改视图.','已创建视图.','更改视图','创建视图','名称','进程列表','%d 个进程被终止','终止','IN-OUT','参数名','数据库概要','创建过程','创建函数','已丢弃子程序.','已更改子程序.','已创建子程序.','更改函数','更改过程','返回类型','创建触发器','已丢弃触发器.','已更改触发器.','已创建触发器.','更改触发器','创建触发器','时间','事件','MySQL 版本: %s 通过 PHP 扩展 %s','%d 行','ON UPDATE CURRENT_TIMESTAMP','移除',' 确定吗?','权限','创建用户','已丢弃用户.','已更改用户.','已创建用户.','Hashed','列','子程序','授权','废除','太大的 POST 数据. 减少数据或者增  "post_max_size" 配置指令.','登录为: %s','上移','下移','函数','集合','导出','输出','打开','保存',' 式','SQL','CVS','跳过','表','结构','数据','已丢弃事件.','已更改事件.','已创建事件.','更改事件','创建事件','在指定时间','每','事件','调度','开始','结束','状态','完成后保存','表和视图','数据长度','索引长度','数据空闲',' 对','分析','优化','检查','修复','清空','已清空表.','行数',',','已转移表.','转移到其它数据库','转移','引擎','保存并继续编辑','克隆','原始','%d 个项目受到影响.','全部结果','已丢弃表.','克隆');break;}function
page_header($title,$error="",$breadcrumb=array(),$title2=""){global$SELF,$LANG;header("Content-Type: text/html; charset=utf-8");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo$LANG;?>">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="robots" content="noindex" />
<title><?php echo$title.(strlen($title2)?": ".htmlspecialchars($title2):"")." - ".lang(1)." 1.9.1";?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo
preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=favicon.ico";?>" />
<link rel="stylesheet" type="text/css" href="<?php echo
preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=default.css";?>" /><?php ?>
</head>

<body>
<script type="text/javascript">
document.body.className = 'js';
function toggle(id) {
	var el = document.getElementById(id);
	el.className = (el.className == 'hidden' ? '' : 'hidden');
	return true;
}
</script>

<div id="content">
<?php

if(isset($breadcrumb)){$link=substr(preg_replace('~db=[^&]*&~','',$SELF),0,-1);echo'<p id="breadcrumb"><a href="'.(strlen($link)?htmlspecialchars($link):".").'">'.(isset($_GET["server"])?htmlspecialchars($_GET["server"]):lang(4)).'</a> &raquo; ';if(is_array($breadcrumb)){if(strlen($_GET["db"])){echo'<a href="'.htmlspecialchars(substr($SELF,0,-1)).'">'.htmlspecialchars($_GET["db"]).'</a> &raquo; ';}foreach($breadcrumb
as$key=>$val){if(strlen($val)){echo'<a href="'.htmlspecialchars("$SELF$key=").($key!="privileges"?urlencode($val):"").'">'.htmlspecialchars($val).'</a> &raquo; ';}}}echo"$title</p>\n";}echo"<h2>$title".(strlen($title2)?": ".htmlspecialchars($title2):"")."</h2>\n";if($_SESSION["messages"]){echo"<p class='message'>".implode("</p>\n<p class='message'>",$_SESSION["messages"])."</p>\n";$_SESSION["messages"]=array();}if(!$_SESSION["tokens"][$_GET["server"]]["?logout"]){$_SESSION["tokens"][$_GET["server"]]["?logout"]=rand(1,1e6);}$databases=&$_SESSION["databases"][$_GET["server"]];if(strlen($_GET["db"])&&$databases&&!in_array($_GET["db"],$databases,true)){$databases=null;}if(isset($databases)&&!isset($_GET["sql"])){session_write_close();}if($error){echo"<p class='error'>$error</p>\n";}}function
page_footer($missing=false){global$SELF,$mysql;?>
</div>

<?php switch_lang();?>
<div id="menu">
<h1><a href="http://phpminadmin.sourceforge.net"><?php echo
lang(1);?></a></h1>
<?php if($missing!="auth"){?>
<form action="" method="post">
<p>
<a href="<?php echo
htmlspecialchars($SELF);?>sql="><?php echo
lang(32);?></a>
<a href="<?php echo
htmlspecialchars($SELF);?>dump=<?php echo
urlencode(isset($_GET["table"])?$_GET["table"]:$_GET["select"]);?>"><?php echo
lang(33);?></a>
<input type="hidden" name="token" value="<?php echo$_SESSION["tokens"][$_GET["server"]]["?logout"];?>" />
<input type="submit" name="logout" value="<?php echo
lang(34);?>" />
</p>
</form>
<form action="">
<p><?php if(strlen($_GET["server"])){?><input type="hidden" name="server" value="<?php echo
htmlspecialchars($_GET["server"]);?>" /><?php }?>
<?php if(get_databases()){?>
<select name="db" onchange="this.form.submit();"><option value="">(<?php echo
lang(35);?>)</option><?php echo
optionlist(get_databases(),$_GET["db"]);?></select>
<?php }else{?>
<input name="db" value="<?php echo
htmlspecialchars($_GET["db"]);?>" /> <input type="submit" value="<?php echo
lang(36);?>" />
<?php }?>
<?php if(isset($_GET["sql"])){?><input type="hidden" name="sql" value="" /><?php }?>
<?php if(isset($_GET["schema"])){?><input type="hidden" name="schema" value="" /><?php }?>
<?php if(isset($_GET["dump"])){?><input type="hidden" name="dump" value="" /><?php }?>
</p>
<?php if(get_databases()){?>
<noscript><p><input type="submit" value="<?php echo
lang(36);?>" /></p></noscript>
<?php }?>
</form>
<?php

if($missing!="db"&&strlen($_GET["db"])){$result=$mysql->query("SHOW TABLE STATUS");if(!$result->num_rows){echo"<p class='message'>".lang(37)."</p>\n";}else{echo"<p>\n";while($row=$result->fetch_assoc()){echo'<a href="'.htmlspecialchars($SELF).'select='.urlencode($row["Name"]).'">'.lang(38).'</a> ';echo'<a href="'.htmlspecialchars($SELF).(isset($row["Rows"])?'table':'view').'='.urlencode($row["Name"]).'">'.htmlspecialchars($row["Name"])."</a><br />\n";}echo"</p>\n";}echo'<p><a href="'.htmlspecialchars($SELF).'create=">'.lang(39)."</a></p>\n";$result->free();}}?>
</div>

<?php if($_COOKIE["highlight"]=="jush"){?>
<script type="text/javascript" src="http://jush.sourceforge.net/jush.js"></script>
<script type="text/javascript">
if (typeof jush != 'undefined') {
	jush.style('http://jush.sourceforge.net/jush.css');
	jush.highlight_tag('pre');
	jush.highlight_tag('code');
}
</script>
<?php }?>

</body>
</html>
<?php
}if(extension_loaded("mysqli")){class
Min_MySQLi
extends
MySQLi{var$extension="MySQLi";function
Min_MySQLi(){$this->init();}function
connect($server,$username,$password){list($host,$port)=explode(":",$server,2);return@$this->real_connect((strlen($server)?$host:ini_get("mysqli.default_host")),(strlen("$server$username")?$username:ini_get("mysqli.default_user")),(strlen("$server$username$password")?$password:ini_get("mysqli.default_pw")),null,(strlen($port)?$port:ini_get("mysqli.default_port")));}function
result($result,$field=0){if(!$result){return
false;}$row=$result->fetch_array();return$row[$field];}}$mysql=new
Min_MySQLi;}elseif(extension_loaded("mysql")){class
Min_MySQL{var$extension="MySQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($server,$username,$password){$this->_link=@mysql_connect((strlen($server)?$server:ini_get("mysql.default_host")),(strlen("$server$username")?$username:ini_get("mysql.default_user")),(strlen("$server$username$password")?$password:ini_get("mysql.default_password")),131072);if($this->_link){$this->server_info=mysql_get_server_info($this->_link);}return(bool)$this->_link;}function
select_db($database){return
mysql_select_db($database,$this->_link);}function
query($query){$result=mysql_query($query,$this->_link);if(!$result){$this->error=mysql_error($this->_link);return
false;}elseif($result===true){$this->affected_rows=mysql_affected_rows($this->_link);return
true;}return
new
Min_MySQLResult($result);}function
multi_query($query){return$this->_result=$this->query($query);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($result,$field=0){if(!$result){return
false;}return
mysql_result($result->_result,0,$field);}function
escape_string($string){return
mysql_real_escape_string($string,$this->_link);}}class
Min_MySQLResult{var$_result,$_offset=0,$num_rows;function
Min_MySQLResult($result){$this->_result=$result;$this->num_rows=mysql_num_rows($result);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$row=mysql_fetch_field($this->_result,$this->_offset++);$row->orgtable=$row->table;$row->orgname=$row->name;$row->charsetnr=($row->blob?63:0);return$row;}function
free(){return
mysql_free_result($this->_result);}}$mysql=new
Min_MySQL;}elseif(extension_loaded("pdo_mysql")){class
Min_PDO_MySQL
extends
PDO{var$extension="PDO_MySQL",$_result,$server_info,$affected_rows,$error;function
__construct(){}function
connect($server,$username,$password){set_exception_handler('auth_error');parent::__construct("mysql:host=".str_replace(":",";port=",$server),$username,$password);restore_exception_handler();$this->setAttribute(13,array('Min_PDOStatement'));$this->server_info=$this->result($this->query("SELECT VERSION()"));return
true;}function
select_db($database){return$this->query("USE ".idf_escape($database));}function
query($query){$result=parent::query($query);if(!$result){$errorInfo=$this->errorInfo();$this->error=$errorInfo[2];return
false;}$this->_result=$result;if(!$result->columnCount()){$this->affected_rows=$result->rowCount();return
true;}$result->num_rows=$result->rowCount();return$result;}function
multi_query($query){return$this->query($query);}function
store_result(){return($this->_result->columnCount()?$this->_result:true);}function
next_result(){return$this->_result->nextRowset();}function
result($result,$field=0){if(!$result){return
false;}$row=$result->fetch();return$row[$field];}function
escape_string($string){return
substr($this->quote($string),1,-1);}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$row=(object)$this->getColumnMeta($this->_offset++);$row->orgtable=$row->table;$row->orgname=$row->name;$row->charsetnr=(in_array("blob",$row->flags)?63:0);return$row;}function
free(){}}$mysql=new
Min_PDO_MySQL;}else{page_header(lang(85),lang(86,'MySQLi, MySQL, PDO_MySQL'),null);page_footer("auth");exit;}$ignore=array("server","username","password");if(ini_get("session.use_trans_sid")&&isset($_POST[session_name()])){$ignore[]=session_name();}if(isset($_POST["server"])){if(isset($_REQUEST[session_name()])){session_regenerate_id();$_SESSION["usernames"][$_POST["server"]]=$_POST["username"];$_SESSION["passwords"][$_POST["server"]]=$_POST["password"];if(count($_POST)==count($ignore)){$location=((string)$_GET["server"]===$_POST["server"]?remove_from_uri():preg_replace('~^[^?]*/([^?]*).*~','\\1',$_SERVER["REQUEST_URI"]).(strlen($_POST["server"])?'?server='.urlencode($_POST["server"]):''));if(!isset($_COOKIE[session_name()])){$location.=(strpos($location,"?")===false?"?":"&").SID;}header("Location: ".(strlen($location)?$location:"."));exit;}}$_GET["server"]=$_POST["server"];}elseif(isset($_POST["logout"])){if($_POST["token"]!=$_SESSION["tokens"][$_GET["server"]]["?logout"]){page_header(lang(34),lang(72));page_footer("db");exit;}else{unset($_SESSION["usernames"][$_GET["server"]]);unset($_SESSION["passwords"][$_GET["server"]]);unset($_SESSION["databases"][$_GET["server"]]);$_SESSION["tokens"][$_GET["server"]]=array();redirect(substr($SELF,0,-1),lang(2));}}function
auth_error(){global$ignore;$username=$_SESSION["usernames"][$_GET["server"]];if($_POST["token"]&&!isset($username)){$_POST["token"]=token();}unset($_SESSION["usernames"][$_GET["server"]]);page_header(lang(0),(isset($username)?lang(3):(isset($_POST["server"])?lang(87):($_POST?lang(88):""))),null);?>
	<form action="" method="post">
	<table border="0" cellspacing="0" cellpadding="2">
	<tr><th><?php echo
lang(4);?></th><td><input name="server" value="<?php echo
htmlspecialchars($_GET["server"]);?>" /></td></tr>
	<tr><th><?php echo
lang(5);?></th><td><input name="username" value="<?php echo
htmlspecialchars($username);?>" /></td></tr>
	<tr><th><?php echo
lang(6);?></th><td><input type="password" name="password" /></td></tr>
	</table>
	<p>
<?php

hidden_fields($_POST,$ignore);foreach($_FILES
as$key=>$val){echo'<input type="hidden" name="files['.htmlspecialchars($key).']" value="'.($val["error"]?$val["error"]:base64_encode(file_get_contents($val["tmp_name"]))).'" />';}?>
	<input type="submit" value="<?php echo
lang(0);?>" />
	</p>
	</form>
<?php

page_footer("auth");}$username=&$_SESSION["usernames"][$_GET["server"]];if(!isset($username)){$username=$_GET["username"];}if(!isset($username)||!$mysql->connect($_GET["server"],$username,$_SESSION["passwords"][$_GET["server"]])){auth_error();exit;}unset($username);$mysql->query("SET SQL_QUOTE_SHOW_CREATE=1");if(!(strlen($_GET["db"])?$mysql->select_db($_GET["db"]):isset($_GET["sql"])||isset($_GET["dump"])||isset($_GET["database"])||isset($_GET["processlist"])||isset($_GET["privileges"])||isset($_GET["user"]))){if(strlen($_GET["db"])){unset($_SESSION["databases"][$_GET["server"]]);}if(strlen($_GET["db"])){page_header(lang(47).": ".htmlspecialchars($_GET["db"]),lang(8),false);}else{page_header(lang(7),"",null);echo'<p><a href="'.htmlspecialchars($SELF).'database=">'.lang(9)."</a></p>\n";echo'<p><a href="'.htmlspecialchars($SELF).'privileges=">'.lang(139)."</a></p>\n";echo'<p><a href="'.htmlspecialchars($SELF).'processlist=">'.lang(112)."</a></p>\n";echo"<p>".lang(134,"<b>$mysql->server_info</b>","<b>$mysql->extension</b>")."</p>\n";echo"<p>".lang(150,"<b>".htmlspecialchars($mysql->result($mysql->query("SELECT USER()")))."</b>")."</p>\n";}page_footer("db");exit;}$mysql->query("SET CHARACTER SET utf8");function
input($name,$field,$value){global$types;$name=htmlspecialchars(bracket_escape($name));if($field["type"]=="enum"){if(isset($_GET["select"])){echo' <label><input type="radio" name="fields['.$name.']" value="-1" checked="checked" /><em>'.lang(198).'</em></label>';}if($field["null"]||isset($_GET["default"])){echo' <label><input type="radio" name="fields['.$name.']" value=""'.(($field["null"]?isset($value):strlen($value))||isset($_GET["select"])?'':' checked="checked"').' />'.($field["null"]?'<em>NULL</em>':'').'</label>';}if(!isset($_GET["default"])){echo'<input type="radio" name="fields['.$name.']" value="0"'.($value===0?' checked="checked"':'').' />';}preg_match_all("~'((?:[^']+|'')*)'~",$field["length"],$matches);foreach($matches[1]as$i=>$val){$val=stripcslashes(str_replace("''","'",$val));$checked=(is_int($value)?$value==$i+1:$value===$val);echo' <label><input type="radio" name="fields['.$name.']" value="'.(isset($_GET["default"])?(strlen($val)?htmlspecialchars($val):" "):$i+1).'"'.($checked?' checked="checked"':'').' />'.htmlspecialchars($val).'</label>';}}else{$first=$field["null"]+isset($_GET["select"]);$onchange=($first?' onchange="var f = this.form[\'function['.addcslashes($name,"\r\n'\\").']\']; if ('.$first.' > f.selectedIndex) f.selectedIndex = '.$first.';"':'');$options=array("");if(!isset($_GET["default"])&&preg_match('~char|date|time~',$field["type"])){$options=(preg_match('~char~',$field["type"])?array("","md5","sha1","password","uuid"):array("","now"));}if($field["null"]){array_unshift($options,"NULL");}if(count($options)>1||isset($_GET["select"])){echo'<select name="function['.$name.']">'.(isset($_GET["select"])?'<option value="orig">'.lang(198).'</option>':'').optionlist($options,(isset($value)?(string)$_POST["function"][$name]:null)).'</select>';}if($field["type"]=="set"){preg_match_all("~'((?:[^']+|'')*)'~",$field["length"],$matches);foreach($matches[1]as$i=>$val){$val=stripcslashes(str_replace("''","'",$val));$checked=(is_int($value)?($value>>$i)&1:in_array($val,explode(",",$value),true));echo' <label><input type="checkbox" name="fields['.$name.']['.$i.']" value="'.(isset($_GET["default"])?htmlspecialchars($val):1<<$i).'"'.($checked?' checked="checked"':'').$onchange.' />'.htmlspecialchars($val).'</label>';}}elseif(strpos($field["type"],"text")!==false){echo'<textarea name="fields['.$name.']" cols="50" rows="12"'.$onchange.'>'.htmlspecialchars($value).'</textarea>';}elseif(preg_match('~binary|blob~',$field["type"])){echo(ini_get("file_uploads")?'<input type="file" name="'.$name.'"'.$onchange.' />':lang(82).' ');}else{echo'<input name="fields['.$name.']" value="'.htmlspecialchars($value).'"'.(preg_match('~^([0-9]+)(,([0-9]+))?$~',$field["length"],$match)?" maxlength='".($match[1]+($match[3]?1:0)+($match[2]&&!$field["unsigned"]?1:0))."'":($types[$field["type"]]?" maxlength='".$types[$field["type"]]."'":'')).$onchange.' />';}}}function
process_input($name,$field){global$mysql;$idf=bracket_escape($name);$value=$_POST["fields"][$idf];if($field["type"]=="enum"?$value==-1:$_POST["function"][$idf]=="orig"){return
false;}elseif($field["type"]=="enum"||$field["auto_increment"]?!strlen($value):$_POST["function"][$idf]=="NULL"){return"NULL";}elseif($field["type"]=="enum"){return(isset($_GET["default"])?"'".$mysql->escape_string($value)."'":intval($value));}elseif($field["type"]=="set"){return(isset($_GET["default"])?"'".implode(",",array_map(array($mysql,'escape_string'),(array)$value))."'":array_sum((array)$value));}elseif(preg_match('~binary|blob~',$field["type"])){$file=get_file($idf);if(!is_string($file)&&($file!=UPLOAD_ERR_NO_FILE||!$field["null"])){return
false;}return"_binary'".(is_string($file)?$mysql->escape_string($file):"")."'";}elseif($field["type"]=="timestamp"&&$value=="CURRENT_TIMESTAMP"){return$value;}elseif(preg_match('~^(now|uuid)$~',$_POST["function"][$idf])){return$_POST["function"][$idf]."()";}elseif(preg_match('~^(md5|sha1|password)$~',$_POST["function"][$idf])){return$_POST["function"][$idf]."('".$mysql->escape_string($value)."')";}else{return"'".$mysql->escape_string($value)."'";}}function
edit_type($key,$field,$collations){global$types,$unsigned,$inout;?>
<td><select name="<?php echo$key;?>[type]" onchange="type_change(this);"><?php echo
optionlist(array_keys($types),$field["type"]);?></select></td>
<td><input name="<?php echo$key;?>[length]" value="<?php echo
htmlspecialchars($field["length"]);?>" size="3" /></td>
<td><select name="<?php echo$key;?>[collation]"><option value="">(<?php echo
lang(17);?>)</option><?php echo
optionlist($collations,$field["collation"]);?></select> <select name="<?php echo$key;?>[unsigned]"><?php echo
optionlist($unsigned,$field["unsigned"]);?></select></td>
<?php
}function
process_type($field,$collate="COLLATE"){global$mysql,$enum_length,$unsigned;return" $field[type]".($field["length"]&&!preg_match('~^date|time$~',$field["type"])?"(".process_length($field["length"]).")":"").(preg_match('~int|float|double|decimal~',$field["type"])&&in_array($field["unsigned"],$unsigned)?" $field[unsigned]":"").(preg_match('~char|text|enum|set~',$field["type"])&&$field["collation"]?" $collate '".$mysql->escape_string($field["collation"])."'":"");}function
edit_fields($fields,$collations,$type="TABLE"){global$inout;?>
<tr>
<?php if($type=="PROCEDURE"){?><td><?php echo
lang(115);?></td><?php }?>
<th><?php echo($type=="TABLE"?lang(18):lang(116));?></th>
<td><?php echo
lang(19);?></td>
<td><?php echo
lang(20);?></td>
<td><?php echo
lang(23);?></td>
<?php if($type=="TABLE"){?>
<td><?php echo
lang(21);?></td>
<td><input type="radio" name="auto_increment_col" value="" /><?php echo
lang(22);?></td>
<td><?php echo
lang(73);?></td>
<?php }?>
<td><input type="image" name="add[0]" src="<?php echo
preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=plus.gif";?>" title="<?php echo
lang(52);?>" /></td>
</tr>
<?php
$column_comments=false;foreach($fields
as$i=>$field){$i++;$display=(isset($_POST["add"][$i-1])||(isset($field["field"])&&!$_POST["drop_col"][$i]));?>
<tr<?php echo($display?"":" style='display: none;'");?>>
<?php if($type=="PROCEDURE"){?><td><select name="fields[<?php echo$i;?>][inout]"><?php echo
optionlist($inout,$field["inout"]);?></select></td><?php }?>
<th><?php if($display){?><input name="fields[<?php echo$i;?>][field]" value="<?php echo
htmlspecialchars($field["field"]);?>" maxlength="64" /><?php }?><input type="hidden" name="fields[<?php echo$i;?>][orig]" value="<?php echo
htmlspecialchars($field[($_POST?"orig":"field")]);?>" /></th>
<?php edit_type("fields[$i]",$field,$collations);?>
<?php if($type=="TABLE"){?>
<td><input type="checkbox" name="fields[<?php echo$i;?>][null]" value="1"<?php if($field["null"]){?> checked="checked"<?php }?> /></td>
<td><input type="radio" name="auto_increment_col" value="<?php echo$i;?>"<?php if($field["auto_increment"]){?> checked="checked"<?php }?> /></td>
<td><input name="fields[<?php echo$i;?>][comment]" value="<?php echo
htmlspecialchars($field["comment"]);?>" maxlength="255" /></td>
<?php }?>
<td class="nowrap">
<input type="image" name="add[<?php echo$i;?>]" src="<?php echo
preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=plus.gif";?>" title="<?php echo
lang(52);?>" onclick="return !add_row(this);" />
<input type="image" name="drop_col[<?php echo$i;?>]" src="<?php echo
preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=minus.gif";?>" title="<?php echo
lang(137);?>" onclick="return !remove_row(this);" />
<input type="image" name="up[<?php echo$i;?>]" src="<?php echo
preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=up.gif";?>" title="<?php echo
lang(151);?>" />
<input type="image" name="down[<?php echo$i;?>]" src="<?php echo
preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=down.gif";?>" title="<?php echo
lang(152);?>" />
</td>
</tr>
<?php

if(strlen($field["comment"])){$column_comments=true;}}return$column_comments;}function
process_fields(&$fields){ksort($fields);$offset=0;if($_POST["up"]){$last=0;foreach($fields
as$key=>$field){if(key($_POST["up"])==$key){unset($fields[$key]);array_splice($fields,$last,0,array($field));break;}if(isset($field["field"])){$last=$offset;}$offset++;}}if($_POST["down"]){$found=false;foreach($fields
as$key=>$field){if(isset($field["field"])&&$found){unset($fields[key($_POST["down"])]);array_splice($fields,$offset,0,array($found));break;}if(key($_POST["down"])==$key){$found=$field;}$offset++;}}$fields=array_values($fields);if($_POST["add"]){array_splice($fields,key($_POST["add"]),0,array(array()));}}function
type_change($count){?>
<script type="text/javascript">
var added = '.';
function add_row(button) {
	var match = /([0-9]+)(\.[0-9]+)?/.exec(button.name)
	var x = match[0] + (match[2] ? added.substr(match[2].length) : added) + '1';
	var row = button.parentNode.parentNode;
	var row2 = row.cloneNode(true);
	var tags = row.getElementsByTagName('select');
	var tags2 = row2.getElementsByTagName('select');
	for (var i=0; tags.length > i; i++) {
		tags[i].name = tags[i].name.replace(/([0-9.]+)/, x);
		tags2[i].selectedIndex = tags[i].selectedIndex;
	}
	tags = row.getElementsByTagName('input');
	for (var i=0; tags.length > i; i++) {
		if (tags[i].name == 'auto_increment_col') {
			tags[i].value = x;
			tags[i].checked = false;
		}
		tags[i].name = tags[i].name.replace(/([0-9.]+)/, x);
		if (/\[(orig|field|comment)/.test(tags[i].name)) {
			tags[i].value = '';
		}
	}
	row.parentNode.insertBefore(row2, row);
	tags[0].focus();
	added += '0';
	return true;
}
function remove_row(button) {
	var field = button.form[button.name.replace(/drop_col(.+)/, 'fields$1[field]')];
	field.parentNode.removeChild(field);
	button.parentNode.parentNode.style.display = 'none';
	return true;
}
function type_change(type) {
	var name = type.name.substr(0, type.name.length - 6);
	type.form[name + '[collation]'].style.display = (/char|text|enum|set/.test(type.options[type.selectedIndex].text) ? '' : 'none');
	type.form[name + '[unsigned]'].style.display = (/int|float|double|decimal/.test(type.options[type.selectedIndex].text) ? '' : 'none');
}
for (var i=1; <?php echo$count;?> >= i; i++) {
	document.getElementById('form')['fields[' + i + '][type]'].onchange();
}
</script>
<?php
}function
normalize_enum($match){return"'".str_replace("'","''",addcslashes(stripcslashes(str_replace($match[0]{0}.$match[0]{0},$match[0]{0},substr($match[0],1,-1))),'\\'))."'";}function
routine($name,$type){global$mysql,$enum_length,$inout;$aliases=array("bit"=>"tinyint","bool"=>"tinyint","boolean"=>"tinyint","integer"=>"int","double precision"=>"float","real"=>"float","dec"=>"decimal","numeric"=>"decimal","fixed"=>"decimal","national char"=>"char","national varchar"=>"varchar");$type_pattern="([a-z]+)(?:\\s*\\(((?:[^'\")]*|$enum_length)+)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s]+)['\"]?)?";$pattern="\\s*(".($type=="FUNCTION"?"":implode("|",$inout)).")?\\s*(?:`((?:[^`]+|``)*)`\\s*|\\b(\\S+)\\s+)$type_pattern";$create=$mysql->result($mysql->query("SHOW CREATE $type ".idf_escape($name)),2);preg_match("~\\(((?:$pattern\\s*,?)*)\\)".($type=="FUNCTION"?"\\s*RETURNS\\s+$type_pattern":"")."\\s*(.*)~is",$create,$match);$fields=array();preg_match_all("~$pattern\\s*,?~is",$match[1],$matches,PREG_SET_ORDER);foreach($matches
as$i=>$param){$data_type=strtolower($param[4]);$fields[$i]=array("field"=>str_replace("``","`",$param[2]).$param[3],"type"=>(isset($aliases[$data_type])?$aliases[$data_type]:$data_type),"length"=>preg_replace_callback("~$enum_length~s",'normalize_enum',$param[5]),"unsigned"=>strtolower(preg_replace('~\\s+~',' ',trim("$param[7] $param[6]"))),"inout"=>strtoupper($param[1]),"collation"=>strtolower($param[8]),);}if($type!="FUNCTION"){return
array("fields"=>$fields,"definition"=>$match[10]);}$returns=array("type"=>$match[10],"length"=>$match[11],"unsigned"=>$match[13],"collation"=>$match[14]);return
array("fields"=>$fields,"returns"=>$returns,"definition"=>$match[15]);}function
dump_csv($row){foreach($row
as$key=>$val){if(preg_match("~[\"\n,]~",$val)){$row[$key]='"'.str_replace('"','""',$val).'"';}}echo
implode(",",$row)."\n";}function
dump_table($table,$style,$is_view=false){global$mysql,$max_packet,$types;if($_POST["format"]=="csv"){echo"\xef\xbb\xbf";if($style){dump_csv(array_keys(fields($table)));}}elseif($style){$result=$mysql->query("SHOW CREATE TABLE ".idf_escape($table));if($result){if($style=="DROP, CREATE"){echo"DROP ".($is_view?"VIEW":"TABLE")." ".idf_escape($table).";\n";}$create=$mysql->result($result,1);$result->free();echo($style!="CREATE, ALTER"?$create:($is_view?substr_replace($create," OR REPLACE",6,0):substr_replace($create," IF NOT EXISTS",12,0))).";\n\n";if($max_packet<1073741824){$row_size=21+strlen(idf_escape($table));foreach(fields($table)as$field){$type=$types[$field["type"]];$row_size+=5+($field["length"]?$field["length"]:$type)*(preg_match('~char|text|enum~',$field["type"])?3:1);}if($row_size>$max_packet){$max_packet=min(1073741824,1024*ceil($row_size/1024));echo"SET max_allowed_packet = $max_packet;\n";}}}if($mysql->server_info>=5){if($style=="CREATE, ALTER"&&!$is_view){$query="SELECT COLUMN_NAME, COLUMN_DEFAULT, IS_NULLABLE, COLLATION_NAME, COLUMN_TYPE, EXTRA, COLUMN_COMMENT FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '".$mysql->escape_string($table)."' ORDER BY ORDINAL_POSITION";?>
DELIMITER ;;
CREATE PROCEDURE phpminadmin_alter () BEGIN
	DECLARE _column_name, _collation_name, _column_type, after varchar(64) DEFAULT '';
	DECLARE _column_default longtext;
	DECLARE _is_nullable char(3);
	DECLARE _extra varchar(20);
	DECLARE _column_comment varchar(255);
	DECLARE done, set_after bool DEFAULT 0;
	DECLARE add_columns text DEFAULT '<?php
$fields=array();$result=$mysql->query($query);$after="";while($row=$result->fetch_assoc()){$row["default"]=(isset($row["COLUMN_DEFAULT"])?"'".$mysql->escape_string($row["COLUMN_DEFAULT"])."'":"NULL");$row["after"]=$mysql->escape_string($after);$row["alter"]=$mysql->escape_string(idf_escape($row["COLUMN_NAME"])." $row[COLUMN_TYPE]".($row["COLLATION_NAME"]?" COLLATE $row[COLLATION_NAME]":"").(isset($row["COLUMN_DEFAULT"])?" DEFAULT $row[default]":"").($row["IS_NULLABLE"]=="YES"?"":" NOT NULL").($row["EXTRA"]?" $row[EXTRA]":"").($row["COLUMN_COMMENT"]?" COMMENT '".$mysql->escape_string($row["COLUMN_COMMENT"])."'":"").($after?" AFTER ".idf_escape($after):" FIRST"));echo", ADD $row[alter]";$fields[]=$row;$after=$row["COLUMN_NAME"];}$result->free();?>';
	DECLARE columns CURSOR FOR <?php echo$query;?>;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	SET @alter_table = '';
	OPEN columns;
	REPEAT
		FETCH columns INTO _column_name, _column_default, _is_nullable, _collation_name, _column_type, _extra, _column_comment;
		IF NOT done THEN
			SET set_after = 1;
			CASE _column_name<?php
foreach($fields
as$row){echo"
				WHEN '".$mysql->escape_string($row["COLUMN_NAME"])."' THEN
					SET add_columns = REPLACE(add_columns, ', ADD $row[alter]', '');
					IF NOT (_column_default <=> $row[default]) OR _is_nullable != '$row[IS_NULLABLE]' OR _collation_name != '$row[COLLATION_NAME]' OR _column_type != '$row[COLUMN_TYPE]' OR _extra != '$row[EXTRA]' OR _column_comment != '".$mysql->escape_string($row["COLUMN_COMMENT"])."' OR after != '$row[after]' THEN
						SET @alter_table = CONCAT(@alter_table, ', MODIFY $row[alter]');
					END IF;";}?>

				ELSE
					SET @alter_table = CONCAT(@alter_table, ', DROP ', _column_name);
					SET set_after = 0;
			END CASE;
			IF set_after THEN
				SET after = _column_name;
			END IF;
		END IF;
	UNTIL done END REPEAT;
	CLOSE columns;
	IF @alter_table != '' OR add_columns != '' THEN
		SET @alter_table = CONCAT('ALTER TABLE <?php echo
idf_escape($table);?>', SUBSTR(CONCAT(add_columns, @alter_table), 2));
		PREPARE alter_command FROM @alter_table;
		EXECUTE alter_command;
		DROP PREPARE alter_command;
	END IF;
END;;
DELIMITER ;
CALL phpminadmin_alter;
DROP PROCEDURE phpminadmin_alter;

<?php
}$result=$mysql->query("SHOW TRIGGERS LIKE '".$mysql->escape_string(addcslashes($table,"%_"))."'");if($result->num_rows){echo"DELIMITER ;;\n\n";while($row=$result->fetch_assoc()){echo"CREATE TRIGGER ".idf_escape($row["Trigger"])." $row[Timing] $row[Event] ON ".idf_escape($row["Table"])." FOR EACH ROW $row[Statement];;\n\n";}echo"DELIMITER ;\n\n";}$result->free();}}}function
dump_data($table,$style,$from=""){global$mysql,$max_packet;if($style){if($_POST["format"]!="csv"&&$style=="TRUNCATE, INSERT"){echo"TRUNCATE ".idf_escape($table).";\n";}$result=$mysql->query("SELECT * ".($from?$from:"FROM ".idf_escape($table)));if($result){$insert="INSERT INTO ".idf_escape($table)." VALUES ";$length=0;while($row=$result->fetch_assoc()){if($_POST["format"]=="csv"){dump_csv($row);}elseif($style=="UPDATE"){$set=array();foreach($row
as$key=>$val){$row[$key]=(isset($val)?"'".$mysql->escape_string($val)."'":"NULL");$set[]=idf_escape($key)." = ".(isset($val)?"'".$mysql->escape_string($val)."'":"NULL");}echo"INSERT INTO ".idf_escape($table)." (".implode(", ",array_map('idf_escape',array_keys($row))).") VALUES (".implode(", ",$row).") ON DUPLICATE KEY UPDATE ".implode(", ",$set).";\n";}else{foreach($row
as$key=>$val){$row[$key]=(isset($val)?"'".$mysql->escape_string($val)."'":"NULL");}$s="(".implode(", ",$row).")";if(!$length){echo$insert,$s;$length=strlen($insert)+strlen($s);}else{$length+=2+strlen($s);if($length<$max_packet){echo", ",$s;}else{echo";\n",$insert,$s;$length=strlen($insert)+strlen($s);}}}}if($_POST["format"]!="csv"&&$style!="UPDATE"&&$result->num_rows){echo";\n";}$result->free();}}}function
dump_headers($identifier,$multi_table=false){$filename=(strlen($identifier)?preg_replace('~[^a-z0-9_]~i','-',$identifier):"dump");$ext=($_POST["format"]=="sql"?"sql":($multi_table?"tar":"csv"));header("Content-Type: ".($ext=="tar"?"application/x-tar":($ext=="sql"||$_POST["output"]!="file"?"text/plain":"text/csv"))."; charset=utf-8");header("Content-Disposition: ".($_POST["output"]=="file"?"attachment":"inline")."; filename=$filename.$ext");return$ext;}$dump_options=lang(156).": <select name='output'><option value='text'>".lang(157)."</option><option value='file'>".lang(158)."</option></select> ".lang(159).": <select name='format'><option value='sql'>".lang(160)."</option><option value='csv'>".lang(161)."</option></select>";$max_packet=0;if(isset($_GET["download"])){header("Content-Type: application/octet-stream");echo$mysql->result($mysql->query("SELECT ".idf_escape($_GET["field"])." FROM ".idf_escape($_GET["download"])." WHERE ".implode(" AND ",where($_GET))." LIMIT 1"));}else{$on_actions=array("RESTRICT","CASCADE","SET NULL","NO ACTION");$types=array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"float"=>12,"double"=>21,"decimal"=>66,"date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4,"char"=>255,"varchar"=>65535,"binary"=>255,"varbinary"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295,"enum"=>65535,"set"=>64,);$unsigned=array("","unsigned","zerofill","unsigned zerofill");$enum_length='\'(?:\'\'|[^\'\\\\]+|\\\\.)*\'|"(?:""|[^"\\\\]+|\\\\.)*"';$inout=array("IN","OUT","INOUT");$functions=array("char_length","from_unixtime","hex","lower","round","sec_to_time","time_to_sec","unix_timestamp","upper");$grouping=array("avg","count","distinct","group_concat","max","min","sum");$confirm=" onclick=\"return confirm('".lang(138)."');\"";$error="";if(isset($_GET["table"])){$result=$mysql->query("SHOW COLUMNS FROM ".idf_escape($_GET["table"]));if(!$result){$error=htmlspecialchars($mysql->error);}page_header(lang(67).": ".htmlspecialchars($_GET["table"]),$error);if($result){$table_status=table_status($_GET["table"]);$auto_increment_only=true;echo"<table border='1' cellspacing='0' cellpadding='2'>\n";while($row=$result->fetch_assoc()){if(!$row["auto_increment"]){$auto_increment_only=false;}echo"<tr><th>".htmlspecialchars($row["Field"])."</th><td>$row[Type]".($row["Null"]=="YES"?" <i>NULL</i>":"")."</td></tr>\n";}echo"</table>\n";$result->free();echo"<p>";echo'<a href="'.htmlspecialchars($SELF).'create='.urlencode($_GET["table"]).'">'.lang(13).'</a>';echo($auto_increment_only?'':' <a href="'.htmlspecialchars($SELF).'default='.urlencode($_GET["table"]).'">'.lang(75).'</a>');echo"</p>\n";echo"<h3>".lang(50)."</h3>\n";$indexes=indexes($_GET["table"]);if($indexes){echo"<table border='1' cellspacing='0' cellpadding='2'>\n";foreach($indexes
as$index){ksort($index["columns"]);$print=array();foreach($index["columns"]as$key=>$val){$print[]="<i>".htmlspecialchars($val)."</i>".($index["lengths"][$key]?"(".$index["lengths"][$key].")":"");}echo"<tr><td>$index[type]</td><td>".implode(", ",$print)."</td></tr>\n";}echo"</table>\n";}echo'<p><a href="'.htmlspecialchars($SELF).'indexes='.urlencode($_GET["table"]).'">'.lang(51)."</a></p>\n";if($table_status["Engine"]=="InnoDB"){echo"<h3>".lang(68)."</h3>\n";$foreign_keys=foreign_keys($_GET["table"]);if($foreign_keys){echo"<table border='1' cellspacing='0' cellpadding='2'>\n";foreach($foreign_keys
as$name=>$foreign_key){echo"<tr>";echo"<td><i>".implode("</i>, <i>",array_map('htmlspecialchars',$foreign_key["source"]))."</i></td>";$link=(strlen($foreign_key["db"])?"<strong>".htmlspecialchars($foreign_key["db"])."</strong>.":"").htmlspecialchars($foreign_key["table"]);echo'<td><a href="'.htmlspecialchars(strlen($foreign_key["db"])?preg_replace('~db=[^&]*~',"db=".urlencode($foreign_key["db"]),$SELF):$SELF)."table=".urlencode($foreign_key["table"])."\">$link</a>";echo"(<em>".implode("</em>, <em>",array_map('htmlspecialchars',$foreign_key["target"]))."</em>)</td>";echo'<td>'.(!strlen($foreign_key["db"])?'<a href="'.htmlspecialchars($SELF).'foreign='.urlencode($_GET["table"]).'&amp;name='.urlencode($name).'">'.lang(100).'</a>':'&nbsp;').'</td>';echo"</tr>\n";}echo"</table>\n";}echo'<p><a href="'.htmlspecialchars($SELF).'foreign='.urlencode($_GET["table"]).'">'.lang(101)."</a></p>\n";}}if($mysql->server_info>=5){echo"<h3>".lang(69)."</h3>\n";$result=$mysql->query("SHOW TRIGGERS LIKE '".$mysql->escape_string(addcslashes($_GET["table"],"%_"))."'");if($result->num_rows){echo"<table border='0' cellspacing='0' cellpadding='2'>\n";while($row=$result->fetch_assoc()){echo"<tr valign='top'><td>$row[Timing]</td><td>$row[Event]</td><th>".htmlspecialchars($row["Trigger"])."</th><td><a href=\"".htmlspecialchars($SELF).'trigger='.urlencode($_GET["table"]).'&amp;name='.urlencode($row["Trigger"]).'">'.lang(100)."</a></td></tr>\n";}echo"</table>\n";}$result->free();echo'<p><a href="'.htmlspecialchars($SELF).'trigger='.urlencode($_GET["table"]).'">'.lang(126)."</a></p>\n";}}elseif(isset($_GET["view"])){page_header(lang(70).": ".htmlspecialchars($_GET["view"]));$view=view($_GET["view"]);echo"<pre class='jush-sql'>".htmlspecialchars($view["select"])."</pre>\n";echo'<p><a href="'.htmlspecialchars($SELF).'createv='.urlencode($_GET["view"]).'">'.lang(109)."</a></p>\n";}elseif(isset($_GET["schema"])){page_header(lang(117),"",array(),$_GET["db"]);$table_pos=array();$table_pos_js=array();preg_match_all('~([^:]+):([-0-9.]+)x([-0-9.]+)(_|$)~',$_COOKIE["schema"],$matches,PREG_SET_ORDER);foreach($matches
as$i=>$match){$table_pos[$match[1]]=array($match[2],$match[3]);$table_pos_js[]="\n\t'".addcslashes($match[1],"\r\n'\\")."': [ $match[2], $match[3] ]";}$top=0;$base_left=-1;$schema=array();$referenced=array();$lefts=array();$result=$mysql->query("SHOW TABLE STATUS");while($row=$result->fetch_assoc()){if(!isset($row["Engine"])){continue;}$pos=0;$schema[$row["Name"]]["fields"]=array();foreach(fields($row["Name"])as$name=>$field){$pos+=1.25;$field["pos"]=$pos;$schema[$row["Name"]]["fields"][$name]=$field;}$schema[$row["Name"]]["pos"]=($table_pos[$row["Name"]]?$table_pos[$row["Name"]]:array($top,0));if($row["Engine"]=="InnoDB"){foreach(foreign_keys($row["Name"])as$val){if(!$val["db"]){$left=$base_left;if($table_pos[$row["Name"]][1]||$table_pos[$row["Name"]][1]){$left=min($table_pos[$row["Name"]][1],$table_pos[$val["table"]][1])-1;}else{$base_left-=.1;}while($lefts[(string)$left]){$left-=.0001;}$schema[$row["Name"]]["references"][$val["table"]][(string)$left]=array_combine($val["source"],$val["target"]);$referenced[$val["table"]][$row["Name"]][(string)$left]=$val["target"];$lefts[(string)$left]=true;}}}$top=max($top,$schema[$row["Name"]]["pos"][0]+2.5+$pos);}$result->free();?>
<script type="text/javascript">
var that, x, y, em;
var table_pos = {<?php echo
implode(",",$table_pos_js)."\n";?>};

function mousedown(el, event) {
	that = el;
	em = document.getElementById('schema').offsetHeight / <?php echo$top;?>;
	x = event.clientX - el.offsetLeft;
	y = event.clientY - el.offsetTop;
}
document.onmousemove = function (ev) {
	if (that !== undefined) {
		ev = ev || event;
		var left = (ev.clientX - x) / em;
		var top = (ev.clientY - y) / em;
		var divs = that.getElementsByTagName('div');
		var line_set = { };
		for (var i=0; divs.length > i; i++) {
			if (divs[i].className == 'references') {
				var div2 = document.getElementById((divs[i].id.substr(0, 4) == 'refs' ? 'refd' : 'refs') + divs[i].id.substr(4));
				var ref = (table_pos[divs[i].title] ? table_pos[divs[i].title] : [ div2.parentNode.offsetTop / em, 0 ]);
				var left1 = -1;
				var is_top = true;
				var id = divs[i].id.replace(/^ref.(.+)-.+/, '$1');
				if (divs[i].parentNode != div2.parentNode) {
					left1 = Math.min(0, ref[1] - left) - 1;
					divs[i].style.left = left1 + 'em';
					divs[i].getElementsByTagName('div')[0].style.width = -left1 + 'em';
					var left2 = Math.min(0, left - ref[1]) - 1;
					div2.style.left = left2 + 'em';
					div2.getElementsByTagName('div')[0].style.width = -left2 + 'em';
					is_top = (div2.offsetTop + ref[0] * em > divs[i].offsetTop + top * em);
				}
				if (!line_set[id]) {
					var line = document.getElementById(divs[i].id.replace(/^....(.+)-[0-9]+$/, 'refl$1'));
					var shift = ev.clientY - y - that.offsetTop;
					line.style.left = (left + left1) + 'em';
					if (is_top) {
						line.style.top = (line.offsetTop + shift) / em + 'em';
					}
					if (divs[i].parentNode != div2.parentNode) {
						line = line.getElementsByTagName('div')[0];
						line.style.height = (line.offsetHeight + (is_top ? -1 : 1) * shift) / em + 'em';
					}
					line_set[id] = true;
				}
			}
		}
		that.style.left = left + 'em';
		that.style.top = top + 'em';
	}
}
document.onmouseup = function (ev) {
	if (that !== undefined) {
		ev = ev || event;
		table_pos[that.firstChild.firstChild.firstChild.data] = [ (ev.clientY - y) / em, (ev.clientX - x) / em ];
		that = undefined;
		var date = new Date();
		date.setMonth(date.getMonth() + 1);
		var s = '';
		for (var key in table_pos) {
			s += '_' + key + ':' + Math.round(table_pos[key][0] * 10000) / 10000 + 'x' + Math.round(table_pos[key][1] * 10000) / 10000;
		}
		document.cookie = 'schema=' + encodeURIComponent(s.substr(1)) + '; expires=' + date + '; path=' + location.pathname + location.search;
	}
}
</script>

<div id="schema" style="height: <?php echo$top;?>em;">
<?php
foreach($schema
as$name=>$table){echo"<div class='table' style='top: ".$table["pos"][0]."em; left: ".$table["pos"][1]."em;' onmousedown='mousedown(this, event);'>";echo'<a href="'.htmlspecialchars($SELF).'table='.urlencode($name).'"><strong>'.htmlspecialchars($name)."</strong></a><br />\n";foreach($table["fields"]as$field){$val=htmlspecialchars($field["field"]);if(preg_match('~char|text~',$field["type"])){$val="<span class='char'>$val</span>";}elseif(preg_match('~date|time|year~',$field["type"])){$val="<span class='date'>$val</span>";}elseif(preg_match('~binary|blob~',$field["type"])){$val="<span class='binary'>$val</span>";}elseif(preg_match('~enum|set~',$field["type"])){$val="<span class='enum'>$val</span>";}echo($field["primary"]?"<em>$val</em>":$val)."<br />\n";}foreach((array)$table["references"]as$target_name=>$refs){foreach($refs
as$left=>$columns){$left1=$left-$table_pos[$name][1];$i=0;foreach($columns
as$source=>$target){echo'<div class="references" title="'.htmlspecialchars($target_name)."\" id='refs$left-".($i++)."' style='left: $left1"."em; top: ".$table["fields"][$source]["pos"]."em; padding-top: .5em;'><div style='border-top: 1px solid Gray; width: ".(-$left1)."em;'></div></div>\n";}}}foreach((array)$referenced[$name]as$target_name=>$refs){foreach($refs
as$left=>$columns){$left1=$left-$table_pos[$name][1];$i=0;foreach($columns
as$target){echo'<div class="references" title="'.htmlspecialchars($target_name)."\" id='refd$left-".($i++)."' style='left: $left1"."em; top: ".$table["fields"][$target]["pos"]."em; height: 1.25em; background: url(".preg_replace("~\\?.*~","",$_SERVER["REQUEST_URI"])."?file=arrow.gif) no-repeat right center;'><div style='height: .5em; border-bottom: 1px solid Gray; width: ".(-$left1)."em;'></div></div>\n";}}}echo"</div>\n";}foreach($schema
as$name=>$table){foreach((array)$table["references"]as$target_name=>$refs){foreach($refs
as$left=>$ref){$min_pos=$top;$max_pos=-10;foreach($ref
as$source=>$target){$pos1=$table["pos"][0]+$table["fields"][$source]["pos"];$pos2=$schema[$target_name]["pos"][0]+$schema[$target_name]["fields"][$target]["pos"];$min_pos=min($min_pos,$pos1,$pos2);$max_pos=max($max_pos,$pos1,$pos2);}echo"<div class='references' id='refl$left' style='left: $left"."em; top: $min_pos"."em; padding: .5em 0;' /><div style='border-right: 1px solid Gray; margin-top: 1px; height: ".($max_pos-$min_pos)."em;'></div></div>\n";}}}?>
</div>
<?php
}elseif(isset($_GET["dump"])){function
tar_file($filename,$contents){$return=pack("a100a8a8a8a12a12",$filename,644,0,0,decoct(strlen($contents)),decoct(time()));$checksum=8*32;for($i=0;$i<strlen($return);$i++){$checksum+=ord($return{$i});}$return.=sprintf("%06o",$checksum)."\0 ";return$return.str_repeat("\0",512-strlen($return)).$contents.str_repeat("\0",511-(strlen($contents)+511)%
512);}if($_POST){$ext=dump_headers((strlen($_GET["dump"])?$_GET["dump"]:$_GET["db"]),(!strlen($_GET["db"])||count(array_filter($_POST["tables"])+array_filter($_POST["data"]))>1));if($_POST["format"]!="csv"){$max_packet=16777216;echo"SET NAMES utf8;\n";echo"SET foreign_key_checks = 0;\n";echo"SET time_zone = '".$mysql->escape_string($mysql->result($mysql->query("SELECT @@time_zone")))."';\n";echo"SET max_allowed_packet = $max_packet;\n";echo"\n";}foreach($_POST["databases"]as$db=>$style){$db=bracket_escape($db,"back");if($mysql->select_db($db)){if($_POST["format"]!="csv"&&ereg('CREATE',$style)&&($result=$mysql->query("SHOW CREATE DATABASE ".idf_escape($db)))){if($style=="DROP, CREATE"){echo"DROP DATABASE IF EXISTS ".idf_escape($db).";\n";}$create=$mysql->result($result,1);echo($style=="CREATE, ALTER"?preg_replace('~^CREATE DATABASE ~','\\0IF NOT EXISTS ',$create):$create).";\n";$result->free();}if($style&&$_POST["format"]!="csv"){echo"USE ".idf_escape($db).";\n\n";$out="";if($mysql->server_info>=5){foreach(array("FUNCTION","PROCEDURE")as$routine){$result=$mysql->query("SHOW $routine STATUS WHERE Db = '".$mysql->escape_string($db)."'");while($row=$result->fetch_assoc()){$out.=$mysql->result($mysql->query("SHOW CREATE $routine ".idf_escape($row["Name"])),2).";;\n\n";}$result->free();}}if($mysql->server_info>=5.1){$result=$mysql->query("SHOW EVENTS");while($row=$result->fetch_assoc()){$out.=$mysql->result($mysql->query("SHOW CREATE EVENT ".idf_escape($row["Name"])),3).";;\n\n";}$result->free();}echo($out?"DELIMITER ;;\n\n$out"."DELIMITER ;\n\n":"");}if(($style||strlen($_GET["db"]))&&(array_filter($_POST["tables"])||array_filter($_POST["data"]))){$views=array();$result=$mysql->query("SHOW TABLE STATUS");while($row=$result->fetch_assoc()){$key=(strlen($_GET["db"])?bracket_escape($row["Name"]):0);if($_POST["tables"][$key]||$_POST["data"][$key]){if(isset($row["Engine"])){if($ext=="tar"){ob_start();}dump_table($row["Name"],$_POST["tables"][$key]);dump_data($row["Name"],$_POST["data"][$key]);if($ext=="tar"){echo
tar_file((strlen($_GET["db"])?"":"$db/")."$row[Name].csv",ob_get_clean());}elseif($_POST["format"]!="csv"){echo"\n";}}elseif($_POST["format"]!="csv"){$views[$row["Name"]]=$_POST["tables"][$key];}}}$result->free();foreach($views
as$view=>$style1){dump_table($view,$style1,true);}}if($mysql->server_info>=5&&$style=="CREATE, ALTER"&&$_POST["format"]!="csv"){$query="SELECT TABLE_NAME, ENGINE, TABLE_COLLATION, TABLE_COMMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE()";?>
DELIMITER ;;
CREATE PROCEDURE phpminadmin_drop () BEGIN
	DECLARE _table_name, _engine, _table_collation varchar(64);
	DECLARE _table_comment varchar(64);
	DECLARE done bool DEFAULT 0;
	DECLARE tables CURSOR FOR <?php echo$query;?>;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
	OPEN tables;
	REPEAT
		FETCH tables INTO _table_name, _engine, _table_collation, _table_comment;
		IF NOT done THEN
			CASE _table_name<?php
$result=$mysql->query($query);while($row=$result->fetch_assoc()){$comment=$mysql->escape_string($row["ENGINE"]=="InnoDB"?preg_replace('~(?:(.+); )?InnoDB free: .*~','\\1',$row["TABLE_COMMENT"]):$row["TABLE_COMMENT"]);echo"
				WHEN '".$mysql->escape_string($row["TABLE_NAME"])."' THEN
					".(isset($row["ENGINE"])?"IF _engine != '$row[ENGINE]' OR _table_collation != '$row[TABLE_COLLATION]' OR _table_comment != '$comment' THEN
						ALTER TABLE ".idf_escape($row["TABLE_NAME"])." ENGINE=$row[ENGINE] COLLATE=$row[TABLE_COLLATION] COMMENT='$comment';
					END IF":"BEGIN END").";";}$result->free();?>

				ELSE
					SET @alter_table = CONCAT('DROP TABLE `', REPLACE(_table_name, '`', '``'), '`');
					PREPARE alter_command FROM @alter_table;
					EXECUTE alter_command; -- returns "can't return a result set in the given context" with MySQL extension
					DROP PREPARE alter_command;
			END CASE;
		END IF;
	UNTIL done END REPEAT;
	CLOSE tables;
END;;
DELIMITER ;
CALL phpminadmin_drop;
DROP PROCEDURE phpminadmin_drop;
<?php
}}}exit;}page_header(lang(155),"",(strlen($_GET["export"])?array("table"=>$_GET["export"]):array()),$_GET["db"]);?>

<script type="text/javascript">
function check(td, name, value) {
	var inputs = td.parentNode.parentNode.parentNode.getElementsByTagName('input');
	for (var i=0; inputs.length > i; i++) {
		if (name.test(inputs[i].name)) {
			inputs[i].checked = (inputs[i].value == value);
		}
	}
}
</script>

<form action="" method="post">
<p><?php echo$dump_options;?></p>

<?php
echo"<table border='1' cellspacing='0' cellpadding='2'>\n<thead><tr><th>".lang(47)."</th>";foreach(array('','USE','DROP, CREATE','CREATE','CREATE, ALTER')as$val){echo"<th onclick=\"check(this, /^databases/, '$val');\" style='cursor: pointer;'>".($val?$val:lang(162))."</th>";}echo"</tr></thead>\n";foreach((strlen($_GET["db"])?array($_GET["db"]):get_databases())as$db){if($db!="information_schema"||$mysql->server_info<5){echo"<tr><td>".htmlspecialchars($db)."</td>";foreach(array('','USE','DROP, CREATE','CREATE','CREATE, ALTER')as$val){echo'<td><input type="radio" name="databases['.htmlspecialchars(bracket_escape($db)).']"'.($val==(strlen($_GET["db"])?'':'CREATE')?" checked='checked'":"")." value='$val' /></td>";}echo"</tr>\n";}}echo"</table>\n";echo"<table border='1' cellspacing='0' cellpadding='2'>\n<thead><tr><th rowspan='2'>".lang(163)."</th><th colspan='4'>".lang(164)."</th><th colspan='4'>".lang(165)."</th></tr><tr>";foreach(array('','DROP, CREATE','CREATE','CREATE, ALTER')as$val){echo"<th onclick=\"check(this, /^tables/, '$val');\" style='cursor: pointer;'>".($val?$val:lang(162))."</th>";}foreach(array('','TRUNCATE, INSERT','INSERT','UPDATE')as$val){echo"<th onclick=\"check(this, /^data/, '$val');\" style='cursor: pointer;'".($val=='UPDATE'?" title='INSERT INTO ... ON DUPLICATE KEY UPDATE'":"").">".($val?$val:lang(162))."</th>";}echo"</tr></thead>\n";$views="";$result=$mysql->query(strlen($_GET["db"])?"SHOW TABLE STATUS":"SELECT 'Engine'");while($row=$result->fetch_assoc()){$print="<tr><td>".htmlspecialchars($row["Name"])."</td>";foreach(array('','DROP, CREATE','CREATE','CREATE, ALTER')as$val){$print.='<td><input type="radio" name="tables['.htmlspecialchars(bracket_escape($row["Name"])).']"'.($val==(strlen($_GET["dump"])&&$row["Name"]!=$_GET["dump"]?'':'DROP, CREATE')?" checked='checked'":"")." value='$val' /></td>";}if(!$row["Engine"]){$views.="$print</tr>\n";}else{foreach(array('','TRUNCATE, INSERT','INSERT','UPDATE')as$val){$print.='<td><input type="radio" name="data['.htmlspecialchars(bracket_escape($row["Name"])).']"'.($val==((strlen($_GET["dump"])&&$row["Name"]!=$_GET["dump"])||!$row["Engine"]?'':'INSERT')?" checked='checked'":"")." value='$val' /></td>";}echo"$print</tr>\n";}}echo"$views</table>\n";?>
<p><input type="submit" value="<?php echo
lang(155);?>" /></p>
</form>
<?php
}elseif(isset($_GET["privileges"])){page_header(lang(139));echo'<p><a href="'.htmlspecialchars($SELF).'user=">'.lang(140)."</a></p>";$result=$mysql->query("SELECT User, Host FROM mysql.user ORDER BY Host, User");if(!$result){?>
	<form action=""><p>
	<?php if(strlen($_GET["server"])){?><input type="hidden" name="server" value="<?php echo
htmlspecialchars($_GET["server"]);?>" /><?php }?>
	<?php echo
lang(5);?>: <input name="user" />
	<?php echo
lang(4);?>: <input name="host" value="localhost" />
	<input type="hidden" name="grant" value="" />
	<input type="submit" value="<?php echo
lang(43);?>" />
	</p></form>
<?php
$result=$mysql->query("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1) AS User, SUBSTRING_INDEX(CURRENT_USER, '@', -1) AS Host");}echo"<table border='1' cellspacing='0' cellpadding='2'>\n";echo"<thead><tr><th>&nbsp;</th><th>".lang(5)."</th><th>".lang(4)."</th></tr></thead>\n";while($row=$result->fetch_assoc()){echo'<tr><td><a href="'.htmlspecialchars($SELF).'user='.urlencode($row["User"]).'&amp;host='.urlencode($row["Host"]).'">'.lang(62).'</a></td><td>'.htmlspecialchars($row["User"])."</td><td>".htmlspecialchars($row["Host"])."</td></tr>\n";}echo"</table>\n";$result->free();}else{if($_POST){if(!in_array($_POST["token"],(array)$TOKENS)){$error=lang(72);}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$error=lang(149);}$token=($_POST&&!$error?$_POST["token"]:token());if(isset($_GET["default"])){$_GET["edit"]=$_GET["default"];}if(isset($_GET["select"])&&$_POST&&(!$_POST["delete"]&&!$_POST["export"]&&!$_POST["save"])){$_GET["edit"]=$_GET["select"];}if(isset($_GET["callf"])){$_GET["call"]=$_GET["callf"];}if(isset($_GET["function"])){$_GET["procedure"]=$_GET["function"];}if(isset($_GET["clone"])){$_GET["edit"]=$_GET["clone"];}if(isset($_GET["sql"])){if(isset($_POST["query"])){setcookie("highlight",$_POST["highlight"],strtotime("+1 month"),preg_replace('~\\?.*~','',$_SERVER["REQUEST_URI"]));$_COOKIE["highlight"]=$_POST["highlight"];}page_header(lang(32),$error);if(!$error&&$_POST){if(is_string($query=(isset($_POST["query"])?$_POST["query"]:get_file("sql_file")))){@set_time_limit(0);$delimiter=";";$offset=0;$empty=true;$space="(\\s+|/\\*.*\\*/|(#|-- )[^\n]*\n|--\n)";while(rtrim($query)){if(!$offset&&preg_match('~^\\s*DELIMITER\\s+(.+)~i',$query,$match)){$delimiter=$match[1];$query=substr($query,strlen($match[0]));}elseif(preg_match('('.preg_quote($delimiter).'|[\'`"]|/\\*|-- |#|$)',$query,$match,PREG_OFFSET_CAPTURE,$offset)){if($match[0][0]&&$match[0][0]!=$delimiter){$pattern=($match[0][0]=="-- "||$match[0][0]=="#"?'~.*~':($match[0][0]=="/*"?'~.*\\*/~sU':'~\\G([^\\\\'.$match[0][0].']+|\\\\.)*('.$match[0][0].'|$)~s'));preg_match($pattern,$query,$match,PREG_OFFSET_CAPTURE,$match[0][1]+1);$offset=$match[0][1]+strlen($match[0][0]);}else{$empty=false;echo"<pre class='jush-sql'>".htmlspecialchars(substr($query,0,$match[0][1]))."</pre>\n";flush();if(!$mysql->multi_query(substr($query,0,$match[0][1]))){echo"<p class='error'>".lang(65).": ".htmlspecialchars($mysql->error)."</p>\n";}else{do{$result=$mysql->store_result();if(is_object($result)){select($result);}else{if(preg_match("~^$space*(CREATE|DROP)$space+(DATABASE|SCHEMA)\\b~isU",$query)){unset($_SESSION["databases"][$_GET["server"]]);}echo"<p class='message'>".lang(64,$mysql->affected_rows)."</p>\n";}}while($mysql->next_result());}$query=substr($query,$match[0][1]+strlen($match[0][0]));$offset=0;}}}if($empty){echo"<p class='message'>".lang(79)."</p>\n";}}else{echo"<p class='error'>".lang(80)."</p>\n";}}?>

<form action="" method="post">
<p><textarea name="query" rows="20" cols="80" style="width: 98%;"><?php echo
htmlspecialchars($_POST?$_POST["query"]:$_GET["sql"]);?></textarea></p>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(66);?>" />
<script type="text/javascript">// <![CDATA[
document.write('<label><input type="checkbox" name="highlight" value="jush"<?php echo($_COOKIE["highlight"]=="jush"?' checked="checked"':'');?> /><?php echo
addcslashes(lang(90),"\r\n'\\");?></label>');
// ]]></script>
</p>
</form>

<?php
if(!ini_get("file_uploads")){echo"<p>".lang(82)."</p>\n";}else{?>
<form action="" method="post" enctype="multipart/form-data">
<p>
<?php echo
lang(81);?>: <input type="file" name="sql_file" />
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(66);?>" />
</p>
</form>
<?php }}elseif(isset($_GET["edit"])){$where=(isset($_GET["select"])?array():where($_GET));$update=($where&&!$_GET["clone"]);$fields=fields($_GET["edit"]);foreach($fields
as$name=>$field){if(isset($_GET["default"])?$field["auto_increment"]||preg_match('~text|blob~',$field["type"]):!isset($field["privileges"][$update?"update":"insert"])){unset($fields[$name]);}}if($_POST&&!$error&&!isset($_GET["select"])){$location=($_POST["insert"]?$_SERVER["REQUEST_URI"]:$SELF.(isset($_GET["default"])?"table=":"select=").urlencode($_GET["edit"]));if(isset($_POST["delete"])){query_redirect("DELETE FROM ".idf_escape($_GET["edit"])." WHERE ".implode(" AND ",$where)." LIMIT 1",$location,lang(40));}else{$set=array();foreach($fields
as$name=>$field){$val=process_input($name,$field);if($val!==false){if(!isset($_GET["default"])){$set[]=idf_escape($name)." = $val";}elseif($field["type"]=="timestamp"){$set[]=" MODIFY ".idf_escape($name)." timestamp".($field["null"]?" NULL":"")." DEFAULT $val".($_POST["on_update"][bracket_escape($name)]?" ON UPDATE CURRENT_TIMESTAMP":"");}else{$set[]=" ALTER ".idf_escape($name).($val==($field["null"]||$field["type"]=="enum"?"NULL":"''")?" DROP DEFAULT":" SET DEFAULT $val");}}}if(!$set){redirect($location);}if(isset($_GET["default"])){query_redirect("ALTER TABLE ".idf_escape($_GET["edit"]).implode(",",$set),$location,lang(74));}elseif($update){query_redirect("UPDATE ".idf_escape($_GET["edit"])." SET ".implode(", ",$set)." WHERE ".implode(" AND ",$where)." LIMIT 1",$location,lang(41));}else{query_redirect("INSERT INTO ".idf_escape($_GET["edit"])." SET ".implode(", ",$set),$location,lang(42));}}}page_header((isset($_GET["default"])?lang(75):($_GET["where"]||isset($_GET["select"])?lang(43):lang(44))),$error,array((isset($_GET["default"])?"table":"select")=>$_GET["edit"]),$_GET["edit"]);unset($row);if($_POST){$row=(array)$_POST["fields"];}elseif($where){$select=array();foreach($fields
as$name=>$field){if(isset($field["privileges"]["select"])&&!preg_match('~binary|blob~',$field["type"])&&(!$_GET["clone"]||!$field["auto_increment"])){$select[]=($field["type"]=="enum"||$field["type"]=="set"?"1*".idf_escape($name)." AS ":"").idf_escape($name);}}$row=array();if($select){$result=$mysql->query("SELECT ".implode(", ",$select)." FROM ".idf_escape($_GET["edit"])." WHERE ".implode(" AND ",$where)." LIMIT 1");$row=$result->fetch_assoc();$result->free();}}?>

<form action="" method="post" enctype="multipart/form-data">
<?php
if($fields){unset($create);echo"<table border='0' cellspacing='0' cellpadding='2'>\n";foreach($fields
as$name=>$field){echo"<tr><th>".htmlspecialchars($name)."</th><td>";$value=(!isset($row)?$field["default"]:(strlen($row[$name])&&($field["type"]=="enum"||$field["type"]=="set")?intval($row[$name]):($_POST["clone"]&&$field["auto_increment"]?"":$row[$name])));input($name,$field,$value);if(isset($_GET["default"])&&$field["type"]=="timestamp"){if(!isset($create)&&!$_POST){$create=$mysql->result($mysql->query("SHOW CREATE TABLE ".idf_escape($_GET["edit"])),1);}$checked=($_POST?$_POST["on_update"][bracket_escape($name)]:preg_match("~\n\\s*".preg_quote(idf_escape($name),'~')." timestamp.* on update CURRENT_TIMESTAMP~i",$create));echo'<label><input type="checkbox" name="on_update['.htmlspecialchars(bracket_escape($name)).']" value="1"'.($checked?' checked="checked"':'').' />'.lang(136).'</label>';}echo"</td></tr>\n";}echo"</table>\n";}?>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<?php
if(isset($_GET["select"])){hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo"<input type='hidden' name='save' value='1' />\n";}if($fields){?>
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(!isset($_GET["default"])&&!isset($_GET["select"])){?><input type="submit" name="insert" value="<?php echo($update?lang(196):lang(45));?>" /><?php }?>
<?php }?>
<?php if($update){?> <input type="submit" name="delete" value="<?php echo
lang(46);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["create"])){if(strlen($_GET["create"])){$orig_fields=fields($_GET["create"]);}if($_POST&&!$error&&!$_POST["add"]&&!$_POST["drop_col"]&&!$_POST["up"]&&!$_POST["down"]){if($_POST["drop"]){query_redirect("DROP TABLE ".idf_escape($_GET["create"]),substr($SELF,0,-1),lang(10));}else{$auto_increment_index=" PRIMARY KEY";if(strlen($_GET["create"])&&strlen($_POST["fields"][$_POST["auto_increment_col"]]["orig"])){foreach(indexes($_GET["create"])as$index){foreach($index["columns"]as$column){if($column===$_POST["fields"][$_POST["auto_increment_col"]]["orig"]){$auto_increment_index="";break
2;}}if($index["type"]=="PRIMARY"){$auto_increment_index=" UNIQUE";}}}$fields=array();ksort($_POST["fields"]);$after="FIRST";foreach($_POST["fields"]as$key=>$field){if(strlen($field["field"])&&isset($types[$field["type"]])){$fields[]=(!strlen($_GET["create"])?"":(strlen($field["orig"])?"CHANGE ".idf_escape($field["orig"])." ":"ADD ")).idf_escape($field["field"]).process_type($field).($field["null"]?" NULL":" NOT NULL").(strlen($_GET["create"])&&strlen($field["orig"])&&strlen($orig_fields[$field["orig"]]["default"])&&$field["type"]!="timestamp"?" DEFAULT '".$mysql->escape_string($orig_fields[$field["orig"]]["default"])."'":"").($key==$_POST["auto_increment_col"]?" AUTO_INCREMENT$auto_increment_index":"")." COMMENT '".$mysql->escape_string($field["comment"])."'".(strlen($_GET["create"])?" $after":"");$after="AFTER ".idf_escape($field["field"]);}elseif(strlen($field["orig"])){$fields[]="DROP ".idf_escape($field["orig"]);}}$status=($_POST["Engine"]?" ENGINE='".$mysql->escape_string($_POST["Engine"])."'":"").($_POST["Collation"]?" COLLATE '".$mysql->escape_string($_POST["Collation"])."'":"").(strlen($_POST["Auto_increment"])?" AUTO_INCREMENT=".intval($_POST["Auto_increment"]):"")." COMMENT='".$mysql->escape_string($_POST["Comment"])."'";$location=$SELF."table=".urlencode($_POST["name"]);if(strlen($_GET["create"])){query_redirect("ALTER TABLE ".idf_escape($_GET["create"])." ".implode(", ",$fields).", RENAME TO ".idf_escape($_POST["name"]).", $status",$location,lang(11));}else{query_redirect("CREATE TABLE ".idf_escape($_POST["name"])." (".implode(", ",$fields).")$status",$location,lang(12));}}}page_header((strlen($_GET["create"])?lang(13):lang(14)),$error,array("table"=>$_GET["create"]),$_GET["create"]);$engines=array();$result=$mysql->query("SHOW ENGINES");while($row=$result->fetch_assoc()){if($row["Support"]=="YES"||$row["Support"]=="DEFAULT"){$engines[]=$row["Engine"];}}$result->free();if($_POST){$row=$_POST;if($row["auto_increment_col"]){$row["fields"][$row["auto_increment_col"]]["auto_increment"]=true;}process_fields($row["fields"]);}elseif(strlen($_GET["create"])){$row=table_status($_GET["create"]);table_comment($row);$row["name"]=$_GET["create"];$row["fields"]=array_values($orig_fields);}else{$row=array("fields"=>array(array("field"=>"")));}$collations=collations();?>

<form action="" method="post" id="form">
<p>
<?php echo
lang(15);?>: <input name="name" maxlength="64" value="<?php echo
htmlspecialchars($row["name"]);?>" />
<select name="Engine"><option value="">(<?php echo
lang(16);?>)</option><?php echo
optionlist($engines,$row["Engine"]);?></select>
<select name="Collation"><option value="">(<?php echo
lang(17);?>)</option><?php echo
optionlist($collations,$row["Collation"]);?></select>
<input type="submit" value="<?php echo
lang(24);?>" />
</p>
<table border="0" cellspacing="0" cellpadding="2">
<?php $column_comments=edit_fields($row["fields"],$collations);?>
</table>
<?php echo
type_change(count($row["fields"]));?>
<p>
<?php echo
lang(22);?>: <input name="Auto_increment" size="4" value="<?php echo
intval($row["Auto_increment"]);?>" />
<?php echo
lang(73);?>: <input name="Comment" value="<?php echo
htmlspecialchars($row["Comment"]);?>" maxlength="60" />
<script type="text/javascript">// <![CDATA[
document.write('<label><input type="checkbox"<?php if($column_comments){?> checked="checked"<?php }?> onclick="column_comments_click(this.checked);" /><?php echo
lang(77);?></label>');
function column_comments_click(checked) {
	var trs = document.getElementsByTagName('tr');
	for (var i=0; i < trs.length; i++) {
		trs[i].getElementsByTagName('td')[5].style.display = (checked ? '' : 'none');
	}
}
<?php if(!$column_comments){?>column_comments_click(false);<?php }?>
// ]]></script>
</p>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(strlen($_GET["create"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["indexes"])){$index_types=array("PRIMARY","UNIQUE","INDEX","FULLTEXT");$indexes=indexes($_GET["indexes"]);if($_POST&&!$error&&!$_POST["add"]){$alter=array();foreach($_POST["indexes"]as$index){if(in_array($index["type"],$index_types)){$columns=array();$lengths=array();$set=array();ksort($index["columns"]);foreach($index["columns"]as$key=>$column){if(strlen($column)){$length=$index["lengths"][$key];$set[]=idf_escape($column).($length?"(".intval($length).")":"");$columns[count($columns)+1]=$column;$lengths[count($lengths)+1]=($length?$length:null);}}if($columns){foreach($indexes
as$name=>$existing){ksort($existing["columns"]);ksort($existing["lengths"]);if($index["type"]==$existing["type"]&&$existing["columns"]===$columns&&$existing["lengths"]===$lengths){unset($indexes[$name]);continue
2;}}$alter[]="ADD $index[type]".($index["type"]=="PRIMARY"?" KEY":"")." (".implode(", ",$set).")";}}}foreach($indexes
as$name=>$existing){$alter[]="DROP INDEX ".idf_escape($name);}if(!$alter){redirect($SELF."table=".urlencode($_GET["indexes"]));}query_redirect("ALTER TABLE ".idf_escape($_GET["indexes"])." ".implode(", ",$alter),$SELF."table=".urlencode($_GET["indexes"]),lang(49));}page_header(lang(50),$error,array("table"=>$_GET["indexes"]),$_GET["indexes"]);$fields=array_keys(fields($_GET["indexes"]));$row=array("indexes"=>$indexes);if($_POST){$row=$_POST;if($_POST["add"]){foreach($row["indexes"]as$key=>$index){if(strlen($index["columns"][count($index["columns"])])){$row["indexes"][$key]["columns"][]="";}}$index=end($row["indexes"]);if($index["type"]||array_filter($index["columns"],'strlen')||array_filter($index["lengths"],'strlen')){$row["indexes"][]=array("columns"=>array(1=>""));}}}else{foreach($row["indexes"]as$key=>$index){$row["indexes"][$key]["columns"][]="";}$row["indexes"][]=array("columns"=>array(1=>""));}?>

<script type="text/javascript">// <![CDATA[
function add_row(field) {
	var row = field.parentNode.parentNode.cloneNode(true);
	var spans = row.getElementsByTagName('span');
	row.getElementsByTagName('td')[1].innerHTML = '<span>' + spans[spans.length - 1].innerHTML + '</span>';
	var selects = row.getElementsByTagName('select');
	for (var i=0; i < selects.length; i++) {
		selects[i].name = selects[i].name.replace(/indexes\[[0-9]+/, '$&1');
		selects[i].selectedIndex = 0;
	}
	var input = row.getElementsByTagName('input')[0];
	input.name = input.name.replace(/indexes\[[0-9]+/, '$&1');
	input.value = '';
	field.parentNode.parentNode.parentNode.appendChild(row);
	field.onchange = function () { };
}

function add_column(field) {
	var column = field.parentNode.cloneNode(true);
	var select = column.getElementsByTagName('select')[0];
	select.name = select.name.replace(/\]\[[0-9]+/, '$&1');
	select.selectedIndex = 0;
	var input = column.getElementsByTagName('input')[0];
	input.name = input.name.replace(/\]\[[0-9]+/, '$&1');
	input.value = '';
	field.parentNode.parentNode.appendChild(column);
	field.onchange = function () { };
}
// ]]></script>

<form action="" method="post">
<table border="0" cellspacing="0" cellpadding="2">
<thead><tr><th><?php echo
lang(104);?></th><td><?php echo
lang(105);?></td></tr></thead>
<?php
$j=0;foreach($row["indexes"]as$index){echo"<tr><td><select name='indexes[$j][type]'".($j==count($row["indexes"])-1?" onchange='add_row(this);'":"")."><option></option>".optionlist($index_types,$index["type"])."</select></td><td>\n";ksort($index["columns"]);foreach($index["columns"]as$i=>$column){echo"<span><select name='indexes[$j][columns][$i]'".($i==count($index["columns"])?" onchange='add_column(this);'":"")."><option></option>".optionlist($fields,$column)."</select>";echo"<input name='indexes[$j][lengths][$i]' size='2' value=\"".htmlspecialchars($index["lengths"][$i])."\" /></span>\n";}echo"</td></tr>\n";$j++;}?>
</table>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(51);?>" />
</p>
<noscript><p><input type="submit" name="add" value="<?php echo
lang(52);?>" /></p></noscript>
</form>
<?php
}elseif(isset($_GET["database"])){if($_POST&&!$error){if($_POST["drop"]){unset($_SESSION["databases"][$_GET["server"]]);query_redirect("DROP DATABASE ".idf_escape($_GET["db"]),substr(preg_replace('~db=[^&]*&~','',$SELF),0,-1),lang(26));}elseif($_GET["db"]!==$_POST["name"]){unset($_SESSION["databases"][$_GET["server"]]);if(query_redirect("CREATE DATABASE ".idf_escape($_POST["name"]).($_POST["collation"]?" COLLATE '".$mysql->escape_string($_POST["collation"])."'":""),$SELF."db=".urlencode($_POST["name"]),lang(27),!strlen($_GET["db"]))){$result=$mysql->query("SHOW TABLES");while($row=$result->fetch_row()){if(!queries("RENAME TABLE ".idf_escape($row[0])." TO ".idf_escape($_POST["name"]).".".idf_escape($row[0]))){break;}}$result->free();if(!$row){$mysql->query("DROP DATABASE ".idf_escape($_GET["db"]));}query_redirect(queries(),preg_replace('~db=[^&]*&~','',$SELF)."db=".urlencode($_POST["name"]),lang(28),!$row,false,$row);}}else{if(!$_POST["collation"]){redirect(substr($SELF,0,-1));}query_redirect("ALTER DATABASE ".idf_escape($_POST["name"])." COLLATE '".$mysql->escape_string($_POST["collation"])."'",substr($SELF,0,-1),lang(29));}}page_header(strlen($_GET["db"])?lang(30):lang(31),$error,array(),$_GET["db"]);$collations=collations();$name=$_GET["db"];$collate=array();if($_POST){$name=$_POST["name"];$collate=$_POST["collation"];}else{if(!strlen($_GET["db"])){$result=$mysql->query("SHOW GRANTS");while($row=$result->fetch_row()){if(preg_match('~ ON (`(([^\\\\`]+|``|\\\\.)*)%`\\.\\*)?~',$row[0],$match)&&$match[1]){$name=stripcslashes(idf_unescape($match[2]));break;}}$result->free();}elseif(($result=$mysql->query("SHOW CREATE DATABASE ".idf_escape($_GET["db"])))){$create=$mysql->result($result,1);if(preg_match('~ COLLATE ([^ ]+)~',$create,$match)){$collate=$match[1];}elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$create,$match)){$collate=$collations[$match[1]][0];}$result->free();}}?>

<form action="" method="post">
<p>
<input name="name" value="<?php echo
htmlspecialchars($name);?>" maxlength="64" />
<select name="collation"><option value="">(<?php echo
lang(17);?>)</option><?php echo
optionlist($collations,$collate);?></select>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(strlen($_GET["db"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["call"])){page_header(lang(84).": ".htmlspecialchars($_GET["call"]),$error);$routine=routine($_GET["call"],(isset($_GET["callf"])?"FUNCTION":"PROCEDURE"));$in=array();$out=array();foreach($routine["fields"]as$i=>$field){if(substr($field["inout"],-3)=="OUT"){$out[$i]="@".idf_escape($field["field"])." AS ".idf_escape($field["field"]);}if(!$field["inout"]||substr($field["inout"],0,2)=="IN"){$in[]=$i;}}if(!$error&&$_POST){$call=array();foreach($routine["fields"]as$key=>$field){if(in_array($key,$in)){$val=process_input($key,$field);if($val===false){$val="''";}if(isset($out[$key])){$mysql->query("SET @".idf_escape($field["field"])." = ".$val);}}$call[]=(isset($out[$key])?"@".idf_escape($field["field"]):$val);}$result=$mysql->multi_query((isset($_GET["callf"])?"SELECT":"CALL")." ".idf_escape($_GET["call"])."(".implode(", ",$call).")");if(!$result){echo"<p class='error'>".htmlspecialchars($mysql->error)."</p>\n";}else{do{$result=$mysql->store_result();if(is_object($result)){select($result);}else{echo"<p class='message'>".lang(83,$mysql->affected_rows)."</p>\n";}}while($mysql->next_result());if($out){select($mysql->query("SELECT ".implode(", ",$out)));}}}?>

<form action="" method="post">
<?php
if($in){echo"<table border='0' cellspacing='0' cellpadding='2'>\n";foreach($in
as$key){$field=$routine["fields"][$key];echo"<tr><th>".htmlspecialchars($field["field"])."</th><td>";$value=$_POST["fields"][$key];if(strlen($value)&&($field["type"]=="enum"||$field["type"]=="set")){$value=intval($value);}input($key,$field,$value);echo"</td></tr>\n";}echo"</table>\n";}?>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(84);?>" />
</p>
</form>
<?php
}elseif(isset($_GET["foreign"])){if($_POST&&!$error&&!$_POST["add"]&&!$_POST["change"]&&!$_POST["change-js"]){if($_POST["drop"]){query_redirect("ALTER TABLE ".idf_escape($_GET["foreign"])." DROP FOREIGN KEY ".idf_escape($_GET["name"]),$SELF."table=".urlencode($_GET["foreign"]),lang(91));}else{$source=array_filter($_POST["source"],'strlen');ksort($source);$target=array();foreach($source
as$key=>$val){$target[$key]=$_POST["target"][$key];}query_redirect("ALTER TABLE ".idf_escape($_GET["foreign"]).(strlen($_GET["name"])?" DROP FOREIGN KEY ".idf_escape($_GET["name"]).",":"")." ADD FOREIGN KEY (".implode(", ",array_map('idf_escape',$source)).") REFERENCES ".idf_escape($_POST["table"])." (".implode(", ",array_map('idf_escape',$target)).")".(in_array($_POST["on_delete"],$on_actions)?" ON DELETE $_POST[on_delete]":"").(in_array($_POST["on_update"],$on_actions)?" ON UPDATE $_POST[on_update]":""),$SELF."table=".urlencode($_GET["foreign"]),(strlen($_GET["name"])?lang(92):lang(93)));}}page_header(lang(94),$error,array("table"=>$_GET["foreign"]),$_GET["foreign"]);$tables=array();$result=$mysql->query("SHOW TABLE STATUS");while($row=$result->fetch_assoc()){if($row["Engine"]=="InnoDB"){$tables[]=$row["Name"];}}$result->free();if($_POST){$row=$_POST;ksort($row["source"]);if($_POST["add"]){$row["source"][]="";}elseif($_POST["change"]||$_POST["change-js"]){$row["target"]=array();}}elseif(strlen($_GET["name"])){$foreign_keys=foreign_keys($_GET["foreign"]);$row=$foreign_keys[$_GET["name"]];$row["source"][]="";}else{$row=array("table"=>$_GET["foreign"],"source"=>array(""));}$source=get_vals("SHOW COLUMNS FROM ".idf_escape($_GET["foreign"]));$target=($_GET["foreign"]===$row["table"]?$source:get_vals("SHOW COLUMNS FROM ".idf_escape($row["table"])));?>

<script type="text/javascript">// <![CDATA[
function add_row(field) {
	var row = field.parentNode.parentNode.cloneNode(true);
	var selects = row.getElementsByTagName('select');
	for (var i=0; i < selects.length; i++) {
		selects[i].name = selects[i].name.replace(/\]/, '1$&');
		selects[i].selectedIndex = 0;
	}
	field.parentNode.parentNode.parentNode.appendChild(row);
	field.onchange = function () { };
}
// ]]></script>

<form action="" method="post">
<p>
<?php echo
lang(95);?>:
<select name="table" onchange="this.form['change-js'].value = '1'; this.form.submit();"><?php echo
optionlist($tables,$row["table"]);?></select>
<input type="hidden" name="change-js" value="" />
</p>
<noscript><p><input type="submit" name="change" value="<?php echo
lang(96);?>" /></p></noscript>
<table border="0" cellspacing="0" cellpadding="2">
<thead><tr><th><?php echo
lang(97);?></th><th><?php echo
lang(98);?></th></tr></thead>
<?php
$j=0;foreach($row["source"]as$key=>$val){echo"<tr>";echo"<td><select name='source[".intval($key)."]'".($j==count($row["source"])-1?" onchange='add_row(this);'":"")."><option></option>".optionlist($source,$val)."</select></td>";echo"<td><select name='target[".intval($key)."]'>".optionlist($target,$row["target"][$key])."</select></td>";echo"</tr>\n";$j++;}?>
</table>
<p>
<?php echo
lang(102);?>: <select name="on_delete"><option></option><?php echo
optionlist($on_actions,$row["on_delete"]);?></select>
<?php echo
lang(103);?>: <select name="on_update"><option></option><?php echo
optionlist($on_actions,$row["on_update"]);?></select>
</p>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(strlen($_GET["name"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
<noscript><p><input type="submit" name="add" value="<?php echo
lang(99);?>" /></p></noscript>
</form>
<?php
}elseif(isset($_GET["createv"])){$dropped=false;if($_POST&&!$error){if(strlen($_GET["createv"])){$dropped=query_redirect("DROP VIEW ".idf_escape($_GET["createv"]),substr($SELF,0,-1),lang(106),$_POST["drop"],!$_POST["dropped"]);}if(!$_POST["drop"]){query_redirect("CREATE VIEW ".idf_escape($_POST["name"])." AS ".$_POST["select"],$SELF."view=".urlencode($_POST["name"]),(strlen($_GET["createv"])?lang(107):lang(108)));}}page_header((strlen($_GET["createv"])?lang(109):lang(110)),$error,array("view"=>$_GET["createv"]),$_GET["createv"]);$row=array();if($_POST){$row=$_POST;}elseif(strlen($_GET["createv"])){$row=view($_GET["createv"]);$row["name"]=$_GET["createv"];}?>

<form action="" method="post">
<p><textarea name="select" rows="10" cols="80" style="width: 98%;"><?php echo
htmlspecialchars($row["select"]);?></textarea></p>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<?php if($dropped){?><input type="hidden" name="dropped" value="1" /><?php }?>
<?php echo
lang(111);?>: <input name="name" value="<?php echo
htmlspecialchars($row["name"]);?>" maxlength="64" />
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(strlen($_GET["createv"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["event"])){$intervals=array("YEAR","QUARTER","MONTH","DAY","HOUR","MINUTE","WEEK","SECOND","YEAR_MONTH","DAY_HOUR","DAY_MINUTE","DAY_SECOND","HOUR_MINUTE","HOUR_SECOND","MINUTE_SECOND");$statuses=array("ENABLED"=>"ENABLE","DISABLED"=>"DISABLE","SLAVESIDE_DISABLED"=>"DISABLE ON SLAVE");if($_POST&&!$error){if($_POST["drop"]){query_redirect("DROP EVENT ".idf_escape($_GET["event"]),substr($SELF,0,-1),lang(166));}elseif(in_array($_POST["INTERVAL_FIELD"],$intervals)&&in_array($_POST["STATUS"],$statuses)){$schedule=" ON SCHEDULE ".($_POST["INTERVAL_VALUE"]?"EVERY '".$mysql->escape_string($_POST["INTERVAL_VALUE"])."' $_POST[INTERVAL_FIELD]".($_POST["STARTS"]?" STARTS '".$mysql->escape_string($_POST["STARTS"])."'":"").($_POST["ENDS"]?" ENDS '".$mysql->escape_string($_POST["ENDS"])."'":""):"AT '".$mysql->escape_string($_POST["STARTS"])."'")." ON COMPLETION".($_POST["ON_COMPLETION"]?"":" NOT")." PRESERVE";query_redirect((strlen($_GET["event"])?"ALTER EVENT ".idf_escape($_GET["event"]).$schedule.($_GET["event"]!=$_POST["EVENT_NAME"]?" RENAME TO ".idf_escape($_POST["EVENT_NAME"]):""):"CREATE EVENT ".idf_escape($_POST["EVENT_NAME"]).$schedule)." $_POST[STATUS] COMMENT '".$mysql->escape_string($_POST["EVENT_COMMENT"])."' DO $_POST[EVENT_DEFINITION]",substr($SELF,0,-1),(strlen($_GET["event"])?lang(167):lang(168)));}}page_header((strlen($_GET["event"])?lang(169).": ".htmlspecialchars($_GET["event"]):lang(170)),$error);$row=array();if($_POST){$row=$_POST;}elseif(strlen($_GET["event"])){$result=$mysql->query("SELECT * FROM information_schema.EVENTS WHERE EVENT_SCHEMA = '".$mysql->escape_string($_GET["db"])."' AND EVENT_NAME = '".$mysql->escape_string($_GET["event"])."'");$row=$result->fetch_assoc();$row["STATUS"]=$statuses[$row["STATUS"]];$result->free();}?>

<form action="" method="post">
<table border="0" cellspacing="0" cellpadding="2">
<tr><th><?php echo
lang(111);?></th><td><input name="EVENT_NAME" value="<?php echo
htmlspecialchars($row["EVENT_NAME"]);?>" maxlength="64" /></td></tr>
<tr><th><?php echo
lang(175);?></th><td><input name="STARTS" value="<?php echo
htmlspecialchars("$row[EXECUTE_AT]$row[STARTS]");?>" /></td></tr>
<tr><th><?php echo
lang(176);?></th><td><input name="ENDS" value="<?php echo
htmlspecialchars($row["ENDS"]);?>" /></td></tr>
<tr><th><?php echo
lang(172);?></th><td><input name="INTERVAL_VALUE" value="<?php echo
htmlspecialchars($row["INTERVAL_VALUE"]);?>" size="6" /> <select name="INTERVAL_FIELD"><?php echo
optionlist($intervals,$row["INTERVAL_FIELD"]);?></select></td></tr>
<tr><th><?php echo
lang(177);?></th><td><select name="STATUS"><?php echo
optionlist($statuses,$row["STATUS"]);?></select></td></tr>
<tr><th><?php echo
lang(73);?></th><td><input name="EVENT_COMMENT" value="<?php echo
htmlspecialchars($row["EVENT_COMMENT"]);?>" maxlength="64" /></td></tr>
<tr><th>&nbsp;</th><td><label><input type="checkbox" name="ON_COMPLETION" value="PRESERVE"<?php echo($row["ON_COMPLETION"]=="PRESERVE"?" checked='checked'":"");?> /><?php echo
lang(178);?></label></td></tr>
</table>
<p><textarea name="EVENT_DEFINITION" rows="10" cols="80" style="width: 98%;"><?php echo
htmlspecialchars($row["EVENT_DEFINITION"]);?></textarea></p>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(strlen($_GET["event"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["procedure"])){$routine=(isset($_GET["function"])?"FUNCTION":"PROCEDURE");$dropped=false;if($_POST&&!$error&&!$_POST["add"]&&!$_POST["drop_col"]&&!$_POST["up"]&&!$_POST["down"]){if(strlen($_GET["procedure"])){$dropped=query_redirect("DROP $routine ".idf_escape($_GET["procedure"]),substr($SELF,0,-1),lang(120),$_POST["drop"],!$_POST["dropped"]);}if(!$_POST["drop"]){$set=array();$fields=array_filter((array)$_POST["fields"],'strlen');ksort($fields);foreach($fields
as$field){if(strlen($field["field"])){$set[]=(in_array($field["inout"],$inout)?"$field[inout] ":"").idf_escape($field["field"]).process_type($field,"CHARACTER SET");}}query_redirect("CREATE $routine ".idf_escape($_POST["name"])." (".implode(", ",$set).")".(isset($_GET["function"])?" RETURNS".process_type($_POST["returns"],"CHARACTER SET"):"")." $_POST[definition]",substr($SELF,0,-1),(strlen($_GET["procedure"])?lang(121):lang(122)));}}page_header((strlen($_GET["procedure"])?(isset($_GET["function"])?lang(123):lang(124)).": ".htmlspecialchars($_GET["procedure"]):(isset($_GET["function"])?lang(119):lang(118))),$error);$collations=get_vals("SHOW CHARACTER SET");$row=array("fields"=>array());if($_POST){$row=$_POST;$row["fields"]=(array)$row["fields"];process_fields($row["fields"]);}elseif(strlen($_GET["procedure"])){$row=routine($_GET["procedure"],$routine);$row["name"]=$_GET["procedure"];}?>

<form action="" method="post" id="form">
<table border="0" cellspacing="0" cellpadding="2">
<?php edit_fields($row["fields"],$collations,$routine);?>
<?php if(isset($_GET["function"])){?><tr><td><?php echo
lang(125);?></td><?php echo
edit_type("returns",$row["returns"],$collations);?></tr><?php }?>
</table>
<?php echo
type_change(count($row["fields"]));?>
<?php if(isset($_GET["function"])){?>
<script type="text/javascript">
document.getElementById('form')['returns[type]'].onchange();
</script>
<?php }?>
<p><textarea name="definition" rows="10" cols="80" style="width: 98%;"><?php echo
htmlspecialchars($row["definition"]);?></textarea></p>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<?php if($dropped){?><input type="hidden" name="dropped" value="1" /><?php }?>
<?php echo
lang(111);?>: <input name="name" value="<?php echo
htmlspecialchars($row["name"]);?>" maxlength="64" />
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(strlen($_GET["procedure"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["trigger"])){$trigger_time=array("BEFORE","AFTER");$trigger_event=array("INSERT","UPDATE","DELETE");$dropped=false;if($_POST&&!$error){if(strlen($_GET["name"])){$dropped=query_redirect("DROP TRIGGER ".idf_escape($_GET["name"]),$SELF."table=".urlencode($_GET["trigger"]),lang(127),$_POST["drop"],!$_POST["dropped"]);}if(!$_POST["drop"]){if(in_array($_POST["Timing"],$trigger_time)&&in_array($_POST["Event"],$trigger_event)){query_redirect("CREATE TRIGGER ".idf_escape($_POST["Trigger"])." $_POST[Timing] $_POST[Event] ON ".idf_escape($_GET["trigger"])." FOR EACH ROW $_POST[Statement]",$SELF."table=".urlencode($_GET["trigger"]),(strlen($_GET["name"])?lang(128):lang(129)));}}}page_header((strlen($_GET["name"])?lang(130).": ".htmlspecialchars($_GET["name"]):lang(131)),$error,array("table"=>$_GET["trigger"]));$row=array("Trigger"=>"$_GET[trigger]_bi");if($_POST){$row=$_POST;}elseif(strlen($_GET["name"])){$result=$mysql->query("SHOW TRIGGERS LIKE '".$mysql->escape_string(addcslashes($_GET["trigger"],"%_"))."'");while($row=$result->fetch_assoc()){if($row["Trigger"]===$_GET["name"]){break;}}$result->free();}?>

<form action="" method="post" id="form">
<table border="0" cellspacing="0" cellpadding="2">
<tr><th><?php echo
lang(132);?></th><td><select name="Timing" onchange="if (/^<?php echo
htmlspecialchars(preg_quote($_GET["trigger"],"/"));?>_[ba][iud]$/.test(this.form['Trigger'].value)) this.form['Trigger'].value = '<?php echo
htmlspecialchars(addcslashes($_GET["trigger"],"\r\n'\\"));?>_' + this.value.charAt(0).toLowerCase() + this.form['Event'].value.charAt(0).toLowerCase();"><?php echo
optionlist($trigger_time,$row["Timing"]);?></select></td></tr>
<tr><th><?php echo
lang(133);?></th><td><select name="Event" onchange="this.form['Timing'].onchange();"><?php echo
optionlist($trigger_event,$row["Event"]);?></select></td></tr>
<tr><th><?php echo
lang(111);?></th><td><input name="Trigger" value="<?php echo
htmlspecialchars($row["Trigger"]);?>" maxlength="64" /></td></tr>
</table>
<p><textarea name="Statement" rows="10" cols="80" style="width: 98%;"><?php echo
htmlspecialchars($row["Statement"]);?></textarea></p>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<?php if($dropped){?><input type="hidden" name="dropped" value="1" /><?php }?>
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(strlen($_GET["name"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["user"])){$privileges=array();$result=$mysql->query("SHOW PRIVILEGES");while($row=$result->fetch_assoc()){foreach(explode(",",$row["Context"])as$context){$privileges[$context][$row["Privilege"]]=$row["Comment"];}}$result->free();$privileges["Server Admin"]+=$privileges["File access on server"];$privileges["Databases"]["Create routine"]=$privileges["Procedures"]["Create routine"];$privileges["Columns"]=array();foreach(array("Select","Insert","Update","References")as$val){$privileges["Columns"][$val]=$privileges["Tables"][$val];}unset($privileges["Server Admin"]["Usage"]);unset($privileges["Procedures"]["Create routine"]);foreach($privileges["Tables"]as$key=>$val){unset($privileges["Databases"][$key]);}function
all_privileges(&$grants,$privileges){foreach($privileges
as$privilege=>$val){if($privilege!="Grant option"){$grants[strtoupper($privilege)]=true;}}}$new_grants=array();if($_POST){foreach($_POST["objects"]as$key=>$val){$new_grants[$val]=((array)$new_grants[$val])+((array)$_POST["grants"][$key]);}}$grants=array();$old_pass="";if(isset($_GET["host"])&&($result=$mysql->query("SHOW GRANTS FOR '".$mysql->escape_string($_GET["user"])."'@'".$mysql->escape_string($_GET["host"])."'"))){while($row=$result->fetch_row()){if(preg_match('~GRANT (.*) ON (.*) TO ~',$row[0],$match)){if($match[1]=="ALL PRIVILEGES"){if($match[2]=="*.*"){all_privileges($grants[$match[2]],$privileges["Server Admin"]);}if(substr($match[2],-1)=="*"){all_privileges($grants[$match[2]],$privileges["Databases"]);all_privileges($grants[$match[2]],(array)$privileges["Procedures"]);}all_privileges($grants[$match[2]],$privileges["Tables"]);}elseif(preg_match_all('~ *([^(,]*[^ ,(])( *\\([^)]+\\))?~',$match[1],$matches,PREG_SET_ORDER)){foreach($matches
as$val){$grants["$match[2]$val[2]"][$val[1]]=true;}}}if(preg_match('~ WITH GRANT OPTION~',$row[0])){$grants[$match[2]]["GRANT OPTION"]=true;}if(preg_match("~ IDENTIFIED BY PASSWORD '([^']+)~",$row[0],$match)){$old_pass=$match[1];}}$result->free();}if($_POST&&!$error){$old_user=(isset($_GET["host"])?$mysql->escape_string($_GET["user"])."'@'".$mysql->escape_string($_GET["host"]):"");$new_user=$mysql->escape_string($_POST["user"])."'@'".$mysql->escape_string($_POST["host"]);$pass=$mysql->escape_string($_POST["pass"]);if($_POST["drop"]){query_redirect("DROP USER '$old_user'",$SELF."privileges=",lang(141));}elseif($old_user==$new_user||$mysql->query(($mysql->server_info<5?"GRANT USAGE ON *.* TO":"CREATE USER")." '$new_user' IDENTIFIED BY".($_POST["hashed"]?" PASSWORD":"")." '$pass'")){if($old_user==$new_user){$mysql->query("SET PASSWORD FOR '$new_user' = ".($_POST["hashed"]?"'$pass'":"PASSWORD('$pass')"));}$revoke=array();foreach($new_grants
as$object=>$grant){if(isset($_GET["grant"])){$grant=array_filter($grant);}$grant=array_keys($grant);if(isset($_GET["grant"])){$revoke=array_diff(array_keys(array_filter($new_grants[$object],'strlen')),$grant);}elseif($old_user==$new_user){$old_grant=array_keys((array)$grants[$object]);$revoke=array_diff($old_grant,$grant);$grant=array_diff($grant,$old_grant);unset($grants[$object]);}if(preg_match('~^(.+)(\\(.*\\))?$~U',$object,$match)&&(($grant&&!$mysql->query("GRANT ".implode("$match[2], ",$grant)."$match[2] ON $match[1] TO '$new_user'"))||($revoke&&!$mysql->query("REVOKE ".implode("$match[2], ",$revoke)."$match[2] ON $match[1] FROM '$new_user'")))){$error=htmlspecialchars($mysql->error);if($old_user!=$new_user){$mysql->query("DROP USER '$new_user'");}break;}}if(!$error){if(isset($_GET["host"])&&$old_user!=$new_user){$mysql->query("DROP USER '$old_user'");}elseif(!isset($_GET["grant"])){foreach($grants
as$object=>$revoke){if(preg_match('~^(.+)(\\(.*\\))?$~U',$object,$match)){$mysql->query("REVOKE ".implode("$match[2], ",array_keys($revoke))."$match[2] ON $match[1] FROM '$new_user'");}}}redirect($SELF."privileges=",(isset($_GET["host"])?lang(142):lang(143)));}}if(!$error){$error=htmlspecialchars($mysql->error);}}page_header((isset($_GET["host"])?lang(5).": ".htmlspecialchars("$_GET[user]@$_GET[host]"):lang(140)),$error,array("privileges"=>lang(139)));if($_POST){$row=$_POST;$grants=$new_grants;}else{$row=$_GET+array("host"=>"localhost");$row["pass"]=$old_pass;if(strlen($old_pass)){$row["hashed"]=true;}$grants[""]=true;}?>
<form action="" method="post">
<table border="0" cellspacing="0" cellpadding="2">
<tr><th><?php echo
lang(5);?></th><td><input name="user" maxlength="16" value="<?php echo
htmlspecialchars($row["user"]);?>" /></td></tr>
<tr><th><?php echo
lang(4);?></th><td><input name="host" maxlength="60" value="<?php echo
htmlspecialchars($row["host"]);?>" /></td></tr>
<tr><th><?php echo
lang(6);?></th><td><input id="pass" name="pass" value="<?php echo
htmlspecialchars($row["pass"]);?>" /><?php if(!$row["hashed"]){?><script type="text/javascript">document.getElementById('pass').type = 'password';</script><?php }?> <label><input type="checkbox" name="hashed" value="1"<?php if($row["hashed"]){?> checked="checked"<?php }?> onclick="this.form['pass'].type = (this.checked ? 'text' : 'password');" /><?php echo
lang(144);?></label></td></tr>
</table>

<?php

echo"<table border='0' cellspacing='0' cellpadding='2'>\n";echo"<thead><tr><th colspan='2'>".lang(139)."</th>";$i=0;foreach($grants
as$object=>$grant){echo'<th>'.($object!="*.*"?'<input name="objects['.$i.']" value="'.htmlspecialchars($object).'" size="10" />':'<input type="hidden" name="objects['.$i.']" value="*.*" size="10" />*.*').'</th>';$i++;}echo"</tr></thead>\n";foreach(array("Server Admin"=>lang(4),"Databases"=>lang(47),"Tables"=>lang(67),"Columns"=>lang(145),"Procedures"=>lang(146),)as$context=>$desc){foreach((array)$privileges[$context]as$privilege=>$comment){echo'<tr><td>'.$desc.'</td><td title="'.htmlspecialchars($comment).'"><i>'.htmlspecialchars($privilege).'</i></td>';$i=0;foreach($grants
as$object=>$grant){$name='"grants['.$i.']['.htmlspecialchars(strtoupper($privilege)).']"';$value=$grant[strtoupper($privilege)];if($context=="Server Admin"&&$object!=(isset($grants["*.*"])?"*.*":"")){echo"<td>&nbsp;</td>";}elseif(isset($_GET["grant"])){echo"<td><select name=$name><option></option><option value='1'".($value?" selected='selected'":"").">".lang(147)."</option><option value='0'".($value=="0"?" selected='selected'":"").">".lang(148)."</option></select></td>";}else{echo"<td align='center'><input type='checkbox' name=$name value='1'".($value?" checked='checked'":"")." /></td>";}$i++;}echo"</tr>\n";}}echo"</table>\n";?>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(24);?>" />
<?php if(isset($_GET["host"])){?><input type="submit" name="drop" value="<?php echo
lang(25);?>"<?php echo$confirm;?> /><?php }?>
</p>
</form>
<?php
}elseif(isset($_GET["processlist"])){if($_POST&&!$error){$killed=0;foreach((array)$_POST["kill"]as$val){if(queries("KILL ".intval($val))){$killed++;}}query_redirect(queries(),$SELF."processlist=",lang(113,$killed),$killed||!$_POST["kill"],false,!$killed&&$_POST["kill"]);}page_header(lang(112),$error);?>

<form action="" method="post">
<table border="1" cellspacing="0" cellpadding="2">
<?php
$result=$mysql->query("SHOW PROCESSLIST");for($i=0;$row=$result->fetch_assoc();$i++){if(!$i){echo"<thead><tr lang='en'><th>&nbsp;</th><th>".implode("</th><th>",array_keys($row))."</th></tr></thead>\n";}echo"<tr><td><input type='checkbox' name='kill[]' value='$row[Id]' /></td><td>".implode("</td><td>",$row)."</td></tr>\n";}$result->free();?>
</table>
<p>
<input type="hidden" name="token" value="<?php echo$token;?>" />
<input type="submit" value="<?php echo
lang(114);?>" />
</p>
</form>
<?php
}elseif(isset($_GET["select"])){$table_status=table_status($_GET["select"]);$indexes=indexes($_GET["select"]);$operators=array("=","<",">","<=",">=","!=","LIKE","REGEXP","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL");if(eregi('^(MyISAM|Maria)$',$table_status["Engine"])){$operators[]="AGAINST";}$fields=fields($_GET["select"]);$rights=array();$columns=array();unset($text_length);foreach($fields
as$key=>$field){if(isset($field["privileges"]["select"])){$columns[]=$key;if(preg_match('~text|blob~',$field["type"])){$text_length=(isset($_GET["text_length"])?$_GET["text_length"]:"100");}}$rights+=$field["privileges"];}$select=array();$group=array();foreach((array)$_GET["columns"]as$key=>$val){if($val["fun"]=="count"||(in_array($val["col"],$columns,true)&&(!$val["fun"]||in_array($val["fun"],$functions)||in_array($val["fun"],$grouping)))){$select[$key]=(in_array($val["col"],$columns,true)?(!$val["fun"]?idf_escape($val["col"]):($val["fun"]=="distinct"?"COUNT(DISTINCT ":strtoupper("$val[fun](")).idf_escape($val["col"]).")"):"COUNT(*)");if(!in_array($val["fun"],$grouping)){$group[]=$select[$key];}}}$where=array();foreach($indexes
as$i=>$index){if($index["type"]=="FULLTEXT"&&strlen($_GET["fulltext"][$i])){$where[]="MATCH (".implode(", ",array_map('idf_escape',$index["columns"])).") AGAINST ('".$mysql->escape_string($_GET["fulltext"][$i])."'".(isset($_GET["boolean"][$i])?" IN BOOLEAN MODE":"").")";}}foreach((array)$_GET["where"]as$val){if(strlen("$val[col]$val[val]")&&in_array($val["op"],$operators)){if($val["op"]=="AGAINST"){$where[]="MATCH (".idf_escape($val["col"]).") AGAINST ('".$mysql->escape_string($val["val"])."' IN BOOLEAN MODE)";}elseif(ereg('IN$',$val["op"])&&!strlen($in=process_length($val["val"]))){$where[]="0";}else{$cond=" $val[op]".(ereg('NULL$',$val["op"])?"":(ereg('IN$',$val["op"])?" ($in)":" '".$mysql->escape_string($val["val"])."'"));if(strlen($val["col"])){$where[]=idf_escape($val["col"]).$cond;}else{$cols=array();foreach($fields
as$name=>$field){if(is_numeric($val["val"])||!ereg('int|float|double|decimal',$field["type"])){$cols[]=$name;}}$where[]=($cols?"(".implode("$cond OR ",array_map('idf_escape',$cols))."$cond)":"0");}}}}$order=array();foreach((array)$_GET["order"]as$key=>$val){if(in_array($val,$columns,true)||preg_match('(^(COUNT\\(\\*\\)|('.strtoupper(implode('|',$functions).'|'.implode('|',$grouping)).')\\(('.implode('|',array_map('preg_quote',array_map('idf_escape',$columns))).')\\))$)',$val)){$order[]=idf_escape($val).(isset($_GET["desc"][$key])?" DESC":"");}}$limit=(isset($_GET["limit"])?$_GET["limit"]:"30");$from="FROM ".idf_escape($_GET["select"]).($where?" WHERE ".implode(" AND ",$where):"").($group&&count($group)<count($select)?" GROUP BY ".implode(", ",$group):"").($order?" ORDER BY ".implode(", ",$order):"").(strlen($limit)?" LIMIT ".intval($limit).(intval($_GET["page"])?" OFFSET ".($limit*$_GET["page"]):""):"");if($_POST&&!$error){if($_POST["export"]){dump_headers($_GET["select"]);dump_table($_GET["select"],"");if($_POST["all"]){dump_data($_GET["select"],"INSERT",($where?"FROM ".idf_escape($_GET["select"])." WHERE ".implode(" AND ",$where):""));}else{foreach((array)$_POST["check"]as$val){parse_str($val,$check);dump_data($_GET["select"],"INSERT","FROM ".idf_escape($_GET["select"])." WHERE ".implode(" AND ",where($check))." LIMIT 1");}}exit;}$result=true;$affected=0;$command=($_POST["delete"]?($_POST["all"]&&!$where?"TRUNCATE ":"DELETE FROM "):($_POST["clone"]?"INSERT INTO ":"UPDATE ")).idf_escape($_GET["select"]);if(!$_POST["delete"]){$set=array();foreach($fields
as$name=>$field){$val=process_input($name,$field);if($_POST["clone"]){$set[]=($val!==false?$val:idf_escape($name));}elseif($val!==false){$set[]=idf_escape($name)." = $val";}}$command.=($_POST["clone"]?" SELECT ".implode(", ",$set)." FROM ".idf_escape($_GET["select"]):" SET ".implode(", ",$set));}if(!$_POST["delete"]&&!$set){}elseif($_POST["all"]){$result=queries($command.($where?" WHERE ".implode(" AND ",$where):""));$affected=$mysql->affected_rows;}else{foreach((array)$_POST["check"]as$val){parse_str($val,$check);$result=queries($command." WHERE ".implode(" AND ",where($check))." LIMIT 1");if(!$result){break;}$affected+=$mysql->affected_rows;}}query_redirect(queries(),remove_from_uri("page"),lang(199,$affected),$result,false,!$result);}page_header(lang(54).": ".htmlspecialchars($_GET["select"]),$error);if(isset($rights["insert"])){echo'<p><a href="'.htmlspecialchars($SELF).'edit='.urlencode($_GET['select']).'">'.lang(55)."</a></p>\n";}if(!$columns){echo"<p class='error'>".lang(71).($fields?"":": ".htmlspecialchars($mysql->error)).".</p>\n";}else{echo"<form action='' id='form'>\n";?>
<script type="text/javascript">// <![CDATA[
function add_row(field) {
	var row = field.parentNode.cloneNode(true);
	var selects = row.getElementsByTagName('select');
	for (var i=0; i < selects.length; i++) {
		selects[i].name = selects[i].name.replace(/[a-z]\[[0-9]+/, '$&1');
		selects[i].selectedIndex = 0;
	}
	var inputs = row.getElementsByTagName('input');
	if (inputs.length) {
		inputs[0].name = inputs[0].name.replace(/[a-z]\[[0-9]+/, '$&1');
		inputs[0].value = '';
	}
	field.parentNode.parentNode.appendChild(row);
	field.onchange = function () { };
}
// ]]></script>
<?php

echo"<fieldset><legend>".lang(54)."</legend>\n";if(strlen($_GET["server"])){echo'<input type="hidden" name="server" value="'.htmlspecialchars($_GET["server"]).'" />';}echo'<input type="hidden" name="db" value="'.htmlspecialchars($_GET["db"]).'" />';echo'<input type="hidden" name="select" value="'.htmlspecialchars($_GET["select"]).'" />';echo"\n";$i=0;$fun_group=array(lang(153)=>$functions,lang(154)=>$grouping);foreach($select
as$key=>$val){$val=$_GET["columns"][$key];echo"<div><select name='columns[$i][fun]'><option></option>".optionlist($fun_group,$val["fun"])."</select>";echo"<select name='columns[$i][col]'><option></option>".optionlist($columns,$val["col"])."</select></div>\n";$i++;}echo"<div><select name='columns[$i][fun]' onchange='this.nextSibling.onchange();'><option></option>".optionlist($fun_group)."</select>";echo"<select name='columns[$i][col]' onchange='add_row(this);'><option></option>".optionlist($columns)."</select></div>\n";echo"</fieldset>\n";echo"<fieldset><legend>".lang(56)."</legend>\n";foreach($indexes
as$i=>$index){if($index["type"]=="FULLTEXT"){echo"(<i>".implode("</i>, <i>",array_map('htmlspecialchars',$index["columns"]))."</i>) AGAINST";echo' <input name="fulltext['.$i.']" value="'.htmlspecialchars($_GET["fulltext"][$i]).'" />';echo"<label><input type='checkbox' name='boolean[$i]' value='1'".(isset($_GET["boolean"][$i])?" checked='checked'":"")." />".lang(76)."</label>";echo"<br />\n";}}$i=0;foreach((array)$_GET["where"]as$val){if(strlen("$val[col]$val[val]")&&in_array($val["op"],$operators)){echo"<div><select name='where[$i][col]'><option></option>".optionlist($columns,$val["col"])."</select>";echo"<select name='where[$i][op]' onchange=\"where_change(this);\">".optionlist($operators,$val["op"])."</select>";echo"<input name='where[$i][val]' value=\"".htmlspecialchars($val["val"])."\" /></div>\n";$i++;}}?>
<script type="text/javascript">
function where_change(op) {
	op.form[op.name.substr(0, op.name.length - 4) + '[val]'].style.display = (/NULL$/.test(op.value) ? 'none' : '');
}
<?php if($i){?>
for (var i=0; <?php echo$i;?> > i; i++) {
	document.getElementById('form')['where[' + i + '][op]'].onchange();
}
<?php }?>
</script>
<?php

echo"<div><select name='where[$i][col]' onchange='add_row(this);'><option></option>".optionlist($columns)."</select>";echo"<select name='where[$i][op]' onchange=\"where_change(this);\">".optionlist($operators)."</select>";echo"<input name='where[$i][val]' /></div>\n";echo"</fieldset>\n";echo"<fieldset><legend>".lang(57)."</legend>\n";$i=0;foreach((array)$_GET["order"]as$key=>$val){if(in_array($val,$columns,true)){echo"<div><select name='order[$i]'><option></option>".optionlist($columns,$val)."</select>";echo"<label><input type='checkbox' name='desc[$i]' value='1'".(isset($_GET["desc"][$key])?" checked='checked'":"")." />".lang(58)."</label></div>\n";$i++;}}echo"<div><select name='order[$i]' onchange='add_row(this);'><option></option>".optionlist($columns)."</select>";echo"<label><input type='checkbox' name='desc[$i]' value='1' />".lang(58)."</label></div>\n";echo"</fieldset>\n";echo"<fieldset><legend>".lang(59)."</legend><div><input name='limit' size='3' value=\"".htmlspecialchars($limit)."\" /></div></fieldset>\n";if(isset($text_length)){echo"<fieldset><legend>".lang(89)."</legend><div><input name='text_length' size='3' value=\"".htmlspecialchars($text_length)."\" /></div></fieldset>\n";}echo"<fieldset><legend>".lang(61)."</legend><div><input type='submit' value='".lang(54)."' /></div></fieldset>\n";echo"</form>\n";$query="SELECT ".($select?(count($group)<count($select)?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$select):"*")." $from";echo"<p><code class='jush-sql'>".htmlspecialchars($query)."</code> <a href='".htmlspecialchars($SELF)."sql=".urlencode($query)."'>".lang(43)."</a></p>\n";$result=$mysql->query($query);if(!$result){echo"<p class='error'>".htmlspecialchars($mysql->error)."</p>\n";}else{if(!$result->num_rows){echo"<p class='message'>".lang(60)."</p>\n";}else{$foreign_keys=array();foreach(foreign_keys($_GET["select"])as$foreign_key){foreach($foreign_key["source"]as$val){$foreign_keys[$val][]=$foreign_key;}}echo"<form action='' method='post'>\n";echo"<table border='1' cellspacing='0' cellpadding='2'>\n";for($j=0;$row=$result->fetch_assoc();$j++){if(!$j){echo'<thead><tr>'.(count($select)==count($group)?'<td><label><input type="checkbox" name="all" value="1" />'.lang(200).'</label></td>':'');foreach($row
as$key=>$val){echo'<th><a href="'.htmlspecialchars(remove_from_uri('(order|desc)[^=]*')).'&amp;order%5B0%5D='.htmlspecialchars($key).($_GET["order"][0]===$key&&!$_GET["desc"][0]?'&amp;desc%5B0%5D=1':'').'">'.htmlspecialchars($key)."</a></th>";}echo"</tr></thead>\n";}$unique_idf=implode('&amp;',unique_idf($row,$indexes));echo'<tr class="nowrap">'.(count($select)==count($group)?'<td><input type="checkbox" name="check[]" value="'.$unique_idf.'" onclick="this.form[\'all\'].checked = false;" /> <a href="'.htmlspecialchars($SELF).'edit='.urlencode($_GET['select']).'&amp;'.$unique_idf.'">'.lang(62).'</a> <a href="'.htmlspecialchars($SELF).'clone='.urlencode($_GET['select']).'&amp;'.$unique_idf.'">'.lang(197).'</a></td>':'');foreach($row
as$key=>$val){if(!isset($val)){$val="<i>NULL</i>";}elseif(preg_match('~blob|binary~',$fields[$key]["type"])&&preg_match('~[\\x80-\\xFF]~',$val)){$val='<a href="'.htmlspecialchars($SELF).'download='.urlencode($_GET["select"]).'&amp;field='.urlencode($key).'&amp;'.$unique_idf.'">'.lang(78,strlen($val)).'</a>';}else{if(!strlen(trim($val))){$val="&nbsp;";}elseif(intval($text_length)>0&&preg_match('~blob|text~',$fields[$key]["type"])&&strlen($val)>intval($text_length)){$val=(preg_match('~blob~',$fields[$key]["type"])?nl2br(htmlspecialchars(substr($val,0,intval($text_length))))."<em>...</em>":shorten_utf8($val,intval($text_length)));}else{$val=nl2br(htmlspecialchars($val));if($fields[$key]["type"]=="char"){$val="<code>$val</code>";}}foreach((array)$foreign_keys[$key]as$foreign_key){if(count($foreign_keys[$key])==1||count($foreign_key["source"])==1){$val="\">$val</a>";foreach($foreign_key["source"]as$i=>$source){$val="&amp;where%5B$i%5D%5Bcol%5D=".urlencode($foreign_key["target"][$i])."&amp;where%5B$i%5D%5Bop%5D=%3D&amp;where%5B$i%5D%5Bval%5D=".urlencode($row[$source]).$val;}$val='<a href="'.htmlspecialchars(strlen($foreign_key["db"])?preg_replace('~([?&]db=)[^&]+~','\\1'.urlencode($foreign_key["db"]),$SELF):$SELF).'select='.htmlspecialchars($foreign_key["table"]).$val;break;}}}echo"<td>$val</td>";}echo"</tr>\n";}echo"</table>\n";echo"<p>";$found_rows=(intval($limit)?$mysql->result($mysql->query(count($group)<count($select)?" SELECT FOUND_ROWS()":"SELECT COUNT(*) FROM ".idf_escape($_GET["select"]).($where?" WHERE ".implode(" AND ",$where):""))):$result->num_rows);if(intval($limit)&&$found_rows>$limit){$max_page=floor(($found_rows-1)/$limit);echo
lang(63).":";print_page(0);if($_GET["page"]>3){echo" ...";}for($i=max(1,$_GET["page"]-2);$i<min($max_page,$_GET["page"]+3);$i++){print_page($i);}if($_GET["page"]+3<$max_page){echo" ...";}print_page($max_page);}echo" (".lang(135,$found_rows).")</p>\n";echo"<fieldset><legend>".lang(43)."</legend><div><input type='hidden' name='token' value='$token' /><input type='submit' value='".lang(43)."' /> <input type='submit' name='clone' value='".lang(202)."' /> <input type='submit' name='delete' value='".lang(46)."'$confirm /></div></fieldset>\n";echo"<fieldset><legend>".lang(155)."</legend><div>$dump_options <input type='submit' name='export' value='".lang(155)."' /></div></fieldset>\n";echo"</form>\n";}$result->free();}}}else{if($_POST["tables"]&&!$error){$result=true;$message="";if(isset($_POST["truncate"])){foreach($_POST["tables"]as$table){if(!queries("TRUNCATE ".idf_escape($table))){$result=false;break;}}$message=lang(189);}elseif(isset($_POST["move"])){$rename=array();foreach($_POST["tables"]as$table){$rename[]=idf_escape($table)." TO ".idf_escape($_POST["target"]).".".idf_escape($table);}$result=queries("RENAME TABLE ".implode(", ",$rename));$message=lang(192);}elseif($result=queries((isset($_POST["optimize"])?"OPTIMIZE":(isset($_POST["check"])?"CHECK":(isset($_POST["repair"])?"REPAIR":(isset($_POST["drop"])?"DROP":"ANALYZE"))))." TABLE ".implode(", ",array_map('idf_escape',$_POST["tables"])))){if(isset($_POST["drop"])){$message=lang(201);}else{while($row=$result->fetch_assoc()){$message.=htmlspecialchars("$row[Table]: $row[Msg_text]")."<br />";}}}query_redirect(queries(),substr($SELF,0,-1),$message,$result,false,!$result);}page_header(lang(47).": ".htmlspecialchars($_GET["db"]),$error,false);echo'<p><a href="'.htmlspecialchars($SELF).'database=">'.lang(30)."</a></p>\n";echo'<p><a href="'.htmlspecialchars($SELF).'schema=">'.lang(117)."</a></p>\n";echo"<h3>".lang(179)."</h3>\n";$result=$mysql->query("SHOW TABLE STATUS");if(!$result->num_rows){echo"<p class='message'>".lang(37)."</p>\n";}else{echo"<form action='' method='post'>\n";echo"<table border='1' cellspacing='0' cellpadding='2'>\n";echo'<thead><tr><td><input type="checkbox" onclick="var elems = this.form.elements; for (var i=0; elems.length > i; i++) if (elems[i].name == \'tables[]\') elems[i].checked = this.checked;" /></td><th>'.lang(67).'</th><td>'.lang(195).'</td><td>'.lang(73).'</td><td>'.lang(183).'</td><td>'.lang(180).'</td><td>'.lang(181).'</td><td>'.lang(182).'</td><td>'.lang(22).'</td><td>'.lang(190)."</td></tr></thead>\n";while($row=$result->fetch_assoc()){table_comment($row);echo'<tr class="nowrap"><td>'.(isset($row["Rows"])?'<input type="checkbox" name="tables[]" value="'.htmlspecialchars($row["Name"]).'"'.(in_array($row["Name"],(array)$_POST["tables"],true)?' checked="checked"':'').' /></td><th><a href="'.htmlspecialchars($SELF).'table='.urlencode($row["Name"]).'">'.htmlspecialchars($row["Name"])."</a></th><td>$row[Engine]</td><td>".htmlspecialchars($row["Comment"])."</td><td>$row[Collation]":'&nbsp;</td><th><a href="'.htmlspecialchars($SELF).'view='.urlencode($row["Name"]).'">'.htmlspecialchars($row["Name"]).'</a></th><td colspan="7">'.lang(70));$row["count"]=$mysql->result($mysql->query("SELECT COUNT(*) FROM ".idf_escape($row["Name"])));foreach((isset($row["Rows"])?array("Data_length"=>"create","Index_length"=>"indexes","Data_free"=>"edit","Auto_increment"=>"create"):array())+array("count"=>"select")as$key=>$link){echo'</td><td align="right">'.(strlen($row[$key])?'<a href="'.htmlspecialchars("$SELF$link=").urlencode($row["Name"]).'">'.number_format($row[$key],0,'.',lang(191)).'</a>':'&nbsp;');}echo"</td></tr>\n";}echo"</table>\n";echo"<p><input type='hidden' name='token' value='$token' /><input type='submit' value='".lang(184)."' /> <input type='submit' name='optimize' value='".lang(185)."' /> <input type='submit' name='check' value='".lang(186)."' /> <input type='submit' name='repair' value='".lang(187)."' /> <input type='submit' name='truncate' value='".lang(188)."'$confirm /> <input type='submit' name='drop' value='".lang(25)."'$confirm /></p>\n";$db=(isset($_POST["target"])?$_POST["target"]:$_GET["db"]);echo"<p>".lang(193).(get_databases()?": <select name='target'>".optionlist(get_databases(),$db)."</select>":': <input name="target" value="'.htmlspecialchars($db).'" />')." <input type='submit' name='move' value='".lang(194)."' /></p>\n";echo"</form>\n";}$result->free();if($mysql->server_info>=5){echo'<p><a href="'.htmlspecialchars($SELF).'createv=">'.lang(110)."</a></p>\n";echo"<h3>".lang(48)."</h3>\n";$result=$mysql->query("SELECT * FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = '".$mysql->escape_string($_GET["db"])."'");if($result->num_rows){echo"<table border='0' cellspacing='0' cellpadding='2'>\n";while($row=$result->fetch_assoc()){echo"<tr>";echo"<td>".htmlspecialchars($row["ROUTINE_TYPE"])."</td>";echo'<th><a href="'.htmlspecialchars($SELF).($row["ROUTINE_TYPE"]=="FUNCTION"?'callf=':'call=').urlencode($row["ROUTINE_NAME"]).'">'.htmlspecialchars($row["ROUTINE_NAME"]).'</a></th>';echo'<td><a href="'.htmlspecialchars($SELF).($row["ROUTINE_TYPE"]=="FUNCTION"?'function=':'procedure=').urlencode($row["ROUTINE_NAME"]).'">'.lang(100)."</a></td>";echo"</tr>\n";}echo"</table>\n";}$result->free();echo'<p><a href="'.htmlspecialchars($SELF).'procedure=">'.lang(118).'</a> <a href="'.htmlspecialchars($SELF).'function=">'.lang(119)."</a></p>\n";}if($mysql->server_info>=5.1&&($result=$mysql->query("SHOW EVENTS"))){echo"<h3>".lang(173)."</h3>\n";if($result->num_rows){echo"<table border='0' cellspacing='0' cellpadding='2'>\n";echo"<thead><tr><th>".lang(111)."</th><td>".lang(174)."</td><td>".lang(175)."</td><td>".lang(176)."</td></tr></thead>\n";while($row=$result->fetch_assoc()){echo"<tr>";echo'<th><a href="'.htmlspecialchars($SELF).'event='.urlencode($row["Name"]).'">'.htmlspecialchars($row["Name"])."</a></th>";echo"<td>".($row["Execute at"]?lang(171)."</td><td>".$row["Execute at"]:lang(172)." ".$row["Interval value"]." ".$row["Interval field"]."</td><td>$row[Starts]")."</td>";echo"<td>$row[Ends]</td>";echo"</tr>\n";}echo"</table>\n";}$result->free();echo'<p><a href="'.htmlspecialchars($SELF).'event=">'.lang(170)."</a></p>\n";}}}page_footer();}