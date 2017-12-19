<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body background="background.png" style="background-size:cover; background-repeat:no-repeat">

<?php require('menu.php'); ?>

	

<div class="mainent">

<fieldset class="fieldset">
    	<legend><h3>Login</h3></legend>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
<label for="un">First Name</label>
    	<input name="un" type="text" placeholder="Username" required /> 
<label for="pw">Password</label>
    	<input name="pw" type="password" placeholder="Password"  required/>
    	<input type="submit" name="submit" value="Login" />
	
	<?php
require_once('db_con.php');
	
if(!empty(filter_input(INPUT_POST, 'submit'))) {

	
	
	$un = filter_input(INPUT_POST, 'un') or die('incorrect useername');
	$pw = filter_input(INPUT_POST, 'pw') or die('incorrect password');
	//$password = password_hash($password, PASSWORD_DEFAULT); // hash and salt the password 
	
	
	$sql = 'SELECT idusers, username, pwhash FROM sfc_users WHERE username=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $uname, $pwhash);

	while ($stmt->fetch()) {} // fill result variables
	
	if (password_verify($pw, $pwhash)){
		
		echo 'You are now logged in as user '.$uname.' id:'.$uid;
		$_SESSION['uid'] = $uid; 
		$_SESSION['un'] = $uname;
		
		
		echo "<script type='text/javascript'>window.top.location='view.php';</script>";
	}
	else {
		echo 'Something went wrong, please make sure you enter correct username and password';
	}
}
?>
	
	</fieldset>
<div class="message">Not registered yet? <a href="adduser.php">Create an account</a></div>	
	
</form>

	
	
</div>





</body>
</html>