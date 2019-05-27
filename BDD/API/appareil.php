<?php
include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("./utils.php");
//TODO recuperer id appareil en en get
//TODO Gerer les requetes POST prendre tous les trucs en parametres (id nom prenom clee session ,idA )

/**
* Ajout d'un appareil
*/

switch( $_SERVER['REQUEST_METHOD']){
    case 'POST':
        /**
        * on peut optimiser le code 
        */

        
        $bdd = Connexion::getMySQLConnexion();
        
        if(isset($_POST['sessionkey'])){
            $session_key = $_POST["sessionkey"];
            $idU = $_POST['idU'];

            $donnees = getSessionKeyFromID($bdd,$idU);
            if($donnees == false){
                $err = getNewError(402, "User not Found");
                echo json_encode($err);
                die();
            }
            // var_dump($donnees);
            $bdd_session = $donnees['sessionkey'];
            if( $bdd_session != $session_key){
                $err = getNewError(402, "Wrong session key");
                echo json_encode($err);
                die();
            }
        }else {
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            
            //// requete pour vérifier les mots de passe
            $donnees = getUser($bdd, $username);
            if($donnees == false){
                $err = getNewError(402, "User does not exists");
                echo json_encode($err);
                die();
            }
            $bdd_mdp = $donnees['mdp']; 
            if( $bdd_mdp != $password){
                $err = getNewError(402, "Wrong password");
                echo json_encode($err);
                die();
            }
            $idU = $donnees['id'];
            // var_dump($donnees);
        }
        

        
        $nom = $_POST['nom'];


        //// la fonction appareil ne marche pas 
        $requete  = insertAppareil($bdd,$idU,$nom);
        //// vérifie que tout s'est bien passé
//        var_dump($requete);
        $app = getAppareilsFromUsersId($bdd, $idU);
        $idApp = $app[count($app)-1];

        $response = getnewSuccess(200, "Appareil added");
        $response['idAppareil'] = $idApp['IDappareil'];
        //// ajouter le Content-Type : application/json
        echo json_encode($response);
        break;
    case 'DELETE':
        $bdd = Connexion::getMySQLConnexion();
        // si il est connecté, on récupère l'id et la clé de session.
        // on fait une requete SQL pour vérifier que les infos sont bonnes
        // sinon, on vérifie qu'il a donné le password et le username
        // on effectue la connexion dans le site nous même 
        if(isset($_GET['id']) && isset($_GET['sessionkey']) ){
            $id=$_GET['id'];
            $sessionkey=$_GET['sessionkey'];
            $donnees = getConnexion($bdd, $id, "");
            if($donnees ==false){
                $res= getNewError(402,"Wrong session key");
                echo json_encode($res);
                die();
            }
        }else if(isset($_GET['username']) && isset($_GET['password']) ){
            $username = $_GET['username'];
            $password = $_GET['password'];
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, array( "username" => $username , "password" => $password));
            curl_setopt($curl, CURLOPT_URL, "http://localhost/SiteD/BDD/API/connexion.php"); // a modifier plus tard
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resultAPI = curl_exec($curl);
            curl_close($curl);
            $resultAPI = json_decode($resultAPI, true);
            if($resultAPI['status'] != 'success'){
                $res= getNewError(402,"wrong password/username");
                echo json_encode($res);
                die();
            }
            $id = $resultAPI['id'];
        }
        
        
        
        
        // vérifier si l'utilisateur a le droit de supprimer son compte ou c'est l'admin
        // CAS 1) : Si il veut supprimer SON compte 
        // CAS 2) : Si il s'agit d'un admin
        
        $userOfAppareilToDelete = $_GET['userToDelete'];
        $appareilToDelete = $_GET['toDelete'];
        $cando = checkIfAdmin($bdd, $id);
        if( ! $cando){
            // var_dump(array($id,  $userOfAppareilToDelete));
            $cando = ($id == $userOfAppareilToDelete);
        }
        if(!$cando){
            $res= getNewError(402,"User dont have permission");
            finishAndDisconnect($resultAPI, $res);
        }
        $res = deleteAppareilOfUserFromId($bdd, $userOfAppareilToDelete, $appareilToDelete);

        $res = getnewSuccess(200,"appareil deleted");
        finishAndDisconnect($resultAPI, $res);
    
        break;
    default :
    $response = getNewError(204, "Request not handled");
    echo json_encode($response);
}