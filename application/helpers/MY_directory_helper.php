<?php
/**
 * Class and Function List:
 * Function list:
 * - normalize_path()
 * - remove_dir()
 * Classes list:
 */
if (!defined('BASEPATH'))
{
  exit('No direct script access allowed');
}

if (!function_exists('normalize_path'))
{
  function normalize_path($path)
  {
    $parts    = Array();
    $path     = str_replace('\\', '/', $path);
    $path     = preg_replace('/\/+/', '/', $path);
    $segments = explode('/', $path);
    $test     = '';
    foreach ($segments as $segment)
    {
      if ($segment != '.')
      {
        $test = array_pop($parts);
        if (is_null($test))
        {
          $parts[] = $segment;
        }
        else if ($segment == '..')
        {
          if ($test == '..')
          {
            $parts[] = $test;
          }

          if ($test == '..' || $test == '')
          {
            $parts[] = $segment;
          }
        }
        else
        {
          $parts[] = $test;
          $parts[] = $segment;
        }
      }
    }

    return implode('/', $parts);
  }
}

if (!function_exists('remove_dir'))
{
  function remove_dir($dir)
  {
    if (is_dir($dir))
    {
      $dir     = (substr($dir, -1) != '/') ? $dir . '/' : $dir;
      $openDir = opendir($dir);
      while ($file = readdir($openDir))
      {
        if (!in_array($file, array(
          '.',
          '..',
        )))
        {
          if (!is_dir($dir . $file))
          {
            unlink($dir . $file);
          }
          else
          {
            remove_dir($dir . $file);
          }
        }
      }
      closedir($openDir);
      rmdir($dir);
    }
  }
}
