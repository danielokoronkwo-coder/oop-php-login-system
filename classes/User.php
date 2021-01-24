<?php

class User {
    
    private $db,
            $data,
            $sessionName,
            $cookieName,
            $isLoggedIn;

    public function __construct($user = null) {
        $this->db = DB::getInstance();
        $this->sessionName = Config::get('session/session_name');
        $this->cookieName = Config::get('remember/cookie_name');

        if (!$user) {
            if (Session::exists($this->sessionName)) {
                $user = Session::get($this->sessionName);
                
                if ($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //Process Logout
                }
            }
        } else {
            $this->find($user);
        }
    }

    public function create($fields = array()) {
        if (!$this->db->insert('users', $fields)) {
            throw new Exception('There was a problem creating your account');
        }
    }

    public function find($user = null) {
        if ($user) {
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->db->get('users', array($field, '=', $user));

            if ($data->count()) {
                $this->data = $data->first();
                return true;
            }
        }

        return false;
    }

    public function login($username = null, $password = null, $remember){
        $user = $this->find($username);
        if ($user) {
            if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
                Session::put($this->sessionName, $this->data()->id);

                if ($remember) {
                    $hash = Hash::unique();
                    $hashCheck = $this->db->get('users_session', array('user_id', '=', $this->data()->id));

                    if (!$hashCheck) {
                        $this->db->insert('users_session', array(
                            'user_id' => $this->data()->id,
                            'hash' => $hash
                        
                        ));
                    } else {
                        $hash = $hashCheck->first()->hash;
                    }
                    Cookie::put($this->cookieName, $hash, Config::get('remember/cookie_expiry'));
                }
                return true;
            }
        }
        return false;
    }

    public function data(){
        return $this->data;
    }

    public function isLoggedIn(){
        return $this->isLoggedIn;
    }

    public function logout() {
        Session::delete($this->sessionName);
    }
}