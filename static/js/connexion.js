function connect(username, password){
    console.log(username, password);


    $.ajax({
        url : " ./BDD/API/connexion.php",
        type : "POST",
        data : "username=" + username + "&password=" + password,
        dataType : 'json',
        success: function(data, status){
            // console.log(data);
            // console.log(status);
            if(data.status === "success"){
                window.location.replace("./dashboard/index.php?sessionkey="+data.sessionKey);
            }else{
                console.log(data);
            }
            // connect(usernameInput.value , passwordInput.value );
        },
        error : function (status) {
            console.log(status)
        }
    })
}

function addModalConnexion(){
    var modalHTML =
        '<div id="modal-to-remove" class="background-modal">' +
            '<i id="modal-icon-delete" class="icon-delete"></i>' +
            '<div class="modal-connexion">' +
                '<h4>Connexion</h4>' +
                '<form id="connect-form">' +
                    '<div class="field">'+
                        '<label for="form-username-connexion">Username :</label>'+
                        '<input id="form-username-connexion" type="text"/> ' +
                    '</div>'+
                    '<div class="field">'+
                        '<label for="form-password-connexion">Password :</label>'+
                        '<input id="form-password-connexion" type="password"/> ' +
                    '</div>'+
                    '<div class="field">' +
                        '<input class="button submit-btn" type="submit">' +
                    '</div>'+
                '</form>' +
            '</div>' +
        '</div>';
    var parser = new DOMParser();
    var Doc = parser.parseFromString(modalHTML, 'text/html');
    Doc.getElementById('modal-icon-delete').addEventListener('click', function (event) {

       removeModalConnexion();
    });

    Doc.getElementById('connect-form').addEventListener('submit', function (event) {
        event.preventDefault();
        var usernameInput = document.getElementById("form-username-connexion");
        var passwordInput = document.getElementById("form-password-connexion");
        var excute = true;

        if( usernameInput.value === ""){
            excute = false;
            usernameInput.classList.add('wrong');
        }else{
            usernameInput.classList.remove('wrong');
        }


        if( passwordInput.value === ""){
            excute = false;
            passwordInput.classList.add('wrong');
        }else{
            passwordInput.classList.remove('wrong');
        }
        if(excute){
            connect(usernameInput.value, passwordInput.value);
        }


    });
    var modal = Doc.getElementById('modal-to-remove');
    var body = document.getElementsByTagName('body')[0];
    body.appendChild(modal);
    // console.log(body);
}


function removeModalConnexion(){
    var modalToRemove = document.getElementById('modal-to-remove');
    if(modalToRemove !== undefined){
        var body = document.getElementsByTagName('body')[0];
        body.removeChild(modalToRemove);
    }
}



var connexionButton = document.getElementById('connexion-btn');
connexionButton.addEventListener('click', function (event) {
    addModalConnexion();
});