<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();
	}

	public function isLogin()
	{
		if(!isset($_SESSION['user_data']) and !is_array($_SESSION['user_data']))
		{
			header("Location: " . base_url('login'));
		}
	}

	public function validate($username, $password)
	{
				define('_MP_API_','');
				define('_MP_API_KEY_','');

				$params = array(
					'username' => $username,
					'password' => $password
				);

				$service_url = '/authentication/login';

				$curl = curl_init();

				curl_setopt_array($curl, array(
				CURLOPT_PORT => "3001",
				CURLOPT_URL => _MP_API_ . $service_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_SSL_VERIFYHOST => false,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => http_build_query($_POST),
				CURLOPT_HTTPHEADER => array(
			"App-Key: " . _MP_API_KEY_,
			"Content-Type: application/x-www-form-urlencoded"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err)
		{
		  return false;
		}
		else
		{
		  $response = json_decode($response, TRUE);
		  if(isset($response['success']))
		  {
				$user_data = $this->checkUser($username);
				
				if($user_data)
				{
					$response['success']['data']['role'] = $user_data[0]['role'];
					// $response['success']['data']['factory_code'] = $user_data[0]['factory_code'];
					// $response['success']['data']['zone'] = $user_data[0]['zone'];
					// $response['success']['data']['warehouse_code'] = $user_data[0]['warehouse_code'];
					// $response['success']['data']['approve_type'] = $user_data[0]['type'];
					// $response['success']['data']['checker'] = $user_data[0]['checker'];
					// $response['success']['data']['maker'] = $user_data[0]['maker'];
					return $response['success']['data'];
				}
				else
				{
					return false;
				}
			}
		}
	}

	public function checkUser($username)
	{
		$sql = "SELECT * FROM authen WHERE username ='".$username."' ";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		if(count($data) > 0)
		{
			return $data;
		}
		else
		{
			return false;
		}
	}
}
