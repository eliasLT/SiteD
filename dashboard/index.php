<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../static/semanticUI/semantic.min.css">
    <link rel="stylesheet" href="../static/css/dashboard/index.css">

</head>
<body>
<?php

    print_r($_GET['id']);
    echo "<p id='idU'>". $_GET['id'] . "</p>";

?>
    <h1>Ceci est le Dashboard</h1>
        
    <div id="clickme" >
    cliquez moi !!!
    </div>

    <form action="../BDD/deconnexion.php" method="get">
        <input type="text" name="sessionkey">
        <input type="submit">
    </form>


    <div id="main">
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="../static/js/dashboard/Carte.js"></script>
    <script src="../static/js/dashboard/index.js"></script>
</body>
</html>