<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/normalize.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="hi.js"></script>
	<script src="https://use.fontawesome.com/15383c95d9.js"></script>
	<meta name="description" content="A website which merely focuses on providing recipes for spicy food cooking in Danish Cuisine along with providing the users to share their own recipes and give rating to all available recipes.">
	<meta name="keywords" content="opskrift, krydderi, spices, spice, madlavning, cooking"> 
	<meta name="robots" content="index, follow">
	
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-92533793-2"></script>
	<script>
  	window.dataLayer = window.dataLayer || [];
  	function gtag(){dataLayer.push(arguments);}
  	gtag('js', new Date());

 	 gtag('config', 'UA-92533793-2');
	</script>
</head>

<?php 
$fn = basename($_SERVER['PHP_SELF']);
//if ($fn == 'p2.php') {
//	echo 'active';
//}

//echo 'active'
?>



    <div class="mainContainer col-1-1"> 
        <div class="containerHero flex">
            <div class="hero">
                <nav class="flex">
                    <a link href="view.php"><img alt="logo" src="logo.png" class="logo flex"></a>
                    <ul class="flex">
						<!--<a class="menu <?= ($fn=='index.php')?' active':'' ?>" href="index.php"><li>Home</li></a>-->
						<a class="menu <?= ($fn=='viewimages.php')?' active':'' ?>" href="view.php"><li>View Recipes</li></a>
						<a class="menu <?= ($fn=='p2.php')?' active':'' ?>" href="index_loggedin.php"><li>Add Recipes</li></a>
						<!--<a class="menu <?= ($fn=='p3.php')?' active':'' ?>" href="p3.php">Search</a>
						<a class="menu <?= ($fn=='p4.php')?' active':'' ?>" href="p4.php">Page 4</a>-->
						<a class="menu log <?= ($fn=='login.php')?' active':'' ?>" href="logout.php"><li>Logout</li></a>
                    </ul>
                </nav>
            </div>

        </div>
       
    </div>

<div class="welcome col-1-1">   	
	<?php
	
	if (!empty($_SESSION['uid'])){
		echo 'Logged in as '.$_SESSION['un'];
		echo '<br><a href="accountinfo.php">Your Recipes</a>';
	}
	else {
		echo 'Not logged in...';
	}

?> </div>



</body>
</html>

