<?php


class User_model extends CI_Model {

    public $name;
    public $username;
    public $password;
    public $is_active;
    public $email;
    public $id;

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

    public function get_user($userId) {
        $this->load->database();
        $query = $this->db->get_where('dv_users', array('id' => $userId), 1);
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

    public function delete_user($userId) {
        $this->load->database();
        $this->db->delete('dv_users_roles_has_dv_users', array('dv_users_id' => $userId));
        $this->db->delete('dv_users', array('id' => $userId));
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
        foreach ($roles_ids_array as $roles_ids) {
            foreach ($roles_ids as $role_id) {
                if (in_array('role_'.$role_id, $_POST)) {
                    $this->db->insert('dv_users_roles_has_dv_users', array("dv_users_roles_id"=>$role_id,"dv_users_id"=>$insert_id));
                } else {
                }
            }
        }

    }

    public function update_user() {
        $this->load->database();
        $this->name = $this->input->post('fullName');
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->is_active = $this->input->post('isActive');
        $this->email = $this->input->post('email');
        $this->id = $this->input->post('userId');
        $this->db->where('id', $this->id);
        $this->db->update('dv_users', $this);

        $this->load->model('role_model');
        $all_roles_ids_array = $this->role_model->getRolesIds();

        $selected_roles_ids = array(); //selected roles at the edited form

        foreach ($all_roles_ids_array as $roles_ids) {
            foreach ($roles_ids as $role_id) {
                if (in_array('role_'.$role_id, $_POST)) {
                    array_push($selected_roles_ids, $role_id);
                }
            }
        }
        // var_dump($selected_roles_ids);
        // echo '<br>';

        $sqlRolesIds = 'select dv_users_roles.id
                            from dv_users
                            inner join dv_users_roles_has_dv_users 
                                on dv_users.id = dv_users_roles_has_dv_users.dv_users_id
                            inner join dv_users_roles
                                on dv_users_roles_has_dv_users.dv_users_roles_id=dv_users_roles.id
                            where dv_users.id = ?';
        $queryRolesIds = $this->db->query($sqlRolesIds, array($this->id));
        $rolesIds = $queryRolesIds->result(); //roles of the user before the editing
        // var_dump($rolesIds);
        $rolesIdsArray  = array();
        foreach ($rolesIds as $roles_ids) {
            foreach ($roles_ids as $role_id) {
                if (!in_array($role_id, $selected_roles_ids)) {
                    $this->db->delete('dv_users_roles_has_dv_users', array("dv_users_roles_id"=>$role_id,"dv_users_id"=>$this->id));
                }
                array_push($rolesIdsArray, $role_id);
            }
        }

        foreach ($selected_roles_ids as $selected_role_id) {
            if (!in_array($selected_role_id, $rolesIdsArray)) {
                $this->db->insert('dv_users_roles_has_dv_users', array("dv_users_roles_id"=>$selected_role_id,"dv_users_id"=>$this->id));
            }
        }

    }

}