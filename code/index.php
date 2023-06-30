<!DOCTYPE html>
<html>

<head>
    <script src="./scripts/index.js" defer></script>
    <link href="./styles/style.css" rel="stylesheet" type="text/css">
    <title>Top Gamez</title>
</head>

<body onload="sort()">
    <h1>Top Gamez Search</h1>
    <form id="search_form">
        <input type="text" id="game_search" oninput="findGame()" class="inputs" placeholder="Search by game title!">
	<br><br>
        <fieldset>
            <legend>Search By</legend>
            <select name="search_options" id="search_options" class="inputs" onChange="sort()">
                <option value="title" class="inputs">Title</option>
                <option value="genre" class="inputs">Genre</option>
                <option value="release" class="inputs">Release Date</option>
                <option value="rating" class="input">User Rating</option>
                <option value="price" class="inputs">Price</option>
            </select>
            <div id="control_div"></div>
        </fieldset>
    </form>
    <br>
    <br>

    <?php
    //setup logs
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    //include the Game class
    require 'Game.php';
    ?>

    <!--This grid will be the container for all the class grids-->
    <div id="grid_container">

        <?php

        //Get an array of games from the XML file
        $games = get_games();

        //display the array of games
        display_games($games);

        function get_games()
        {
            // Get the catalog.xml file if it exists
            $filename = "../xml/catalog.xml";
            if (file_exists($filename)) {

                $games = simplexml_load_file($filename);
                console_log("INFO: catalog.xml loaded");

                // Read through the catalog.xml file
                $numGames = $games->count();
                for ($count = 0; $count < $numGames; $count += 1) {

                    $title = $games->children()[$count]->title;
                    $genre = $games->children()[$count]->genre;
                    $release = $games->children()[$count]->release;
                    $rating = $games->children()[$count]->rating;
                    $price = $games->children()[$count]->price;
                    $description = $games->children()[$count]->description;
                    $image_large = $games->children()[$count]->image_large;
                    $image_small = $games->children()[$count]->image_small;

                    //create the game object and pass in the properties
                    $game = new Game($title, $genre, $release, $rating, $price, $description, $image_large, $image_small);

                    //add the new game to the games array
                    $gamesArray[$count] = $game;
                    $num = count($gamesArray);
                    console_log("INFO: Created $title, total games in gamesArray is $num");
                }
                return $gamesArray;
            }
        }

        //takes an array of game objects and displays them in the array order
        function display_games($gamesArr)
        {
            //get the class scope games list and display it
            $total = count($gamesArr);
            console_log("INFO: displayGames() is passed an array of size $total");
            for ($index = 0; $index < $total; $index += 1) {

                $title = $gamesArr[$index]->get_title();
                $genre = $gamesArr[$index]->get_genre();
                $release = $gamesArr[$index]->get_release();
                $rating = $gamesArr[$index]->get_rating();
                $price = $gamesArr[$index]->get_price();
                $description = $gamesArr[$index]->get_description();
                $image_large = $gamesArr[$index]->get_image_large();
                $image_small = $gamesArr[$index]->get_image_small();
                $game_title_id = 'game_title'.$index;

                echo "<div class='grid_game'><form method='POST' action='page.php'>
          <picture><img src='$image_small' alt='image of $title' class='image_small'></picture>
          <p id='$game_title_id' class='title'>$title</p><input type='hidden' name='title' value='$title'>
          <p class='genre'>Genre: $genre</p><input type='hidden' name='genre' value='$genre'>
          <p class='release'>Release Date: $release</p><input type='hidden' name='release' value='$release'>
          <p class='rating'>User Rating: $rating/5</p><input type='hidden' name='rating' value='$rating'>
          <p class='price'>Price: $$price</p><input type='hidden' name='price' value='$price'>
          <input type='hidden' name='image_small' value='$image_small'>
          <input type='hidden' name='image_large' value='$image_large'>
          <input type='hidden' name='description' value='$description'>
          <br><input type='submit' value='More Info >' class='submit_button'></form></div>";

                console_log("INFO: displayed $title");
            }
        }

        //use this function to send logs to the console 
        function console_log($message)
        {
            echo "<script>console.log('$message');</script>";
        }

        ?>
    </div>
</body>

</html>
