<?php

namespace Application\Utils;


class Utils
{

    /**
     * @param $array (tableau peut être null : sera instancié)
     * @param $item
     * @return array
     */
    public static function addToArrayIfNotExist(&$array, $item)
    {
        if ($array == null)
        {
            $array = array();
        }

        if(!in_array($item, $array, true)){
            array_push($array, $item);
        }

        return $array;
    }

    /**
     * Renvoie la valeur correspondante à la clef $p_keyToBeTested dans le tableau $p_tableau_a_parcourir
     * Si absence de la clef, renvoie la valeur par défaut : $p_defaultReturn
     * Teste si la clef $p_keyToBeTested est bien présente dans le tableau $p_tableau_a_parcourir
     * @param $p_keyToBeTested
     * @param $p_tableau_a_parcourir
     * @param null $p_defaultReturn
     * @return null
     */
    public static function getValueWithDefault($p_keyToBeTested, $p_tableau_a_parcourir, $p_defaultReturn = null)
    {
        if ($p_tableau_a_parcourir == null || !array_key_exists($p_keyToBeTested, $p_tableau_a_parcourir)) {
            return $p_defaultReturn;
        }
        return $p_tableau_a_parcourir[$p_keyToBeTested];

    }

    /**
     * @param $str
     * @param $sub
     * @return bool true if $str begins with $sub
     */
    public static function beginsWith($str, $sub)
    {
        return (substr($str, 0, strlen($sub)) == $sub);
    }

    /**
     * @param $str
     * @param $sub
     * @return bool true if $str ends with $sub
     */
    public static function endsWith($str, $sub)
    {
        return (substr($str, strlen($str) - strlen($sub)) == $sub);
    }

    /**
     * in_array avec recherche case insensitive
     * @param $needle
     * @param $haystack
     * @return bool
     */
    public static function in_arrayi($needle, $haystack)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }

    /**
     * Arrondi à la dizaine, la centaine... supérieure
     * @param float $value valeur à arrondir
     * @param int $precision 1 (par défaut) pour les dizaines, 2 pour les centaines, 3 pour millier etc...
     * @return float
     */
    public static function decRound ($value, $precision = 1)
    {
        $p = pow (10, $precision);
        return ceil ($value / $p) * $p; // arrondi à la précision supérieure
    }
}