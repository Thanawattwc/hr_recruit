<?php
defined('BASEPATH') || exit('No direct script access allowed');

class JobCreate_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

    // $this->load->model('application');
  }
  public function getData($params)
  {
    $sql = "SELECT [id]
            ,[job_number]
            ,[start_date]
            ,[end_date]
            ,[job_portal]
            ,[job_referral]
            ,[company_code]
            ,[plant_code]
            ,[org_name]
            ,[postion_id]
            ,[positon_name]
            ,[owner_email]
            ,[owner_fullname]
            ,[owner_postion_name]
            ,[owner_phone_number]
            ,[cost_center]
            ,[gl_code]
            ,[internal_order]
            ,[budget]
            ,[position_detail]
            ,[status]
            FROM [HR_JOBDEV].[dbo].[job]
            WHERE [active] = 1  AND [id] = $params
        ";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function getRunNumber($params = array())
  {
    $sql = "SELECT TOP 1
    [id]
    ,[company_code]
    ,[year]
    ,[month]
    ,[day]
    ,[number]
    ,[create_date]
    FROM [HR_JOBDEV].[dbo].[runningnumber]
    WHERE [company_code] = '" . $params['company_code'] . "' 
     AND [year]  = '" . date("y") . "' 
     AND [month]  = '" . date("m") . "' 
     AND [day]  = '" . date("d") . "'";
    if (!empty($params['number'])) {
      $sql .= "AND [number]  = '" . $params['number'] . "'";
    }
    $sql .= "Order BY [number] DESC";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function genRunNumber($params = array())
  {
    $sql = "insert into [HR_JOBDEV].[dbo].[runningnumber]
    ([company_code]
    ,[year]
    ,[month]
    ,[day]
    ,[number]
    ,[create_date]
    ) values ('" . $params['company_code'] . "' 
     , '" . date("y") . "' 
     , '" . date("m") . "' 
     , '" . date("d") . "' 
     , '" . $params['number'] . "' 
     , getdate()
    )";
    $query = $this->db->query($sql);

    if ($this->db->affected_rows() > 0) {

      return true;
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
  public function getPlant()
  {
    $sql = "SELECT
    [plant_code]
    ,[plant_name]
    FROM [HR_JOBDEV].[dbo].[plant]
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

  public function insert_job($params = array())
  {
    $sql = "INSERT INTO [HR_JOBDEV].[dbo].[job]( 
      [job_number]
     ,[start_date]
     ,[end_date]
     ,[job_portal]
     ,[job_referral]
     ,[company_code]
     ,[plant_code]
     ,[org_name]
     ,[postion_id]
     ,[positon_name]
     ,[owner_email]
     ,[owner_fullname]
     ,[owner_postion_name]
     ,[owner_phone_number]
     ,[cost_center]
     ,[gl_code]
     ,[internal_order]
     ,[budget]
     ,[position_detail]
     ,[status]
     ,[active]
     ,[repost]
     ,[create_date]
     ,[create_by]
     ,[update_date]
     ,[update_by]) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,1,0, getdate(),?, getdate(),?)";
    $values = array(
      $params['job_number'], $params['start_date'], $params['end_date'], $params['job_portal'], $params['job_referral'], $params['company_code'], $params['plant_code'], $params['org_name'], $params['postion_id'], $params['positon_name'], $params['owner_email'], $params['owner_fullname'], $params['owner_postion_name'], $params['owner_phone_number'], $params['cost_center'], $params['gl_code'], $params['internal_order'], $params['budget'], $params['position_detail'], $params['status'], $params['create_by'], $params['update_by']
    );
    $this->db->query($sql, isset($values) ? $values : false);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }
  public function update_job($params = array())
  {
    $sql = "UPDATE [HR_JOBDEV].[dbo].[job]
      SET 
      [job_number] = ?
     ,[start_date] = ?
     ,[end_date] = ?
     ,[job_portal] = ?
     ,[job_referral] = ?
     ,[company_code] = ?
     ,[plant_code] = ?
     ,[org_name] = ?
     ,[postion_id] = ?
     ,[positon_name] = ?
     ,[owner_email] = ?
     ,[owner_fullname] = ?
     ,[owner_postion_name] = ?
     ,[owner_phone_number] = ?
     ,[cost_center] = ?
     ,[gl_code] = ?
     ,[internal_order] = ?
     ,[budget] = ?
     ,[position_detail] = ?
     ,[update_date] = getdate()
     ,[update_by] = ?
     WHERE [ID] = ?
     ";
    $values = array(
      $params['job_number']
      , $params['start_date']
      , $params['end_date']
      , $params['job_portal']
      , $params['job_referral']
      , $params['company_code']
      , $params['plant_code']
      , $params['org_name']
      , $params['postion_id']
      , $params['positon_name']
      , $params['owner_email']
      , $params['owner_fullname']
      , $params['owner_postion_name']
      , $params['owner_phone_number']
      , $params['cost_center']
      , $params['gl_code']
      , $params['internal_order']
      , $params['budget']
      , $params['position_detail']
      , $params['update_by']
      , $params['id']
    ); 
    $this->db->query($sql, isset($values) ? $values : false);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }
}
