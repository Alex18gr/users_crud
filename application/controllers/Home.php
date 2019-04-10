<?php


class Home extends CI_Controller
{
    /*
     * Loading the main page with the list of the users
     * */
    public function index() {

        $data = array();

        // loading the user model
        $this->load->model('user_model');

        $data['users'] = $this->user_model->get_users();

        $this->master('home/index', $data);
    }


    function master($page, $data) {
        $this->load->view('home/header');
        $this->load->view($page, $data);
        $this->load->view('home/footer');
    }


    /*
     *
     * handles the new user page and the post mapping for adding the user to the database
     * */
    public function addNewUser() {
        $data = array();
        $this->load->helper('form');

        $this->load->library('form_validation');

        // Setting the validation rules for the form
        $this->form_validation->set_rules('isActive', 'is Active', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passwordConf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->form_validation->run() == TRUE) {
            $this->load->model('user_model');
            $this->user_model->insert_new_user();
            $this->load->library('form_validation');
            if ($this->form_validation->run() == FALSE) {
            } else {
                $data['success'] = TRUE;
            }
        }
        $this->load->model('role_model');
        $data['all_roles_list'] = $this->role_model->getRoles();
        $this->load->view('new-user-form', $data);
    }

    /*
     * Handles the edit user page and the post mapping for updating the user in tha database
     * */
    public function editUser($userId) {
        $data = array();
        $this->load->helper('form');
        $this->load->model('user_model');

        $this->load->library('form_validation');

        // Setting the validation rules for the form
        $this->form_validation->set_rules('isActive', 'is Active', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('passwordConf', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' and $this->form_validation->run() == TRUE) {
            $this->user_model->update_user();
            $this->load->library('form_validation');
            if ($this->form_validation->run() == FALSE) {
            } else {
                $data['success'] = TRUE;
            }
        }

        $this->load->model('role_model');
        $data['all_roles_list'] = $this->role_model->getRoles();

        $userVar = $this->user_model->get_user($userId);
        $data['user_details'] = $userVar[0];
        $this->load->view('edit-user-form', $data);
    }


    /*
     * This mapping is used to delete the selected user, redirects to the main list page
     * after the deletion
     * */
    public function deleteUser($userId) {
        $this->load->model('user_model');
        $this->user_model->delete_user($userId);
        $this->load->helper('url');
        redirect('/', 'refresh');
    }
}