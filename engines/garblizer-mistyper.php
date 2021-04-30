<?php
//This is universal for any root directory in pages whether online, live or development
//This is also universal for in engine or in page
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines","/admin","/srrs");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Include required files
include $enginesdirectory . 'garblizer-required-files.php';

//Mistyper randomly includes typos in the inserted text

//The angry words to randomly include
$missletters = array(
"a"=>"aqwsxz",
"b"=>"bvfghn ",
"c"=>"cxsdfv ",
"d"=>"dswerfvcx",
"e"=>"edsw234rf",
"f"=>"fdertgbvc",
"g"=>"gfrtyhnbv",
"h"=>"hgtyujmnb",
"i"=>"iu789olkj",
"j"=>"jhyuik,mn",
"k"=>"kjuiol.,m",
"l"=>"lkiop;/.,",
"m"=>"mnhjk, ",
"n"=>"nbghjm ",
"o"=>"olki890p;",
"p"=>"p;l'o90-[",
"q"=>"q12wsa",
"r"=>"re345tgfd",
"s"=>"saqwedcxz",
"t"=>"tr456yhgf",
"u"=>"uy678ikjh",
"v"=>"vcdfgb ",
"w"=>"wq123edsa",
"x"=>"xzasdc ",
"y"=>"yt567ujhg",
"z"=>"zas\x"
);

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
    //Lookup mistype key
    $lookupletter = strtolower($letter);

    //Flag to make output uppercase
    if ($lookupletter != $letter)
      $uppercase = true;
    else
      $uppercase = false;

    if (isset($missletters[$lookupletter]) == true)
      {
      //Get the options of misses
      $misses = str_split($missletters[$lookupletter]);

      //Get the mistype
      $topmisskey = count($misses)-1;
      $misskey = rand(0,$topmisskey);
      $miss = $misses[$misskey];

      //Replace the letter with the misstype
      $letter = $miss;
      }

    if ($uppercase == true)
      $letter = strtoupper($letter);
    }

  $textarray[$textarraykey] = $letter;
  }

//Implode array to create output
$text = implode("",$textarray);
?>
