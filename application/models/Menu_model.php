<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu` FROM `user_sub_menu`
                    JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";

        return $this->db->query($query)->result_array();
    }


    public function ubahMenu($where = null, $data = null)
    {
        $this->db->update('user_menu', $data, $where);
    }

    public function ubahSubmenu($where = null, $data = null)
    {
        $this->db->update('user_sub_menu', $data, $where);
    }

    public function deletemenu($where = null)
    {
        $this->db->delete('user_menu', $where);
    }

    public function deletesubmenu($where = null)
    {
        $this->db->delete('user_sub_menu', $where);
    }
}