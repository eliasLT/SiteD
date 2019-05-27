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
    $insertUser_SQL = "INSERT INTO users (nom,prenom,adresse,departement,mail,telephone,username,mdp,date_ins) VALUES (?,?,?,?,?,?,?,?,DATE_FORMAT(NOW(),'%Y%m%d%H%i%s'))";
    
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
        $req->execute(array($id));
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
    global $insertAppareil_SQL ;
    $insertAppareil_SQL = "INSERT INTO appareils(IDusers, nom, enregistrement) VALUES (?,?,DATE_FORMAT(NOW(),'%Y%m%d%H%i%s'))";
    function insertAppareil($conne,$idU,$nom){
        global $insertAppareil_SQL;
        $req = $conne->prepare($insertAppareil_SQL);
        $req->execute(array($idU,$nom));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $deleteAppareilOfUserFromId_SQL;
    $deleteAppareilOfUserFromId_SQL = "DELETE FROM appareils WHERE IDappareil=? AND IDusers=?";

    function deleteAppareilOfUserFromId($bdd, $idU, $idA){
        global $deleteAppareilOfUserFromId_SQL;
        $req = $bdd->prepare($deleteAppareilOfUserFromId_SQL);
        $req->execute(array($idA,$idU));
        $donnees = $req->fetch();
        return $donnees;
    }



    global $insertConnexion_SQL;
    $insertConnexion_SQL = "INSERT INTO connexion (iduser , dateC, sessionkey) VALUES (?,DATE_FORMAT(NOW(),'%Y%m%d%H%i%s'),?)";
    function insertConnexion($conne,$iduser,$sessionkey){
        global $insertConnexion_SQL;
        $req = $conne->prepare($insertConnexion_SQL);
        $req->execute(array($iduser,$sessionkey));
        $donnees = $req->fetch();
        return $donnees;
        
    }

    global $deconnexion_SQL;
    $deconnexion_SQL ="DELETE FROM connexion WHERE iduser= ?";
    function deconnexion($conne,$iduser){
        global $deconnexion_SQL;
        $req = $conne->prepare($deconnexion_SQL);
        $req->execute(array($iduser));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $checkAdmin_SQL;
    $checkAdmin_SQL="SELECT * FROM `domotique_admin` WHERE idUser=?";
    function checkIfAdmin($bdd, $id){
        global $checkAdmin_SQL;
        $req = $bdd->prepare($checkAdmin_SQL);
        $req->execute(array($id));
        $donnees = $req->fetch();
        return $donnees;
       
    }

    function deleteAllFactureOfUser($bdd,$id){
        return false;
    }


    global $getAppareilsFromUsersId_SQL;
    $getAppareilsFromUsersId_SQL = "SELECT * FROM appareils WHERE IDusers=?";
    function getAppareilsFromUsersId($bdd, $id){
        global $getAppareilsFromUsersId_SQL;
        $req = $bdd->prepare($getAppareilsFromUsersId_SQL);
        $req->execute(array($id));
        // $donnees = $req->fetch();
        $toSend = array();;
        while(($donnees = $req->fetch()) != false){
            
            unset($donnees[0]);
            unset($donnees[1]);
            unset($donnees[2]);
            unset($donnees[3]);
            $toSend[] = $donnees;
        }


        return $toSend;
    }


    global $deleteAllAppareilOfUser_SQL;
    $deleteAllAppareilOfUser_SQL = "DELETE FROM appareils WHERE IDusers=?";
    function deleteAllAppareilOfUser($bdd, $id){
        global $deleteAllAppareilOfUser_SQL;
        $req = $bdd->prepare($deleteAllAppareilOfUser_SQL);
        $req->execute(array($id));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $deleteUserFromId_SQL;
    $deleteUserFromId_SQL = "DELETE FROM users WHERE ID=?";
    function deleteUserFromId($bdd, $id){
        global $deleteUserFromId_SQL;
        $req = $bdd->prepare($deleteUserFromId_SQL);
        $req->execute(array($id));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $insertAdmin_SQL;
    $insertAdmin_SQL = "INSERT INTO domotique_admin (idUser) VALUES (?)";
    function insertAdmin($bdd, $idUser){
        global $insertAdmin_SQL;
        $req = $bdd->prepare($insertAdmin_SQL);
        $req->execute(array($idUser));
        $donnees = $req->fetch();
        return $donnees;
    }
    global $checkAdminSessionKey_SQL;
    $checkAdminSessionKey_SQL = "SELECT idAdmin, session_key, dateC FROM admin_connexion WHERE idAdmin=? AND session_key=?";
    function checkAdminSessionKey($bdd, $var_idAdmin, $var_sessionkey){
        global $checkAdminSessionKey_SQL;
        $req = $bdd->prepare($checkAdminSessionKey_SQL);
        $req->execute(array($var_idAdmin,$var_sessionkey));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $deleteAdminConnexion_SQL;
    $deleteAdminConnexion_SQL="DELETE FROM `admin_connexion` WHERE idAdmin=? AND session_key=?";
    function deleteAdminConnexion($bdd,$var_idAdmin,$var_sessionkey){
        global $deleteAdminConnexion_SQL;
        $req = $bdd->prepare($deleteAdminConnexion_SQL);
        $req->execute(array($var_idAdmin,$var_sessionkey));
        $donnees = $req->fetch();
        return $donnees;
    }

    global $inserConnexionAdmin_SQL;
    $inserConnexionAdmin_SQL = "INSERT INTO admin_connexion(idAdmin, session_key, dateC) VALUES (?,?,DATE_FORMAT(NOW(),'%Y%m%d%H%i%s'))";
    function inserConnexionAdmin($bdd,$var_idAdmin,$var_sessionkey){
        global $inserConnexionAdmin_SQL;
        $req = $bdd->prepare($inserConnexionAdmin_SQL);
        $req->execute(array($var_idAdmin,$var_sessionkey));
        $donnees = $req->fetch();
        return $donnees;

    }

   
    
    global $deleteAdmin_SQL;
    $deleteAdmin_SQL="DELETE FROM `domotique_admin` WHERE idUser=?";
    function deleteAdmin($bdd,$var_idUser){
        global $deleteAdmin_SQL;
        $req = $bdd->prepare($deleteAdmin_SQL);
        $req->execute(array($var_idUser));
        $donnees = $req->fetch();
        return $donnees;

    }
   
?>