<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('authentication');
	}
	public function index()
	{
		if(isset($_SESSION['user_data']) and is_array($_SESSION['user_data']))
		{
			$this->session->unset_userdata('redirect_url');
			$this->session->unset_userdata('user_data');

			header("HTTP/1.1 301 Moved Permanently");
			header("Location: ".base_url('/'));
		}
		else
		{
			$this->load->view('pages/login');
		}
	}
}
