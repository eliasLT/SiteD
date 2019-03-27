console.log("bonjour");
const maFonction = function(event){//on ajoute un ecouteur d événement de clic à un élément 
    // console.log(event);
    var id = document.getElementById("idU").innerHTML;//on recupere id de l'utilisateur (le contenu de la div)
    // console.log(id.innerHTML);
    $.ajax({//Jquery on appelle la fonction ajax 
        url : "../BDD/mongo/conso.php",
        type : "GET",
        data : "idU=" + id,
        dataType : 'json',
        success: function(data, status){
            // console.log(data);
            
            var main = document.getElementById("main");
            // je vide la div main
            while (main.firstChild) {
                main.removeChild(main.firstChild);
            }
            
            for(var i = 0; i< data.length; i++){
                var card = new Carte("tele", data[i].idU, data[i].idA, data[i].dateD, data[i].dateF, data[i].conso);
                // console.log(card.toHTML());
                main.appendChild(card.toHTML());
            }
        }
    })
}

var cliqueme = document.getElementById('clickme');//on recupere le boutton avec id "clickme"
cliqueme.addEventListener('click', maFonction )


