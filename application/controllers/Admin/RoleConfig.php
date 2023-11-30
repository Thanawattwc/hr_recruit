<?php
defined('BASEPATH') || exit('No direct script access allowed');

class RoleConfig extends CI_Controller
{
  private $_params;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('admin/RoleConfig_model');

    $this->_params = array(
      'active' => 'roleConfig',
    );
  }

  public function index()
  {
    // unset($_SESSION);

    $this->_params['title']   = 'ตั้งค่าสิทธิ์';
    $this->_params['content'] = 'roleConfig';

    $this->load->view('_shared/layout', $this->_params);
  }
  public function getData()
  {
    $res = $this->RoleConfig_model->getData();
    $this->returnData($res);
  }
  public function updateData()
  {
    $req = array(
      "fullName" => $this->input->post("fullName"),
      "position" => $this->input->post("position"),
      "username" => $this->input->post("username"),
      "email" => $this->input->post("email"),
      "phone" => $this->input->post("phone"),
      "role" => $this->input->post("role"),
      "id" => $this->input->post("id"),
      "updateBy" => "System",
    );
    $res = $this->RoleConfig_model->updateData($req);
    $this->returnData($res);
  }
  public function addData()
  {
    $req = array(
      "fullName" => $this->input->post("fullName"),
      "position" => $this->input->post("position"),
      "username" => $this->input->post("username"),
      "email" => $this->input->post("email"),
      "phone" => $this->input->post("phone"),
      "role" => $this->input->post("role"),
      "updateBy" => "System",
    );
    $res = $this->RoleConfig_model->insertData($req);
    $this->returnData($res);
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
