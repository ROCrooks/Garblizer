<?php
//This is universal for any root directory in pages whether online, live or development
//This is also universal for in engine or in page
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines","/admin","/srrs");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Include required files
include $enginesdirectory . 'garblizer-required-files.php';

//Angry ranter inserts random angry words and phrases into the text

//The angry words to randomly include
$rantwords = array(
"we won!",
"snowflake",
"go back to your safe space",
"tards",
"globalists",
"sovereignty",
"MAGA",
"MBGA",
"Brexit Means Brexit",
"Tommy",
"socialism",
"communism",
"Antifa are the real fascists",
"invasion",
"get over it",
"UN",
"cultural maxism"
);

//Break text up into array
$textarray = explode(" ",$text);

//Read each word one at a time
foreach ($textarray as $textarraykey=>$word)
  {
  //Choose whether to include the ranty word
  $diceroll = randomdigit(true,$likelihoodprecision);

  //Compare the dice roll to the likelihood
  if ($diceroll <= $module['Likelihood'])
    {
    //Get the ranty word to add
    $toprantkey = count($rantwords)-1;
    $rantkey = rand(0,$toprantkey);
    $rantword = $rantwords[$rantkey];

    //Add the ranty word to the original word
    $word = $word . " " . $rantword;
    }

  $textarray[$textarraykey] = $word;
  }

//Implode array to create output
$text = implode(" ",$textarray);
?>
