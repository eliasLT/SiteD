<?php
global $mysql;
global $mongo;

    class Connexion{
        
        
        public static function getMySQLConnexion(){
            global $mysql;
            if($mysql == NULL){
                $mysql = new PDO('mysql:host=localhost;dbname=domotique', 'root', '');
            }

            return $mysql;
        }

        public static function getMongoConnexion(){
            global $mongo;
            if($mongo == NULL){
                // $m = new  MongoClient();
                // $mongo = $m->Domotique->conso;

                try{
                    $m = new  MongoClient();
                    $mongo = $m->Domotique->conso;
                    // $conso = (new MongoDB\Client)->Domotique->conso;
                }catch(Exception $e){
                    die('Erreur : '.$e->getMessage());
                }
            }
            return $mongo;
        }

    }


?>