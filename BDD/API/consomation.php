<?php

include("../functions.php");
include("../class/Connexion.php");
include("../class/requests.php");
include("./utils.php")
//TODO Gerer les requetes GET prendre tous les trucs en parametres (id nom prenom clee session ,idA )
//TODO recuperer les consomation instantanee dans mongodb et les facture dans mysql retourner en JSon

/***
 * Pour tes requuests mongoDB tu les mets dans le fichier mongoRequests.php
 * 
 * et pour la connexion MongoDB, on va faire ensemble le fichier class/Connexion.php
 */

case 'POST':
        $var_idU = $_POST["idU"];
        $var_idA = $_POST["idA"];
        $var_dateD = $_POST["dateD"];
        $var_dateF = $_POST["dateF"];
        $var_conso = $_POST["conso"];
      
       
        }

        //// les consommations c'est sur mongoDB 
        $bdd = Connexion::getMySQLConnexion();
        //// getUserExists c pas ça les parametres
        $user = getUserExists($bdd, $var_idU, $var_idA,$var_dateD,$var_dateF,$var_conso);
        // if($user!=false){
        //     $err = getNewError(403, "User already exists");
        //     echo json_encode($err);
        //     die();
        // } a continuer.

        //// Je comprends toujours pas pourquoi tu l'as fait
        $var_mdp = md5($var_mdp);
        $var_Adresse = $bdd->quote($var_Adresse);

        //// on veut ajouter une consommation en mongoDB pas insert un utilisateur
        $requete  = insertUser($bdd, $var_Nom,$var_Prenom,$var_Adresse ,$var_Departement,$var_mail,$var_Telephone,$var_Username,$var_mdp);
        $response = getNewSuccess(200, "User created");
        echo json_encode($response);
        break;
   case 'GET':
       echo 'GET request not done for now';
       break;

   case 'DELETE':

        // vérifier que c une personne connecté

        // vérifier si l'utilisateur a le droit de supprimer son compte ou c'est l'admin

        // effectivement supprimer le compte

        //// C'est du copier coller de utilisateur.php
       echo 'DELETE request not done for now';
       $var_Nom = $_DELETE["nom"];
       $var_Prenom = $_DELETE["prenom"];
       $var_Adresse = $_DELETE["adresse"];
       $var_Departement = $_DELETE["departement"];
       $var_mail = $_DELETE["mail"];
       $var_Telephone = $_DELETE["telephone"];
       $var_Username = $_DELETE["username"];
       $var_mdp = $_DELETE['password'];

       // if($var_mdp!=$_GET['cpassword'] || $var_mail != $_GET['cmail']){
       //     $err = getNewError(403, "Wrong confirmation");
       //     echo json_encode($err);
       //     die();
       // }

       $bdd = Connexion::getMySQLConnexion();

        $var_mdp = md5($var_mdp);
        $var_Adresse = $bdd->quote($var_Adresse);

       $requete  = insertUser($bdd, $var_Nom,$var_Prenom,$var_Adresse ,$var_Departement,$var_mail,$var_Telephone,$var_Username,$var_mdp);
       $response = getNewError(204, "User not exist");
       echo json_encode($response);

       break;
   default :
       echo 'request not Handled';
}


