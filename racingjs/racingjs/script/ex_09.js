window.onload = function () {
    var x = document.all;
    console.log(x);

    canvas = document.all[17];
    carre = document.all[16];

    canvas.setAttribute("draggable", true);
    canvas.setAttribute("ondragstart", "testou(event)");
    carre.setAttribute("ondragover", "test(event)");
    carre.setAttribute("ondrop", "testi(event)");
   
    canvas.style.position = "relative";

    no = canvas.getBoundingClientRect(); // renvoie la taille d'un element et sa position relative 
    
};

function test(test){
    test.preventDefault();
}

function testi(test) {

    test.preventDefault(); //si l'événement n'est pas traité sont ation de base ne sera pas prise en compte

    var e = test.dataTransfer.getData("text");

    var x = test.clientX;
    var y = test.clientY; 

    resX = x - no.left - dx;
    resY = y - no.top - dy;

    canvas.style.top = resY + "px";
    canvas.style.left = resX + "px";

    aziz(resX, resY);
}

function testou(test) {

    test.dataTransfer.setData("text", test.target.soucis); //defini les actions de dragdata 

    var no1 = canvas.getBoundingClientRect();// renvoie la taille d'un element et sa position relative 
    
    var x = test.clientX; //action x de la souris    
    var y = test.clientY; //action y de la souris 

    dx = x - no1.left; // action de la souris - la taille de gauche 
    dy = y - no1.top; //action de la souris - la taille d'en haut
}



function aziz(x, y){
    document.all[18].innerHTML = 
    "Nouvelles coordonnées => {x:" + x + "px" + ", y:" + y + "px" +"}";
}


