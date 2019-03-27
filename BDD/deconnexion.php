<?php
$session_key = $_GET["sessionkey"];

$bdd = new PDO('mysql:host=localhost;dbname=domotique', 'root', '');
$req = $bdd->prepare("DELETE FROM `connexion` WHERE  sessionkey=?");
$req->execute(array( $session_key));


header('Location : http://localhost/SiteD/');