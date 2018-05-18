<?php
class Image_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function add($data)
    {
        $res = $this->db->insert('zd_image', $data);
        return $res;
    }

    public function getList()
    {
        return $this->db->query('select * from zd_image')->result_array();
    }

    public function getInfo($info)
    {
        $this->db->where($info);
        $this->db->select('*');
        $query = $this->db->get('zd_image');
        //返回一位数组
        $query->row();
        return $query->row_array();
    }

    public function  countImg($condition) {
        if ($condition) {
            return $this->db->query('select count(*) as num from zd_image where '.$condition)->result_array();
        } else {
            return $this->db->query('select count(*) as num from zd_image')->result_array();
        }

    }

    public function page($tablename = 'zd_image', $per_nums, $start_position, $condition = array()) {
    //传入3个参数，表名字，每页的数据量，其实位置
        $this->db->order_by('img_id', 'desc');
        $this->db->limit($per_nums, $start_position);
        $query = $this->db->get_where($tablename, $condition);
        $data = $query->result();
        $data2['total_nums'] = $this->db->count_all($tablename);
        $data2[] = $data;
        //这里大家可能看的优点不明白，可以分别将$data和$data2打印出来看看是什么结果。
        return $data2;
    }

     public  function del($id){
        $this->db->where('img_id', $id);

         return $this->db->delete("zd_image");
    }

    public  function update($id, $data){
        $this->db->where('img_id', $id);

        return $this->db->update("zd_image", $data);
    }

}