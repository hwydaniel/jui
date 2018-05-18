<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ComforTable extends CI_Controller{
    public function index() {

        $this->load->view('home/comfortable/index.html');
    }
}