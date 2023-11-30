<?php
if (!defined('BASEPATH'))
{
  exit('No direct script access allowed');
}

if (!function_exists('validate_password'))
{
  function validate_password($candidate)
  {
    $rule_uppercase    = '/[A-Z]/';
    $rule_lowercase    = '/[a-z]/';
    $rule_special_char = '/[!@#$%&*()^,._;:-]/';
    $rule_number       = '/[0-9]/';

    if (preg_match_all($rule_uppercase, $candidate, $o) < 1)
    {
      return FALSE;
    }

    if (preg_match_all($rule_lowercase, $candidate, $o) < 1)
    {
      return FALSE;
    }

    if (preg_match_all($rule_special_char, $candidate, $o) < 1)
    {
      return FALSE;
    }

    if (preg_match_all($rule_number, $candidate, $o) < 1)
    {
      return FALSE;
    }

    if (strlen($candidate) < 8)
    {
      return FALSE;
    }

    return TRUE;
  }
}