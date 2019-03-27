<?php   
    /**
     * $_SERVER est un tableau fourni par php 
     * c'est un tableau qui contient toute les valeurs relatifs au serveur.
     * REQUEST_URI contient l'URL demandée au serveur (expected : /SiteD/??????.php OR /siteD/)
     * $matches: 
     * [
     *   ["/siteD/?????.php, "/???????.php"], // $matches[0]
     *   ["siteD", "??????"] // $matches[1]
     * ]
     * "???????" = $matches[1][1]
     */
    preg_match_all('#\/([a-zA-Z]+)#', $_SERVER['REQUEST_URI'], $matches);   
    $menu = array(
        "index" =>"Accueil",
        "inscription" => "Inscription",
        "contact" => "Contact",
    );
?>

<header id="header" class='header'>

    <nav class='ui secondary pointing menu'>
        <?php 
            if(! isset($matches[1][1])){
                $matches[1][1] = "index";
            }
            foreach($menu as $k => $v){//
                $classes = $matches[1][1] != $k ? "item" : "item active";
                echo "<a class='$classes' href='$k.php'>$v</a>";
            }
        ?>
    
         
            <button id='connexion' class='ui button primary'>Espace Client</button>
        </div>
  </nav>
    
</header>

<script>
    document.getElementById('connexion').addEventListener('click', function popupwindow(event) {
        var ifrm = document.createElement('div');
        ifrm.setAttribute('id', 'ifrm'); // assign an id

        //document.body.appendChild(ifrm); // to place at end of document

        // to place before another page element
        var el = document.getElementById('header');
        el.parentNode.insertBefore(ifrm, el);

        var htmlParse = `<form id='azerty' action='./BDD/connexion.php' method='post' class='ui form'>
        <h4 class='ui dividing header'>Connexion : </h4>
        <div class='field'>
            <input type='text' name='username' placeholder='Login'>
        </div>
        <div class='field'>
            <input type='password' name='mdp' placeholder='Password'>
        </div>
        
    
        <input type="submit" value="Connexion" id='soumettre' class='ui button'></input>
    </form>`
        var parser = new DOMParser();
        var doc = parser.parseFromString(htmlParse, "text/html");

        // assign url
        ifrm.appendChild(doc.getElementById('azerty'))
        
    });
</script>

