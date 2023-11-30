<?php
defined('BASEPATH') || exit('No direct script access allowed');

class RoleConfig_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

    // $this->load->model('application');
  }
  public function getData($params = array())
  {
    $sql = "SELECT
        [id]
        ,[fullname]
        ,[position_name]
        ,[username]
        ,[email]
        ,[Phone]
        ,[role]
    FROM [HR_JOBDEV].[dbo].[authen]
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
  public function updateData($params = array())
  {
    $sql = "UPDATE [HR_JOBDEV].[dbo].[authen]
        SET [fullname] = ?
        ,[position_name] = ?
        ,[username] = ?
        ,[email] = ?
        ,[Phone] = ?
        ,[role] = ?
        ,[update_date] = getdate()
        ,[update_by] = ?
    WHERE [active] = '1' AND [id] = ?
    ";
    $values = array(
      $params['fullName'], $params['position'], $params['username'], $params['email'], $params['phone'], $params['role'],$params['updateBy'], $params['id']
    );
    $this->db->query($sql, isset($values) ? $values : false);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }
  public function insertData($params = array())
  {
    $sql = "INSERT INTO [HR_JOBDEV].[dbo].[authen] (
            [position_name]
            ,[username]
            ,[fullname]
            ,[email]
            ,[Phone]
            ,[role]
            ,[active]
            ,[create_date]
            ,[create_by]
            ,[update_date]
            ,[update_by])
            VALUES( ?,?,?,?,?,?,1,getdate(),?,getdate(),?)
    ";
    $values = array(
      $params['position'],  $params['username'], $params['fullName'], $params['email'], $params['phone'], $params['role'],$params['updateBy'], $params['updateBy']
    );
    $this->db->query($sql, isset($values) ? $values : false);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }
}
