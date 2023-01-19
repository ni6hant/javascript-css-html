var i = 0;
//We need to get the element, in this case the canvas
const canvas = document.querySelector('#canvas');

//Variables needed later
var initialX = 0;
var initialY = 0;
var finalX = 0;
var finalY = 0;
var midX = 0;
var midY = 0;
var lengthOfSide = 0;
var mousePressed = false;
var color = "black";

//Resizing canvast to fit the Window
canvas.height = window.innerHeight;
canvas.width = window.innerWidth;

//We need to define what environment we're working in, in this case 2d
const context = canvas.getContext('2d');

//This is the traingle class which contains all the three major points and the color
class triangle {
    constructor(initialX, initialY, finalX, finalY) {
        this.initialX = initialX;
        this.initialY = initialY;
        this.finalX = finalX;
        this.finalY = finalY;
    }
    get midX() {
        return this.finalX - ((this.finalX - this.initialX) / 2);
    }
    get midY() {
        return this.initialY - ((this.finalX - this.initialX) * 0.86602540378);
    }
    get color() {
        return getRandomColor();
    }

    drawObject() {
        context.lineWidth = 2;
        context.strokeStyle = "black";
        context.beginPath();
        //B or the leftmost point of the Triangle
        context.lineTo(this.initialX, this.initialY);
        //C or the rightmost point of the Triangle
        context.lineTo(this.finalX, this.initialY);
        //context.moveTo(finalX, initialY);
        //A or the topmost point of the Traingle
        context.lineTo(this.midX, this.midY);
        //B or the leftmost point of the Triangle
        //context.lineTo(this.initialX, this.initialY);
        context.closePath();
        context.stroke();
        context.fillStyle = this.color;
        context.fill();
    }
    isHitBy(x, y) {
        //define proper formula to check if hit
        if (x >= this.initialX) {
            console.log("return hit");
        }
    }
}

window.addEventListener('load', () => {

    let drawing = false;
    //Event Listener
    //This calls the function which saves the inital point when the mouse was pressed into global variable
    canvas.addEventListener("mousedown", saveInitalPoint);
    //This calls the function which saves the final point when the mouse was lift up
    canvas.addEventListener("mouseup", drawTriangle);
    //canvas.addEventListener("mousemove", tempLine);
    canvas.addEventListener("mousemove", function (e) {
        var canvasBounds = canvas.getBoundingClientRect();
        var clickX = e.pageX - canvasBounds.left;
        var clickY = e.pageY - canvasBounds.top;
        if (mousePressed && triangleisHit(clickX, clickY)) {
            //action to take when hit
            console.log('Hit');
        }
    });
})

function clearCanvas() {
    var canvas = document.getElementById('canvas'),
        ctx = canvas.getContext("2d");
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function saveInitalPoint(e) {
    initialX = e.clientX;
    initialY = e.clientY;
    color = getRandomColor();
    mousePressed = true;
    //Debug Code
    //console.log(initialX);
    //console.log(initialY);
}

function drawTriangle(e) {
    //This call is made to save the coordinates of the final mouse position when the mouse is no more held
    getLengthOfTriangle(e);
    //Defines a new triangle object
    triangle[i] = new triangle(initialX, initialY, finalX, finalY, color);
    //Draws the new Traingle Object
    triangle[i].drawObject();
    console.log(triangle[i])
    mousePressed = false;
    i++;

}

function triangleisHit(x, y) {
    if (triangle[i].isHitBy(x, y)) {
        console.log("function return hit");
        //return (triangle.isHitBy());
    }
}

function getLengthOfTriangle(e) {
    finalX = e.clientX;
    finalY = e.clientY;
    //Debug Code
    //console.log(finalX);
    //console.log(finalY);
}

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
