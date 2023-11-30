<?php
defined('BASEPATH') || exit('No direct script access allowed');

class JobCreate extends CI_Controller
{
  private $_params;

  public function __construct()
  {
    parent::__construct();

    $this->load->model('HR/JobCreate_model', 'jc');

    $this->_params = array(
      'active' => 'jobCreate',
    );
  }

  public function index()
  {
    // unset($_SESSION);

    $this->_params['title']   = 'สร้างประกาศงาน';
    if(!isset($_GET['edit'])){
      $this->_params['content'] = 'jobCreate';
      if(isset($_GET['id'])){
        $this->_params['data'] = $this->jc->getData($_GET['id']);
      }
    }else{
      // $data = $this->jc->getData($_GET['id']);
      $this->_params['content'] = 'jobCreate';
      $this->_params['data'] = $this->jc->getData($_GET['edit']);
    }
    // $this->_params['content'] = 'jobCreate';
    $this->_params['page'] = 'HR/jobCreate';

    $this->load->view('_shared/layout', $this->_params);
  }

  public function getCompany()
  {
    $data = $this->jc->getCompany();
    if (!empty($data)) {
      $msg = 'Successfully.';
      $this->json->data = array(
        'success' => array(
          'code' => 200,
          'message' => $msg,
          'data' =>  $data
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
  public function getPlant() 
  {
    $data = $this->jc->getPlant();
    if (!empty($data)) {
      $msg = 'Successfully.';
      $this->json->data = array(
        'success' => array(
          'code' => 200,
          'message' => $msg,
          'data' =>  $data
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

  public function create_job()
  {
    $req = array(
      'job_number' =>  $this->input->post('job_number'),
      'start_date' => $this->input->post('start_date'),
      'end_date' => $this->input->post('end_date'),
      'job_portal' => $this->input->post('job_portal'),
      'job_referral' => $this->input->post('job_referral'),
      'company_code' => $this->input->post('company_code'),
      'plant_code' => $this->input->post('plant_code'),
      'org_name' => $this->input->post('org_name'),
      'postion_id' => $this->input->post('postion_id'),
      'positon_name' => $this->input->post('positon_name'),
      'owner_email' => $this->input->post('owner_email'),
      'owner_fullname' => $this->input->post('owner_fullname'),
      'owner_postion_name' => $this->input->post('owner_postion_name'),
      'owner_phone_number' => $this->input->post('owner_phone_number'),
      'cost_center' => $this->input->post('cost_center'),
      'gl_code' => $this->input->post('gl_code'),
      'internal_order' => $this->input->post('internal_order'),
      'budget' => $this->input->post('budget'),
      'position_detail' => $this->input->post('position_detail'),
      'status' => "Online",
      'create_by' => 'System',
      'update_by' => 'System',
      'active' => '1'
    );
    $res = $this->jc->insert_job($req);
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
  public function update_job()
  {
    $req = array(
      'id' =>  $this->input->post('id'),
      'job_number' =>  $this->input->post('job_number'),
      'start_date' => $this->input->post('start_date'),
      'end_date' => $this->input->post('end_date'),
      'job_portal' => $this->input->post('job_portal'),
      'job_referral' => $this->input->post('job_referral'),
      'company_code' => $this->input->post('company_code'),
      'plant_code' => $this->input->post('plant_code'),
      'org_name' => $this->input->post('org_name'),
      'postion_id' => $this->input->post('postion_id'),
      'positon_name' => $this->input->post('positon_name'),
      'owner_email' => $this->input->post('owner_email'),
      'owner_fullname' => $this->input->post('owner_fullname'),
      'owner_postion_name' => $this->input->post('owner_postion_name'),
      'owner_phone_number' => $this->input->post('owner_phone_number'),
      'cost_center' => $this->input->post('cost_center'),
      'gl_code' => $this->input->post('gl_code'),
      'internal_order' => $this->input->post('internal_order'),
      'budget' => $this->input->post('budget'),
      'position_detail' => $this->input->post('position_detail'),
      'status' => "Online",
      'create_by' => 'System',
      'update_by' => 'System',
      'active' => '1'
    );
    $res = $this->jc->update_job($req);
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

  public function gen_runno()
  {
    $req = array(
      'company_code' =>  $this->input->post('company_code'),
    );
    if (!empty($req['company_code'])) {
    }
    $rn = $this->jc->getRunNumber($req);

    if (!empty($rn)) {
      $number = $rn[0]['number'];
      $number = $number + 1;
    } else {
      $number = '0001';
    }
    $req += array('number' =>  $number,);
    if ($this->jc->genRunNumber($req)) {
      $data = $this->jc->getRunNumber($req);
      $check = true;
    } else {
      $data = $req;
      $check = false;
    }



    $this->returnData($data, $check);
  }
  public function upload_test()
  {
    $config['upload_path'] = 'upload/';
    $config['allowed_types'] = 'txt|pdf|jpg|png';
    $config['max_size']     = '0';
    $this->upload->initialize($config);

    // $this->upload->do_upload('testFile');
    // $res = $this->upload->data('file_name');
    // if ($this->upload->display_errors()) {
    //   $this->returnWeb($res, "error");
    // } else {
    //   $this->returnWeb($res, "success");
    // }

    if (isset($_FILES['file']['name'])) {
      if (0 < $_FILES['file']['error']) {
        echo 'Error during file upload' . $_FILES['file']['error'];
      } else {
        if (file_exists('upload/' . $_FILES['file']['name'])) {
          // echo 'File already exists : uploads/' . $_FILES['file']['name'];
        } else {
          // $this->load->library('upload', $config);
          if (!$this->upload->do_upload('file')) {
            echo $this->upload->display_errors();
          } else {
            // echo 'File successfully uploaded : uploads/' . $_FILES['file']['name'];
          }
        }
      }
    } else {
      echo 'Please choose a file';
    }
  }

  public function returnData($res, $status)
  {
    if ($status) {
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
