<?php

/**
 * Tu mets ici toutes tes requetes en mongoDBs
 */


global  $name;
$name = 'Domotique.conso';


 function deleteAllConsoOfUser($collection,$idUser){
     global $name;
     $data =array(
      "idUser" => $idUser
        );
     $bulk = new MongoDB\Driver\BulkWrite;
     $bulk->delete($data);
     $collection->executeBulkWrite($name, $bulk);
     return true;
 } 



 function insertConsommation($collection, $idUser, $idAppareil, $conso, $date){
    global $name;
     $data = array(
                "idUser" => $idUser,
                "idAppareil" => $idAppareil,
                "date" => $date,
                "conso" => $conso  
            );
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($data);
     $collection->executeBulkWrite($name, $bulk);
 }


 function deleteConsommation($collection, $idUser, $idAppareil){
     global $name;
     $data =array(
        "idUser" => $idUser,
        "idAppareil" => $idAppareil
     );
     $bulk = new MongoDB\Driver\BulkWrite;
     $bulk->delete($data);
     $collection->executeBulkWrite($name, $bulk);


 }

 function getConsommationOfAppareil($collection, $idUser, $idAppareil){
        global  $name;
     $data =array(
        "idUser" => $idUser,
        "idAppareil" => $idAppareil
     );

     $options = [
//                        'projection' => ['_id' => 0],
//                        'sort' => ['x' => -1],
                    ];
     $query = new MongoDB\Driver\Query($data, $options);
     $cursor = $collection->executeQuery($name, $query);

     $toReturn = array();
     foreach ($cursor as $item) {
         $toReturn[] = $item;
     }
    return $toReturn;
 }