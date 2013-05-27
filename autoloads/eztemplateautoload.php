<?php
/**
 * @copyright Copyright (C) 2013 land in sicht AG All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 */

// Operator autoloading
$eZTemplateOperatorArray = array();

$eZTemplateOperatorArray[] =
  array( 'script' => 'extension/lisecb/autoloads/lisecboperators.php',
         'class' => 'lisecboperators',
         'operator_names' => array( 'exchange', 'currentRate' ) );


?>