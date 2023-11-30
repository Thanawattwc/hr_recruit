<?php
/**
 * Class and Function List:
 * Function list:
 * - base_url()
 * - base_path()
 * - create_url()
 * Classes list:
 */
if (!defined('BASEPATH'))
{
  exit('No direct script access allowed');
}

if (!function_exists('base_url'))
{
  function base_url($uri = '', $protocol = NULL)
  {
    $CI            = &get_instance();
    $url           = $CI->config->base_url($uri, $protocol);
    $parts         = parse_url($url);
    $parts['path'] = normalize_path($parts['path']);

    return create_url($parts);
  }
}

if (!function_exists('base_path'))
{
  function base_path($uri = '', $protocol = NULL)
  {
    $CI    = &get_instance();
    $url   = $CI->config->base_url($uri, $protocol);
    $parts = parse_url($url);

    if ($parts['host'] == 'localhost')
    {
      $start = strpos($path, $path) + 1;
      $end   = strpos($parts['path'], '/', $start);

      $parts['path'] = substr($parts['path'], $end);
    }

    $uri = normalize_path($parts['path']);

    return $uri;
  }
}

if (!function_exists('create_url'))
{
  function create_url($parts, $encode = TRUE)
  {
    if ($encode)
    {
      if (isset($parts['user']))
      {
        $parts['user'] = rawurlencode($parts['user']);
      }
      if (isset($parts['pass']))
      {
        $parts['pass'] = rawurlencode($parts['pass']);
      }
      if (isset($parts['host']) && !preg_match('!^(\[[\da-f.:]+\]])|([\da-f.:]+)$!ui', $parts['host']))
      {
        $parts['host'] = rawurlencode($parts['host']);
      }
      if (!empty($parts['path']))
      {
        $parts['path'] = preg_replace('!%2F!ui', '/', rawurlencode($parts['path']));
      }
      if (isset($parts['query']))
      {
        $parts['query'] = rawurlencode($parts['query']);
      }
      if (isset($parts['fragment']))
      {
        $parts['fragment'] = rawurlencode($parts['fragment']);
      }
    }

    $url = '';

    if (!empty($parts['scheme']))
    {
      $url .= $parts['scheme'] . ':';
    }
    if (isset($parts['host']))
    {
      $url .= '//';
      if (isset($parts['user']))
      {
        $url .= $parts['user'];
        if (isset($parts['pass']))
        {
          $url .= ':' . $parts['pass'];
        }
        $url .= '@';
      }
      if (preg_match('!^[\da-f]*:[\da-f.:]+$!ui', $parts['host']))
      {
        $url .= '[' . $parts['host'] . ']';
      }
      else
      {
        $url .= $parts['host'];
      }
      if (isset($parts['port']))
      {
        $url .= ':' . $parts['port'];
      }
      if (!empty($parts['path']) && $parts['path'][0] != '/')
      {
        $url .= '/';
      }
    }
    if (!empty($parts['path']))
    {
      $url .= $parts['path'];
    }
    if (isset($parts['query']))
    {
      $url .= '?' . $parts['query'];
    }
    if (isset($parts['fragment']))
    {
      $url .= '#' . $parts['fragment'];
    }

    return $url;
  }
}
