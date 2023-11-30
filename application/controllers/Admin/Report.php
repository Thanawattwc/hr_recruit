<?php

use Mpdf\Tag\P;

defined('BASEPATH') || exit('No direct script access allowed');

class Report extends CI_Controller
{
  private $_params;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('admin/Report_model', 'report');

    $this->_params = array(
      'active' => 'report',
    );
  }

  public function index()
  {
    // unset($_SESSION);

    // $this->_params['title']   = ($this->application->language == 'th') ? 'รายการประกาศงาน' : 'jobList';
    $this->_params['title']   = 'รายงาน';
    $this->_params['content'] = 'report';
    $this->_params['page'] = "admin/report";

    $this->load->view('_shared/layout', $this->_params);
  }
  

  public function getList()
  {
    // $req = array(
    //     "id" => $this->input->GET('id'),
    // );
    $dataType = $this->input->GET('type');
    if ($dataType == 'all') {
      $res = $this->report->getListA();
      $res = array_map(function ($res) {
        return array(
          'id' => $res['id'],
          'ลำดับ' => $res['id'],
          'วันที่ลงประกาศ' => $res['start_date'],
          'ชื่อ-สกุลที่ลงประกาศ' => $res['owner_fullname'],
          'Position ID' => $res['postion_id'],
          'ตำแหน่งงาน' => $res['positon_name'],
          'บริษัท' => $res['company_code'],
          'สังกัดกลุ่มธุรกิจ,กลุ่มงาน,สายงาน,ด้าน,ฝ่าย' => $res['org_name'],
        );
      }, $res);
    } else if ($dataType == 'referral') {
      $res = $this->report->getListB('0');
    

      // var_dump( $res);
      $res = array_map(function ($res) {
       
        // var_dump($res2);
        return array(
          'id' => $res['id'],
          'ลำดับ' => $res['id'],
          // 'job_number' => $res['job_number'],
          'วันที่ลงประกาศ' => $res['start_date'],
          'ชื่อ-สกุลที่ต้องการขอโอนย้าย' => $res['fullname'],
          'org_name' => $res['org_name'],
          'ตำแหน่งปัจจุบัน' => $res['position_name'],
          'บริษัท' => $res['company_name2'],
          'สังกัดกลุ่มธุรกิจ,กลุ่มงาน,สายงาน,ด้าน,ฝ่าย' => $res['org_name'],
          'สถานที่ทำงาน' => $res['location_name'],
          'เบอร์มือถือ' => $res['Phone'],
          'email' => $res['email'],
        );
      }, $res);


    } else if ($dataType == 'portal') {
      $res = $this->report->getListB('1');
      $res = array_map(function ($res) {
        return array(

          'id' => $res['id'],
          'ลำดับ' => $res['id'],
          // 'วันที่ลงประกาศ' => $res['start_date'],
          'ชื่อ-สกุล ที่ต้องการแนะนำ' => $res['fullname'],
          'สังกัดกลุ่มธุรกิจ,กลุ่มงาน,สายงาน,ด้าน,ฝ่าย' => $res['org_name'],
          'ตำแหน่งปัจจุบัน' => $res['position_name'],
          // 'บริษัท' => $res['company_code'],
          // 'สังกัดกลุ่มธุรกิจ,กลุ่มงาน,สายงาน,ด้าน,ฝ่าย' => $res['org_name'],
          'สถานที่ทำงาน' => $res['location_name'],
          'เบอร์มือถือ' => $res['Phone'],
          'email' => $res['email'],
        );
      }, $res);
    } else {
      $res = false;
    }
    $this->returnData($res);
  }

  public function getListdaft()
  {
    // $req = array(
    //     "id" => $this->input->GET('id'),
    // );
    // $res = $this->master->getList($req);
    $res = $this->Report_model->getList();
    if ($res) {
      $msg = 'Successfully.';
      $this->json->data = array(
        'success' => array(
          'code' => 200,
          'message' => $msg,
          'data' =>  $res
        )
      );
      header('HTTP/1.1 200 OK');
    } else {
      $msg = 'error';
      $this->json->data = array(
        'error' => array(
          'code' => 405,
          'message' => $res
        )
      );
      header('HTTP/1.1 405 Method Not Allowed');
    }
    header('Content-Type: application/json');
    $data['output'] = $this->json->export();
    $this->load->view('data/output', $data);
  }

  // public function getListoverall()
  // {
  //   $req = array(
  //     "getCol" => "[id]
  //       ,[start_date]
  //       ,[owner_fullname]
  //       ,[postion_id]
  //       ,[positon_name]
  //       ,[company_code]
  //       ,[org_name]",
  //   );
  //   $res = $this->report->getListoverall($req);
  //   // print_r($res);

  //   $res = array_map(function ($res) {
  //     return array(
  //       'id' => $res['id'],
  //       'ลำดับ' => $res['id'],
  //       'วันที่ลงประกาศ' => $res['start_date'],
  //       'ชื่อ-สกุลที่ลงประกาศ' => $res['owner_fullname'],
  //       'Position ID' => $res['postion_id'],
  //       'ตำแหน่งงาน' => $res['positon_name'],
  //       'บริษัท' => $res['company_code'],
  //       'สังกัดกลุ่มธุรกิจ,กลุ่มงาน,สายงาน,ด้าน,ฝ่าย' => $res['org_name'],
  //     );
  //   }, $res);
  //   $this->returnData($res);
  // }

  // public function getDataportal()
  // {
  //   $req = array(
  //     "getCol" => "[id]
  //       ,[start_date]
  //       ,[fullname]
  //       ,[position_name]
  //       ,[company_code]
  //       ,[org_name]
  //       ,[location_name]
  //       ,[Phone]
  //       ,[email]",
  //   );
  //   $res = $this->report->getDataportal($req);
  //   print_r($res);

  //   $res = array_map(function ($res) {
  //     return array(
  //       'id' => $res['id'],
  //       'ลำดับ' => $res['id'],
  //       'วันที่ลงประกาศ' => $res['start_date'],
  //       'ชื่อ-สกุลที่ ที่ต้องการขอโอนย้าย' => $res['fullname'],
  //       'ตำแหน่งปัจจุบัน' => $res['position_name'],
  //       'บริษัท' => $res['company_code'],
  //       'สังกัดกลุ่มธุรกิจ,กลุ่มงาน,สายงาน,ด้าน,ฝ่าย' => $res['org_name'],
  //       'สถานที่ทำงาน' => $res['location_name'],
  //       'เบอร์มือถือ' => $res['Phone'],
  //       'email' => $res['email'],
  //     );
  //   }, $res);
  //   $this->returnData($res);
  // }




  public function returnData($res)
  {
    if ($res) {
      $msg = 'Successfully.';
      $this->json->data = array(
        'success' => array(
          'code' => 200,
          'message' => $msg,
          'data' =>  $res
        )
      );
      header('HTTP/1.1 200 OK');
    } else {
      $msg = 'error';
      $this->json->data = array(
        'error' => array(
          'code' => 405,
          'message' => $res
        )
      );
      header('HTTP/1.1 405 Method Not Allowed');
    }
    header('Content-Type: application/json');
    $data['output'] = $this->json->export();
    $this->load->view('data/output', $data);
  }
}
