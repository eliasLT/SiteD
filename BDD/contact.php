<?php


$var_mail=$_POST["Email"];
$var_text=$_POST["Texte"];

 $bdd = new PDO('mysql:host=localhost;dbname=domotique', 'root', '');

$bdd->exec("INSERT INTO contact(mail,text_text) VALUES('$var_mail','$var_text');



?>