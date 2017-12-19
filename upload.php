<?php session_start(); ?>

<?php require('menu_loggedin.php'); ?>



<body background="background.png" style="background-size:cover; background-repeat:no-repeat">

<?php
require_once('db_con.php');

	
//echo 'logged in as id:'.$_SESSION['uid'];
	
$title = filter_input(INPUT_POST, 'title') or die('title not accepted');
$description = filter_input(INPUT_POST, 'description') or die('description not accepted');
$recipe = filter_input(INPUT_POST, 'recipe') or die('recipe not accepted');
$ingredients = filter_input(INPUT_POST, 'ingredients') or die('ingredient not accepted');

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// If you need unique names:
//$target_file = $target_dir . uniqid().'.'.$imageFileType;	
	
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo '<div class="mainupload">Sorry, this file is not an image <br><br> <a href="index_loggedin.php">Go back</a><br>
	 </div>';
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo '<div class="mainmessage">Sorry, this recipe already exists <br><br> <a href="index_loggedin.php">Go back</a><br>
	 </div>';
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo '<div class="mainmessage">Sorry, this file is too large <br><br> <a href="index_loggedin.php">Go back</a><br>
	 </div>';
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo  '<div class="mainmessage">Sorry, only JPG, JPEG, PNG & GIF files are allowed <br><br> <a href="index_loggedin.php">Go back</a><br>
	 </div>';
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo '<div class="mainmessage">Sorry, your file was not uploaded, this recipe already exists <br><br> <a href="index_loggedin.php">Go back</a><br>
	 </div>';
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
		
		require_once('db_con.php');
		
		$sql = 'INSERT INTO sfc_recipes (url, title, description, ingredients, recipe, users_idusers) VALUES (?,?,?,?,?,?)';
		
			$stmt = $link->prepare($sql);
		$stmt->bind_param('sssssi', $target_file, $title, $description, $ingredients, $recipe, $_SESSION['uid']);
		$stmt->execute();
		//echo '<br>affected rows:'.$stmt->affected_rows.'<br>';
		if ($stmt->affected_rows > 0) {
			echo '<div class="mainmessage">Thank you for sharing the taste with us. Your recipe is added to the database :) <br><br> <a href="index_loggedin.php">Go back</a><br>
	<a href="view.php"> View all recipes </a> </div>';
		}
		else {
			echo '<div class="mainmessage"> Could not add the file to the database :( </div>';
		}
		
    } else {
        echo '<div class="mainmessage">Sorry, there was an error uploading your file.</div>';
    }
}
?>

</body>
