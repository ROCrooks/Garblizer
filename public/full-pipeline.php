<?php
//Test data to use for full pipeline
if (isset($text) == false)
  {
  $text = "Hello, my name is Dave and I am an alcholic. My favourite drinks used to be red wine and cheese liqueur. Once I got so drunk that I ate a seal and slept in a 4 poster bed in a mansion.";

  //Settings for the various tests of the Garblizer module
  //This is the order they are run in
  $settings = array();
  $settings['AngryRanter'] = array("Likelihood"=>0.5);
  $settings['Mistyper'] = array("Likelihood"=>0.5);

  $testing = true;
  }

//URLs of every engine
$engineurls = array();
$engineurls['AngryRanter'] = 'angryranter.php';
$engineurls['Mistyper'] = 'mistyper.php';

//Unset all garbles with likelihood of 0
foreach ($settings as $settingkey=>$garblize)
  {
  if ($garblize['Likelihood'] <= 0)
    unset($settings[$settingkey]);
  }

//Run each engine
foreach ($settings as $enginename=>$modulesettings)
  {
  //Get the module URL
  $moduleurl = $engineurls[$enginename];

  //Get the module settings
  $likelihood = $modulesettings['Likelihood'];

  //Run the module
  include $moduleurl;

  //Replace the original text with the output text
  $text = $outputtext;
  }

//Display test text if script is being tested
include 'display-testing-output.php';
?>
