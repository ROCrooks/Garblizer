<?php
//This is universal for any root directory in pages whether online, live or development
//This is also universal for in engine or in page
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines","/admin","/srrs");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$functiondirectory = $currentdirectory . "/functions/";

//List of functions required
$functionfiles = array("maths");
foreach($functionfiles as $file)
  {
  include_once $functiondirectory . $file . "-functions.php";
  }
?>
