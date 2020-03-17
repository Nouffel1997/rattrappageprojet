window.onload = function () {
    function Hero(nom, chose, intelligence, force) {
        this.nom = nom[0].toUpperCase() + nom.substr(1);
        this.chose = chose;
        this.intelligence = intelligence;
        this.force = force;
    }

    var mage = new Hero("amadeus", "mage", 10, 3);
    var guerrier = new Hero("pontius", "guerrier", 3, 10);
    mage.toString();
    guerrier.toString();

    Hero.prototype.toString = function () {
        return "Je suis " + this.nom + " le " + this.chose + ", j'ai " + this.intelligence + " points d'intelligence et " + this.force + " points de force !" + "</br>";

    }
    document.all[19].innerHTML = guerrier + mage;
};






