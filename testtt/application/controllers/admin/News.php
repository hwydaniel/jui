<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class News extends AdmBase_Controller {

    public function index() {
        $this->render('admin/news/index.html');
    }

}