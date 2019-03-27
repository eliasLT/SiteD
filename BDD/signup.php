<?php

require'functions.php'; 
$var_Nom = $_GET["nom"];
$var_Prenom = $_GET["prenom"];
$var_Adresse = $_GET["adresse"];
$var_Departement = $_GET["departement"];
$var_mail = $_GET["mail"];
$var_Telephone = $_GET["telephone"];
$var_Username = $_GET["username"];
$var_mdp = $_GET['password'];
if($var_mdp!=$_GET['cpassword'] || $var_mail != $_GET['cmail']){
    header('Location: ../error/error.php?er=confirmation');
    die();
}

//   : vérifier si les informations sont corrects
if(passwordIsOK($var_mdp) != ' '){
    header('Location: ../error/error.php?er=mdpPasBon');
    die();
}
//connexion a la base de donnéee
try
{
    $bdd = Connexion::getMySQLConnexion();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
///   : vérifier que le nom d'utilisateur n'existe pas
$req =$bdd->prepare("SELECT * FROM users WHERE username=? OR mail=?");
$req->execute(array($var_Username, $var_mail));
$donnees = $req->fetch();
if($donnees!=false){
    header('Location: ../error/error.php?er=utilisateurExiste');
    die();
}



///   : crypter le $var_mdp avec l'algo : MD5. et envoyer à la BDD le mot de passe crypté
echo '<p>'.$var_mdp . '</p>';
$var_mdp = md5($var_mdp);

$var_Adresse = $bdd->quote($var_Adresse);


$requete  = "INSERT INTO users (nom,prenom,adresse,departement,mail,telephone,username,mdp,date_ins) VALUES ('$var_Nom','$var_Prenom',$var_Adresse ,'$var_Departement','$var_mail','$var_Telephone','$var_Username','$var_mdp', CURDATE())";
echo $requete;

$bdd->exec($requete);

//die();
// INSERT INTO users (nom,prenom,adresse,departement,mail,telephone,username,mdp,date_ins) VALUES ('LEFFAD','Karim','41 ru adresse','75','leffadkarim97@live.fr','0102030405','Karrrr','eminem', CURDATE())


//   : Ajouter une redirection vers le dashbord si le compte est enregistré
header("Location: connexion.php?username=$var_Username&mdp=".$_GET['password']);
//   : Si le compte est mal enregistré, rediriger vers la page d'erreur
?>