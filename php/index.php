<?php
define('APP_DEBUG', 0);
define('ERROR_REPORTING_ON', 1);

require 'app/bootstrap.php';

$Postas = new csomagkuldes\Galamb('Pityu');

echo Util::debug($Postas);
echo Util::debug($Postas instanceof csomagkuldes\Postas);
echo Util::debug($Postas instanceof csomagkuldes\Postas);
echo Util::debug($Postas instanceof csomagkuldes\Futar);
echo Util::debug($Postas instanceof csomagkuldes\Galamb);

$csomag = new csomagkuldes\Csomag(true);
$csomag->setSuly(2)->setCelOrszag('Magyarország');


$a = new NumberFormatter("hu_HU", NumberFormatter::CURRENCY);
$a->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 2);
echo $a->format(12345.12345) . PHP_EOL; // kimenet 12.345,67 Ft


// :: scope resolution operator
// Paamayim Nekudotayim

//echo Util::debug(Util::getFileInfo(__FILE__, 1));
echo Util::convert(memory_get_usage(true), 1);

