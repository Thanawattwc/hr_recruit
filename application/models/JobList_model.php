<?php
defined('BASEPATH') || exit('No direct script access allowed');

class JobList_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

    // $this->load->model('application');
  }


  public function getData($params = array())
  {
    $sql = "SELECT[id]
            ,[positon_name]
            ,[org_name]
            ,[company_code]
            ,[start_date]
            FROM [HR_JOBDEV].[dbo].[job]
            where active = '1' 
            AND [status] = 'Online' 
            AND [start_date] <= GETDATE()
            ";
    if (!empty($params['org_name'])) {
      $sql .= " AND org_name = '" . $params['org_name'] . "'";
    }
    if (!empty($params['plant_code'])) {
      $sql .= " AND [plant_code] = '" . $params['plant_code'] . "'";
    }
    if (!empty($params['company_code'])) {
      $sql .= " AND [company_code] = '" . $params['company_code'] . "'";
    }

    $sql .= " order by id desc";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function getMaster($params = array())
  {
    $sql = "SELECT " . $params['getCol'] . " 
            FROM [HR_JOBDEV].[dbo].[job] j 
            WHERE j.[active] = '1' 
            AND j.[status] = 'Online' ";
    if (!empty($params['org_name'])) {
      $sql .= " AND j.[org_name] = '" . $params['org_name'] . "'";
    }
    if (!empty($params['plant_code'])) {
      $sql .= " AND j.[plant_code] = '" . $params['plant_code'] . "'";
    }
    if (!empty($params['company_code'])) {
      $sql .= " AND j.[company_code] = '" . $params['company_code'] . "'";
    }
    $sql .= " GROUP BY " . $params['getCol'];
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function getMasterPlant_code($params = array())
  {
    $sql = "SELECT j.[plant_code], p.[plant_name]
            FROM [HR_JOBDEV].[dbo].[job] j 
            LEFT JOIN [HR_JOBDEV].[dbo].[plant] p on p.[plant_code] = j.[plant_code]  
            WHERE j.[active] = '1' 
            AND j.[status] = 'Online' ";
    if (!empty($params['org_name'])) {
      $sql .= " AND j.[org_name] = '" . $params['org_name'] . "'";
    }
    if (!empty($params['plant_code'])) {
      $sql .= " AND j.[plant_code] = '" . $params['plant_code'] . "'";
    }
    if (!empty($params['company_code'])) {
      $sql .= " AND j.[company_code] = '" . $params['company_code'] . "'";
    }
    $sql .= " GROUP BY j.[plant_code], p.[plant_name] ";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function getMasterCompany_code($params = array())
  {
    $sql = "SELECT j.[company_code], c.[company_name]
            FROM [HR_JOBDEV].[dbo].[job] j 
            LEFT JOIN [HR_JOBDEV].[dbo].[company] c on c.[company_code] = j.[company_code]
            WHERE j.[active] = '1' 
            AND j.[status] = 'Online' ";
    if (!empty($params['org_name'])) {
      $sql .= " AND j.[org_name] = '" . $params['org_name'] . "'";
    }
    if (!empty($params['plant_code'])) {
      $sql .= " AND j.[plant_code] = '" . $params['plant_code'] . "'";
    }
    if (!empty($params['company_code'])) {
      $sql .= " AND j.[company_code] = '" . $params['company_code'] . "'";
    }
    $sql .= " GROUP BY j.[company_code], c.[company_name] ";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function getMasterOrg_name($params = array())
  {
    $sql = "SELECT j.[org_name]
            FROM [HR_JOBDEV].[dbo].[job] j 
            WHERE j.[active] = '1' 
            AND j.[status] = 'Online' ";
    if (!empty($params['org_name'])) {
      $sql .= " AND j.[org_name] = '" . $params['org_name'] . "'";
    }
    if (!empty($params['plant_code'])) {
      $sql .= " AND j.[plant_code] = '" . $params['plant_code'] . "'";
    }
    if (!empty($params['company_code'])) {
      $sql .= " AND j.[company_code] = '" . $params['company_code'] . "'";
    }
    $sql .= " GROUP BY j.[org_name] ";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
}
