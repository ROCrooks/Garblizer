<?php
//This is universal for any root directory in pages whether online, live or development
//This is also universal for in engine or in page
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines","/admin","/srrs");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Include required files
include $enginesdirectory . 'garblizer-required-files.php';

//Capitalise Meh makes the capitalisation of words random

//Break text up into array of letters
$textarray = str_split($text);

//Read each word one at a time
foreach ($textarray as $textarraykey=>$letter)
  {
  //Choose whether to include the ranty word
  $diceroll = randomdigit(true,$likelihoodprecision);

  //Compare the dice roll to the likelihood
  if ($diceroll <= $module['Likelihood'])
    {
    //Make the upper and lower case letters
    $letteroptions = array();
    $letteroptions[0] = strtolower($letter);
    $letteroptions[1] = strtoupper($letter);

    //Choose an element
    $choice = rand(0,1);

    //Assign the letter case randomly
    $textarray[$textarraykey] = $letteroptions[$choice];
    }
  }

//Implode array to create output
$text = implode("",$textarray);
?>
