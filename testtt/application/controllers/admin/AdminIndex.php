<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class AdminIndex extends AdmBase_Controller {

    /*
     * author:hwy
     * 后台首页
     * */
    public function index() {

        //$data= array('user_name'=>'张三','password'=>'密码');
        //$this->render('admin/adminindex/index1.html',$data,array('title'=>'测试布局'));
        $this->render('admin/adminindex/index.html');

    }


}