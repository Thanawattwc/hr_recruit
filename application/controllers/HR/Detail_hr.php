<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Detail_hr extends CI_Controller
{
  private $_params;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('HR/Detail_hr_model', 'detail');

    $this->_params = array(
      'active' => 'Detail_hr',
    );
  }

  public function index()
  {
    // unset($_SESSION);
    $data = $this->detail->getData($_GET['id']);
    $this->_params['title']   = 'รายละเอียดประกาศงาน';
    $this->_params['content'] = 'Detail_hr';
    $this->_params['page'] = 'HR/Detail_hr';
    $this->_params['data'] = $data;
    $this->load->view('_shared/layout', $this->_params);
  }
  public function update_status()
  {
    $req = array(
      "id" => $this->input->POST("id"),
      "status" => $this->input->POST("status"),
      "update_by" => $_SESSION['user_data']['user_info']['username'],
    );
    $res = $this->detail->update_status($req);
    $this->returnData($res);
  }
  public function repost()
  {
    $req = array(
      "id" => $this->input->POST("id"),
      "update_by" => $_SESSION['user_data']['user_info']['username'],
    );
    if ($this->detail->update_repost($req)) {
      $res = $this->detail->repost($req);
    } else {
      $res = false;
    };
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
