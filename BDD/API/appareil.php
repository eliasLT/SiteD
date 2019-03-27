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
        $idU = $_POST['idU'];
        $nom = $_POST['nom'];

        $bdd = Connexion::getMySQLConnexion();

        if(isset($_POST['session_key'])){
            $session_key = $_POST["sessionkey"];
            $donnees = getSessionKeyFromID($idU);
            if($donnees == false){
                $err = getNewError(402, "User not Found");
                echo json_encode($err);
                die();
            }
            $bdd_session = $donnees['iduser'];
            if( $bdd_session != $session_key){
                $response  = array();
                $response['status'] = 'error';
                $response['code'] = 402;
                $response['message'] = "Wrong session key";

                echo json_encode($response);
                die();
            }
        }else {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            //// requete pour vérifier les mots de passe
            $donnees = getUser($bdd, $username);
            if($donnees == false){
                $response  = array();
                $response['status'] = 'error';
                $response['code'] = 402;
                $response['message'] = "User does not exist";

                echo json_encode($response);
                die();
            }
            $bdd_mdp = $donnees['mdp']; 
            if( $bdd_mdp != $password){
                $response  = array();
                $response['status'] = 'error';
                $response['code'] = 402;
                $response['message'] = "Le mot de passe n'est pas correct";

                echo json_encode($response);
                die();
            }
        }

        
        //// la fonction appareil ne marche pas 
        $requete  = appareil($bdd,$idA,$idU,$nom,$type,$datenregistrement);
        //// vérifie que tout s'est bien passé
        $response = getNewSuccess(200, "User created");
        //// ajouter le Content-Type : application/json
        echo json_encode($response);
        break;


        

        
        /**
         * Cette partie est inutile car déjà fait dans la ligne 69
         */
        $response  = array();
        $response['status'] = 'success';
        $response['code'] = 200;
        $response['message'] = "l'ajout de l'appareil est fait";

        echo json_encode($response);
        break;
    case 'GET':
        echo 'GET request not done for now';
        break;

    case 'DELETE':
        echo 'DELETE request not done for now';
        $bdd = Connexion::getMySQLConnexion();

        break;
    default :
        echo 'request not Handled';
 }