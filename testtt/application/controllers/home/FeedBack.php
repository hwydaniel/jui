<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FeedBack extends CI_Controller{
    public function index() {
        $this->load->view('home/feedback/index.html');
    }
}



