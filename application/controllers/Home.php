<?php


class Home extends CI_Controller
{
    public function index() {

        $data = array("title"=>"Home Page");
        $this->load->model('user_model');

        $data['users'] = $this->user_model->get_users();

        $this->master('home/index', $data);
    }

    function master($page, $data) {
        $this->load->view('home/header');
        $this->load->view($page, $data);
        $this->load->view('home/footer');
    }

    public function addNewUser() {
        $data = array();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->load->model('user_model');
            $this->user_model->insert_new_user();
            $this->load->library('form_validation');
            if ($this->form_validation->run() == FALSE) {
            } else {
                $data['success'] = TRUE;
            }
        }
        $this->load->helper('form');
        $this->load->model('role_model');
        $data['all_roles_list'] = $this->role_model->getRoles();
        $this->load->view('new-user-form', $data);
    }

    public function editUser($userId) {
        echo 'Editing user with id: '.$userId;
    }
}