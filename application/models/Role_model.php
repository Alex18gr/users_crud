<?php


class Role_model extends CI_Model {

    public function getRoles() {
        $this->load->database();
        $query = $this->db->get('dv_users_roles');
        $results = $query->result();
        return $results;
    }

    public  function getRolesIds() {
        $this->load->database();
        $this->db->select('id');
        $query = $this->db->get('dv_users_roles');
        $results = $query->result_array();
        return $results;
    }

}