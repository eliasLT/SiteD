function Carte(nom, idU, idA, dateD, dateF, conso){
    this.nom = nom;
    this.idU = idU;
    this.idA = idA;
    this.dateD= dateD;
    this.dateD= dateD;
    this.dateF= dateF;
    this.conso=conso;

    this.toHTML = function (){
        var res = "<div class='ui card'>"
        res+= "<div class='content'>"
        res+= "<div class='header'>"+this.nom+"</div>"
        res+= "<div class='description'>consomation : " + this.conso + "<div>"
        res+= "</div>"
        res+= "</div>"

        var parser = new DOMParser(); // lit une string et la transforme en HTML
        var doc = parser.parseFromString(res, "text/html"); // la fonction de transformation

        return doc.querySelector("div.card");
    }
}