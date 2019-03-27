<?php
include("./functions.php");
include("class/Connexion.php");
include("class/requests.php");
/*****
 * 	récupérer les données fournis par le formulaire $_GET et $_POST
 */
if(isset($_POST['username'])){
  $var_username = $_POST["username"];
}else{
  $var_username = $_GET["username"];
}
if($var_username==''){

  header('Location: http://localhost/SiteD/error/error.php?connexion=pasDeUsername');
}
if(isset($_POST['mdp'])){
  $var_mdp = $_POST["mdp"];
}else{
  $var_mdp = $_GET["mdp"];
}
$var_mdp = md5($var_mdp);




 /**
  * Connecter à la base de données, et récupérer l'utilisateur s'il existe
  * Select id, mdp from users where username='$var_username'
  */
$bdd = Connexion::getMySQLConnexion();

/**
 * Si l'utilisateur n'existe pas renvoyer une page d'erreur
 * Si l'utilisateur existe : crypter le mdp avec md5 et vérifier si c'est egal.
 * Si c'est pas egal : renvoyer une page d'erreur
 * si c'est egal : générer une clé de session
 */

$donnees = getUser($bdd, $var_username);
if ($donnees == false){
  header('Location: http://localhost/SiteD/error/error.php?connexion=pasEnregistre');
}
// var_dump($donnees);
$bdd_id  = $donnees['id'];
$bdd_mdp = $donnees['mdp']; 
// $req->closeCursor();


echo "user : $var_mdp  , BDD : $bdd_mdp";


if($var_mdp != $bdd_mdp){
  header('Location: http://localhost/SiteD/error/error.php?connexion=mauvaisMotdePasse');
  exit();
}
/**
  * Inserer la connection dans la table "connection" avec la clé de session l'id et la date 
  */

  //   vérifier si l'utilisateur n'est pas connecté
$bdd = Connexion::getMySQLConnexion();
$donnees=getConnexion($bdd , $var_username ,$var_mdp);

if($donnees==false){
  $session_key = getSessionKey($bdd_id, $bdd_mdp);
  $req = $bdd->exec("INSERT INTO connexion (iduser, dateC, sessionkey) VALUES ('$bdd_id', CURDATE(), '$session_key')");
}else{
  // recuperer la clé session
  $session_key=$donnees['sessionkey'];
}
  /**
   * Rediriger vers le dashbord
   */
 header("Location: ../dashboard/index.php?session=$session_key&id=$bdd_id");

?>