<?php

require 'core/init.php';

if (Session::exists('success')) {
    echo Session::flash('success');
}











// $user = DB::getInstance()->update('users', 3, array(
//     'name' => 'Dele Momoudu',
//     'username' => 'DeleOvation',
//     'password' => 'newpassword',

// ));


// get('users',  array('username', '=', 'daniel90'));

// if (!$user {
//     echo 'No user found';
// } else {
//     echo $user->first()->username;
//     // foreach ($user->results() as $user) {
//     //     echo $user->username, '<br>';
//     // }
// }