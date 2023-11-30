<?php
defined('BASEPATH') || exit('No direct script access allowed');

class HRList extends CI_Controller
{
  private $_params;

  public function __construct()
  {
    parent::__construct();

    // $this->load->model('JobList_model');
    // $this->load->model('JobCreate_model', 'jc');
    $this->load->model('HR/HRList_model');
    $this->_params = array(
      'active' => 'HRList',
    );
  }

  public function index()
  {
    $this->_params['title']   = 'รายการประกาศงาน (HR)';
    $this->_params['content'] = 'HRList';
    $this->_params['page'] = 'HR/HRList';

    $this->load->view('_shared/layout', $this->_params);
  }

  public function getData()
  {
    $req = array(
      'org_name' => $this->input->get('org_name'),
      'status' => $this->input->get('status'),
      'plant_code' => $this->input->get('plant_code'),
      'company_code' => $this->input->get('company_code'),
    );
    $res = $this->HRList_model->getData($req);
    $res = array_map(
      function ($res) {
        return array(
          'id' => $res['id'],
          'ลำดับ' => $res['id'],
          'Position ID' => $res['postion_id'],
          'ตำแหน่งงาน' => $res['positon_name'],
          'สังกัด' => $res['org_name'],
          'สถานที่ปฎิบัติงาน' => $res['company_code'],
          'วันที่ลงประกาศ' =>  $this->DateThai($res['start_date']),
          'จำนวนวันที่เหลือ' =>  $this->DateThai($res['end_date']),
          'Repost' => $res['repost'],
          'สถานะรายการ' => $res['status'],
        );
      },
      $res
    );
    $this->returnData($res);
  }
  public function getMaster()
  {
    $find = $this->input->get('find');

    $req = array(
      'org_name' => $this->input->get('org_name'),
      'status' => $this->input->get('status'),
      'plant_code' => $this->input->get('plant_code'),
      'company_code' => $this->input->get('company_code'),
    );
    $plant_code = "";
    $org_name = "";
    $company_code = "";
    $status = "";
    if ($find != "plant_code") {
      // $req['getCol'] = "[plant_code]";
      // $plant_code = $this->HRList_model->getMaster($req);
      $plant_code = $this->HRList_model->getMasterPlant_code($req);
    }
    if ($find != "org_name") {
      // $req['getCol'] = "[org_name]";
      // $org_name = $this->HRList_model->getMaster($req);
      $org_name = $this->HRList_model->getMasterOrg_name($req);
    }
    if ($find != "company_code") {
      // $req['getCol'] = "[company_code]";
      // $company_code = $this->HRList_model->getMaster($req);
      $company_code = $this->HRList_model->getMasterCompany_code($req);
    }
    if ($find != "status") {
      // $req['getCol'] = "[status]";
      // $status = $this->HRList_model->getMaster($req);
      $status = $this->HRList_model->getMasterStatus($req);
    }

    $res = array(
      "plant_code" => $plant_code,
      "org_name" => $org_name,
      "company_code" => $company_code,
      "status" => $status,
    );
    $this->returnData($res);
  }

  public function DateThai($strDate)
  {
    $strYear = substr(date("Y", strtotime($strDate)) + 543, 2, 3);
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    if (isset($strDate)) {
      return "$strDay $strMonthThai $strYear";
    } else {
      return '-';
    }
  }
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
