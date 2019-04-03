<?php 

function getNewError($errorCode, $errorMessage){
    $response  = array();
    $response['status'] = 'error';
    $response['code'] = $errorCode;
    $response['message'] = $errorMessage;
    return $response;
}

function getnewSuccess($code, $msg){
    $response  = array();
    $response['status'] = 'success';
    $response['code'] = $code;
    $response['message'] = $msg;
    return $response;
}



/**
 * cette fonction termene le code affiche le code en json puis deconnecte si on la connecter precedemment
 * $resultAPI :  est utile lors de la deconnection
 */
function finishAndDisconnect($resultAPI, $res){
    echo json_encode($res);
    if(isset($_GET['username']) && isset($_GET['password']) ){
        $curl = curl_init();
        $params = "id=".$resultAPI['id']."&sessionkey=".$resultAPI['sessionKey']; 
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        // curl_setopt($curl, CURLOPT_POSTFIELDS, array( ));
        curl_setopt($curl, CURLOPT_URL, "http://localhost/SiteD/BDD/API/connexion.php?$params"); // a modifier plus tard
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);
    }


    die();
}