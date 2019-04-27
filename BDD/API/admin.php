<?php
include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("../class/mongoRequests.php");
include("./utils.php");

switch( $_SERVER['REQUEST_METHOD']){
    case 'POST':

            // récupérer l'id de l'admin qui ajoute l'user en admin
        // récupérer la clé de session de l'admin
        // récupérer l'id de l'user qui devient admin
        $var_idUser = $_POST["idUser"];
        $var_idAdmin= $_POST["idAdmin"];
        $var_sessionkey=$_POST["sessionkey"];
        $bdd = Connexion::getMySQLConnexion();


        
        
        

        // on vérifie que la clé de session est correct
        $donnees = checkAdminSessionKey($bdd, $var_idAdmin, $var_sessionkey);
        if($donnees ==false){
            $res= getNewError(402,"Wrong session key for admin");
            echo json_encode($res);
            die();
        }

        // on ajoute l'admin avec la requete SQL
        
        $requetes =insertAdmin($bdd, $idUser);
        $response = getNewSuccess(200, "Admin added ");
        echo json_encode($response);
        break;
    case 'DELETE':

        /**
         *  delete the admin
         * 
         */
       

        $var_idUser = $_POST["idUser"];
        $var_idAdmin= $_POST["idAdmin"];
        $var_sessionkey=$_POST["sessionkey"];
        $bdd = Connexion::getMySQLConnexion();
        $donnees = checkAdminSessionKey($bdd, $var_idAdmin, $var_sessionkey);
        if($donnees ==false){
            $res= getNewError(402,"Wrong session key for admin");
            echo json_encode($res);
            die();
        }

        $requetes = deleteAdmin($bdd,$var_idUser);

        $res = getnewSuccess(200, "Admin deleted");
        finishAndDisconnect($resultAPI, $res);

        // une fois la réposne envoyé, on déconnecte l'utilisateur si on l'a connecté 

        
        break;
    default :
        $response = getNewError(204, "Request not handled");
        echo json_encode($response);
} 