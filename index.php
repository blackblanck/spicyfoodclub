<?php session_start(); ?><!doctype html>
<html>
<head>

<title>Spicy Food Club</title>

</head>

<body style=" background-image:url(background.png); background-repeat:no-repeat">

<?php require('menu.php'); ?>



<div class="main">
 <h1>Color it with spice, share the taste with us!</h1>

</div>
	
	
	<div class="default">
  <button class="button">
    <a class="menu log expand <?= ($fn=='login.php')?' active':'' ?>" href="login.php"><li>Login</li></a>
  </button>
</div>





</body>
</html>