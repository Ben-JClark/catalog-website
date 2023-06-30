5<!DOCTYPE html>
<html>
<head>
	<link href="../styles/style.css" rel="stylesheet" type="text/css">
	<script src="../scripts/page.js" defer></script>
    <title>Top Gamez Details</title>
	
</head>
<!--onload populates page with game object-->
<body onload="populate()">

<?php
     $title = $_POST["title"];
     $genre = $_POST["genre"];
     $release = $_POST["release"];
     $rating = $_POST["rating"];
     $price = $_POST["price"];
     $description = $_POST["description"];
     $image_large = $_POST["image_large"];
     $image_small = $_POST["image_small"];
     //echo "<p>$title, $genre, $release, $rating, $price, $description, $image_large, $image_small</p>";
	 echo "
	<h1>$title</h1>
	
	<div class='wrapper'>
	<picture><img src='$image_large' alt='image of $title' class='image_large'></picture>
		<div id='specifications'>
			 <h3 class='left'>Genre: $genre</h3> 
			 
			 <h3 class='right'>Relase date: $release</h3>
		</div>
		<div id='information'>
			 <h3 class='left'>Description: $description</h3>
			 <h3 class='right'>Price: $ $price</h3>
		 </div>
	</div>
	 ";
   ?> 
   
   <script>
		function populate(){
		//gets rating of game and draws graph
			var r = <?php echo "$rating;" ?>;
			drawGraph(r);
		}
	</script>
   <div class ="wrapper">
	   <div id="rate">
			<!--Canvas for ratings graph-->
		   <h3 class="left">Rating</h3><canvas id="ratingGraph" width="155" height="35"
			style="background-color: #002626; border:1px solid #002626;">
				
			</canvas><?php echo"<h3 class='right'>$rating/5</h3>";?>
		</div>
		
	
	
	</div>
</body>


</html>
