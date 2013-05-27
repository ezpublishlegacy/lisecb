<?php
/**
 * @copyright Copyright (C) 2013 land in sicht AG All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 */

class lisecboperators 
{
    /*!
     Constructor
    */
    function lisecboperators()
    {
        $this->Operators = array( 'exchange', 'currentRate');
        $options = array( 'ttl'   => 86400 );
        ezcCacheManager::createCache( 'ecbRates', 'var/cache', 'ezcCacheStorageFilePlain', $options );
    }

    /*!
     Returns the operators in this class.
    */
    function &operatorList()
    {
        return $this->Operators;
    }

    /*!
     \return true to tell the template engine that the parameter list
    exists per operator type, this is needed for operator classes
    that have multiple operators.
    */
    function namedParameterPerOperator()
    {
        return true;
    }

    /*!
     Both operators have one parameter.
     See eZTemplateOperator::namedParameterList()
    */
    function namedParameterList()
    {
        return array( 'exchange' => array( 'currency' => array( 'type' => 'string',
                                                                'required' => true,
                                                                'default' => '' )),
                      'currentRate' => array ( 'currency' => array( 'type' => 'string',
                                                                'required' => true,
                                                                'default' => '' )),
                      
                    );
    }

    /*!
     \Executes the needed operator(s).
     \Checks operator names, and calls the appropriate functions.
    */
    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace,
                     $currentNamespace, &$operatorValue, $namedParameters )
    {
        switch ( $operatorName )
        {
            case 'exchange':
            {
                $operatorValue = $this->exchange($operatorValue ,$namedParameters["currency"] );
                
            } 
            break;
            case 'currentRate': 
            {
                $operatorValue = $this->currentRate($namedParameters["currency"] );
            }
            break;
           
    	}
    }

    function exchange($operatorValue,$currency)
    {
        $rate = (float) self::getEuroExchangeRate($currency);
        $returnPrice = (float)$operatorValue * $rate;

        return $returnPrice;
    }
    
    function currentRate($currency)
    {
        $rate = (float) self::getEuroExchangeRate($currency);
        return $rate;
    }
    
    
    public static function getEuroExchangeRate($currency)
    {
        $cache_id = "exchangeRates";
        $cache = ezcCacheManager::getCache( "ecbRates" );
        $rates = array();
        if ( ( $cacheResult = $cache->restore( $cache_id ) ) === false )
        {
            $xml = @simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
            foreach($xml->Cube->Cube->Cube as $rate){
                $cur = (string)$rate['currency'];
                $rat = (float)$rate['rate'];
                $rates[$cur] = $rat;
            }
            $cache->store($cache_id, serialize($rates));
        }
        else
        {
            $rates = unserialize($cacheResult);
        }
        if (isset($rates[$currency]))
        {
            return $rates[$currency];
        }
        return false;
    }

    var $Operators;
}

?>