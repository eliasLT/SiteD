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

                try{
                    $mongo = new MongoDB\Driver\Manager("mongodb://localhost:27017/Domotique");
                }catch(Exception $e){
                    die('Erreur : '.$e->getMessage());
                }
            }
            return $mongo;
        }

    }


?>