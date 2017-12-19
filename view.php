<?php session_start(); ?>

<!doctype html>
<html>
<head>

<title>View All Recipes</title>

</head>

<body>
	
	
	
<?php require('menu_loggedin.php'); ?>
	

<div class="col-1-1 ">
<div class="support col-1-3"></div>
<div class="col-1-3"><form class="search" action="search"><input type="search" placeholder="Not available at the moment" required><button type="submit">Search</button></form></div>   
<div class="support col-1-3"></div>
</div>
	

	<div class="col-1-1"> 
	
	<a href="#section2"><div class="scrolldown col-1-4 push-1-4 highrating "><p>Most popular recipes<p></div></a>
	<a href="#section3"><div class="scrolldown col-1-4 shared"><p>Recipes added by members</p></div></a>
	
	</div>




	
	
<div class="main wrapper col-1-1"> 
<section> 
	
<div class="headingcover col-1-1"> 
	<div class="support col-1-12"></div>
<div class="heading col-10-12">Recipes by Spicy Food Club</div>

</div>
	
	
<div class="allforone col-1-12"></div>
<div class="bigbox col-10-12"> 
	
	

<?php 
	
require_once('db_con.php');	
	
$stmt = $link->prepare("SELECT idrecipes, url, title, description, recipe, users_idusers, username, ingredients
from sfc_recipes, sfc_users
where
users_idusers = idusers
AND users_idusers = '6' ORDER by idrecipes DESC LIMIT 6");
$stmt->execute();
$stmt->bind_result($recipeid, $url, $title, $description, $recipe, $recipeuid, $recipeusername, $ingredients);
while($stmt->fetch()){
		

echo '<button class="myBtn col-1-3" style="background-image:url('.$url.'); background-size:cover;"><h3 class="title"> '.$title.'  <p class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star	"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></p><p class="spice">very chilli</p></h3></button>';
echo '<div class="myModal modal">';
echo ' <div class="modal-content">';
echo '<span class="close">&times;</span>';
?>
	<div class="recipedetails" > 
<h1><?=$title?></h1>
<h3><?=$description?> </h3>
Recipe by <?=$recipeusername?> (user id: <?=$recipeuid?>)
<h4>Ingredients: </h4> <p><?=$ingredients?></p> 
<h4>Recipe:</h4><p><?=$recipe?></p>
<h4> Tips:</h4> <p>Make sure that you add plenty of spice. Spice is the key to success</p> 

<iframe width="560" height="315" src="https://www.youtube.com/embed/wdKJ0o4_CQE" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
	
	</div>

	<div class="share"> <h3> Share this Recipe </h3> <br>
<!-- Social Button HTML -->

<!-- Twitter -->
<a href="http://twitter.com/share?url=<URL>&text=<TEXT>&via=<VIA>" target="_blank" class="share-btn twitter">
    <i class="fa fa-twitter"></i>
</a>


<!-- Facebook -->
<a href="http://www.facebook.com/sharer/sharer.php?u=<URL>" target="_blank" class="share-btn facebook">
    <i class="fa fa-facebook"></i>
</a>


<a href="http://pinterest.com/pin/create/button/?url=<URL>&description=<TITLE>" target="_blank" class="share-btn pinterest">
	<i class="fa fa-pinterest"></i>
	</a>
	
<!-- Email -->
<a href="mailto:?subject=<SUBJECT&body=<BODY>" target="_blank" class="share-btn email">
    <i class="fa fa-envelope"></i>
</a>
</div>	 
	

<div class="urlimage">
		
	<img class="indimage" src="<?=$url?>" alt="<?=$title?>"/>  
	


<div class="rating"> Your rating 1-2-3-4-5 </div>


<?php if ($_SESSION['uid'] == $recipeuid ) { ?>
		
	<table class="freedom"> 
		<tr> 
		<td> <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="idrecipes" value="<?=$recipeid?>" />
			<button type="submit" name="cmd" value="delete_recipe">Delete</button> 
		</form> </td>

		<td> <button > <a href="rename_recipe.php?idrecipes=<?=$recipeid?>">Edit</a></button>	</td>
		</tr>
		</table>
<?php }	?>
	
		<?php
	
	echo '</div>';
echo '</div>';
echo '</div>';	
			
	?>
<?php 
		} 
	
?>	

<?php
		if($cmd = filter_input(INPUT_POST, 'cmd')){

			if($cmd == 'delete_recipe'){
				// code to delete the recipe

				$recipeid = filter_input(INPUT_POST, 'idrecipes')
					or die('Missing/illegal recipe id parameter');
				

				require_once('db_con.php');
				$sql = 'DELETE FROM sfc_recipes WHERE idrecipes=(?)';
				$stmt = $link->prepare($sql);
				$stmt->bind_param('i', $recipeid);
				$stmt->execute(); 
				

				if($stmt->affected_rows > 0){
					
					
					echo "<script type='text/javascript'>window.top.location='accountinfo.php';</script>";
				
				}
				
				else{
					echo 'Could not delete recipe '.$url;
				}			

			}
			else {
				die('Unknown cmd parameter');
			}
		}
?>
	

	
	</div>
	
	<div class="allforone col-1-12"></div>
	</section>
	</div>

<button onclick="topFunction()" id="gotop" title="Go to top">Top</button>

<div class="main wrapper col-1-1" id="section2"> 	

  <section>

	  <div class="headingcover col-1-1"> 
	<div class="support col-1-12"></div>
<div class="heading col-10-12">Most popular recipes</div>

</div>
	  
<div class="allforone col-1-12"></div>
<div class="bigbox col-10-12"> 
	
	

<?php 
	
require_once('db_con.php');	
	
$stmt = $link->prepare("SELECT idrecipes, url, title, description, recipe, users_idusers, username, ingredients
from sfc_recipes, sfc_users
where users_idusers = idusers ORDER by idrecipes DESC LIMIT 6");
$stmt->execute();
$stmt->bind_result($recipeid, $url, $title, $description, $recipe, $recipeuid, $recipeusername, $ingredients);
while($stmt->fetch()){
		

echo '<button class="myBtn col-1-3" style="background-image:url('.$url.'); background-size:cover;"><h3 class="title"> '.$title.'  <p class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star	"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></p><p class="spice">very chilli</p></h3></button>';
echo '<div class="myModal modal">';
echo ' <div class="modal-content">';
echo '<span class="close">&times;</span>';
?>
	<div class="recipedetails" > 
<h1><?=$title?></h1>
<h3><?=$description?> </h3>
Recipe by <?=$recipeusername?> (user id: <?=$recipeuid?>)
<h4>Ingredients: </h4> <p><?=$ingredients?></p> 
<h4>Recipe:</h4><p><?=$recipe?></p>
<h4> Tips:</h4> <p>Make sure that you add plenty of spice. Spice is the key to success</p> 


	 
	</div>
	
		<div class="share"><h3> Share this Recipe </h3> <br>
<!-- Social Button HTML -->

<!-- Twitter -->
<a href="http://twitter.com/share?url=<URL>&text=<TEXT>&via=<VIA>" target="_blank" class="share-btn twitter">
    <i class="fa fa-twitter"></i>
</a>


<!-- Facebook -->
<a href="http://www.facebook.com/sharer/sharer.php?u=<URL>" target="_blank" class="share-btn facebook">
    <i class="fa fa-facebook"></i>
</a>


<a href="http://pinterest.com/pin/create/button/?url=<URL>&description=<TITLE>" target="_blank" class="share-btn pinterest">
	<i class="fa fa-pinterest"></i>
	</a>
	
<!-- Email -->
<a href="mailto:?subject=<SUBJECT&body=<BODY>" target="_blank" class="share-btn email">
    <i class="fa fa-envelope"></i>
</a>
</div>	

<div class="urlimage">
	

	
	<img class="indimage" src="<?=$url?>" alt="<?=$title?>"/>  
	
	


<div class="rating"> Your rating 1-2-3-4-5 </div>


<?php if ($_SESSION['uid'] == $recipeuid ) { ?>
	<table class="freedom"> 
		<tr> 
		<td> <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="idrecipes" value="<?=$recipeid?>" />
			<button type="submit" name="cmd" value="delete_recipe">Delete</button> 
		</form> </td>

		<td> <button > <a href="rename_recipe.php?idrecipes=<?=$recipeid?>">Edit</a></button>	</td>
		</tr>
		</table>	
<?php }	?>
	
		<?php
	
	echo '</div>';
echo '</div>';
echo '</div>';	
			
	?>
<?php 
		} 
	
?>	

<?php
		if($cmd = filter_input(INPUT_POST, 'cmd')){

			if($cmd == 'delete_recipe'){
				// code to delete the recipe

				$recipeid = filter_input(INPUT_POST, 'idrecipes')
					or die('Missing/illegal recipe id parameter');
				

				require_once('db_con.php');
				$sql = 'DELETE FROM sfc_recipes WHERE idrecipes=(?)';
				$stmt = $link->prepare($sql);
				$stmt->bind_param('i', $recipeid);
				$stmt->execute(); 
				

				if($stmt->affected_rows > 0){
					
					
					echo "<script type='text/javascript'>window.top.location='accountinfo.php';</script>";
				
				}
				
				else{
					echo 'Could not delete recipe '.$url;
				}			

			}
			else {
				die('Unknown cmd parameter');
			}
		}
?>
	

	
	</div>
	
	<div class="allforone col-1-12"></div>
	</section>
	</div>

<div class="main wrapper col-1-1" id="section3">
  <section>
	<div class="headingcover col-1-1"> 
	<div class="support col-1-12"></div>
<div class="heading col-10-12">Recipes by Spicy Food Club Members</div>

</div>
<div class="allforone col-1-12"></div>
<div class="bigbox col-10-12"> 
	
	

<?php 
	
require_once('db_con.php');	
	
$stmt = $link->prepare("SELECT idrecipes, url, title, description, recipe, users_idusers, username, ingredients
from sfc_recipes, sfc_users
where
users_idusers = idusers
AND username != 'admin' ORDER by idrecipes DESC");
$stmt->execute();
$stmt->bind_result($recipeid, $url, $title, $description, $recipe, $recipeuid, $recipeusername, $ingredients);
while($stmt->fetch()){
		

echo '<button class="myBtn col-1-3" style="background-image:url('.$url.'); background-size:cover;"><h3 class="title"> '.$title.'  <p class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star	"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i></p><p class="spice">very chilli</p></h3></button>';
echo '<div class="myModal modal">';
echo ' <div class="modal-content">';
echo '<span class="close">&times;</span>';
?>
	<div class="recipedetails" > 
<h1><?=$title?></h1>
<h3><?=$description?> </h3>
Recipe by <?=$recipeusername?> (user id: <?=$recipeuid?>)
<h4>Ingredients: </h4> <p><?=$ingredients?></p> 
<h4>Recipe:</h4><p><?=$recipe?></p>
<h4> Tips:</h4> <p>Make sure that you add plenty of spice. Spice is the key to success</p> 


	 
	</div>
	
		<div class="share"><h3> Share this Recipe </h3> <br>
<!-- Social Button HTML -->

<!-- Twitter -->
<a href="http://twitter.com/share?url=<URL>&text=<TEXT>&via=<VIA>" target="_blank" class="share-btn twitter">
    <i class="fa fa-twitter"></i>
</a>


<!-- Facebook -->
<a href="http://www.facebook.com/sharer/sharer.php?u=<URL>" target="_blank" class="share-btn facebook">
    <i class="fa fa-facebook"></i>
</a>


<a href="http://pinterest.com/pin/create/button/?url=<URL>&description=<TITLE>" target="_blank" class="share-btn pinterest">
	<i class="fa fa-pinterest"></i>
	</a>
	
<!-- Email -->
<a href="mailto:?subject=<SUBJECT&body=<BODY>" target="_blank" class="share-btn email">
    <i class="fa fa-envelope"></i>
</a>
</div>	

<div class="urlimage">
	

	
	<img class="indimage" src="<?=$url?>" alt="<?=$title?>"/>  
	
	


<div class="rating"> Your rating 1-2-3-4-5 </div>


<?php if ($_SESSION['uid'] == $recipeuid ) { ?>
	<table class="freedom"> 
		<tr> 
		<td> <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="idrecipes" value="<?=$recipeid?>" />
			<button type="submit" name="cmd" value="delete_recipe">Delete</button> 
		</form> </td>

		<td> <button > <a href="rename_recipe.php?idrecipes=<?=$recipeid?>">Edit</a></button>	</td>
		</tr>
		</table>	
<?php }	?>
	
		<?php
	
	echo '</div>';
echo '</div>';
echo '</div>';	
			
	?>
<?php 
		} 
	
?>	

<?php
		if($cmd = filter_input(INPUT_POST, 'cmd')){

			if($cmd == 'delete_recipe'){
				// code to delete the recipe

				$recipeid = filter_input(INPUT_POST, 'idrecipes')
					or die('Missing/illegal recipe id parameter');
				

				require_once('db_con.php');
				$sql = 'DELETE FROM sfc_recipes WHERE idrecipes=(?)';
				$stmt = $link->prepare($sql);
				$stmt->bind_param('i', $recipeid);
				$stmt->execute(); 
				

				if($stmt->affected_rows > 0){
					
					
					echo "<script type='text/javascript'>window.top.location='accountinfo.php';</script>";
				
				}
				
				else{
					echo 'Could not delete recipe '.$url;
				}			

			}
			else {
				die('Unknown cmd parameter');
			}
		}
?>
	

	
	</div>
	
	<div class="allforone col-1-12"></div>
	</section>
	</div>
	


</body>
	
	<script>
	
// Get the modals
var modals = document.getElementsByClassName("myModal");
//save the main scope
var self = this;
//Get the buttons
var btn = document.getElementsByClassName("myBtn");

	console.log('btn spans:'+btn.length);
	
//loop through the buttons and attach the click event to them
for (var i = 0; i < btn.length; i++) {
    
    //save the current index on the button
    btn[i].id = i;
    btn[i].onclick = function(){
        	console.log('btn clicked id:'+this.id);
        //get the right modal for the button using the index (id)
        var modal = modals[this.id];

        //show the modal by changing the style of the modal element
        modal.style.display = 'block';
    };
}


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close");

	
console.log('close spans:'+span.length);	
// When the user clicks on <span> (x), close the modal
for (var i = 0; i < span.length; i++) {
	
	console.log('assigning onclick fubction to span id:'+i);
	
    span[i].id = i;
    span[i].onclick = function() {
			console.log('close clicked id:'+this.id);

        //console.log(this.id)
        //console.log(self.modal[this.id])
  //   self.modal[this.id].style.display = 'none';
		
		        //get the right modal for the button using the index (id)
        var modal = modals[this.id];

        //show the modal by changing the style of the modal element
        modal.style.display = 'none';
		console.log('xxxx');
    };
}
	
	
/*	
	// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};*/
	</script>
		
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>
	
	<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("gotop").style.display = "block";
    } else {
        document.getElementById("gotop").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>

</html>