<?php
//This is universal for any root directory in pages whether online, live or development
//This is also universal for in engine or in page

$currentdirectory = getcwd();
$removedirs = array("/pages","/engines","/admin","/srrs");
$currentdirectory = str_replace($removedirs,"",$currentdirectory);
$enginesdirectory = $currentdirectory . "/engines/";

//The list of modules currently available in Garblizer
$allmodules = array();
$allmodules[0] = array("Title"=>"Angry Ranter","Description"=>"Inserts random angry get in your safe space and meaningless phrases into the text.","Name"=>"AngryRanter","URL"=>"angryranter");
$allmodules[1] = array("Title"=>"Mistyper","Description"=>"Intriduves tylos ijto tye tdxt st ramdom.","Name"=>"MistyperSet","URL"=>"mistyper");
$allmodules[2] = array("Title"=>"Capitalize Meh","Description"=>"SHoWs uTter dIsreGaRd oF cOrREct capitALizATion.","Name"=>"CapitalizeMeh","URL"=>"capitalisemeh");
$allmodules[3] = array("Title"=>"Spacing Meh","Description"=>"Puts&nbsp;&nbsp;completely&nbsp;&nbsp;&nbsp;random sizes&nbsp;&nbsp;&nbsp;of spacings between letters.","Name"=>"SpacingMeh","URL"=>"spacingmeh");

if (isset($_POST['Submit']) == true)
  {
  //Test data to use for full pipeline
  if (isset($_POST['InputText']) == true)
    $text = $_POST['InputText'];

  //Save input text for displaying later
  $inputtext = $text;

  //Define likelihood precision
  if (isset($likelihoodprecision) == false)
    $likelihoodprecision = mt_getrandmax();

  //Include Garblizer modules
  $garblizermodules = array();
  foreach($allmodules as $possiblemodule)
    {
    //Get the details to import the engine in the loop
    $setid = $possiblemodule['Name'] . "Set";
    $probid = $possiblemodule['Name'] . "Prob";
    $url = $enginesdirectory . "garblizer-" . $possiblemodule['URL'] . ".php";

    //Run the engine if desired and probability greater than 0
    if (isset($_POST[$setid]) == true)
      {
      if ($_POST[$probid] > 0)
        {
        $module = array("Likelihood"=>$_POST[$probid]);
        include $url;
        }
      }
    }
  $outputhtml = '<div class="item">';
  $outputhtml = $outputhtml . '<p class="blockheading">Garblized Text</p>';
  $outputhtml = $outputhtml . '<p>Your input text:<br>';
  $outputhtml = $outputhtml . $inputtext . '</p>';
  $outputhtml = $outputhtml . '<p>Has been Garblized into:<br>';
  $outputhtml = $outputhtml . $text . '</p>';
  $outputhtml = $outputhtml . '</div>';
  }
else
  $outputhtml = "";

//Make the HTML for the form
$garblizermodulesformhtml = "";
$garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table;">';
$garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-row;">';
$garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-cell; width: 100px; vertical-align: top;"><p>Text</p></div>';
$garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-cell; width: 750px;"><textarea name="InputText" cols="80" rows="10"></textarea></div>';
$garblizermodulesformhtml = $garblizermodulesformhtml . '</div>';
$garblizermodulesformhtml = $garblizermodulesformhtml . '</div>';
$garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table;">';
foreach($allmodules as $module)
  {
  //Format module details appropriately for form
  $inputtitle = $module['Title'];
  $inputname = $module['Name'];
  $inputdescription = $module['Description'];
  $inputsetname = $inputname . "Set";
  $inputprobname = $inputname . "Prob";
  $inputjsid = "'" . $inputname . "'";

  //Make HTML for form items
  $garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-row;">';
  $garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-cell; width: 120px; vertical-align: middle;"><p>' . $inputtitle . '</p></div>';
  $garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-cell; width: 30px; vertical-align: middle;"><p><input type="checkbox" name="' . $inputsetname . '" value="true" checked></p></div>';
  $garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-cell; width: 300px; vertical-align: middle;"><p><input type="range" name="' . $inputprobname . '" min="0" max="1" step="0.01" value="0.2" style="width: 95%;" oninput="document.getElementById(' . $inputjsid . ').innerHTML = this.value" onload="document.getElementById(' . $inputjsid . ').innerHTML = this.value"></p></div>';
  $garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-cell; width: 40px; vertical-align: middle;"><p><span id="' . $inputname . '" style="vertical-align: middle;">0.2</span></p></div>';
  $garblizermodulesformhtml = $garblizermodulesformhtml . '<div style="display: table-cell; width: 400px; vertical-align: middle;"><p>' . $inputdescription . '</p></div>';
  $garblizermodulesformhtml = $garblizermodulesformhtml . '</div>';
  }
//Make the HTML form
$garblizermodulesformhtml = $garblizermodulesformhtml . '</div>';
$garblizermodulesformhtml = $garblizermodulesformhtml . '<p><input type="submit" name="Submit" value="Submit"> <input type="Reset" name="Reset" value="Reset">';
$garblizermodulesformhtml = '<div class="item"><p class="blockheading">Use Garblizer</p><p>Insert your text and choose which Garblizer modules to include, and how much they apply to the text. 0.2 is a recommended setting for all of them, too high and the text becomes too incoherent, too low many not be as funny.</p><form method="post" action="?page=Garblizer">' . $garblizermodulesformhtml . '</form></div>';
?>
<?php
echo $outputhtml;
?>
<div class="item">
<p class="blockheading">Garblizer</p>
<p>Garblizer turns normal, regular text into the sort of incoherent gibberish
  that so many angry people on social media write in preference to clear written
  communication. A number of modules are available to turn the input text into
  corrupted angry ranty lunacy.</p>
</div>
<?php
echo $garblizermodulesformhtml;
?>
