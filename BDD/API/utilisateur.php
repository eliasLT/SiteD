<?php
include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("./utils.php");

switch( $_SERVER['REQUEST_METHOD']){
    case 'POST':
        $var_Nom = $_POST["nom"];
        $var_Prenom = $_POST["prenom"];
        $var_Adresse = $_POST["adresse"];
        $var_Departement = $_POST["departement"];
        $var_mail = $_POST["mail"];
        $var_Telephone = $_POST["telephone"];
        $var_Username = $_POST["username"];
        $var_mdp = $_POST['password'];

        // if($var_mdp!=$_GET['cpassword'] || $var_mail != $_GET['cmail']){
        //     $err = getNewError(403, "Wrong confirmation");
        //     echo json_encode($err);
        //     die();
        // }

        if(passwordIsOK($var_mdp) != ' '){
            $err = getNewError(403, "Password not good");
            echo json_encode($err);
            die();
        }
        $bdd = Connexion::getMySQLConnexion();
        $user = getUserExists($bdd, $var_Username, $var_mail);
        if($user!=false){
            $err = getNewError(403, "User already exists");
            echo json_encode($err);
            die();
        }

        $var_mdp = md5($var_mdp);
        $var_Adresse = $bdd->quote($var_Adresse);

        $requete  = insertUser($bdd, $var_Nom,$var_Prenom,$var_Adresse ,$var_Departement,$var_mail,$var_Telephone,$var_Username,$var_mdp);
        $response = getNewSuccess(200, "User created");
        echo json_encode($response);
        break;
    case 'GET':
        echo 'GET request not done for now';
        /**
         * Lister les appareil d'un utilisateur
         */
        // si il est connecté, on récupère l'id et la clé de session.
                        // on fait une requete SQL pour vérifier que les infos sont bonnes
                // sinon, on vérifie qu'il a donné le password et le username
                        // on effectue la connexion dans le site nous même 

        // vérifier si l'utilisateur a le droit de voir son compte ou c'est l'admin
                // CAS 1) : Si il veut voir SES appareils 
                // CAS 2) : Si il s'agit d'un admin
                
                // SINON on renvoie un JSON avec getNewError avec msg : ",'a pas les droits pour supprimer le compte" et on termine exit()

        // on fait une requete SQL pour récupérer tous les appareils de l'utilisateur

        // et on renvoit tous ça en JSON

        break;

    case 'DELETE':

        /**
         *  vérifier que c une personne connecté
         */
                // si il est connecté, on récupère l'id et la clé de session.
                        // on fait une requete SQL pour vérifier que les infos sont bonnes
                // sinon, on vérifie qu'il a donné le password et le username
                        // on effectue la connexion dans le site nous même 

        
        // vérifier si l'utilisateur a le droit de supprimer son compte ou c'est l'admin
                // CAS 1) : Si il veut supprimer SON compte 
                // CAS 2) : Si il s'agit d'un admin
                
                // SINON on renvoie un JSON avec getNewError avec msg : ",'a pas les droits pour supprimer le compte" et on termine exit()


        // effectivement supprimer le compte
            // on récupère tous les appareils de l'utilisateur.
            // on supprime tous ces appareils de la BDD
            // on supprime toutes les factures de cet utilisateur
            // on supprime toutes les consommation de l'utilisateur
            // enfin on supprime l'utilisateur de la BDD
            // nota bene : regarder comment curl marche en PHP 


        //// $_DELETE je suis pas sur qu'il existe
        //// on a pas besoin de tous ces champs pour supprimer un utilisateur
        $var_Nom = $_DELETE["nom"];
        $var_Prenom = $_DELETE["prenom"];
        $var_Adresse = $_DELETE["adresse"];
        $var_Departement = $_DELETE["departement"];
        $var_mail = $_DELETE["mail"];
        $var_Telephone = $_DELETE["telephone"];
        $var_Username = $_DELETE["username"];
        $var_mdp = $_DELETE['password'];


        $bdd = Connexion::getMySQLConnexion();

        //// je comprends pas à quoi ça sert de faire ça 
        $var_mdp = md5($var_mdp);
        $var_Adresse = $bdd->quote($var_Adresse);

        //// on veut supprimer un utilisateur pas insert!!!!!!!
        //// à refaire ELIASSSSSSS
        $requete  = insertUser($bdd, $var_Nom,$var_Prenom,$var_Adresse ,$var_Departement,$var_mail,$var_Telephone,$var_Username,$var_mdp);
        $response = getNewError(204, "User not exist");
        echo json_encode($response);


        // une fois la réposne envoyé, on déconnecte l'utilisateur si on l'a connecté 

        break;
    default :
        $response = getNewError(204, "Request not handled");
        echo json_encode($response);
} 