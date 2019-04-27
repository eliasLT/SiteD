<?php
include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("../class/mongoRequests.php");
include("./utils.php");

switch( $_SERVER['REQUEST_METHOD']){
    case 'POST':
        /**
         * username et mdp
         */
        $bdd = Connexion::getMySQLConnexion();
        $var_username = $_POST["username"];
        $var_mdp = $_POST['password'];
        $user = getUser($bdd, $var_username);
        if($user==false){
            $err = getNewError(403, "User does not exist");
            echo json_encode($err);
            die();
        }
        $var_mdp = md5($var_mdp);
        if($var_mdp != $user["mdp"]){
            // var_dump($user);
            $err = getNewError(402,"error password");
            echo json_encode($err);
            die();
        }
        // var_dump($user);
        $id = $user['id'];
        $check=checkIfAdmin($bdd, $id);
        if($check == false){
            $err = getNewError(403, "Admin connected");
            echo json_encode($err);
            die();
        }

        // var_dump($check);
        

        $var_idAdmin = $check['idAdmin'];
        $sessionkey = getSessionKey("", "");
        $conne= inserConnexionAdmin($bdd,$var_idAdmin,$sessionkey);
        $response = getNewSuccess(200, "Admin added ");
        echo json_encode($response);

        
        break;
    case 'DELETE':
        $var_idAdmin= $_GET["idAdmin"];
        $var_sessionkey=$_GET["sessionkey"];
        $bdd = Connexion::getMySQLConnexion();
        $donnees = checkAdminSessionKey($bdd, $var_idAdmin, $var_sessionkey);
        if($donnees ==false){
            $res= getNewError(402,"Wrong session key for admin");
            echo json_encode($res);
            die();
        }

        $requetes = deleteAdminConnexion($bdd,$var_idAdmin,$var_sessionkey);

        $response  = getnewSuccess(200, "Admin disconnected");
        echo json_encode($response);
        break;
    default :
        $response = getNewError(204, "Request not handled");
        echo json_encode($response);
} 