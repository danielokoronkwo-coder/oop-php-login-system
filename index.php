<?php

require 'core/init.php';

if (Session::exists('home')) {
    echo '<p>'.Session::flash('home').'</p>';
}




$user = new User();
$anotherUser = new User(8);

if ($user->isLoggedIn()) {
?>
    <p>Hello <a href="#"><?php echo $user->data()->username;?></a></p>

    <ul>
        <li>
            <a href="logout.php">Logout</a>
        </li>
    </ul>
<?php
} else {
    echo 'You need to <a href="register.php">Register</a> or <a href="login.php">Login</a>';
}
// echo Session::get(Config::get('session/session_name'));









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