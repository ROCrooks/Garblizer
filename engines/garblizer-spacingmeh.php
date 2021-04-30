<?php
//This is universal for any root directory in pages whether online, live or development
//This is also universal for in engine or in page
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines","/admin","/srrs");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Include required files
include $enginesdirectory . 'garblizer-required-files.php';

//Spacing Meh makes the spacing between words random

//Break text up into array of letters
$textarray = str_split($text);

//Read each word one at a time
foreach ($textarray as $textarraykey=>$letter)
  {
  if ($letter == " ")
    {
    //Choose whether to include the ranty word
    $diceroll = randomdigit(true,$likelihoodprecision);

    //Compare the dice roll to the likelihood
    if ($diceroll <= $module['Likelihood'])
      {
      //Choose an element
      $choice = rand(1,15);

      //Make random spacing
      if (($choice >= 1) AND ($choice <= 8))
        $textarray[$textarraykey] = "&nbsp;&nbsp;";
      if (($choice >= 9) AND ($choice <= 12))
        $textarray[$textarraykey] = "&nbsp;&nbsp;&nbsp;";
      if (($choice >= 13) AND ($choice <= 14))
        $textarray[$textarraykey] = "&nbsp;&nbsp;&nbsp;&nbsp;";
      if ($choice == 15)
        $textarray[$textarraykey] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
      }
    }

  }

//Implode array to create output
$text = implode("",$textarray);
?>
