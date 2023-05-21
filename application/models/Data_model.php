<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model
{
    public function updatedata()
    {
        $query = "UPDATE `tbl_sensor` set `status` = 0";
        return $this->db->query($query);
    }

    public function DataMonitoring()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('tbl_sensor')->result_array();
    }

    public function ambildibaca()
    {
        $this->db->select("*")->from('tbl_sensor')->where('alkohol', 4)->order_by('id', 'DESC')->limit(5);
        return $this->db->get()->result_array();
    }

    public function getDataUser()
    {
        $query = "SELECT `tbl_user`.*, `user_role`.`role` FROM `tbl_user`
                    JOIN `user_role` ON `tbl_user`.`role_id` = `user_role`.`id_role`";

        return $this->db->query($query)->result_array();
    }

    public function suhuterbaru()
    {
        $this->db->select('suhu')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->suhu;
        }
        return false;
    }

    public function udaraterbaru()
    {
        $this->db->select('udara')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->udara;
        }
        return false;
    }

    public function beratterbaru()
    {
        $this->db->select('berat')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->berat;
        }
        return false;
    }

    public function alkoholterbaru()
    {
        $this->db->select('alkohol')->from('tbl_sensor')->order_by('id', 'DESC')->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->alkohol;
        }
        return false;
    }

    public function jmldata($where = null)
    {
        return $this->db->get_where('tbl_sensor', $where);
    }

    public function DataUser()
    {
        return $this->db->get('tbl_user')->result_array();
    }

    public function deleteuser($where, $user)
    {
        $this->db->delete($user, $where);
    }

    public function deleterole($where, $role)
    {
        $this->db->delete($role, $where);
    }

    public function ubahRole($where = null, $data = null)
    {
        $this->db->update('user_role', $data, $where);
    }
}
