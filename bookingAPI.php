<?php
    require_once(__DIR__ . "\logs/log.php");
    require_once(__DIR__ . "\database.php");
    global $basicUrl;
    $basicUrl = "https://dispatchapi-sandbox.taxi.booking.com/v1/bookings";
    checkToken(3500);

    /*****************************************CORE FUNCTION API*/
    function checkToken($timeoutToken){
        if (!isset($_SESSION['TokenAPI'])){
            logMess("First Session token check it in db or fetch", $GLOBALS['logAPIfilepath']);
            //first check if token in db is enought recent
            $result = selectToken();
            $row = $result->fetch_assoc();
            $tokenCreation = strtotime($row['datetime']);
            if($tokenCreation + $timeoutToken < time()) {
                logMess("Refetch token", $GLOBALS['logAPIfilepath']);
                //token expired refetch
                $token = fetchToken();
                $_SESSION['TokenAPI'] = $token;
                $_SESSION['TokenAPI_timeout'] = time();
                updateToken($token);
            }else{
                logMess("Token still valid", $GLOBALS['logAPIfilepath']);
                $_SESSION['TokenAPI'] = $row['token'];
                $_SESSION['TokenAPI_timeout'] = $tokenCreation;
            }
        }else if($_SESSION['TokenAPI_timeout'] + $timeoutToken < time()){
            logMess("Session token expired refetch it", $GLOBALS['logAPIfilepath']);
            //token expired refetch
            $token = fetchToken();
            $_SESSION['TokenAPI'] = $token;
            $_SESSION['TokenAPI_timeout'] = time();
            updateToken($token);
        }
    }

    function fetchToken(){
        $curlSES = curl_init();
        curl_setopt($curlSES, CURLOPT_USERPWD, "6s0fqbhiij42o68j5palk1r6fh" . ":" . "8cka2482ksbe36nq9ffe63n62mrb4boup0jslesaskg6cqa1lne");
        curl_setopt($curlSES, CURLOPT_POST, true);
        curl_setopt($curlSES, CURLOPT_URL, 'https://auth.dispatchapi-sandbox.taxi.booking.com/oauth2/token?grant_type=client_credentials');
        curl_setopt($curlSES, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlSES, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

        //EXECUTE
        $curl_response = curl_exec($curlSES);
        if($curl_response !== false){
            $curl_response = json_decode($curl_response, TRUE);
            $curl_response = $curl_response["access_token"];
            logMess("Fetched token: ".$curl_response, $GLOBALS['logAPIfilepath']);
        }else{
            //leggere bene errori!!!!!!!!!!!!!!!!!!!!!!!!! il message error o success
            $curl_response = "******** ERROR: ". curl_error($curlSES)." - ERROR CODE: ".curl_errno($curlSES);
            logMess($curl_response, $GLOBALS['logAPIfilepath']);
        }
        curl_close($curlSES);
        return $curl_response;
    }

    //Core function to call API GET, POST and PUT
    function callApi($type, $service_url, $data, $header){
        logMess("callAPI - Type: $type - Url: $service_url - Data: $data", $GLOBALS['logAPIfilepath']);
        $curlSES = curl_init();
        if($type = "GET"){
            curl_setopt($curlSES, CURLOPT_URL, $service_url);
            curl_setopt($curlSES, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlSES, CURLOPT_HTTPGET, true);
            curl_setopt($curlSES, CURLOPT_POST, false);
            curl_setopt($curlSES, CURLOPT_PUT, false);
            curl_setopt($curlSES, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curlSES, CURLOPT_CONNECTTIMEOUT,10);
            curl_setopt($curlSES, CURLOPT_TIMEOUT,30);
            curl_setopt($curlSES, CURLOPT_HTTPHEADER, $header);
        }elseif($type = "POST"){
            curl_setopt($curlSES, CURLOPT_URL, $service_url);
            curl_setopt($curlSES, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curlSES, CURLOPT_HTTPGET, false);
            curl_setopt($curlSES, CURLOPT_POST, true);
            curl_setopt($curlSES, CURLOPT_PUT, false);
            curl_setopt($curlSES, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curlSES, CURLOPT_CONNECTTIMEOUT,10);
            curl_setopt($curlSES, CURLOPT_TIMEOUT,30);
            curl_setopt($curlSES, CURLOPT_HEADER, true);
            curl_setopt($curlSES, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curlSES, CURLOPT_POSTFIELDS, $data); 
        }elseif($type = "PUT"){
            curl_setopt($curlSES, CURLOPT_URL, $service_url);
            curl_setopt($curlSES, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curlSES, CURLOPT_HTTPGET, false);
            curl_setopt($curlSES, CURLOPT_POST, false);
            curl_setopt($curlSES, CURLOPT_PUT, true);
            curl_setopt($curlSES, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curlSES, CURLOPT_CONNECTTIMEOUT,10);
            curl_setopt($curlSES, CURLOPT_TIMEOUT,30);
            curl_setopt($curlSES, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curlSES, CURLOPT_PUTTFIELDS, $data);
        }
        //EXECUTE
        $curl_response = curl_exec($curlSES);
        //AGGIUNGERE CONTROLLO DEL MESSAGE ERROR
        if($curl_response !== false){
            $curl_response = json_decode($curl_response);
            echo "Response: ";
            print_r($curl_response);
        }else{
            $curl_response = "******** ERROR Call API - Type: $type - Url: $service_url - Data: $data - error: ". curl_error($curlSES)." - error code: ".curl_errno($curlSES);
            logMess($curl_response, $GLOBALS['logAPIfilepath']);
        }
        curl_close($curlSES);
        return $curl_response;
    }

    /*****************************************POSSIBLE CALLS IMPLEMENTED IN THE WEBAPP*/
    //API RESPONSE DICTIONARY
    /*echo $json_objekat->links[0]->href;
    echo $json_objekat->links[0]->rel;
    echo $json_objekat->links[0]->type;
    echo $json_objekat->bookings[0]->links[0]->href;
    echo $json_objekat->bookings[0]->links[0]->rel;
    echo $json_objekat->bookings[0]->links[0]->type;
    echo $json_objekat->bookings[0]->reference;
    echo $json_objekat->bookings[0]->legId;
    echo $json_objekat->bookings[0]->status;
    echo $json_objekat->bookings[0]->price->amount;
    echo $json_objekat->bookings[0]->price->currency;
    echo $json_objekat->bookings[1]->reference;
    echo $json_objekat->bookings[1]->legId;
    echo $json_objekat->bookings[1]->status;
    */

    //Call API to GET booking. Possible status: NEW, PENDING_AMENDMENT, PENDING_CANCELLATION
    function getAPI($status){
        //Contact API for NEW status
        $service_url = $GLOBALS['basicUrl']."?status=$status&changed=True";//'http://quotes.rest/qod.json';
        $header = array(
            'Content-Type: application/json', 
            'Authorization: '.$_SESSION['TokenAPI']
        );
        $json_objekat = callApi("GET", $service_url, Null, $header);

        if(!is_string($json_objekat)){
            for($i = 0; $i < sizeof($json_objekat->bookings); $i++){
                echo $json_objekat->bookings[$i]->legId . " -- " . $json_objekat->bookings[$i]->reference . " -- " . $json_objekat->bookings[$i]->status . " -- " . $json_objekat->bookings[$i]->state_hash;
                echo "\r\n";
            } 
        }

        /*if(!is_string($json_objekat)){
            require_once('database.php');
            if($status == "NEW"){
                require_once('database.php');
                $result = selectBookingsByStatus($status);
                if($result->num_rows > 0){
                    //Insert only the one not present in the DB
                    $arrayResult = array();
                    while ($row = $result->fetch_assoc()) {
                        $arrayResult[] = $row["booking_id"];
                    }
                    $result->free();
                    for($i = 0; $i < sizeof($json_objekat->bookings); $i++){
                        $key = array_search($json_objekat->bookings[$i]->legId, $arrayResult);
                        if($key === false){
                            echo $json_objekat->bookings[$i]->legId;
                            insertBooking($json_objekat->bookings[$i]->legId, $status);
                        }
                    }
                }else{
                    //insert All
                    for($i = 0; $i < sizeof($json_objekat->bookings); $i++){
                        insertBooking($json_objekat->bookings[$i]->legId, $status);
                    }
                }
            }elseif($status == "PENDING_AMENDMENT" || $status == "PENDING_CANCELLATION"){
                for($i = 0; $i < sizeof($json_objekat->bookings); $i++){
                    updateBookingPending($status, $json_objekat->bookings[$i]->legId);
                }
            }
        }*/
    }

    //POST ACCEPT/REJECT: valid when status is NEW(acc/rej), ACCEPTED(rej), DRIVER_ASSIGNED(rej), PENDING_AMENDEMENT(acc/rej), PENDING_CANCELLATION(acc)
    function postAPI($hash, $response, $reason){
        /*Perform a GET request to get the latest version of the booking before attempting to POST the response FOR THE HASH. */
        $legId = "10101010";
        $reference = "10000005";
        $service_url = $GLOBALS['basicUrl']."/".$reference."/".$legId."/responses";
        
        /*$access_key = "6s0fqbhiij42o68j5palk1r6fh";
        $signed_headers = 'content-type;host;x-amz-date;x-amz-security-token';;
        $autorization = $algorithm . ' ' . 'Credential=' . $access_key . '/' . $credential_scope . ', ' .  'SignedHeaders=' . $signed_headers . ', ' . 'Signature=' . $signature;
        $header = array(
            "Content-Type: application/json", 
            "Authorization: ". $autorization,
            "Date: " . time()
        );*/

        $data = [ "properties" => [
            "state_hash" => ["type" => "string", "examples" => [$hash]],
            "supplierResponse" => ["type" => "string", "enum" => [$response]],
            "cancellationReason" => ["type" => "string", "enum" => [$reason]]
            ]
        ];
        $data = json_encode($data);
        $json_objekat = callApi("POST", $service_url, $data, $header);
        if(!is_string($json_objekat)){
            echo "OK";
            //updateBooking($newStatus, $id_booking, $currentStatus);
        }else{
            /*Show error to user */
            echo "NO OK";
        }
    }

    //PUT DRIVER
    function putAPI($statusUpdate, $id_booking, $driver){
        $service_url = $GLOBALS['basicUrl']."/".$row["reference"]."/".$row["legId"]."/driver";
        $data = [ "properties" => [
            "state_hash" => ["type" => "string", "examples" => [""]],
            "supplierResponse" => ["type" => "string", "enum" => [""]],
            "cancellationReason" => ["type" => "string", "enum" => [""]]
            ]
        ];
        $data = json_encode($data);
        $json_objekat = callApi("PUT", $service_url, $data);
        if(!is_string($json_objekat)){
            updateBooking($statusUpdate, $id_booking, NULL);
        }else{
            /*Show error to user */
        }
    }

?>

