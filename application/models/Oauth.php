<?php
defined('BASEPATH') || exit('No direct script access allowed');



class Oauth extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

    $this->load->library('curl');

    $this->curl->url = _API_MITRPHOL_URL_;
  }

  public function login($params = array())
  {

    if (isset($params['USERNAME']) && isset($params['PASSWORD']))
    {
      $service_path = '/oauth/token';
      $params       = Array(
        'grant_type'    => 'password',
        'client_id'     => _API_MITRPHOL_CLIENT_,
        'client_secret' => _API_MITRPHOL_SECRET_,
        'username'      => $params['USERNAME'],
        'password'      => $params['PASSWORD'],
      );
      $this->curl->create($service_path);
      $this->curl->post($params);
      $this->curl->ssl(FALSE, FALSE);
      $response = $this->curl->execute();

      // print_r($response);

      if ($response)
      {
        // print '<br>';
        // print_r($response);
        // print '</br>';

        $response = json_decode($response, TRUE);

        $this->session->set_userdata($response);

        return $response;
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }

  public function logout()
  {
    $service_path = '/oauth/logout';
    $this->curl->get($service_path);
    $this->curl->ssl(FALSE, FALSE);
    $response = $this->curl->execute();

    if ($response)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  public function refresh_token()
  {
    if (!empty($_SESSION['refresh_token']))
    {
      $service_path = '/oauth/token';
      $params       = Array(
        'grant_type'    => 'refresh_token',
        'refresh_token' => $_SESSION['refresh_token'],
      );
      $this->curl->create($service_path);
      $this->curl->post($params);
      $this->curl->ssl(FALSE, FALSE);
      $response = $this->curl->execute();

      if ($response)
      {
        $response = json_decode($response, TRUE);

        $this->session->set_userdata($response);

        redirect(current_url());
      }
      else
      {
        return false;
      }
    }
    else
    {
      return false;
    }
  }

  public function profile()
  {
    $service_path = '/user/profile';
    $this->curl->get($service_path);
    $this->curl->ssl(FALSE, FALSE);
    $this->curl->http_header('Authorization', $_SESSION['token_type'] . ' ' . $_SESSION['access_token']);
    $response = $this->curl->execute();

    if ($response)
    {
      $response = json_decode($response, TRUE);

      $profile['user_data'] = $response['success']['data'];
      $this->session->set_userdata($profile);

      return $response;
    }
    else
    {
      if ($this->curl->info['http_code'] == 401)
      {
        if (isset($_SESSION['refresh_token']))
        {
          if (!$this->refresh_token())
          {
            redirect(base_url('/logout'), 'location', 301);
          }
        }
      }
      else
      {
        return false;
      }
    }
  }

  // Params : Array('id' => array([_EMPLOYEE_ID_]))
  public function get_employee($params = array())
  {
    $service_path = '/employee/profile';
    $this->curl->get($service_path, $params);
    $this->curl->ssl(FALSE, FALSE);
    $this->curl->http_header('Authorization', $_SESSION['token_type'] . ' ' . $_SESSION['access_token']);
    $response = $this->curl->execute();

    if ($response)
    {
      $response = json_decode($response, TRUE);

      return $response['success']['data'];
    }
    else
    {
      if ($this->curl->info['http_code'] == 401)
      {
        if (isset($_SESSION['refresh_token']))
        {
          if (!$this->refresh_token())
          {
            redirect(base_url('/logout'), 'location', 301);
          }
        }
      }
      else
      {
        return false;
      }
    }
  }

  // Params : Array('keyword' => array([_EMPLOYEE_ID_]))
  public function find_contact($params = array())
  {
    $service_path = '/employee/profile';
    $this->curl->get($service_path, $params);
    $this->curl->ssl(FALSE, FALSE);
    $this->curl->http_header('Authorization', $_SESSION['token_type'] . ' ' . $_SESSION['access_token']);
    $response = $this->curl->execute();

    if ($response)
    {
      $response = json_decode($response, TRUE);

      return $response['success']['data'];
    }
    else
    {
      if ($this->curl->info['http_code'] == 401)
      {
        if (isset($_SESSION['refresh_token']))
        {
          if (!$this->refresh_token())
          {
            redirect(base_url('/logout'), 'location', 301);
          }
        }
      }
      else
      {
        return false;
      }
    }
  }
}
