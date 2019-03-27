<?php

    global $getUser_SQL ;
    $getUser_SQL = "SELECT id,mdp FROM users WHERE username=?";

    function getUser($conn, $username){
        global $getUser_SQL;
        $req = $conn->prepare($getUser_SQL);
        $req->execute(array($username));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $getUserExists_SQL;
    $getUserExists_SQL = "SELECT * FROM users WHERE username=? OR mail=?";
    function getUserExists($conn, $username, $mail){
        global $getUserExists_SQL;
        $req = $conn->prepare($getUserExists_SQL);
        $req->execute(array($username, $mail));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $insertUser_SQL ;
    $insertUser_SQL = "INSERT INTO users (nom,prenom,adresse,departement,mail,telephone,username,mdp,date_ins) VALUES (?,?,?,?,?,?,?,?, CURDATE())";
    
    function insertUser($conn, $var_Nom,$var_Prenom,$var_Adresse ,$var_Departement,$var_mail,$var_Telephone,$var_Username,$var_mdp){
        global $insertUser_SQL ;
        $req = $conn->prepare($insertUser_SQL);
        $req->execute(array($var_Nom,$var_Prenom,$var_Adresse ,$var_Departement,$var_mail,$var_Telephone,$var_Username,$var_mdp));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $getConnexion_SQL;
    $getConnexion_SQL = "SELECT * FROM connexion WHERE iduser=?";
    function getConnexion($conne,$id ,$mdp){
        global $getConnexion_SQL;
        $req = $conne->prepare($getConnexion_SQL);
        $req->execute(array($id,$mdp));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $getSessionKeyFromID_SQL;
    // à refaire
    $getSessionKeyFromID_SQL = "SELECT sessionkey FROM connexion WHERE iduser=?";
    function getSessionKeyFromID($conne, $id){
        global $getSessionKeyFromID_SQL;
        $req = $conne->prepare($getSessionKeyFromID_SQL);
        $req->execute(array($id));
        $donnees = $req->fetch();
        return $donnees;
    }

    //// la requete vérifie qu'elle marche
    global $getAppareil_SQL ;
    $getAppareil = "INSERT INTO appareils(IDappareil, IDusers, nom, enregistrement) VALUES (?,?,?,CURDATE())";
    function apprareils($conne,$idA,$idU,$nom,$type,$datenregistrement){
        global $getAppareil_SQL;
        $req = $conne->prepare($getAppareil_SQL);
        $req->execute(array($idA,$idU,$nom,$type,$datenregistrement));
        $donnees = $req->fetch();
        return $donnees;
        
    }

    global $insertConnexion_SQL;
    $insertConnexion_SQL = "INSERT INTO connexion (iduser , dateC, sessionkey) VALUES (?,CURDATE(),?)";
    function insertConnexion($conne,$iduser,$sessionkey){
        global $insertConnexion_SQL;
        $req = $conne->prepare($insertConnexion_SQL);
        $req->execute(array($iduser,$sessionkey));
        $donnees = $req->fetch();
        return $donnees;
        
    }
    global $deconnexion_SQL;
    $deconnexion_SQL ="DELETE FROM connexion WHERE iduser= ? , sessionkey=?";
    function deconnexion($conne,$iduser,$sessionkey){
        global $deconnexion_SQL;
        $req = $conne->prepare($deconnexion_SQL);
        $req->execute(array($iduser,$sessionkey));
        $donnees = $req->fetch();
        return $donnees;
    }
        
?>