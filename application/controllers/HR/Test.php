<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Test extends CI_Controller
{
  private $_params;

  public function __construct()
  {
    parent::__construct();

    // $this->load->model('HR/HRList_model');
    $this->load->model('HR/Test_model');

    $this->_params = array(
      'active' => 'Test',
    );
  }

  public function index()
  {
    // unset($_SESSION);

    // echo "123344";
    // exit();

    // $this->_params['title']   = ($this->application->language == 'th') ? 'รายการประกาศงาน' : 'jobList';
    $this->_params['title']   = 'test';
    $this->_params['content'] = 'Test';
    $this->_params['page'] = 'HR/test';

    $this->load->view('_shared/layout', $this->_params);
  }

  // public function getCompany()
  // {
  //   // $req = array(

  //   //   'company_code' => $this->input->get('company_code'),
  //   //   'company_name' => $this->input->get('company_name'),
  //   //   // 'status' => $this->input->get('status'),
  //   // );
  //   //  print_r ($req);
  //   $data = $this->Test_model->getCompany();
  //   if (!empty($data)) {
  //     $msg = 'Successfully.';
  //     $this->json->data = array(
  //       'success' => array(
  //         'code' => 200,
  //         'message' => $msg,
  //         'data' =>  $data
  //       )
  //     );
  //     header('HTTP/1.1 200 OK');
  //   } else {
  //     $msg = 'error';
  //     $this->json->data = array(
  //       'error' => array(
  //         'code' => 405,
  //         'message' => $msg
  //       )
  //     );
  //     header('HTTP/1.1 405 Method Not Allowed');
  //   }
  //   header('Content-Type: application/json');
  //   $data['output'] = $this->json->export();
  //   $this->load->view('data/output', $data);
  // }

  // public function getLocation() 
  // {
  //   // $req = array(
  //   //   'location_code' => $this->input->get('location_code'),
  //   //   'location_name' => $this->input->get('location_name'),
  //   //   // 'status' => $this->input->get('status'),
  //   // );
  //   //  print_r ($req);
  //   $data = $this->Test_model->getLocation();
  //   if (!empty($data)) {
  //     $msg = 'Successfully.';
  //     $this->json->data = array(
  //       'success' => array(
  //         'code' => 200,
  //         'message' => $msg,
  //         'data' =>  $data
  //       )
  //     );
  //     header('HTTP/1.1 200 OK');
  //   } else {
  //     $msg = 'error';
  //     $this->json->data = array(
  //       'error' => array(
  //         'code' => 405,
  //         'message' => $msg
  //       )
  //     );
  //     header('HTTP/1.1 405 Method Not Allowed');
  //   }
  //   header('Content-Type: application/json');
  //   $data['output'] = $this->json->export();
  //   $this->load->view('data/output', $data);
  // }

  // public function org_name()
  // {
  //   $data = $this->Test_model->get_org();
  //   $this->returnData($data);
  // }
  public function getData()
  {
    $req = array(
 
      'org_name' => $this->input->get('org_name'),
      'status' => $this->input->get('status'),
      'location' => $this->input->get('location'),
    );
    // print_r ($req);
    $data = $this->Test_model->getData($req);
    $this->returnData($data);
  }
  public function add()
  {
    $req = array(
      'company' => $this->input->get('company_code'),
      'location' => $this->input->get('location_code'),
      'org' => $this->input->get('org_name'),
      'id' => $this->input->get('id'),
    //   'createBy' => $this->application->me['user_info']['id'],
    );
   
    if ($this->input->POST('count')) {
      $req += array(
        'count' => $this->input->POST('count'),
      );
    } else {
      $req += array(
        'limit'  => $this->input->POST('limit'),
        'offset' => $this->input->POST('offset'),
      );
    }
    
    $res = $this->check->get($req);


    if (isset($res)) {
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
      // $msg = 'error';
      $this->json->data = array(
        'error' => array(
          'code' => 405,
          'message' => $req . "=>" . $res
        )
      );
      header('HTTP/1.1 405 Method Not Allowed');
    }
    header('Content-Type: application/json');
    $data['output'] = $this->json->export();
    $this->load->view('data/output', $data);
  }

  
  public function test()
  {
    
    // $req = array(
    //   'org_name' => $this->input->get('org_name'),
    //   'company' => $this->input->get('company'),
    //   'location' => $this->input->get('location'),
    // );
    $data = array(
      'org' => $this->Test_model->get_org(),
      'company' => $this->Test_model->get_Company(),
      'location' => $this->Test_model->get_Location(),
      'datatesting' => $this->input->post('datatesting'),
    );

    $this->returnData($data);
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
