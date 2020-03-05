<?php
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

include_once '../functions/maths-functions.php';
//Angry ranter randomly inserts random angry words into the piece of text

//Get the precision of the likelihood seed generated if it isn't already
include 'likelihood-precision.php';

//Get the test data generated if it isn't already
include 'default-testing-data.php';

//Break text up into array
$textarray = explode(" ",$text);

//Read each word one at a time
foreach ($textarray as $textarraykey=>$word)
  {
  //Choose whether to include the ranty word
  $diceroll = randomdigit(true,$likelihoodprecision);

  //Compare the dice roll to the likelihood
  if ($diceroll <= $likelihood)
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
$outputtext = implode(" ",$textarray);

//Get the test data generated if it isn't already
include 'display-testing-output.php';
?>
