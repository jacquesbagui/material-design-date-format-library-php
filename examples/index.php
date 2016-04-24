<?php

namespace  Jacquesbagui\MaterialDate;

require_once("../src/MaterialDesignDateFormats.php");



$date =  new MaterialDesignDateFormats();


$future = $date->display("2016-04-23 17:12:01");

echo $future .'<br> <br>';



$futureContext = $date->futureContext("2015-04-23 17:12:01");

echo $futureContext .'<br> <br>';



$pastContext = $date->pastContext("2014-02-23 10:12:01");

echo $pastContext .'<br> <br>';


$distancePastContext = $date->distancePastContext("2016-03-23 17:12:01");

echo $distancePastContext .'<br> <br>';


$weekdayContext = $date->weekdayContext("2016-03-23 17:12:01");

echo $weekdayContext .'<br> <br>';
