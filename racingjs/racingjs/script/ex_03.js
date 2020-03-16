window.onload = function () {

    //var txt;
    document.body.childNodes[1].childNodes[1].childNodes[5].childNodes[1].addEventListener("click", function () {

        var person = prompt("Quel est votre nom ?");
        while (person == "" || person == null) {
            person = prompt("Veuillez entrer votre nom");
        }
        if (person !== null) {
            if (confirm("Etes vous sûr que " + person + " est votre nom ?")) {
                alert("Bonjour " + person + " !");
            document.body.childNodes[1].childNodes[1].childNodes[5].childNodes[1].innerHTML = "bonjour " + person + " !";

                console.log(person);
            }else{

            }
        }
    })
};

/*var person = prompt("Quel est votre nom ?");
while(person == null || person == "")
txt = prompt("Veuillez entrer votre nom");
if(person !== null || person !== "")
{
    break;
}*/