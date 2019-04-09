<?php


class User_model extends CI_Model {

    public $name;
    public $username;
    public $password;
    public $is_active;
    public $email;

    public function get_users() {
        $this->load->database();
        $query = $this->db->get('dv_users');
        $results = $query->result();

        foreach ($results as $result) {
            $sqlRoles = 'select dv_users_roles.name, dv_users_roles.id
                            from dv_users
                            inner join dv_users_roles_has_dv_users 
                                on dv_users.id = dv_users_roles_has_dv_users.dv_users_id
                            inner join dv_users_roles
                                on dv_users_roles_has_dv_users.dv_users_roles_id=dv_users_roles.id
                            where dv_users.id = ?';
            $queryRoles = $this->db->query($sqlRoles, array($result->id));

            $resultsRoles = $queryRoles->result();

            $rolesString = '';
            $ids = array();
            foreach ($resultsRoles as $resultsRole) {
                $rolesString.=$resultsRole->name . ', ';
                array_push($ids, $resultsRole->id);
            }
            $result->role_string = $rolesString;
            $result->role_ids =$ids;

        }

        return $results;
    }

    public function insert_new_user() {
        $this->load->database();
        $this->name = $this->input->post('fullName');
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->is_active = $this->input->post('isActive');
        $this->email = $this->input->post('email');
        $this->db->insert('dv_users', $this);
        $insert_id = $this->db->insert_id();

        $this->load->model('role_model');
        $roles_ids_array = $this->role_model->getRolesIds();
        // $nums = array(1,2,3,4,5,6);
        foreach ($roles_ids_array as$roles_ids) {
            foreach ($roles_ids as $role_id) {
                if (in_array('role_'.$role_id, $_POST)) {
                    $this->db->insert('dv_users_roles_has_dv_users', array("dv_users_roles_id"=>$role_id,"dv_users_id"=>$insert_id));
                } else {
                }
            }
        }

    }

}