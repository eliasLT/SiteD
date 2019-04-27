<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Domotique JF</title>
    <link rel="stylesheet" href="./static/semanticUI/semantic.min.css">
    <link rel="stylesheet" href="./static/css/style.css">
    <link rel="stylesheet" href="./static/css/background.css">  

    <!-- <link rel="stylesheet" href="static/css/index.css"> -->
</head>
<body>
    <?php include("/../header.php"); ?>
    <div class="main">
    La problématique industrielle : On veut pouvoir suivre et contrôler la consommation électrique d’un
appartement situé dans un immeuble, le tout, à distance …
Pour ce faire, chaque appartement doit être équipé d&#39;un matériel compteur d&#39;énergie électrique connecté sur
une voie série de type RS485 et interprétant les requêtes formulées suivant le protocole MODBUS et donc qui
peut être interrogé par l&#39;intermédiaire d&#39;une machine locale de type PC ou autre ...
L’immeuble, quant à lui, doit être équipé avec un contrôleur de type automate programmable de façon à
pouvoir commander individuellement chacune des charges électriques (chauffage, éclairage …) pour chaque
appartement
    </div>

    <?php include("/../footer.php"); ?>
</body>
</html>