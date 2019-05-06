console.log("bonjour");

var form = document.getElementById("inscr");

function isMail(mail) {
        return true;
}

function isPassword(password) {
    return true;
}

form.addEventListener('submit', function(event){
    event.preventDefault();
    // console.log("un clique");

    var nomInput = document.getElementById("nom");
    var prenomInput = document.getElementById("prenom");
    var mailInput = document.getElementById("mail");
    var cmailInput = document.getElementById("cmail");
    var usernameInput = document.getElementById("username");
    var passwordInput = document.getElementById("password");
    var cpasswordInput = document.getElementById("cpassword");
    var adresseInput = document.getElementById("adresse");
    var telephoneInput = document.getElementById("telephone");
    var  departementInput = document.getElementById("departement");

    var excute = true;

    if( nomInput.value === ""){
        excute = false;
        nomInput.classList.add('wrong');
    }else{
        nomInput.classList.remove('wrong');
    }


    if( prenomInput.value === ""){
        excute = false;
        prenomInput.classList.add('wrong');
    }else{
        prenomInput.classList.remove('wrong');
    }


    if( mailInput.value === ""  ||  !isMail(mailInput.value) ){
        console.log(mailInput.value);
        console.log(!isMail(mailInput.value))
        excute = false;
        mailInput.classList.add('wrong');
    }else{
        mailInput.classList.remove('wrong');
    }
    if( cmailInput.value === ""  || mailInput.value !== cmailInput.value){
        excute = false;
        cmailInput.classList.add('wrong');
    }else{
        cmailInput.classList.remove('wrong');
    }

    if( usernameInput.value === ""){
        excute = false;
        usernameInput.classList.add('wrong');
    }else{
        usernameInput.classList.remove('wrong');
    }


    if( passwordInput.value === "" || ! isPassword(passwordInput)){
        excute = false;
        passwordInput.classList.add('wrong');
    }else{
        passwordInput.classList.remove('wrong');
    }
    if( cpasswordInput.value === ""  || passwordInput.value !== cpasswordInput.value){
        excute = false;
        cpasswordInput.classList.add('wrong');
    }else{
        cpasswordInput.classList.remove('wrong');
    }


    if( adresseInput.value === ""){
        excute = false;
        adresseInput.classList.add('wrong');
    }else{
        adresseInput.classList.remove('wrong');
    }

    if( telephoneInput.value === ""){
        excute = false;
        telephoneInput.classList.add('wrong');
    }else{
        telephoneInput.classList.remove('wrong');
    }

    // console.log(departementInput)
    if( departementInput.value === "0"){
        excute = false;
        departementInput.classList.add('wrong');
    }else{
        departementInput.classList.remove('wrong');
    }
    if(excute){
        // console.log("nom=" + nomInput.value+"&prenom=" + prenomInput.value +"&adresse="
        //     + adresseInput.value+"&departement=" + departementInput.value + "&mail="
        //     + mailInput.value+ "&telephone="+ telephoneInput.value+"&username="
        //     + usernameInput.value + "&password=" + passwordInput.value);

        $.ajax({
            url : " ./BDD/API/utilisateur.php",
            type : "POST",
            data : "nom=" + nomInput.value+"&prenom=" + prenomInput.value +"&adresse="
                + adresseInput.value+"&departement=" + departementInput.value + "&mail="
                + mailInput.value+ "&telephone="+ telephoneInput.value+"&username="
                + usernameInput.value + "&password=" + passwordInput.value,
            dataType : 'json',
            success: function(data, status){
                console.log(data);
                console.log(status);
            },
            error : function (status) {
                console.log(status)
            }
        })

    }
});

