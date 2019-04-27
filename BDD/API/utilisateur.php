<?php
include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("../class/mongoRequests.php");
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
        /**
         * Lister les appareil d'un utilisateur
         */
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


        // vérifier si l'utilisateur a le droit de voir son compte ou c'est l'admin
                // CAS 1) : Si il veut voir SES appareils 
                // CAS 2) : Si il s'agit d'un admin
                
                // SINON on renvoie un JSON avec getNewError avec msg : 

        $userToGetAppareils = $_GET['toGet'];
        //   var_dump($_GET);
        $cando = checkIfAdmin($bdd, $id);
        if( ! $cando){
            $cando = ($id == $userToGetAppareils);
        }
        if(!$cando){
            $res= getNewError(402,"User dont have permission");
            finishAndDisconnect($resultAPI, $res);
        }
        // on fait une requete SQL pour récupérer tous les appareils de l'utilisateur
        /**
         * getAppareilsFromUsers : retourne un tableau indexé d'appareils
         */
        $user_s_appareils = getAppareilsFromUsersId($bdd, $userToGetAppareils);
        // echo json_encode($user_s_appareils);
        $res = getnewSuccess(200, "appareils returned");
        $res["appareils"] = $user_s_appareils;

        // var_dump($res);
        // et on renvoit tous ça en JSON
        finishAndDisconnect($resultAPI, $res);
        break;

    case 'DELETE':

        /**
         *  vérifier que c une personne connecté
         */
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
        
        $userToDelete = $_GET['toDelete'];
        $cando = checkIfAdmin($bdd, $id);
        if( ! $cando){
            $cando = ($id == $userToDelete);
        }
        if(!$cando){
            $res= getNewError(402,"User dont have permission");
            finishAndDisconnect($resultAPI, $res);
        }


        // effectivement supprimer le compte
            // on supprime tous ses appareils de la BDD
            $res = deleteAllAppareilOfUser($bdd, $userToDelete);
            // on supprime toutes les factures de cet utilisateur
            $res = deleteAllFactureOfUser($bdd, $userToDelete);

            // on supprime toutes les consommation de l'utilisateur
            $res = deleteAllConsoOfUser($userToDelete);

            // enfin on supprime l'utilisateur de la BDD
            $res = deleteUserFromId($bdd, $userToDelete);

            $res = getnewSuccess(200, "User deleted");
            finishAndDisconnect($resultAPI, $res);

        // une fois la réposne envoyé, on déconnecte l'utilisateur si on l'a connecté 

        
        break;
    default :
        $response = getNewError(204, "Request not handled");
        echo json_encode($response);
} 