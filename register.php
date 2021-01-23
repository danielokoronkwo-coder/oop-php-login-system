<?php
    require_once 'core/init.php';

    if (Input::exists()) {
        if (Token::check(Input::get('token'))) {
            
            $validate = new Validate();
            $validation = $validate->check($_POST, array(
                'username' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
                ),
                'name' => array(
                    'required' => true,
                    'min' => 2,
                    'max' => 64,
                ),
                'password' => array(
                    'required' => true,
                    'min' => 8,
                ),
                'confirm_password' => array(
                    'required' => true,
                    'matches' => 'password',
                )

                ));

                if ($validate->passed()) {
                    $user = new User();
                    $salt = Hash::make(32);
                    echo $salt;
                    die();
                    try {
                        $user->create(array(
                            'name' => '',
                            'username' => '',
                            'password' => '',
                            'joined' => '',
                            'group' => ''

                        ))
                    } catch (Exception $e) {
                        die($e->getMessage())
                    }
                } else {
                    foreach ($validate->errors() as $error) {
                        echo $error.'<br>';
                    };
            }
        }
    }
?>
<form action="" method="post">
    <div class="field">
        <label for="username">Username:</label>
        <input type="text" name="username"  id="username" autocomplete="off">
    </div>

    <div class="field">
        <label for="name">Fullname:</label>
        <input type="text" name="name"  id="name" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" autocomplete="off">
    </div>

    <div class="field">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" autocomplete="off">
    </div>

    <input type="hidden" name="token" id="token" value="<?php echo Token::generate();?>">
    <button type="submit">Register</button>
</form>



