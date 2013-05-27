<?php 
/**
 * @copyright Copyright (C) 2013 land in sicht AG All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 */

$price = $Params['price'];
$currency = strtoupper($Params['currency']);

$ecb = new lisecboperators();

$rate = $ecb->currentRate($currency);
$currencyPrice = $ecb->exchange($price,$currency);


$content = array("price" => round($currencyPrice,2),
                 "rate" => round($rate,4) );

echo json_encode($content);
eZExecution::cleanExit();
?>