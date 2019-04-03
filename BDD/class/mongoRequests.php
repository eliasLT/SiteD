<?php

/**
 * Tu mets ici toutes tes requetes en mongoDBs
 */

 function deleteAllConsoOfUser($id){
     return false;
 }



 function insertConsommation($collection, $idUser, $idAppareil, $conso, $date){
    $data = array(
                "idUser" => $idUser,
                "idAppareil" => $idAppareil,
                "date" => $date,
                "conso" => $conso  
            );
            $collection->insert($data);
 }