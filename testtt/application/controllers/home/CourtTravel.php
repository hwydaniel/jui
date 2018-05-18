<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CourtTravel extends CI_Controller{
    public function index() {
        $this->load->view('home/courttravel/index.html');
    }
}