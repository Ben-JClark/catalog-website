var gamesGrid = document.getElementById("grid_container");
var controlDiv = document.getElementById("control_div");
var searchForm = document.getElementById("search_form")

/**
 * Prevents the form from submitting when user presses search on the search filter
 */
searchForm.addEventListener("submit", function(event){
    event.preventDefault();
    findGame();
})

/**
 * Sorts all the games in the page in alphabetical order
 * Optional * Can add a filter to reverse the alphabetical order if we want more search options
 */
function sortByTitle(){
    if(gamesGrid.hasChildNodes){
        let games = document.getElementsByClassName("grid_game");
        let gamesTitle = document.getElementsByName("title");
        for(let i = 0; i < games.length; i++){
            for(let j = 0; j < games.length; j++){
                let nextGame = j;
                nextGame = nextGame + 1;
                let game1Title = gamesTitle.item(j);
                let game2Title = gamesTitle.item(nextGame);
                if(j == games.length -1)
                    break;
                let order = (game1Title.value.localeCompare(game2Title.value));
                if(order == -1){
                    gamesGrid.insertBefore(games.item(j), games.item(nextGame));
                }
                else if(order == 1){
                    gamesGrid.insertBefore(games.item(nextGame), games.item(j));
                }
            }
        }
    }
}

/**
 * Utility method used to push hidden games to the back of the list
 */
function pushHiddenGames(){
    if(gamesGrid.hasChildNodes){
        let hiddenGames = document.getElementsByClassName("hidden");
        for(let i = (hiddenGames.length - 1); i >= 0; i--){
            gamesGrid.insertBefore(hiddenGames.item(i), null);
        }
    }
}

/**
 * Utility method used to show all the games again
 */
function resetHiddenGames(){
    if(gamesGrid.hasChildNodes){
        let hiddenGames = document.getElementsByClassName("hidden");
        for(let i = (hiddenGames.length - 1); i >= 0; i--){
            hiddenGames.item(i).className = "grid_game";
        }
    }
}

function resetControlDiv(){
    controlDiv.innerHTML = "";
}

/**
 * Main sorting method that decides which sort method to imploy
 */
function sort(){
    let searchOptions = document.getElementById("search_options");
    resetHiddenGames();
    resetControlDiv();
    if(searchOptions.value === "title"){
        sortByTitle();
    }
    else if(searchOptions.value === "genre"){
        sortByGenre();
    }
    else if(searchOptions.value === "price"){
        sortByPrice();
    }
    else{
        sortBySlider(searchOptions.value);
    }
}

/**
 * Sorts the game by using a slider value
 * @param {The attribute we want to search by} filter 
 */
function sortBySlider(filter){
    let slider = document.createElement("input");
    let sliderVal = document.createElement("span");
    slider.type = "range";
    let gameFilter = document.getElementsByName(filter);
    let min = gameFilter.item(0).value;
    let max = gameFilter.item(0).value;
    for(let i = 0; i < gameFilter.length; i++){
        if(gameFilter.item(i).value < min)
            min = gameFilter.item(i).value;
        if(gameFilter.item(i).value >= max)
            max = gameFilter.item(i).value;
    }
    slider.min = min;
    slider.max = max;
    slider.value = slider.min;
    slider.oninput = function(){
        resetHiddenGames();
        let gameFilter = document.getElementsByName(filter);
        let gridGames = document.getElementsByClassName("grid_game");
        sliderVal.innerHTML = slider.value;
        for(let i = (gameFilter.length - 1); i >= 0; i--){
            if(gameFilter.item(i).value < slider.value)
                gridGames.item(i).className = "hidden";
        }
        pushHiddenGames();
    }
    controlDiv.appendChild(slider);
    controlDiv.appendChild(sliderVal);
}

/**
 * sorts games by price
 * Has issues dealing with non integer values and some ranges
 * Not sure what the error is. Believe it is a javascript type issue
 * This code has always had error with sorting games when the input value is between 2-8 and above 100
 * Might refactor
 */
function sortByPrice(){
    let priceSelect = document.createElement("input");
    priceSelect.type = "number";
    priceSelect.min = 0;
    priceSelect.step = 10;
    priceSelect.max = 99;
    priceSelect.value = priceSelect.min;
    priceSelect.oninput = function(){
        resetHiddenGames();
        let priceFilter = document.getElementsByName("price");
        let gridGames = document.getElementsByClassName("grid_game");
        for(let i = (priceFilter.length - 1); i >= 0; i--){
            if(priceFilter.item(i).value > priceSelect.value){
                gridGames.item(i).className = "hidden"; 
            }
        }
        pushHiddenGames();
    }
    controlDiv.appendChild(priceSelect);
}

/**
 * Sorts games by genres provided
 */
function sortByGenre(){
    let genreSelect = document.createElement("select");
	genreSelect.className = "inputs";
    let games = document.getElementsByName("genre");
    for(let i = 0; i < games.length; i++){
        let optionsValue = games.item(i).value;
        let option = document.createElement("option");
        option.id = optionsValue;
        if(genreSelect.options.namedItem(optionsValue) != null)
            continue;
        option.textContent = optionsValue;
        option.value = optionsValue;
        genreSelect.appendChild(option);
    }
    //Whenever the user selects a new genre
    genreSelect.onchange = function(){
        resetHiddenGames();
        let gridGames = document.getElementsByClassName("grid_game");
        let genres = document.getElementsByName("genre");
        for(let i = (games.length - 1); i >= 0; i--){
            if(!((genres.item(i).value.localeCompare(genreSelect.value) == 0)))
                gridGames.item(i).className = "hidden";
        }
        pushHiddenGames();
    }
    controlDiv.appendChild(genreSelect);
}

/**
 * Finds the games based of the user's search
 */
function findGame(){
    resetHiddenGames();
    let gridGames = document.getElementsByClassName("grid_game");
    let gameTitles = document.getElementsByName("title");
    let gameTitle = document.getElementById("game_search");
    gameTitle = (gameTitle.value + "").toLocaleLowerCase();
    console.log("Inside findgame()");
    console.log(gameTitle + " Title to search: Outside the loop");
    if(gameTitle != null){
        for(let i = (gameTitles.length - 1); i >= 0; i--){
            if(((gameTitles.item(i).value + "").toLocaleLowerCase()).includes(gameTitle) == false){
                gridGames.item(i).className = "hidden";
            }
        }
    }
    pushHiddenGames();
}
