<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - get_module()
 * - set_module_methods()
 * - _set_module()
 * Classes list:
 * - Module
 */
if (!defined('BASEPATH'))
{
  exit('No direct script access allowed');
}

class Module
{
  public $CI;
  public $module;
  public $dir;
  public $exclude_dir;
  public $exclude_method;

  public function __construct()
  {
    $this->CI            = &get_instance();
    $this->dir           = null;
    $this->exclude_method = Array();
    $this->exclude_method = Array(
      '__construct',
      'get_instance',
      'index',
      'json',
    );
  }

  public function get_module()
  {
    $this->_set_module();

    return $this->module;
  }

  public function set_module_methods($module_name, $module_method)
  {
    $this->module[$module_name] = $module_method;
  }

  private function _set_module()
  {
    foreach (glob(APPPATH . 'controllers/' . $this->dir . '/*') as $module)
    {
      if (is_dir($module))
      {
        $dirname = basename($module, '.php');

        if (!in_array($dirname, $this->exclude_dir))
        {
          foreach (glob(APPPATH . 'controllers/' . $this->dir . '/' . $dirname . '/*') as $subdirmodule)
          {
            $subdirmodulename = basename($subdirmodule, '.php');
            array_push($this->exclude_method, $subdirmodulename);

            if (!class_exists($subdirmodulename))
            {
              $this->CI->load->file($subdirmodule);
            }

            $aMethods     = get_class_methods($subdirmodulename);
            $aUserMethods = Array();

            foreach ($aMethods as $method)
            {
              if (!in_array($method, $this->exclude_method))
              {
                $aUserMethods[] = $method;
              }
            }

            $this->set_module_methods(strtolower($subdirmodulename), $aUserMethods);
          }
        }
      }
      else if (pathinfo($module, PATHINFO_EXTENSION) == 'php')
      {
        $modulename = basename($module, '.php');
        array_push($this->exclude_method, $modulename);

        if (!class_exists($modulename))
        {
          $this->CI->load->file($module);
        }

        $aMethods     = get_class_methods($modulename);
        $aUserMethods = Array();

        if (is_array($aMethods))
        {
          foreach ($aMethods as $method)
          {
            if (!in_array($method, $this->exclude_method))
            {
              $aUserMethods[] = $method;
            }
          }
        }

        $this->set_module_methods(strtolower($modulename), $aUserMethods);
      }
    }
  }
}
