<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Application extends CI_Model
{
  public $me;
  public $company_list;
  public $date;
  public $language;

  private $privileges;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('authentication');
    $this->load->model('oauth');

    $this->date = time();

    if (isset($_COOKIE['language']) && (_APPLICATION_MULTI_LANGUAGE_ == TRUE)) {
      $this->lang->load('application', $_COOKIE['language']);
      $this->config->set_item('language', $_COOKIE['language']);
      $this->language = $_COOKIE['language'];
    } else {
      $this->language = $this->config->item('language');
      // $this->language = 'th';
    }

    if (_OAUTH_) {
      if (!$this->oauth->verify()) {
        if (!isset($_SESSION['redirect_url'])) {
          $uri_segments = $this->uri->segment_array();

          if (IS_AJAX) {
            array_pop($uri_segments);
          }

          $_SESSION['redirect_url'] = base_url(implode('/', $uri_segments));
        }

        if (IS_AJAX) {
          delete_cookie('app_perm');
          delete_cookie('refresh_token');
        }

        redirect(base_url('login') . '?session_expired=1', 'location', 301);
      }
    } else {
      if (!$this->authentication->is_login()) {
        if (!isset($_SESSION['redirect_url'])) {
          $uri_segments = $this->uri->segment_array();

          if (IS_AJAX) {
            array_pop($uri_segments);
          }

          $_SESSION['redirect_url'] = base_url(implode('/', $uri_segments));
        }

        if (IS_AJAX) {
          delete_cookie('app_perm');
        }

        redirect(base_url('login') . '?session_expired=1', 'location', 301);
      }
    }

    $req = array('user_id' => $_SESSION['user_data']['user_info']['id']);

    // $administrator = $this->get_administrator($req);
    // $user          = $this->get_user($req);

    // if ($administrator)
    // {
    //   $_SESSION['user_data']['id']   = $administrator[0]['id'];
    //   $_SESSION['user_data']['role'] = array(
    //     'id'    => $administrator[0]['authorization_id'],
    //     'name'  => $administrator[0]['role'],
    //     'group' => 'Administrator',
    //   );

    //   if ($administrator[0]['detail'] == 'Full Access')
    //   {
    //     $_SESSION['user_data']['role']['access'] = $administrator[0]['detail'];
    //   }
    //   else
    //   {
    //     $_SESSION['user_data']['role']['access'] = json_decode($administrator[0]['detail'], true);
    //   }

    //   set_cookie('app_perm', $administrator[0]['detail'], _REFRESH_TOKEN_LIFE_);
    // }
    // else
    // {
    //   if (_ALL_EMPLOYEE_USAGE_)
    //   {
    //     $user_authorization = $this->get_authorization(array('is_default' => 1));

    //     $_SESSION['user_data']['id']   = $user_authorization[0]['id'];
    //     $_SESSION['user_data']['role'] = array(
    //       'id'     => $user_authorization[0]['id'],
    //       'name'   => $user_authorization[0]['name'],
    //       'group'  => 'User',
    //       'access' => json_decode($user_authorization[0]['detail'], true),
    //     );

    //     set_cookie('app_perm', $user_authorization[0]['detail'], _REFRESH_TOKEN_LIFE_);
    //   }
    //   else
    //   {
    //     $_SESSION['user_data']['id']   = $user[0]['id'];
    //     $_SESSION['user_data']['role'] = array(
    //       'id'     => $user[0]['authorization_id'],
    //       'name'   => $user[0]['role'],
    //       'group'  => 'User',
    //       'access' => json_decode($user[0]['detail'], true),
    //     );

    //     set_cookie('app_perm', $user[0]['detail'], _REFRESH_TOKEN_LIFE_);
    //   }
    // }

    $this->me = $_SESSION['user_data'];

    // if (is_array($_SESSION['user_data']['role']['access']))
    // {
    //   if (!isset($_SESSION['user_data']['role']['access'][$this->router->fetch_class()]) && ($this->router->fetch_class() != 'main'))
    //   {
    //     show_404();
    //   }

    //   if ($this->router->fetch_class() != 'main')
    //   {
    //     if (!in_array($this->router->fetch_method(), $_SESSION['user_data']['role']['access'][$this->router->fetch_class()]) && ($this->router->fetch_method() != 'index'))
    //     {
    //       show_404();
    //     }
    //   }
    // }
  }

  // Params : Array('id' => [_AUTHORIZATION_ID_])
  public function get_authorization($params = array())
  {
    if (isset($params['count'])) {
      $sql = 'SELECT COUNT(id) AS count';
    } else {
      $sql = 'SELECT *';
    }

    $sql .= ' FROM authen';

    // if (isset($params['is_default']))
    // {
    //   $sql .= ' WHERE is_default = ?';

    //   if ($this->me['role']['access'] != 'Full Access')
    //   {
    //     $sql .= ' AND id <> 1';
    //   }

    //   $condition = array($params['is_default']);
    // }
    // else if (isset($params['id']))
    // {
    //   $sql .= ' WHERE id = ?';
    //   $condition = array($params['id']);

    //   if ($this->me['role']['access'] != 'Full Access')
    //   {
    //     $sql .= ' AND id <> 1';
    //   }
    // }
    // else if (isset($params['keyword']))
    // {
    //   $sql .= ' WHERE ';

    //   $search_condition = array();

    //   foreach (explode(' ', $params['keyword']) as $value)
    //   {
    //     $date_condition = 'DATE_FORMAT(DATE_ADD(create_date, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(create_date, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(create_date)), "," , -1), DATE_FORMAT(DATE_ADD(last_modified, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(last_modified, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(last_modified)), "," , -1)';

    //     array_push($search_condition, 'CONCAT_WS("", id, name, detail, create_date, last_modified, ' . $date_condition . ') LIKE \'%' . $this->db->escape_like_str($value) . '%\'');
    //   }

    //   $sql .= implode(' AND ', $search_condition);

    //   if ($this->me['role']['access'] != 'Full Access')
    //   {
    //     $sql .= ' AND id <> 1';
    //   }
    // }
    // else
    // {
    //   if ($this->me['role']['access'] != 'Full Access')
    //   {
    //     $sql .= ' WHERE id <> 1';
    //   }
    // }

    if (!isset($params['count'])) {
      $sql .= ' ORDER BY create_date ASC';
    }

    if (isset($params['limit']) && isset($params['offset'])) {
      $sql .= ' OFFSET ' . $params['limit'] . ' ROWS FETCH NEXT ' . $params['offset'] . ' ROWS ONLY';
    }

    // $this->db->query('SET @month_th = "มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม"');

    $query = $this->db->query($sql, isset($condition) ? $condition : false);
    $data  = $query->result_array();

    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }

  // Params : Array('name' => [_AUTHORIZATION_NAME_], 'detail' => [_detail_])
  // public function add_authorization($params = array())
  // {
  //   $this->db->insert('tbl_authorization', $params);

  //   if ($this->db->affected_rows() > 0)
  //   {
  //     return $this->get_authorization(array('id' => $this->db->insert_id()));
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_AUTHORIZATION_ID_], 'name' => [_AUTHORIZATION_NAME_], 'detail' => [_detail_], 'is_default' => [_DEFAULT_VALUE_])
  // public function update_authorization($params = array())
  // {
  //   $req = array(
  //     'id' => $params['id'],
  //   );

  //   unset($params['id']);

  //   if (_DATABASE_DRIVER_ == 'sqlsrv')
  //   {
  //     $this->db->set('last_modified', 'GETDATE()', false);
  //   }

  //   if (_ALL_EMPLOYEE_USAGE_)
  //   {
  //     if(isset($params['is_default']) && $params['is_default'] == 1)
  //     {
  //       $this->db->update('tbl_authorization', array('is_default' => 0));
  //     }
  //   }

  //   if ($this->db->update('tbl_authorization', $params, $req))
  //   {
  //     return $this->get_authorization($req);
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_AUTHORIZATION_ID_])
  // public function delete_authorization($params = array())
  // {
  //   $this->db->delete('tbl_authorization', array('id' => $params['id']));

  //   if ($this->db->affected_rows() > 0)
  //   {
  //     @$this->db->delete('tbl_administrator', array('role' => $params['id']));
  //     @$this->db->delete('tbl_user', array('role' => $params['id']));

  //     return true;
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_ADMINISTRATOR_ID_], 'user_id' => [_EPMLOYEE_ID_])
  // public function get_administrator($params = array())
  // {
  //   if (isset($params['count']))
  //   {
  //     $sql = 'SELECT COUNT(administrator.id) AS count';
  //   }
  //   else
  //   {
  //     $sql = 'SELECT administrator.id, administrator.user_id, administrator.username, administrator.name, administrator.email, administrator.photo, administrator.is_active, authorize.name AS role, authorize.id AS authorization_id, authorize.detail, administrator.create_date, administrator.last_modified';
  //   }

  //   $sql .= ' FROM tbl_administrator AS administrator';
  //   $sql .= ' JOIN tbl_authorization AS authorize';
  //   $sql .= ' ON administrator.role = authorize.id';

  //   if (isset($params['id']))
  //   {
  //     if (isset($params['email']))
  //     {
  //       $sql .= ' WHERE administrator.id <> ? AND administrator.email = ?';
  //       $condition = array($params['id'], $params['email']);
  //     }
  //     else
  //     {
  //       $sql .= ' WHERE administrator.id = ?';
  //       $condition = array($params['id']);
  //     }
  //   }

  //   if (isset($params['user_id']))
  //   {
  //     $sql .= ' WHERE administrator.user_id = ?';
  //     $condition = array($params['user_id']);
  //   }

  //   if (!isset($params['id']) && !isset($params['user_id']))
  //   {
  //     if (isset($params['keyword']))
  //     {
  //       $sql .= ' WHERE ';

  //       $search_condition = array();

  //       foreach (explode(' ', $params['keyword']) as $value)
  //       {
  //         $date_condition = 'DATE_FORMAT(DATE_ADD(administrator.create_date, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(administrator.create_date, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(administrator.create_date)), "," , -1), DATE_FORMAT(DATE_ADD(administrator.last_modified, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(administrator.last_modified, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(administrator.last_modified)), "," , -1)';

  //         array_push($search_condition, 'CONCAT_WS("", administrator.id, administrator.user_id, administrator.username, administrator.name, administrator.email, administrator.create_date, administrator.last_modified, authorize.name, ' . $date_condition . ') LIKE \'%' . $this->db->escape_like_str($value) . '%\'');
  //       }

  //       $sql .= implode(' AND ', $search_condition);
  //       $sql .= ' AND administrator.user_id <> ?';
  //       $condition = array($this->me['user_info']['id']);
  //     }
  //     else if (isset($params['username']))
  //     {
  //       $sql .= ' WHERE administrator.username = ?';
  //       $condition = array($params['username']);
  //     }
  //     else if (isset($params['email']))
  //     {
  //       $sql .= ' WHERE administrator.email = ?';
  //       $condition = array($params['email']);
  //     }
  //     else
  //     {
  //       $sql .= ' WHERE administrator.user_id <> ?';
  //       $condition = array($this->me['user_info']['id']);
  //     }

  //     if ($this->me['role']['access'] != 'Full Access')
  //     {
  //       $sql .= ' AND authorize.id <> 1';
  //     }
  //   }

  //   if (!isset($params['count']))
  //   {
  //     $sql .= ' ORDER BY administrator.create_date ASC';
  //   }

  //   if (isset($params['limit']) && isset($params['offset']))
  //   {
  //     if (_DATABASE_DRIVER_ == 'sqlsrv')
  //     {
  //       $sql .= ' OFFSET ' . $params['limit'] . ' ROWS FETCH NEXT ' . $params['offset'] . ' ROWS ONLY';
  //     }
  //     else if (_DATABASE_DRIVER_ == 'mysqli')
  //     {
  //       $sql .= ' LIMIT ' . $params['limit'] . ', ' . $params['offset'];
  //     }
  //   }

  //   // $this->db->query('SET @month_th = "มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม"');

  //   $query = $this->db->query($sql, isset($condition) ? $condition : false);
  //   $data  = $query->result_array();

  //   if (count($data) > 0)
  //   {
  //     return $data;
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('user_id' => [_USER_ID_], 'username' => [_USERNAME_], 'role' => [_AUTHORIZATION_ID_])
  // public function add_administrator($params = array())
  // {
  //   $this->db->insert('tbl_administrator', $params);

  //   if ($this->db->affected_rows() > 0)
  //   {
  //     return $this->get_administrator(array('id' => $this->db->insert_id()));
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_ADMINISTRATOR_ID_], 'role' => [_AUTHORIZATION_ID_], 'is_active' => [_ACTIVE_VALUE_])
  // public function update_administrator($params = array())
  // {
  //   $req = array(
  //     'id' => $params['id'],
  //   );

  //   unset($params['id']);

  //   if (_DATABASE_DRIVER_ == 'sqlsrv')
  //   {
  //     $this->db->set('last_modified', 'GETDATE()', false);
  //   }

  //   if ($this->db->update('tbl_administrator', $params, $req))
  //   {
  //     return $this->get_administrator($req);
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_ADMINISTRATOR_ID_])
  // public function delete_administrator($params = array())
  // {
  //   $this->db->delete('tbl_administrator', array('id' => $params['id']));

  //   if ($this->db->affected_rows() > 0)
  //   {
  //     return true;
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_USER_ID_], 'user_id' => [_EMPLOYEE_ID_])
  // public function get_user($params = array())
  // {
  //   if (isset($params['count']))
  //   {
  //     $sql = 'SELECT COUNT(u.id) AS count';
  //   }
  //   else
  //   {
  //     $sql = 'SELECT u.id, u.user_id, u.username, u.name, u.email, u.photo, u.is_active, authorize.name AS role, authorize.id AS authorization_id, authorize.detail, u.create_date, u.last_modified';
  //   }

  //   $sql .= ' FROM tbl_user AS u';
  //   $sql .= ' JOIN tbl_authorization AS authorize';
  //   $sql .= ' ON u.role = authorize.id';

  //   if (isset($params['id']))
  //   {
  //     if (isset($params['email']))
  //     {
  //       $sql .= ' WHERE u.id <> ? AND u.email = ?';
  //       $condition = array($params['id'], $params['email']);
  //     }
  //     else
  //     {
  //       $sql .= ' WHERE u.id = ?';
  //       $condition = array($params['id']);
  //     }
  //   }

  //   if (isset($params['user_id']))
  //   {
  //     $sql .= ' WHERE u.user_id = ?';
  //     $condition = array($params['user_id']);
  //   }

  //   if (!isset($params['id']) && !isset($params['user_id']))
  //   {
  //     if (isset($params['keyword']))
  //     {
  //       $sql .= ' WHERE ';

  //       $search_condition = array();

  //       foreach (explode(' ', $params['keyword']) as $value)
  //       {
  //         $date_condition = 'DATE_FORMAT(DATE_ADD(u.create_date, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(u.create_date, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(u.create_date)), "," , -1), DATE_FORMAT(DATE_ADD(u.last_modified, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(u.last_modified, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(u.last_modified)), "," , -1)';

  //         array_push($search_condition, 'CONCAT_WS("", u.id, u.user_id, u.username, u.name, u.email, u.create_date, u.last_modified, authorize.name, ' . $date_condition . ') LIKE \'%' . $this->db->escape_like_str($value) . '%\'');
  //       }

  //       $sql .= implode(' AND ', $search_condition);

  //       if ($this->me['role']['access'] != 'Full Access')
  //       {
  //         $sql .= ' AND authorize.id <> 1';
  //       }
  //     }
  //     else if (isset($params['username']))
  //     {
  //       $sql .= ' WHERE u.username = ?';
  //       $condition = array($params['username']);
  //     }
  //     else if (isset($params['email']))
  //     {
  //       $sql .= ' WHERE u.email = ?';
  //       $condition = array($params['email']);
  //     }
  //   }

  //   if (!isset($params['count']))
  //   {
  //     $sql .= ' ORDER BY u.create_date ASC';
  //   }

  //   if (isset($params['limit']) && isset($params['offset']))
  //   {
  //     if (_DATABASE_DRIVER_ == 'sqlsrv')
  //     {
  //       $sql .= ' OFFSET ' . $params['limit'] . ' ROWS FETCH NEXT ' . $params['offset'] . ' ROWS ONLY';
  //     }
  //     else if (_DATABASE_DRIVER_ == 'mysqli')
  //     {
  //       $sql .= ' LIMIT ' . $params['limit'] . ', ' . $params['offset'];
  //     }
  //   }

  //   // $this->db->query('SET @month_th = "มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม"');

  //   $query = $this->db->query($sql, isset($condition) ? $condition : false);
  //   $data  = $query->result_array();

  //   if (count($data) > 0)
  //   {
  //     return $data;
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('user_id' => [_USER_ID_], 'username' => [_USERNAME_], 'role' => [_AUTHORIZATION_ID_])
  // public function add_user($params = array())
  // {
  //   $this->db->insert('tbl_user', $params);

  //   if ($this->db->affected_rows() > 0)
  //   {
  //     return $this->get_user(array('id' => $this->db->insert_id()));
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_USER_ID_], 'role' => [_AUTHORIZATION_ID_])
  // public function update_user($params = array())
  // {
  //   $req = array(
  //     'id' => $params['id'],
  //   );

  //   unset($params['id']);

  //   if (_DATABASE_DRIVER_ == 'sqlsrv')
  //   {
  //     $this->db->set('last_modified', 'GETDATE()', false);
  //   }

  //   if ($this->db->update('tbl_user', $params, $req))
  //   {
  //     return $this->get_user($req);
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }

  // Params : Array('id' => [_USER_ID_])
  // public function delete_user($params = array())
  // {
  //   $this->db->delete('tbl_user', array('id' => $params['id']));

  //   if ($this->db->affected_rows() > 0)
  //   {
  //     return true;
  //   }
  //   else
  //   {
  //     return false;
  //   }
  // }
}
