<?php session_start(); ?><!doctype html>
<html>
<head>


<title>Add recipes</title>
	


</head>

<body background="background.png" style="background-size:cover; background-repeat:no-repeat; background-position: top left;">
<?php require('menu_loggedin.php'); ?>


	<div class="col-3-12"></div>

<div class="addrecipe col-6-12">
	<form action="upload.php" method="post" enctype="multipart/form-data">
		
		<fieldset class="fieldset">
    	<legend>Share your recipe</legend>
		<label for="file">Select the spicy image </label>
     	<input type="file" name="fileToUpload" id="fileToUpload"><br><br>
		<label for="title">Set the title for that spicy thing (Max 25 characters)</label>
    	<input type="text" name="title" placeholder="Image title" min="1" maxlength="20" required />
		<label for="description">Tell us more about it (Max 250 characters) </label>
		<input type="text" name="description" placeholder="Description" min="1" maxlength="250" required />
		<label for="ingredients">What are the ingredients? (Max 250 characters) </label>
		<input type="text" name="ingredients" placeholder="Ingredients" min="1" maxlength="250" required />
		<label for="recipe">Now please tell step by step (Max 1100 characters)</label>
		 <textarea type="text" name="recipe" placeholder="Recipe" min="1" maxlength="1100" style=" width: 100%; height:200px" required /></textarea>
    	<input type="submit" value="upload" name="upload">
		</fieldset>
	</form>
	


<a href="view.php"> Go back </a>	
</div>

</body>
</html>