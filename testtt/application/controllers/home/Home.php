<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('feeback_model');
	}

	public function index()
	{
		//$query = $this->db->query('SELECT * from zd_feeback');
		$re = $this->feeback_model->getInfo(array('fee_id' => 222));
		print_r($re);
		$this->load->view('home/home/index.html');
	}
}
