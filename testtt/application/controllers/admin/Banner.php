<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Banner extends AdmBase_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('image_model');
    }

    public function index()
    {
        $img_type = $this->input->get('img_type');

        $condition = array();
        if ($img_type) {
            $condition['img_type'] = $img_type;
        }

        $start = $this->uri->segment(4);
        $page_num = '5';//每页的数据
        $data = $this->image_model->page('zd_image', $page_num, $start, $condition);
        $coun_con = '';
        if ($img_type) {
            $coun_con = ' img_type=' . $img_type;
        }

        $count = $this->image_model->countImg($coun_con);

        $total_nums = $count[0]['num']; //这里得到从数据库中的总页数
        $data['query'] = $data[0]; //把查询结果放到$data['query']中

        $data['img_type'] = $img_type;
        $this->load->library('pagination');

        $config['base_url'] = site_url('admin/Banner/index');
        if ($img_type) {
            $config['base_url'] = site_url('admin/Banner/index?img_type=' . $img_type);
        }

        $config['total_rows'] = $total_nums;//总共多少条数据
        $config['per_page'] = $page_num;//每页显示几条数据
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['first_link'] = '首页';
        $config['uri_segment'] = 4;
        $config['first_tag_open'] = '<li>';//“第一页”链接的打开标签。
        $config['first_tag_close'] = '</li>';//“第一页”链接的关闭标签。
        $config['last_link'] = '尾页';//你希望在分页的右边显示“最后一页”链接的名字。
        $config['last_tag_open'] = '<li>';//“最后一页”链接的打开标签。
        $config['last_tag_close'] = '</li>';//“最后一页”链接的关闭标签。
        $config['next_link'] = '下一页';//你希望在分页中显示“下一页”链接的名字。
        $config['next_tag_open'] = '<li>';//“下一页”链接的打开标签。
        $config['next_tag_close'] = '</li>';//“下一页”链接的关闭标签。
        $config['prev_link'] = '上一页';//你希望在分页中显示“上一页”链接的名字。
        $config['prev_tag_open'] = '<li>';//“上一页”链接的打开标签。
        $config['prev_tag_close'] = '</li>';//“上一页”链接的关闭标签。
        $config['cur_tag_open'] = '<li class="current">';//“当前页”链接的打开标签。
        $config['cur_tag_close'] = '</li>';//“当前页”链接的关闭标签。
        $config['num_tag_open'] = '<li>';//“数字”链接的打开标签。
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $this->render('admin/banner/index.html', $data);
    }
    public function bannerAdd() {
        $data = array();

        if (IS_POST) {
            $img_desc = $this->input->post('img_desc');
            $img_type = $this->input->post('img_type');

            $img_jump = $this->input->post('img_jump');
            if (empty($img_desc)) {
                js_error_tip(1, '请输入描述');
            }
            if (empty($img_jump)) {
                js_error_tip(1, '请输入跳转');
            }
            if (empty($img_type)) {
                js_error_tip(1, '请选择类型');
            }
            //判断是否上传
            if (empty($_FILES['img_name']['tmp_name'])){
                js_error_tip(1, '请选择图片上传');
            }

            //图片上传
            $config['upload_path'] = './admstyle/upload/banner';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '0';
            $config['max_width'] = '0';
            $config['max_height'] = '0';
            $config['encrypt_name']=true;   //文件重命名
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('img_name');//图片
            $img_info=$this->upload->data();   //打印你图片的信息

            $data['img_type'] = $img_type;
            $data['img_add_time'] = time();
            $data['img_name'] = $img_info['file_name'];;
            $data['img_desc'] = $img_desc;
            $data['img_jump'] = $img_jump;
            $this->image_model->add($data);

            js_error_tip(0, '添加成功', site_url('admin/Banner/index'));

        } else {

            $this->render('admin/banner/banner_add.html');
        }

    }

    public function bannerEdit() {
        $img_id = $this->input->get('img_id');
        $img_info = $this->image_model->getInfo(array('img_id' => $img_id));

        $data = array();
        $data['img_info'] = $img_info;
        $data['img_id'] = $img_id;

        if (IS_POST) {

            $img_id = $this->input->post('img_id');
            $img_desc = $this->input->post('img_desc');
            $img_type = $this->input->post('img_type');

            $img_jump = $this->input->post('img_jump');
            if (empty($img_desc)) {
                js_error_tip(1, '请输入描述');
            }
            if (empty($img_jump)) {
                js_error_tip(1, '请输入跳转');
            }
            if (empty($img_type)) {
                js_error_tip(1, '请选择类型');
            }
            //判断是否上传
            if (!empty($_FILES['img_name'])){
                //图片上传
                $config['upload_path'] = './admstyle/upload/banner';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['encrypt_name']=true;   //文件重命名
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('img_name');//图片
                $img_info=$this->upload->data();   //打印你图片的信息
                $pdata['img_name'] = $img_info['file_name'];
            }

            $pdata['img_id'] = $img_id;
            $pdata['img_type'] = $img_type;
            $pdata['img_add_time'] = time();

            $pdata['img_desc'] = $img_desc;
            $pdata['img_jump'] = $img_jump;
            $this->image_model->update($img_id, $pdata);
            js_error_tip(0, '修改成功', site_url('admin/Banner/index'));

        } else {
            $this->render('admin/banner/banner_edit.html', $data);
        }


    }

    /*
     *删除图片
     * */
    public function bannerDel() {
        $img_id = $this->input->post('img_id');
        $img_info = $this->image_model->getInfo(array('img_id' => $img_id));
        if ($img_info) {
            unlink('./admstyle/upload/banner/'. $img_info['img_name']);
        }
        $res = $this->image_model->del($img_id);

        if ($res) {
            echo js_error_tip(0, '删除成功', site_url('admin/Banner/index'));
        } else {
            echo js_error_tip(1, '删除失败，请稍后重试');
        }

    }

}