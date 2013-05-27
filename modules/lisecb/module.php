<?
/**
 * @copyright Copyright (C) 2013 land in sicht AG All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 */

$Module = array( 'name' => 'eZ lis ECB Currency Converter' );

$ViewList = array();

$ViewList['convert'] = array(
                    'functions' => array(),
                    'default_navigation_part' => 'ezurlaliasnavigationpart',
                    'ui_context' => 'administration',
                    'script' => 'convert.php',
                    'params' => array(),
                    'unordered_params' => array( 'price' => 'price',
                    							 'currency' => 'currency'),
                    );

?>