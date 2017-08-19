<?php

require 'header.php';

$data=$_POST;
if (isset($data['do_signup'])) {
    if (trim($data['login']) == '' ) {
	$errors[] = 'Введите логин';
    }
    if (trim($data['email']) == '' ) {
	$errors[] = 'Enter email';
    }
    if ($data['password'] == '' ) {
	$errors[] = 'Enter password';
    }
    if ($data['password2'] != $data['password']) {
	$errors[] = 'Passwords mismatch';
    }
    if (R::count('users', "login = ?", array($data['login'])) > 0 ) {
	$errors = 'Login exists';
    }
    if (R::count('users', "email = ?", array($data['email'])) > 0 ) {
	$errors = 'Email exists';
    }
    if (empty($errors)) {
	// all ok
	$user =  R::dispense('users');
	$user->login = $data['login'];
	$user->email = $data['email'];
	$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
	$user->perm = 'user';
	R::store($user);
	echo '<div style="color:green;">Registered ok.</div>';
    } else {
	echo '<div style="color:red;">'.array_shift($errors).'</div>';
    }
} // isset post
?>

<form action="signup.php" method="post">
Login:
 <input type="text" name="login" value="<?php echo $data['login']; ?>"><br>
Email:
 <input type="email" name="email" value="<?php echo $data['email']; ?>"><br>
Password:
 <input type="password" name="password" value="<?php echo $data['password']; ?>"><br>
Password repeat:
 <input type="password" name="password2" value="<?php echo $data['password2']; ?>"><br>
<button type="submit" name="do_signup" value="">Signup</button>
</form>

