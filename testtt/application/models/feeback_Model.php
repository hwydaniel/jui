<?php
class Feeback_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function add($data) {
        $res = $this->db->insert('zd_feeback', $data);
        return $res;
    }

    public function getList()
    {
        return $this->db->query('select * from zd_feeback')->result_array();
    }

    public function getInfo($info)
    {
        $this->db->where($info);
        $this->db->select('*');
        $query=  $this->db->get('zd_feeback');
        //返回一位数组
        $query->row();
        return $query->row_array();

//        return $query->result_array();
    }
    public function edit($fee_id, $arr) {
        $this->db->where('fee_id',$fee_id);//定位
        $re = $this->db->update('user',$arr);
        return $re;
    }

    public function user_del($id){
        $this->db->where('uid',$id);
        $this->db->delete('user');
    }

    function  user_select($id){
        $this->db->where('uid',$id);
        $this->db->select('*');
        $query=  $this->db->get('user');
        return $query->result();
    }

}