<?php
//This is universal for any root directory in pages whether online, live or development
//This is also universal for in engine or in page
$currentdirectory = getcwd();
$removedirs = array("/pages","/engines","/admin","/srrs");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//Define likelihood precision
if (isset($likelihoodprecision) == false)
  $likelihoodprecision = mt_getrandmax();

//Test data to use for full pipeline
$text = "Hello, my name is Dave and I am an alcholic. My favourite drinks used to be red wine and cheese liqueur. Once I got so drunk that I ate a seal and slept in a 4 poster bed in a mansion.";

//Settings for the various tests of the Garblizer module
//This is the order they are run in
$garblizermodules = array();
$module = array("Engine"=>"garblizer-angryranter.php","Likelihood"=>0.1);
array_push($garblizermodules,$module);
$module = array("Engine"=>"garblizer-mistyper.php","Likelihood"=>0.1);
array_push($garblizermodules,$module);
$module = array("Engine"=>"garblizer-capitalisemeh.php","Likelihood"=>1);
array_push($garblizermodules,$module);


//Unset all garbles with likelihood of 0
foreach ($garblizermodules as $modulekey=>$garblize)
  {
  if ($garblize['Likelihood'] <= 0)
    unset($garblizermodules[$settingkey]);
  }

//Run each engine
foreach ($garblizermodules as $module)
  {
  //Run the module
  include $enginesdirectory . $module['Engine'];
  }

echo $text;
?>
