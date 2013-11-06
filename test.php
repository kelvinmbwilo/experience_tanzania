<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('display_errors', 'On');error_reporting(E_ALL);
//use "PHPImageWorkshop\ImageWorkshop";
require_once('ImageWorkshop/src/PHPImageWorkshop/ImageWorkshop.php');
$pinguLayer = PHPImageWorkshop\ImageWorkshop::initFromPath(__DIR__.'/img/swahili.jpg');
echo $pinguLayer->getWidth(). "<br />";
echo $pinguLayer->getHeight()."<br />";
$pinguLayer->resizeInPixel(400, null, true);
echo $pinguLayer->getWidth(). "<br />";
echo $pinguLayer->getHeight();
$wwfLogoLayer = PHPImageWorkshop\ImageWorkshop::initFromPath(__DIR__.'/img/fac.png');
$tuxLayer = PHPImageWorkshop\ImageWorkshop::initFromPath(__DIR__.'/img/logo1.png');
$pinguLayer->addLayerOnTop($wwfLogoLayer, 20, 10, 'LB');
$pinguLayer->addLayerOnTop($tuxLayer, 20, 10, 'RT');

//saving the results
$dirPath = __DIR__."/img/thumbs";
$filename = "pingu_edited.png";
$createFolders = true;
$backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
$imageQuality = 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)
  
$pinguLayer->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);
?>
