<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('oauth');
	}
	public function index()
	{
		if (isset($_SESSION['user_data']) and is_array($_SESSION['user_data'])) {

			header('HTTP/1.1 301 Moved Permanently');

			if (isset($_SESSION['redirect_url'])) {
				$redirect_url = $_SESSION['redirect_url'];
				unset($_SESSION['redirect_url']);
				header('Location: ' . $redirect_url);
			} else {
				header("Location: " . base_url('/'));
			}
		} else {
			$this->load->view('pages/login');
		}
	}

	public function validate()
	{
		$username = $this->input->post('username'); //html_escape($this->input->post('username'));
		$password = $this->input->post('password'); //html_escape($this->input->post('password'));

		// $data = $this->authentication->validate($username, $password);

		$params = array(
			'USERNAME' => $username,
			'PASSWORD' => $password
		);

		$user_data = $this->checkUser($params);
		$company_data = $this->checkCompany($user_data);

		// print_r($params);
		// print_r($company_data);

		if ($user_data) {
			$data = $this->oauth->login($params);

			if ($data) {
				set_cookie('refresh_token', $data['refresh_token'], _REFRESH_TOKEN_LIFE_);

				$profile = $this->oauth->profile();

				$profile['success']['data']['role'] = $user_data[0]['role'];
				$profile['success']['data']['company'] = $company_data['company'];
				$profile['success']['data']['location'] = $company_data['location'];

				$msg = 'Successfully.';
				$this->json->data = array(
					'success' => array(
						'code' => 200,
						'message' => $msg,
						'data' => $profile
					)
				);

				$_SESSION['user_data'] = $profile['success']['data'];
				$this->session->set_userdata('user_data', $profile['success']['data']);

				header('HTTP/1.1 200 OK');
			} else {
				$msg = 'Invalid Username or Password.';
				$this->json->data = array(
					'error' => array(
						'code' => 401,
						'message' => $msg
					)
				);

				header('HTTP/1.1 401 Unauthorized');
			}
		} else {
			$msg = 'Permission Denied.';
			$this->json->data = array(
				'error' => array(
					'code' => 401,
					'message' => $msg
				)
			);

			header('HTTP/1.1 401 Unauthorized');
		}

		header('Content-Type: application/json');
		$data['output'] = $this->json->export();
		$this->load->view('data/output', $data);
	}

	public function checkUser($params = array())
	{
		$sql = "SELECT * FROM authen WHERE active = '1'";

		if (isset($params['USERNAME'])) {
			$sql .= " AND username  = '" . $params['USERNAME'] . "'";
		}
		$query = $this->db->query($sql);
		$data = $query->result_array();
		if (count($data) > 0) {
			return $data;
		} else {
			return false;
		}
	}

	public function checkCompany($params = array())
	{
		$sql = "SELECT company_code, location_code FROM authen_company WHERE active = '1'";

		if (isset($params['personal_id'])) {
			$sql .= " AND personal_id  = '" . $params['personal_id'] . "'";
		}
		$query = $this->db->query($sql);
		$data = $query->result_array();
		if (count($data) > 0) {
			$company = "";
			$location = "";

			foreach ($data as $key => $value) {
				//   if($company){
				// 	$company .= ", ";
				//   }
				//   if($location){
				// 	$location .= ", ";
				//   }
				if ($value['company_code'] <> null && $company) {
					$company .= ", ";
					$company .= $value['company_code'];
				} elseif ($value['company_code'] <> null && $company == "") {
					$company .= $value['company_code'];
				} else {
					$company = "all";
				}
				if ($value['location_code'] <> null && $location) {
					$location .= ", ";
					$location .= $value['location_code'];
				} elseif ($value['location_code'] <> null && $location == "") {
					$location .= $value['location_code'];
				} else {
					$location = "all";
				}
			};
			$data = array(
				'company' => $company,
				'location' => $location
			);
			return $data;
		} else {
			return false;
		}
	}
}
