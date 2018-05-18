<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

    public function index() {
        $this->load->view('home/news/index.html');
    }

    public function newsShow() {
        $this->load->view('home/news/news_show.html');
    }

}