<?php

class Form extends CI_Controller {

        public function index()
        {
        //         $this->load->helper(array('form', 'url'));

        //         $this->load->library('form_validation');

        //         if ($this->form_validation->run() == FALSE)
        //         {
        //                 $this->load->view('myform');
        //         }
        //         else
        //         {
        //                 $this->load->view('formsuccess');
        //         }

            $this->load->helper(array('form', 'url'));

            $this->load->library('form_validation');

            // $this->form_validation->set_rules('username', 'Username', 'required');
            // $this->form_validation->set_rules('username', 'Username', array('required', 'min_length[5]'));
            // $this->form_validation->set_rules('password', 'Password', 'required',
            //         array('required' => 'You must provide a %s.')
            // );
            // $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
            // $this->form_validation->set_rules('email', 'Email', 'required');

        //     $config = array(
        //         array(
        //                 'field' => 'username',
        //                 'label' => 'Username',
        //                 'rules' => 'required|min_length[5]|max_length[12]|is_unique[users.username]',
        //                 'errors' => array(
        //                     'required'      => 'You have not provided %s.',
        //                     'is_unique'     => 'This %s already exists.',
        //                 ),
        //         ),
        //         array(
        //                 'field' => 'password',
        //                 'label' => 'Password',
        //                 'rules' => 'required',
        //                 'errors' => array(
        //                         'required' => 'You must provide a %s.',
        //                 ),
        //         ),
        //         array(
        //                 'field' => 'passconf',
        //                 'label' => 'Password Confirmation',
        //                 'rules' => 'required'
        //         ),
        //         array(
        //                 'field' => 'email',
        //                 'label' => 'Email',
        //                 'rules' => 'required'
        //         )
        // );
        
        // $this->form_validation->set_rules($config);


        // $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $this->form_validation->set_rules('username', 'Username', 'callback_username_check');

            if ($this->form_validation->run() == FALSE)
            {
                    $this->load->view('myform2');
            }
            else
            {
                    $this->load->view('formsuccess');
            }
        }

        
        public function username_check($str)
        {
                if ($str == 'test')
                {
                        $this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
        
}