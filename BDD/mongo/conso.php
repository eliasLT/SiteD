<?php


 $id = $_GET['idU'];

// // TODO
// // récupérer l'id de l'utilisateur connecté par $_GET et faire une requete mongoDB pour avoir seulement les consommation de l'appareil

try{
    $m = new  MongoClient();

    // $conso = (new MongoDB\Client)->Domotique->conso;
}catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$db = $m->Domotique;
$conso = $db->conso;



$results = $conso->find( array( "idU" => intval($id) ) );
$toJson = array();
foreach($results as $data){
    $toJson [] = $data;
}

echo json_encode($toJson);


// $data = array();
// for ($i = 0; $i < 50; $i++) { 
//     // echo $i;
//     $data = array(
         
//         "idU" => $i,
//         "idA" => $i,
//         "dateD" => "28/02",
//         "dateF" => "28/02",
//         "conso" => 12.3 * $i
        
//     );


//     $conso->insert($data);
// }

//     echo "document inserted successfully";
//     echo json_encode($data);
//     echo json_encode($conso);

?>