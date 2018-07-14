<?php
 ini_set('display_errors',1);
 error_reporting(E_ALL & ~E_NOTICE);
// ini_set('memory_limit', '8M');
 require_once 'db.php';
// require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Parts list 0.1</title>
<style>
.tr {display: table-row;}
.tc {display:table-cell; padding:1px 4px;border: 1px dotted green; }
.ib {display:inline-block; border: 1px solid blue; padding: 1px 4px;}
.l {cursor:pointer;}
.hm1 {display:inline-block;border:1px dotted; padding: 0 5px;}
.hm2 {display:inline-block;border:1px dotted; padding: 0 5px;
margin:0 2px; float:right;}
</style>
<!-- jQuery (neccessary for Bootstrap s JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
 <!-- Include all compiled plugins (below), or include individual files as needed -->
 <!--
    <script src="/public/js/bootstrap.min.js"></script>
 -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" 
crossorigin="anonymous" defer>
</script>
<script src="events.js"></script>
</head>
<body>
<div class="hm1"><a href="/">Main</a></div>
<?php
 if (isset($_SESSION['logged_user'])) : ?>
 <div class="hm2">Logged as: <?php echo $_SESSION['logged_user']->login.
		    " (".$_SESSION['logged_user']->perm.")"; ?>
		    <a href="logout.php">Logout</a></div>
 <?php else : ?>
    <div class="hm2"><a href="/login.php">Login</a></div>
    <div class="hm2"><a href="/signup.php">Signup</a></div>
 <?php endif; ?>
<hr>
