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
                $m = new  MongoClient();
                $mongo = $m->Domotique->conso;
            }
            return $mongo;
        }

    }


?>