<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/semanticUI/semantic.min.css">
    <link rel="stylesheet" href="static/css/style.css">
</head>

<body>
    <?php 
        $departement = array(
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

    
    <?php include('./header.php'); ?>
    <div class="main">
    <form class="ui form" action="./BDD/signup.php" method="get">
        <h4 class="ui dividing header">Créer votre compte</h4>
        <div class="field">
            <label>Nom</label>
            <div class="two fields">
                <div class="field">
                    <input type="text" name="nom" placeholder="Nom">
                </div>
                <div class="field">
                    <input type="text" name="prenom" placeholder="Prénom">
                </div>
            </div>
        </div>
        <div class="field">
            <input type="text" name="mail" placeholder="mail">
        </div>
        <div class="field">
            <input type="text" name="cmail" placeholder="Confirmer le mail">
        </div>
        <div class="field">
                    <input type="text" name="username" placeholder="Username">
                </div>
        <div class="field">
            <input type="password" name="password" placeholder="mot de passe">
        </div>
        <div class="field">
            <input type="password" name="cpassword" placeholder="Confirmer le mot de passe">
        </div>
        <div class="field">
            <label>Adresse</label>
            <div class="fields">
                <div class="twelve wide field">
                    <input type="text" name="adresse" placeholder="Adresse">
                </div>
                <div class="four wide field">
                    <input type="text" name="telephone" placeholder="Telephone">
                </div>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
                <label>Département</label>
                <select name="departement" class="ui fluid dropdown">
                    
                    <?php 
                        // print_r
                        foreach($departement as $k => $v){
                            echo "<option value='$k'>$k : $v</option>";
                        }
                    // mettre en place le département en php 
                    ?>
                </select>
            </div>
        </div>

        <!-- <div id='soumettre' class="ui button" tabindex="0">Créer le compte</div> -->
        <input type="submit" value="Créer le compte" id='soumettre' class="ui button"></input>
    </form>
    </div>
    
    <!-- <script src="static/js/inscription.js"></script> -->
</body>

</html>