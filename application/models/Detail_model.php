<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Detail_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();

    // $this->load->model('application');
  }

  //   public function get($params = array())
  //   {
  //     if (isset($params['count']))
  //     {
  //       $sql = 'SELECT COUNT(id) AS count';
  //     }
  //     else
  //     {
  //       $sql = 'SELECT *';
  //     }

  //     $sql .= ' FROM job';

  //     if (isset($params['id']))
  //     {
  //       $sql .= ' WHERE id = ?';
  //       $condition = array($params['id']);
  //     }
  //     // else if (isset($params['keyword']))
  //     // {
  //     //   $sql .= ' WHERE ';

  //     //   $search_condition = array();

  //     //   foreach (explode(' ', $params['keyword']) as $value)
  //     //   {
  //     //     $date_condition = 'DATE_FORMAT(DATE_ADD(create_date, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(create_date, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(create_date)), "," , -1), DATE_FORMAT(DATE_ADD(last_modified, INTERVAL 543 YEAR), "%Y"), DATE_FORMAT(last_modified, "%M"), SUBSTRING_INDEX(SUBSTRING_INDEX(@month_th, ",", MONTH(last_modified)), "," , -1)';

  //     //     array_push($search_condition, 'CONCAT_WS("", title, create_date, last_modified, ' . $date_condition . ') LIKE \'%' . $this->db->escape_like_str($value) . '%\'');
  //     //   }

  //     //   $sql .= implode(' AND ', $search_condition);
  //     // }

  //     $sql .= ' ORDER BY create_date DESC';

  //     if (isset($params['limit']) && isset($params['offset']))
  //     {
  //       if (_DATABASE_DRIVER_ == 'sqlsrv')
  //       {
  //         $sql .= ' OFFSET ' . $params['limit'] . ' ROWS FETCH NEXT ' . $params['offset'] . ' ROWS ONLY';
  //       }
  //       else if (_DATABASE_DRIVER_ == 'mysqli')
  //       {
  //         $sql .= ' LIMIT ' . $params['limit'] . ', ' . $params['offset'];
  //       }
  //     }

  //     $this->db->query('SET @month_th = "มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม"');

  //     $query = $this->db->query($sql, isset($condition) ? $condition : false);
  //     $data  = $query->result_array();

  //     if (count($data) > 0)
  //     {
  //       return $data;
  //     }
  //     else
  //     {
  //       return false;
  //     }
  //   }
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
  public function getData($params)
  {
    $sql = "SELECT *
            FROM [HR_JOBDEV].[dbo].[job]
            WHERE [id] = $params
        ";
    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }
  public function getList($params = array())
  {
    $getCol = $params['getCol'];
    $sql = "SELECT $getCol
    -- [id]
    -- ,[number]
    -- ,[status]
    -- ,[org_name_th]
    -- ,[org_name_en]
    -- ,[pos_id]
    -- ,[pos_name_th]
    -- ,[pos_name_en]
    -- ,[detail_number]
    -- ,[company]
    -- ,[plant]
    -- ,[priority]
    -- ,[start_date]
    -- ,[end_date]
    -- ,[duplicate]
    -- ,[hr_contact]
    -- ,[create_by]
    -- ,[create_date]
    -- ,[update_by]
    -- ,[update_date]
    -- ,[active]
    FROM [HR_JOBDEV].[dbo].[job]
    WHERE [active] = '1'
    and [status] = 'Online'
    ";
    if (!empty($params['sql'])) {
      $sql .= $params['sql'];
    }

    $query = $this->db->query($sql);
    $data  = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }

  public function get_number($params = array()) ////
  {
    $sql = " SELECT top 1
      company_code
      ,year
      ,month
      ,day
      ,number
      FROM [HR_JOBDEV].[dbo].[tbl_runningnumber]

    Where type = '" . $params['type']
      . "' and date = '" . $params['date'] . "'
    order by number desc
    ";
    $query = $this->db->query($sql);
    $data = $query->result_array();
    if (count($data) > 0) {
      return $data;
    } else {
      return false;
    }
  }


  public function insert_number($params = array()) //
  {
    $this->db->insert('tbl_runningnumber', $params);
    if ($this->db->affected_rows() > 0) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }

  public function insert_job($params = array())
  {
    $sql = "INSERT INTO [HR_JOBDEV].[dbo].[register]( 
         [job_number]
      ,[position_id]
      ,[org_name]
      ,[location_name]
      ,[company_name]
      ,[email]
      ,[fullname]
      ,[position_name]
      ,[Phone]
      ,[file_path]
      ,[create_date]
      ,[portal]) values ('"
      . $params['job_number']
      . "', '" . $params['position_id']
      . "', '" . $params['org_name']
      . "', '" . $params['location_name']
      . "', '" . $params['comapany_name']
      . "', '" . $params['email']
      . "', '" . $params['fullname']
      . "', '" . $params['position_name']
      . "', '" . $params['Phone']
      . "', '" . $params['file_path'] . "'
      ,getdate(), '" . $params['portal'] . "')
      ";
    // return $sql;

    $query = $this->db->query($sql);

    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }

  public function insert_register($params = array())
  {
    $sql = "INSERT INTO [HR_JOBDEV].[dbo].[register]
    ([job_number]
    ,[emp_id]
    ,[fullname]
    ,[user_name]
    ,[email]
    ,[phone]
    ,[company_code]
    ,[company_name]
    ,[plant_code]
    ,[plant_name]
    ,[org_name]
    ,[position_name]
    ,[file_path]
    ,[portal]
    ,[create_date] ) VALUES
    (
    '" . $params['job_number'] . "'
    ,'" . $params['emp_id'] . "' 
    ,'" . $params['fullname'] . "' 
    ,'" . $params['user_name'] . "' 
    ,'" . $params['email'] . "' 
    ,'" . $params['phone'] . "' 
    ,'" . $params['company_code'] . "' 
    ,'" . $params['company_name'] . "' 
    ,'" . $params['plant_code'] . "' 
    ,'" . $params['plant_name'] . "' 
    ,'" . $params['org_name'] . "' 
    ,'" . $params['position_name'] . "' 
    ,'" . $params['file_path'] . "' 
    ," . $params['portal'] . " 
    ,GETDATE() 
    )";
    $this->db->query($sql);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else {

      return false;
    }
  }
}
