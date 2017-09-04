<?php
require 'header.php';
$data = $_POST;
if (isset($data['do_login'])) {
    $errors = array();
    $user = R::findOne('users', 'login = ?', array($data['login']));
    if ($user) {
	if (password_verify($data['password'], $user->password)) {
	    $_SESSION['logged_user'] = $user;
	    echo '<div style="color:green;">Login ok.<br>
	    You can goto <a href="/">Main page</a><div><hr>';
	} else {
	    $errors[] = 'Wrong password';
	}
    } else {
	$errors[] = 'Login not found';
    }
    if (!empty($errors)) {
	echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
//	var_dump($data);
    }
}
?>

<form action="login.php" method="POST">
    Login:
    <input type="text" name="login" vaule="<?php echo @$data['login']; ?>"><br>
    Password:
    <input type="password" name="password" vaule="<?php echo @$data['password']; ?>"><br>
    <button type="submit" name="do_login">Login</button>
</form>