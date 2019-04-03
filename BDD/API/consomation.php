<?php

include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("../class/mongoRequests.php");
include("./utils.php");
//TODO Gerer les requetes GET prendre tous les trucs en parametres (id nom prenom clee session ,idA )
//TODO recuperer les consomation instantanee dans mongodb et les facture dans mysql retourner en JSon

/***
 * Pour tes requuests mongoDB tu les mets dans le fichier mongoRequests.php
 * 
 * et pour la connexion MongoDB, on va faire ensemble le fichier class/Connexion.php
 */
switch( $_SERVER['REQUEST_METHOD']){
    case 'POST':
        $bdd = Connexion::getMySQLConnexion();
        // si il est connecté, on récupère l'id et la clé de session.
                        // on fait une requete SQL pour vérifier que les infos sont bonnes
                // sinon, on vérifie qu'il a donné le password et le username
                        // on effectue la connexion dans le site nous même 

        if(isset($_POST['id']) && isset($_POST['sessionkey']) ){
            $id=$_POST['id'];
            $sessionkey=$_POST['sessionkey'];
            $donnees = getConnexion($bdd, $id, "");
            if($donnees ==false){
                $res= getNewError(402,"Wrong session key");
                echo json_encode($res);
                die();
            }
        }else if(isset($_POST['username']) && isset($_POST['password']) ){
            $username = $_POST['username'];
            $password = $_POST['password'];
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

        // récuperer les donnees de la consomation $_POST
        $idAppareil = $_POST['idA'];
        $consommation = $_POST['conso'];
        $date = $_POST['date'];

        $mongo = Connexion::getMongoConnexion();
        // faire une requete pour ajouter la consommation Dans MONGOREQUEST
        insertConsommation($mongo, $id, $idAppareil, $consommation, $date);


        $res = getNewSuccess(200, "Consommation Added");
        finishAndDisconnect($resultAPI, $res);
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
       break;

    case 'DELETE':
    default :
        $response = getNewError(204, "Request not handled");
        echo json_encode($response);
  break;
  
   
}


