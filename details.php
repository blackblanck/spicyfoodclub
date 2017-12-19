<?php session_start(); ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="hi.js"></script>


<title>View All Recipes</title>

	

</head>

<body>
<?php require('menu_loggedin.php'); ?>



  	
<?php
	
	if (!empty($_SESSION['uid'])){
		echo 'Logged in as '.$_SESSION['un'];
		
	}


?>



<?php 
	
require_once('db_con.php');	
	
$stmt = $link->prepare("SELECT idrecipes, url, title, description, recipe, users_idusers, username, ingredients
from recipes, users
where idrecipes=? LIMIT 1");
$stmt->execute();
$stmt->bind_param('i',$recipeid);
$stmt->bind_result($recipeid, $url, $title, $description, $recipe, $recipeuid, $recipeusername, $ingredients);
	

while($stmt->fetch()){
	
	
?>
	

		
	
	<h3>Added by <?=$recipeusername?> (user id: <?=$recipeuid?>) with title: '<?=$title?>' with description: '<?=$description?>' recipe: '<?=$recipe?>' ingredients: '<?=$ingredients?>'</h3>
	<img class="indimage" src="<?=$url?>"  />  
		
		
	
<?php if ($_SESSION['uid'] == $recipeuid ) { ?>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="idrecipes" value="<?=$recipeid?>" />
			<button type="submit" name="cmd" value="delete_img">Delete</button>
		</form>
		<a href="rename_image.php?imageid=<?=$recipeid?>">Rename</a>		
<?php }	?>
	

				
<?php } 

	
?>


	<?php
		if($cmd = filter_input(INPUT_POST, 'cmd')){

			if($cmd == 'delete_img'){
				// code to delete the recipe

				$recipeid = filter_input(INPUT_POST, 'idrecipes')
					or die('Missing/illegal title parameter');

				require_once('db_con.php');
				$sql = 'DELETE FROM recipes WHERE idrecipes=(?)';
				$stmt = $link->prepare($sql);
				$stmt->bind_param('i', $recipeid);
				$stmt->execute();

				if($stmt->affected_rows > 0){
					echo "<script type='text/javascript'>window.top.location='view.php';</script>";
				
				
				}
				
				else{
					echo 'Could not delete img '.$url;
				}			

			}
			else {
				die('Unknown cmd parameter');
			}
		}
?>



</div>
	


</body>
</html>