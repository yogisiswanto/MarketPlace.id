<?php

    class User_Model extends CI_Model{

        function __construct(){
            
            parent::__construct();
        }        

        public function insert($data){

            if ($this->db->insert('user', $data)) {
            
                return TRUE;
            }
        }

        public function get($username, $password){
            
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_name', $username);
            $this->db->where('user_password', $password);
            return $this->db->get();
        }

        public function getActivationCode($user_id, $activationCode)
        {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_id', $user_id);
            $this->db->where('activation_code', $activationCode);
            return $this->db->get();
        }

        public function update($data)
        {
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('user', $data);
        }

        public function check_phone_number($user_phone_number){

            $this->db->select('user_phone_number');
            $this->db->from('user');
            $this->db->where('user_phone_number', $user_phone_number);
            return $this->db->get()->num_rows();
        }
    }