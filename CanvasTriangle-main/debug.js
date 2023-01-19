//To do later:
//Debug code to change the size of the window

window.addEventListener('resize, ')

function resize(canvas.height,canvas.width){
    canvas.height = window.innerHeight;
    canvas.width = window.innerWidth;
}


/*
triangle.isHitBy = function (x, y) {
    if (x >= this.initialX) {
        console.log("return hit");
    }
}
*/
    //Depreciated Functions
    //Function to draw line to show the length of the traingle
    /*function tempLine(e) {
        if (!mousePressed) {
            return;
        }
        context.lineWidth = 10;
        context.strokeStyle = "black";
        context.beginPath();
        context.lineTo(initialX, initialY);
        context.lineTo(e.clientX, initialY);
        //context.closePath();
        context.stroke();
    }*/
    //Functions to set painting to true or false
    /*function startPosition(e) {
        drawing = true;
        context.strokeStyle = getRandomColor();
        draw(e);
    }*/
    //Functions to set painting to true or false
    /*function finishedPosition() {
        drawing = false;
        context.beginPath();
    }*/

    //Function to draw
    /*function draw(e) {
        //If we're not drawing, we can simply return this function.
        if (!drawing) {
            return;
        }

        //Pre-applied styles to the pen
        context.lineWidth = 10;
        context.lineCap = "round";
        //context.strokeStyle = getRandomColor();

        //We want the line to go to where our mouse is
        //This is for simple drawing with a pen

        
        context.lineTo(e.clientX, e.clientY);
        context.stroke();
        context.beginPath();
        context.moveTo(e.clientX, e.clientY);

        context.lineTo(e.clientX, 0.5 * e.clientY);
        context.stroke();
        context.beginPath();
        context.moveTo(e.clientX, 0.5 * e.clientY);

        context.beginPath();

        //C or the rightmost point of the Triangle
        context.moveTo(e.clientX, e.clientY);
        //A or the topmost point of the Traingle
        context.lineTo(e.clientX - 50, e.clientY - 100);
        //B or the leftmost point of the Triangle
        context.lineTo(e.clientX - 100, e.clientY);

        context.fillStyle = getRandomColor();
        context.fill();

    }*/

    
    //For some reason, this doesn't seem to work.
    //context.lineCap = "round";

    /*
    class Triangle() {
        context.beginPath();
        //B or the leftmost point of the Triangle
        context.lineTo(initialX, initialY);
        //C or the rightmost point of the Triangle
        context.lineTo(finalX, initialY);
        //context.moveTo(finalX, initialY);
        //A or the topmost point of the Traingle
        context.lineTo((finalX - (lengthOfSide / 2)), (initialY - (lengthOfSide * 0.86602540378)));
        //B or the leftmost point of the Triangle
        context.lineTo(initialX, initialY);
        context.closePath();
    }
     //Depreciated code to test if the script works when the document is ready
    //console.log("Test Works");
    //Debug Code. To Remove
    //Drawing Rectangles
    context.strokeStyle = "red";
    context.lineWidth = 5;
    context.strokeRect(100,100, 200, 200);
    context.strokeStyle = "blue";
    context.lineWidth = 2;
    context.strokeRect(100,100, 100, 100);
    

    //Debug Code. To Remove
    //Drawing Lines
    
    context.beginPath();
    //Moving the pointer without drawing
    context.moveTo(100,100);
    context.lineTo(200,100);
    context.lineTo(200,150);
    context.closePath();
    context.stroke();
    

    
    //Variables
    //We don't want the drawing to start as soon as the window opens and hence we are setting drawing to false

    //Event Listener to return if the mouse is pressed down or not
    
    Debug Code
    canvas.addEventListener("mousedown", startPosition);
    canvas.addEventListener("mouseup", finishedPosition);
    canvas.addEventListener("mousemove", draw);
    */