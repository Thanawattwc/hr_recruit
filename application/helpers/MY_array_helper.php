<?php
/**
 * Class and Function List:
 * Function list:
 * - unique_array()
 * Classes list:
 */
if (!defined('BASEPATH'))
{
  exit('No direct script access allowed');
}

if (!function_exists('unique_array'))
{
  function unique_array($array, $key)
  {
    $temp_array = array();
    foreach ($array as &$v)
    {
      if (!isset($temp_array[$v[$key]]))
      {
        $temp_array[$v[$key]] = &$v;
      }

    }

    return array_values($temp_array);
  }
}
