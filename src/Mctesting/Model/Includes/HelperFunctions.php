<?php

namespace Mctesting\Model\Includes;

/**
 * Description of HelperFunctions
 *
 * @author Nick
 */
class HelperFunctions {

  /**
   * 
   * @param string $string
   * @param type $start
   * @param type $end
   * @return string
   */
  public function get_string_between($string, $start, $end) {
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
      return "";
    }
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
  }

  public function get_string_before_between_and_after($string, $start, $end) {
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) {
      return "";
    }
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    //return substr($string, $ini, $len);

    $before = strstr($string, $start, $before_needle = TRUE);
    $after = strstr($string, $end);
    $between = substr($string, $ini, $len);

    $stringArray = array($before, $between, $after);
    return $stringArray;
  }
  
  public function numbers_only($value)
{/*
  return true if all numbers in a string, false otherwise
 *  */
    //return preg_match('/^([0-9]+)$/', $value);
    return ctype_digit(strval($value));
}

}
