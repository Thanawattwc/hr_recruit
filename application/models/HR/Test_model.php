<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Test_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

    // $this->load->model('application');
  }


  public function get($params = array())
  {
    $sql = 'SELECT * ';
    $sql .= ' FROM [HR_JOBDEV].[dbo].[job]';
    $sql .= " where active = '1'";
    $sql .= " and status = 'Online'";

    if (isset($params['org_name'])) {
      $sql .= ' and org_name = ?';
      $condition = array($params['org_name']);
    }
    $sql .= " order by id desc";
    $query = $this->db->query($sql, isset($condition) ? $condition : false);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }

  public function getData($params = array())
  {
    $sql = "SELECT * 
            FROM [HR_JOBDEV].[dbo].[job]
            where active = '1'
            and status = 'Online'";
    if (isset($params['org_name'])) {
      $sql .= ' and org_name = ?';
      $condition = array($params['org_name']);
    }
    $sql .= " order by id desc";
    $query = $this->db->query($sql, isset($condition) ? $condition : false);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }


  public function get_org()
  {
    $sql = "SELECT org_name
            FROM [HR_JOBDEV].[dbo].[job]
            where active = '1'
            and status = 'Online'
            group by org_name";
    $query = $this->db->query($sql, isset($condition) ? $condition : false);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function get_Company()
  {
    $sql = " SELECT 
              j.[company_code]
              , c.[company_name]
              FROM [HR_JOBDEV].[dbo].[job] j
              Left join [HR_JOBDEV].[dbo].[company] c on c.company_code = j.company_code
              where j.[active] = '1'
              and j.[status] = 'Online'
              group by 
              j.[company_code]
              , c.[company_name]";
    $query = $this->db->query($sql, isset($condition) ? $condition : false);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }

  public function get_Location()
  {
    $sql = "SELECT
            j.[location_code]
            ,l.[location_name]
            FROM [HR_JOBDEV].[dbo].[job] j
            Left join [HR_JOBDEV].[dbo].[location] l on l.[location_code] = j.[location_code]
            where j.[active] = '1'
            and j.[status] = 'Online'
            group by j.[location_code]
            ,l.[location_name]";
    $query = $this->db->query($sql, isset($condition) ? $condition : false);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }

  public function getCompany()
  {
    $sql = "SELECT
     [company_code]
    ,[company_name]
    FROM [HR_JOBDEV].[dbo].[company]
    WHERE [active] = '1'
    ";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function getLocation()
  {
    $sql = "SELECT
    [location_code]
    ,[location_name]
    FROM [HR_JOBDEV].[dbo].[location]
    WHERE [active] = '1'
    ";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
}
