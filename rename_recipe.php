<?php session_start(); ?>
<body background="background.png" style="background-size:cover; background-repeat:no-repeat">

<?php require('menu_loggedin.php'); ?>
<?php
	
if($cmd = filter_input(INPUT_POST, 'cmd')){
	if($cmd == 'rename_recipe'){
		
		$recipeid = filter_input(INPUT_POST, 'idrecipes', FILTER_VALIDATE_INT)
			or die('Missing/illegal recipe-id parameter');
		$title = filter_input(INPUT_POST, 'title')
			or die('Missing/illegal title parameter');
		$description = filter_input(INPUT_POST, 'description')
			or die('Missing/illegal description parameter');
		$ingredients = filter_input(INPUT_POST, 'ingredients')
			or die('Missing/illegal ingredients parameter');
		$recipe = filter_input(INPUT_POST, 'recipe')
			or die('Missing/illegal recipe parameter');
		
		require_once('db_con.php');
		$sql = 'UPDATE sfc_recipes SET title=?, description=?, ingredients=?, recipe=? WHERE idrecipes=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('ssssi', $title, $description, $ingredients, $recipe, $recipeid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo '<div class="mainmessage">Thank you for the update. Your recipe has been edited:) <br><br> <a href="index_loggedin.php">Upload new recipe</a><br>
	<a href="view.php"> View all recipes </a><br><a href="accountinfo.php"> View your recipes </a> </div>';
		}
		else{
			echo 'Nothing was changed ?!?!?!';
		}
		
	}
	else {
		die('Unknown cmd parameter');
	}
}
?>



<?php
	
	if(empty($recipeid)){
		$recipeid = filter_input(INPUT_GET, 'idrecipes', FILTER_VALIDATE_INT)
			or die('Missing/illegal recipe laylaylom parameter');
	}
	
	require_once('db_con.php');
	$sql = 'SELECT title, description, ingredients, recipe FROM sfc_recipes WHERE idrecipes=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('i', $recipeid);
	$stmt->execute();
	$stmt->bind_result($title, $description, $ingredients, $recipe);
	while($stmt->fetch()) {}
	
	?>
	
	<div class="col-3-12"></div>

<div class="addrecipe col-6-12">
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset class="fieldset">
    	<legend>Edit your recipe</legend>
		
    	<input name="idrecipes" type="hidden" value="<?=$recipeid?>" />
		<label for="title">Edit the title for that spicy thing (Max 25 characters)</label>
    	<input name="title" type="text" value="<?=$title?>" placeholder="Title" required />
		<label for="description">Edit your description (Max 250 characters) </label>
		<input name="description" type="text" value="<?=$description?>" placeholder="Description" required />
		<label for="ingredients">Edit ingredients (Max 250 characters) </label>
		<input name="ingredients" type="text" value="<?=$ingredients?>" placeholder="Ingredients" required />
		<label for="recipe">Re-write your recipe (Max 1100 characters)</label>
		<textarea name="recipe" type="text" value="<?=$recipe?>" placeholder="Recipe" min="1" maxlength="1100" style="width: 100%; height:200px" required /></textarea>
		<button name="cmd" value="rename_recipe" type="submit">Update</button>
  	</fieldset>
</form>
<a href="view.php"> Go back </a>
</div>

</body>
</html>