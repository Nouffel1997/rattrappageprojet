window.onload = function () {


    canvas = document.all[17];
    carre = document.all[16];

    canvas.setAttribute("draggable", true);
    canvas.setAttribute("ondragstart", "start(event)");
    carre.setAttribute("ondragover", "move(event)");
    carre.setAttribute("ondrop", "drop(event)");

    canvas.style.position = "relative";

    heightposition = canvas.getBoundingClientRect(); // renvoie la taille d'un element et sa position relative 

};

function move(test) {
    test.preventDefault();
}

function drop(test) {

    var x = test.clientX;
    var y = test.clientY;

    resX = x - heightposition.left - dx;
    resY = y - heightposition.top - dy;

    canvas.style.top = resY + "px";
    canvas.style.left = resX + "px";

    coordonne(resX, resY);
}

function start(test) {



    var heightposition1 = canvas.getBoundingClientRect();

    var x = test.clientX; //action x de la souris    
    var y = test.clientY; //action y de la souris 

    dx = x - heightposition1.left; // action de la souris - la taille de gauche 
    dy = y - heightposition1.top; //action de la souris - la taille d'en haut
}



function coordonne(x, y) {
    document.all[18].innerHTML =
        "Nouvelles coordonnées => {x:" + x + "px" + ", y:" + y + "px" + "}";
}


