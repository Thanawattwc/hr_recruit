<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Report_model extends CI_Model
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
  public function getListoverall($params = array())
  {
    $getCol = $params['getCol'];
    $sql = "SELECT $getCol
  FROM [HR_JOBDEV].[dbo].[job]
  WHERE [active] = '1'
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
  // public function getDataportal($params = array())
  // {
  //   $getCol = $params['getCol'];
  //   $sql = "SELECT * $getCol
  //  FROM [HR_JOBDEV].[dbo].[job]
  // INNER JOIN [HR_JOBDEV].[dbo].[register]
  // ON [HR_JOBDEV].[dbo].[job].job_number = [HR_JOBDEV].[dbo].[register].job_number
  // INNER JOIN [HR_JOBDEV].[dbo].[log]
  // ON [HR_JOBDEV].[dbo].[register].job_number = [HR_JOBDEV].[dbo].[log].job_number
  // ";
  //   if (!empty($params['sql'])) {
  //     $sql .= $params['sql'];
  //   }

  //   $query = $this->db->query($sql);
  //   $data  = $query->result_array();
  //   if (count($data) > 0) {
  //     return $data;
  //   } else {
  //     return false;
  //   }
  // }
  public function getListA($params = array())
  {
    $sql = "SELECT [id]
    ,[start_date]
    ,[owner_fullname]
    ,[postion_id]
    ,[positon_name]
    ,[company_code]
    ,[org_name]
    FROM [HR_JOBDEV].[dbo].[job]
    WHERE [active] = '1'
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

 
  public function getListB($portal)
  {
    $sql = "SELECT [HR_JOBDEV].[dbo].[register].id
    , [HR_JOBDEV].[dbo].[register].job_number
    , [HR_JOBDEV].[dbo].[register].org_name
    , [HR_JOBDEV].[dbo].[register].location_name
    , [HR_JOBDEV].[dbo].[register].company_name
    , [HR_JOBDEV].[dbo].[register].email
    , [HR_JOBDEV].[dbo].[register].fullname
    , [HR_JOBDEV].[dbo].[register].position_name
    , [HR_JOBDEV].[dbo].[register].Phone
    , [HR_JOBDEV].[dbo].[register].portal
    
    , [HR_JOBDEV].[dbo].[job].job_number
    , [HR_JOBDEV].[dbo].[job].start_date
    , [HR_JOBDEV].[dbo].[job].company_code
    , [HR_JOBDEV].[dbo].[job].org_name
    , [HR_JOBDEV].[dbo].[job].active
    , [HR_JOBDEV].[dbo].[job].company_code
    
    
    , [HR_JOBDEV].[dbo].[company].company_name as company_name2
    
    FROM [HR_JOBDEV].[dbo].[register]
    INNER JOIN [HR_JOBDEV].[dbo].[job] ON [HR_JOBDEV].[dbo].[register].job_number=[HR_JOBDEV].[dbo].[job].job_number
    INNER JOIN [HR_JOBDEV].[dbo].[company] ON [HR_JOBDEV].[dbo].[company].company_code=[HR_JOBDEV].[dbo].[job].company_code
    WHERE [HR_JOBDEV].[dbo].[register].portal='$portal' and [HR_JOBDEV].[dbo].[job].active='1'";
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

  public function getListc($params = array())
  {
    $sql = "SELECT [id]
      ,[org_name]
      ,[location_name]
      ,[email]
      ,[fullname]
      ,[position_name]
      ,[Phone]
    FROM [HR_JOBDEV].[dbo].[register]
    WHERE [portal] = '0'
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

}
