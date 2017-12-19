<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Sign-up</title>
<link href= "includes/css/grid.css" rel="stylesheet">
<link href= "includes/css/styles.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body background="background.png" style="background-size:cover; background-repeat:no-repeat">
<?php require('menu.php'); ?>


	
	
<div class="mainent">

<form class="login-container" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend><h3>Sign-up</h3></legend>
		<label for="fname">First Name</label>
    	<input name="un" type="text" placeholder="Username" required />
		<label for="lname">Password</label>
    	<input name="pw" type="password" placeholder="Password"  required/>
		<label for="lname">E-mail</label>
    	<input name="em" type="email" placeholder="E-mail"  required/> <br>
    	<input type="submit" name="submit" value="Create user"/>
    	
	</fieldset>
	<p class="message" style="text-align:center;"> Upon succesful completion of your registry, <br> you will be directed to login page</p>
</form>
	
	<?php
	require_once('db_con.php');
	
	
	if(!empty(filter_input(INPUT_POST, 'submit'))) {
	$un = filter_input(INPUT_POST, 'un') or die('Username not accepted');
	$pw = filter_input(INPUT_POST, 'pw') or die('Password not accepted');
	$pw = password_hash($pw, PASSWORD_DEFAULT);  // hash and salt the password
	$em = filter_input(INPUT_POST, 'em', FILTER_VALIDATE_EMAIL) or die('a legit address please');
	
//echo 'Created user: '.$un.' with e-mail address: ' .$em;
	
	$sql = 'INSERT INTO sfc_users (username, pwhash, email) VALUES (?,?,?)';
	$stmt = $link->prepare($sql);  //storing in stmt
	$stmt->bind_param('sss', $un, $pw, $em);
	$stmt->execute();

	if($stmt->affected_rows >0){
		
		echo "<script type='text/javascript'>window.top.location='login.php';</script>";
		
		
	}
	else {
		echo 'Error adding user ['.$un.'] this user already exists';
	}


		
}
?>

	</div>





</body>
</html>