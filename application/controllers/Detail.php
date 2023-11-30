<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Detail extends CI_Controller
{
  private $_params;

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Detail_model');
    $this->_params = array(
      'active' => 'Detail',
    );
  }

  public function index()
  {
    $data = $this->Detail_model->getData($_GET['id']);
    $this->_params['title']   = 'รายละเอียดประกาศงาน';
    $this->_params['content'] = 'Detail';
    $this->_params['data'] = $data;
    $this->load->view('_shared/layout', $this->_params);
  }

  public function post_portal()
  {
    $req = array(
      'job_number' =>  $this->input->post('job_number'),
      'position_id' => $this->input->post('position_id'),
      'org_name' => $this->input->post('org_name'),
      'company_name' => $this->input->post('company_name'),
      'location_name' => $this->input->post('location_name'),
      'email' => $this->input->post('email'),
      'fullname' => $this->input->post('fullname'),
      'position_name' => $this->input->post('position_name'),
      'Phone' => $this->input->post('Phone'),
      'file_path' => 's',
      'portal' => $this->input->post('portal')
    );
    $res = $this->Detail_model->insert_job($req);
    if (!empty($res)) {
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
          'message' => $msg
        )
      );
      header('HTTP/1.1 405 Method Not Allowed');
    }
    header('Content-Type: application/json');
    $data['output'] = $this->json->export();
    $this->load->view('data/output', $data);
  }

  public function convertpdf()
  {
    $this->load->library('pdf');
    $data = $this->Detail_model->getData($_GET['id']);
    $filename = '1234';
    $css = '
      table{
          font-family: "sarabun";
          border: 1px solid; 
          border-color: red;
          width:100%;
      }
      th{
          font-family: "sarabun";
          border: 1px solid; 
          border-color: green;
      }
      td{
          font-family: "sarabun";
          border: 1px solid; 
          border-color: blue;
      }
    ';
    $html = "<h1>" . $data[0]['positon_name'] . "</h1>";
    $html .= $data[0]['position_detail'];
    $html .= "<p> ส่งข้อมูลที่ คุณ" . $data[0]['owner_fullname'] . " Email : " . $data[0]['owner_email'] . " ติดต่อ : " . $data[0]['owner_phone_number'] . "</p>";
    $html .= "<p> Email : " . $data[0]['owner_email'] . "</p>";
    $html .= "<p> ติดต่อ : " . $data[0]['owner_phone_number'] . "</p>";
    $this->pdf->create($html, $css, $filename);
  }

  public function send()
  {
    foreach ($_POST as $key => $value) {
      $req[$key] = $this->input->post($key);
    }
    $res = $this->Detail_model->insert_register($req);
    $this->returnWeb($res, "success");
  }

  public function returnWeb($res, $msg)
  {
    if ($msg == "success") {
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
      $msg = 'Something Wrong !!!';
      $this->json->data = array(
        'error' => array(
          'code' => 405,
          'message' => $msg,
          'data' =>  $res
        )
      );
      header('HTTP/1.1 405 Method Not Allowed');
    }
    header('Content-Type: application/json');
    $data['output'] = $this->json->export();
    $this->load->view('data/output', $data);
  }
}
