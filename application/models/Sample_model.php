<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Sample_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  // public function getCompany()
  // {
  //   $sql = "SELECT
  //    [company_code]
  //   ,[company_name]
  //   FROM [HR_JOBDEV].[dbo].[company]
  //   WHERE [active] = '1'
  //   ";
  //   $query = $this->db->query($sql);
  //   $data  = $query->result_array();
  //   if (count($data) > 0) {
  //     return $data;
  //   } else {
  //     return false;
  //   }
  // }
  // public function getLocation()
  // {
  //   $sql = "SELECT
  //   [location_code]
  //   ,[location_name]
  //   FROM [HR_JOBDEV].[dbo].[location]
  //   WHERE [active] = '1'
  //   ";
  //   $query = $this->db->query($sql);
  //   $data  = $query->result_array();
  //   if (count($data) > 0) {
  //     return $data;
  //   } else {
  //     return false;
  //   }
  // }

  public function get($params = array())
  {
    $sql = 'SELECT * ';
    $sql .= ' FROM tbl_pr';
    // $sql .= " where emp_id = '" . $params['emp_id'] . "'";
    // $sql .= " where user_id = '" . $params['user_id'] . "'";   
    $sql .= " and active = '1'";
    // $sql .= " and status = 'On process'";
    // 

    if (isset($params['pr_id'])) {
      $sql .= ' and pr_id = ?';
      $condition = array($params['pr_id']);
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

  // public function get_number($params = array()) ////
  // {
  //   $sql = " SELECT top 1
  //     type
  //     ,date
  //     ,number
  //     FROM [HR_JOBDEV].[dbo].[tbl_runningnumber]
  //   Where type = '" . $params['type']
  //     . "' and date = '" . $params['date'] . "'
  //   order by number desc
  //   ";
  //   $query = $this->db->query($sql);
  //   $data = $query->result_array();
  //   if (count($data) > 0) {
  //     return $data;
  //   } else {
  //     return false;
  //   }
  // }

  // public function insert_number($params = array()) //
  // {
  //   $this->db->insert('tbl_runningnumber', $params);
  //   if ($this->db->affected_rows() > 0) {
  //     return $this->db->insert_id();
  //   } else {
  //     return false;
  //   }
  // }
  // public function insert_pr($params = array())
  // {
  //   $this->db->set('createDate', 'GETDATE()', false);
  //   $this->db->set('updateDate', 'GETDATE()', false);
  //   $this->db->insert('[HR_JOBDEV].[dbo].[job]', $params);
  //   if ($this->db->affected_rows() > 0) {
  //     return $this->db->insert_id();
  //   } else {
  //     return false;
  //   }
  // }
}
