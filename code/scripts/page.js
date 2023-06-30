//Draws graph based on rating out of five
function drawGraph(r){

	
	var canvas = document.getElementById("ratingGraph");
	var ctx = canvas.getContext("2d");
	var width = 25;
	var height = 25;
	var gap = 5;
	var x = 5;
	var y = 5;
	var count = r;
	
	for (let i = 0; i < count; i++) {
		ctx.fillStyle = "#008080";
		ctx.fillRect(x,y,height,width);
		x+= width + gap;
	}
}