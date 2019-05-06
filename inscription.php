<html lang="fr">

<head>
    <meta charset="UTF-8">
    <!--    <link rel="stylesheet" href="static/semanticUI/semantic.min.css">-->
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/inscription.css">
</head>

<body>
<?php
$departement = array(
    00 => 'Département',
    75 => 'Paris',
    78 => 'Yvelines',
    92 => 'Hauts-de-Seine',
    94 => 'Val de Maarne',
    77 => 'Seine et Marne',
    93 => 'Seine Saint-Denis',
    91 => 'Essone',
    99 => 'Konoha'
);
?>


<?php include('./composants/header.php'); ?>
<form id="inscr" class="ui form" action="" method="post">
    <h4 class="titre-form">Créer votre compte</h4>
    <div class="field">
<!--        <label for="nom"> Nom : </label>-->
        <input id="nom" type="text" name="nom" placeholder="Nom">
<!--        <label for="prenom"> Prenom : </label>-->
        <input id="prenom" type="text" name="prenom" placeholder="Prénom">
<!--        <label for="mail"> Mail : </label>-->
        <input id="mail" type="text" name="mail" placeholder="mail">
        <input id="cmail" type="text" name="cmail" placeholder="Confirmer le mail">
<!--        <label for="username"> Username : </label>-->
        <input id="username" type="text" name="username" placeholder="Username">
<!--        <label for="password"> Mot de Passe : </label>-->
        <input id="password" type="password" name="password" placeholder="mot de passe">
        <input id="cpassword" type="password" name="cpassword" placeholder="Confirmer le mot de passe">
<!--        <label for="adresse"> Adresse : </label>-->
        <input id="adresse" type="text" name="adresse" placeholder="Adresse">
<!--        <label for="telephone"> Téléphone : </label>-->
        <input id="telephone" type="text" name="telephone" placeholder="Telephone">
<!--        <label for="departement"> Département : </label>-->
        <select id="departement" name="departement" class="ui fluid dropdown">

            <?php
            // print_r
            foreach($departement as $k => $v){
                echo "<option value='$k'>$k : $v</option>";
            }
            // mettre en place le département en php
            ?>
        </select>
        <!-- <div id='soumettre' class="ui button" tabindex="0">Créer le compte</div> -->
        <input type="submit" value="Créer le compte" id='soumettre'></input>

    </div>


</form>


<?php
include("/composants/footer.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
 <script src="static/js/inscription.js"></script>
</body>

</html>