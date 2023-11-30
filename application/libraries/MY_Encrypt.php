<?php
/**
 * Class and Function List:
 * Function list:
 * - encode()
 * - decode()
 * Classes list:
 * - MY_Encrypt extends CI_Encrypt
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Encrypt extends CI_Encrypt
{
    public function encode($string, $key = NULL, $url_safe = TRUE)
    {
        $ret = parent::encode($string, $key);

        if ($url_safe)
        {
            $ret = strtr($ret, Array(
                '+' => '-',
                '=' => '~',
                '/' => '.'
            ));
        }

        return substr($ret, 0, -2);
    }

    public function decode($string, $key = NULL)
    {
        $string = $string . '~~';
        $string = strtr($string, Array(
            '-' => '+',
            '~' => '=',
            '.' => '/'
        ));

        return parent::decode($string, $key);
    }
}
