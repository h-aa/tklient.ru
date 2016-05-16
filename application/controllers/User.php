<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
		
	function __construct() 
	{
		parent::__construct();
		$this->load->model('Request_data');
		$this->load->model('User_model');
		$this->load->model('Update_model');
	}	
	
	

	public function user_message()
	{
		if(!$this->ion_auth->logged_in())
		{
			redirect('/', 'refresh');
		}
		$data['all_request_count_all'] = $this->Request_data->request_count();
	 	$data['all_request_count_today'] = $this->Request_data->request_count_today();
	 	$user_id = $this->ion_auth->user()->row()->id;
	 	$user_messages = $this->User_model->user_messages($user_id);
	 	$data['user_messages'] = $user_messages;
	 	foreach ($user_messages as $row) {
	 		if($row->reading == '0')
	 		{
	 			$this->Update_model->message_reading($row->id_message);
	 		}
	 	}
	 	$this->load->view('user/user_message', $data);
	}

	public function user_sms()
	{
		if(!$this->ion_auth->logged_in())
		{
			redirect('/', 'refresh');
		}		
		$data['all_request_count_all'] = $this->Request_data->request_count();
	 	$data['all_request_count_today'] = $this->Request_data->request_count_today();		
		$this->load->view('user/user_sms', $data);
	}	

	public function user_request()
	{
		if(!$this->ion_auth->logged_in())
		{
			redirect('/', 'refresh');
		}		
		$data['all_request_count_all'] = $this->Request_data->request_count();
	 	$data['all_request_count_today'] = $this->Request_data->request_count_today();		
		$user_id = $this->ion_auth->user()->row()->id;
	 	$month = now() - 2592000;
	 	$week = now() - 604800;
	 	$hour24 = now() - 86400;
	 	$hour4 = now() - 14400;
	 	$hour1 = now() - 3600;
	 	$data['all_user_request'] = $this->Request_data->count_user_request($user_id);
	 	$data['month_user_request'] = $this->Request_data->count_user_request($user_id,$month);
	 	$data['week_user_request'] = $this->Request_data->count_user_request($user_id,$week);
	 	$data['hour24_user_request'] = $this->Request_data->count_user_request($user_id,$hour24);
	 	$data['hour4_user_request'] = $this->Request_data->count_user_request($user_id,$hour4);
	 	$data['hour1_user_request'] = $this->Request_data->count_user_request($user_id,$hour1);	
		$this->load->view('user/user_request', $data);		
	}	

	public function user_payment()
	{
		if(!$this->ion_auth->logged_in())
		{
			redirect('/', 'refresh');
		}		
		$data['all_request_count_all'] = $this->Request_data->request_count();
	 	$data['all_request_count_today'] = $this->Request_data->request_count_today();		
		$this->load->view('user/user_payment', $data);
	}	

}
