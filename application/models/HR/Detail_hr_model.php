<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Detail_hr_model extends CI_Model
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
            ,[org_name]
            ,[postion_id]
            ,[positon_name]
            ,[owner_email]
            ,[owner_fullname]
            ,[owner_postion_name]
            ,[owner_phone_number]
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

  public function update_status($params = array())
  {
    $sql = "UPDATE [HR_JOBDEV].[dbo].[job]
    SET [status] = ?
      ,[update_date] = getdate()
      ,[update_by] = ?
    WHERE [id] = ?
    ";
    $values = array(
      $params['status'], $params['update_by'], $params['id'],
    );
    $this->db->query($sql, isset($values) ? $values : false);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }
  public function update_repost($params = array())
  {
    $sql = "UPDATE [HR_JOBDEV].[dbo].[job]
    SET [active] = 0
      ,[update_date] = getdate()
      ,[update_by] = ?
    WHERE [id] = ?
    ";
    $values = array(
     $params['update_by'], $params['id'],
    );
    $this->db->query($sql, isset($values) ? $values : false);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }
  public function repost($params = array()){
    $sql = "INSERT INTO [HR_JOBDEV].[dbo].[job]
    ( [job_number]
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
    ,[update_by] )
    SELECT 
    [job_number]
    ,GETDATE()
    ,DATEADD(MONTH,1,GETDATE())
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
    ,'Online'
    ,'1'
    ,[repost] + 1
    ,GETDATE()
    ,?
    ,GETDATE()
    ,?
    FROM [HR_JOBDEV].[dbo].[job]
    WHERE [id] = ?
    ";
    $values = array(
      $params['update_by'], $params['update_by'], $params['id'],
    );
    $query = $this->db->query($sql, isset($values) ? $values : false);
    $data=$this->db->insert_id();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }

}
