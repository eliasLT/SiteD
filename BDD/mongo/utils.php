<?php

// print_r($_GET); 
        try{
            $m = new MongoClient();
        }catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        
        $db = $m->Domotique;
        $conso = $db->conso;

        $results = $conso->find();
        echo "<p>";
        $toJson = array();
        foreach($results as $data){
            // var_dump($data);
            // echo json_encode($data);
            // echo "</p><p>";
            $toJson [] = $data;
        }
       
        echo json_encode($toJson);
        
        echo "</p>"; 
        // echo "Connection to database successfully";
        // print_r($m);
        // select a database
        // $db = $m->selectDB("Domotique");
        // print_r($db);
         
        // echo "Database mydb selected";

    ?>