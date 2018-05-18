<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ScenicOverview extends CI_Controller {

    public function index()
    {
        $this->load->view('home/scenicoverview/index.html');
    }
}