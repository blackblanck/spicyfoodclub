
	
$recipes = $link->$query("SELECT idrecipes, url, title, description, recipe, users_idusers, username, ingredients from recipes, users where idrecipes=? and idusers=?");
$row = mysqli_query($sucess, query) or die (mysqli_error());
		while ($row=$recipes->fetch_object()) {
			
echo '<pre>' . print_r($row, true) . '</pre>';
		}





if (isset($_POST['cmd'])) {
	$cmd = $_POST['cmd'];
	
 } else die ("you need to pick an existing shit");
	
	if($stmt->num_rows != 1){
					echo "huhu";



	$recipeid = $row ['idrecipes'];
	$url = $row ['url'];
	$title = $row ['title'];
	$description= $row ['description'];
	$recipe = $row ['recipe'];
	$recipeuid = $row ['usersidusers'];
	$recipeusername = $row ['username'];
	$ingredients= $row ['ingredients'];


		
			$stmt = $link->prepare("SELECT idrecipes, url, title, description, recipe, users_idusers, username, ingredients from recipes, users where idrecipes=? and idusers=? ");
			$rows =$result->num_rows;
			$stmt->execute();
			$stmt->bind_result($recipeid, $url, $title, $description, $recipe, $recipeuid, $recipeusername, $ingredients);
			while($stmt->fetch_array(MYSQLI_ASSOC)){
					$recipeid = $_POST['idrecipes'];
					$url = $_POST['fileToUpload'];
					$title = $_POST['title'];
					$description= $_POST['description'];
					$recipe = $_POST['recipe'];
					$recipeuid = $_POST['usersidusers'];
					$recipeusername = $_POST['username'];
					$ingredients= $_POST['ingredients'];
				}	


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


  <div class="info">
  	
  	<?php
	
	if (!empty($_SESSION['uid'])){
		echo 'Logged in as '.$_SESSION['un'];
		
	}
	else {
		echo 'Not logged in...';
	}

?>

	</div>



	
<p class="main">Displaying one recipe</p>

<?php 

//check for a recipe submisson
	


		if(isset ($_POST['submit'])){
			
			$cmd = $_POST['cmd']; 
			require_once('db_con.php');

		} else echo "cry baby cry";
			
			

				

			
			$stmt = $link->prepare("SELECT idrecipes, url, title, description, recipe, users_idusers, username, ingredients from recipes, users where idrecipes=? and idusers=? ");
			$stmt->execute();
			$stmt->bind_result($recipeid, $url, $title, $description, $recipe, $recipeuid, $recipeusername, $ingredients);
			while($stmt->fetch_array()){
			$recipeid = $_POST['idrecipes'];
			$url = $_POST['fileToUpload'];
			$title = $_POST['title'];
			$description= $_POST['description'];
			$recipe = $_POST['recipe'];
			$recipeuid = $_POST['usersidusers'];
			$recipeusername = $_POST['username'];
			$ingredients= $_POST['ingredients'];
			
			}	
				
			
				

		
	
	
?>
	
	
	
	
	<h3>Added by <?=$recipeusername?> (user id: <?=$recipeuid?>) with title: '<?=$title?>' with description: '<?=$description?>' recipe: '<?=$recipe?>' ingredients: '<?=$ingredients?>'</h3>
	<img class="indimage" src="<?=$url?>"  />  
		
		
	

				
<?php 

	
?>
	
	<?php if ($_SESSION['uid'] == $recipeuid ) { ?>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="idrecipes" value="<?=$recipeid?>" />
			<button type="submit" name="cmd" value="delete_img">Delete</button>
		</form>
		<a href="rename_image.php?imageid=<?=$recipeid?>">Rename</a>		
<?php }	?>


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




	


</body>
</html>