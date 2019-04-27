<?php

/**
 * Tu mets ici toutes tes requetes en mongoDBs
 */

 function deleteAllConsoOfUser($collection,$idUser){
   $data =array(
      "idUser" => $idUser
      
   );
  $res = $collection->remove($data);
     return true;
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


 function deleteConsommation($collection, $idUser, $idAppareil){
     $data =array(
        "idUser" => $idUser,
        "idAppareil" => $idAppareil
     );
    $collection->remove($data);


 }

 function getConsommationOfAppareil($collection, $idUser, $idAppareil){
    $data =array(
        "idUser" => $idUser,
        "idAppareil" => $idAppareil
     );
    $res = $collection->find($data);
     $toReturn = array();
     while($res->hasNext()){
        //  var_dump($res->next());
        $toReturn[] = $res->next();
     }
    // var_dump(get_class_methods($res));
    return $toReturn;
 }