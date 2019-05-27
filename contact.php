<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--    <link rel="stylesheet" href="static/semanticUI/semantic.min.css">-->
    <link rel="stylesheet" href="static/css/style.css">
    <link rel="stylesheet" href="static/css/contact.css">
    <link rel="stylesheet" href="static/css/inscription.css">
</head>
<body>
<?php include("./composants/header.php"); ?>

<h3>Contact Form</h3>

<div class="container">
    <form action="">
        <label for="fname">Prénom</label>
        <input type="text" id="fname" name="firstname" placeholder="Prénom..">

        <label for="lname">Nom</label>
        <input type="text" id="lname" name="lastname" placeholder="Nom..">



        <label for="subject">Sujet</label>
        <textarea id="subject" name="subject" placeholder="Nouveau message.." style="height:200px"></textarea>

        <input type="submit" value="Envoyer">
    </form>
</div>

</body>
</html>
    <?php
    include("/composants/footer.php"); ?>
  

    
</body>
</html>