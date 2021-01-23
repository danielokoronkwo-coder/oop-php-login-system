<?php

class User {
    
    private $db;

    public function __construct($user = null) {
        $this->db = DB::getInstance();
    }

    public function create($fields = array()) {
        if (!$this->db->insert('users', $fields) {
            throw new Exception('There was a problem creating an account');     
        }
    }
}