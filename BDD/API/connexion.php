<?php

include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("./utils.php");


switch( $_SERVER['REQUEST_METHOD']){
    case 'POST':
        // on récupère le username de l'utilisateur et le password
        $username=$_POST['username'];
        $password=$_POST['password'];

        $bdd = Connexion::getMySQLConnexion();



        // on crypte le password avec md5
      
            $password = md5($password);

        // on récupère l'utilisateur de la BDD
            // si il n'existe pas, on renvoie un json d'erreur avec message
            $user = getUser($bdd, $username);
            if($user==false){
                $err = getNewError(403, "User does not exist");
                echo json_encode($err);
                die();
            }
           
        
        // on vérifie que le mot de passe est le bon 
            // si c'est pas bon on renvoie un json d'erreur avec message
        if($password != $user["mdp"]){
            var_dump($user);
            $err = getNewError(402,"error password");
            echo json_encode($err);
            die();
        }
        $id = $user['id'];
        $sessionkey = getSessionKey($id, $password);
         
        // on génère une cle session


        // on fait une request pour ajouter l'utilisateur à la table connexion
        $donnees = insertConnexion($bdd , $id ,$sessionkey);

        // on renvoie un json de success avec message, clé de session et id
        $res = getnewSuccess(200, "connection established");
        $res['sessionKey'] = $sessionkey;
        $res['id'] = $id;
        echo json_encode($res);

    break;
    case 'DELETE' :
        // on déconnecte un utilisateur
        // on récupère l'id de l'utilisateur et la clé de session
            // si y'a pas de clé de session on renvoie un json d'erreur avec message
            // $donnees = deconnexion($bdd , $id, $sessionkey);
            // $res
            var_dump($_GET);
        
        // on vérifie avec une request SQL que la clé de session est pour l'utilisateur
            // si c'est pas la bonne, on renvoie un json d'erreur avec message
        
        // on enlève la connexion dans la table connexion

        // et on renvoie un json success avec message 
    break;
    default : 
        $response = getNewError(204, "Request not handled");
        echo json_encode($response);

    }