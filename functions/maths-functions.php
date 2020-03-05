<?php
//---FunctionBreak---
/*Normalises a value against minumum and maximum values in a range

$value is the value to normalise
$min is the minimum value
$max is the maximum value

Output is a colour for a particular heat on a heat chart*/
//---DocumentationBreak---
function normalisevalue($value,$min,$max)
  {
  $numerator = $value-$min;
  $denominator = $max-$min;
  $normalised = $numerator/$denominator;
  Return $normalised;
  }
//---FunctionBreak---
/*Generates a random digit between 0 and 1

$edges is default to true and can generate 0 or 1s
$maximum is the range to generate random numbers across. This is defaulted to false and will be generated automatically, set if the function will be called repeatedly

Output is a decimal between 0 and 1*/
//---DocumentationBreak---
function randomdigit($edges=true,$maximum=false)
  {
  //Generate maximum if not already generated
  if ($maximum == false)
    $maximum = mt_getrandmax();

  $number = mt_rand(0,$maximum);

  //Use edge property to define what to normalise against
  if ($edges == true)
    {
    $normmin = 0;
    $normmax = $maximum;
    }
  else
    {
    $normmin = -1;
    $normmax = $maximum+1;
    }

  //Normalise and return
  $number = normalisevalue($number,$normmin,$normmax);
  Return $number;
  }
//---FunctionBreak---
?>
