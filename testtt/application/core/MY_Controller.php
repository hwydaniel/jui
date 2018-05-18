<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function  __construct()
    {
        parent::__construct();
    }
}

/**/
class HomeBase extends MY_Controller
{
    public $ss = '';
    function  __construct()
    {
        parent::__construct();
        $this->ss = 122333;
    }
}

class AdmBase_Controller extends MY_Controller
{
    protected $layout = 'layout/main.html';
    private   $js_files = array();
    private   $css_files = array();
    public    $need_login = false;

    public function __construct()
    {
        parent::__construct();
        //$this->check_login();
    }
    public function add_js($filepath)
    {
        array_push($this->js_files, "<script type='text/javascript' src='". $filepath ."'></script>");
    }
    public function add_css($filepath){
        array_push($this->css_files, "<link href='".$filepath."' rel='stylesheet' type='text/css'>");
    }

    protected function render($file = NULL, $viewData = array(), $globalData= array())
    {
        if($this->js_files){
            $globalData['js_files'] = $this->js_files;
        }
        if($this->css_files){
            $globalData['css_files'] = $this->css_files;
        }
        if( !is_null($file) ) {
            $data['content'] = $this->load->view($file, $viewData, TRUE);
            $data['layout'] = $globalData;
            $this->load->view($this->layout, $data);
        } else {
            $this->load->view($this->layout, $viewData);
        }
        $viewData = array();
    }
}

