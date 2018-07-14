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
<div style="dispaly:table; text-align:center; vertical-align:middle;">
<form style="display: table; border: 1px dotted; padding: 10px; margin:auto;" action="login.php" method="POST">
    Login:
    <input style="display:block; position:relative; float:right; margin:0 0 0 5px; border: 1px dotted #999;" type="text" name="login" vaule="<?php echo @$data['login']; ?>"><br><br>
    Password:
    <input style="display:block; position:relative; float:right; margin:0 0 0 5px;border: 1px dotted #999;" type="password" name="password" vaule="<?php echo @$data['password']; ?>"><br>
    <button style="display:block; position:relative; float:right; margin: 10px 0 0 0;" type="submit" name="do_login">Login</button>
</form>
</div>