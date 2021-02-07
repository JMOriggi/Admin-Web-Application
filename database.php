<?php
    
    /*****************************************CORE FUNCTION DB CONNECTION*/
    require_once(__DIR__ . "\logs/log.php");
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    function connect(){
        require_once(__DIR__ . "\databaseConfig.php");
        $config = getDbConfig();
        $mysqli = new mysqli($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);
        if (mysqli_connect_errno()) {
            $msg = "********* ERROR: Failed to connect to MySQL: " . mysqli_connect_errno();
            logMess($msg, $GLOBALS['logDBfilepath']);
            exit();
        }
        return $mysqli;
    }
    function disconnect($mysqli){
        $mysqli->close();
    }

    function executeQuery($query){
        $mysqli = connect();
        $result = $mysqli->query($query);
        if ($result !== false) {
            $txt = "--- Success: ".$query;
        } else {
            $txt = "********* ERROR: " . $query . " --- " . $mysqli->error;
        }
        logMess($txt, $GLOBALS['logDBfilepath']);
        disconnect($mysqli);
        return $result;
    }

    /*****************************************AJAX QUERY (Action called using post argument from JS; RESULT in JSON because otherwise JS cannot read it)*/
    function getBookings(){ 
        //&& isset($params['type']) && isset($params['id'])
        //Check se ho tutti i parameri di cui ho bisogno
        $session_user_id = $_SESSION['session_user_id'];
        if(isset($session_user_id) ) {
            $query = "SELECT description as title, date as start, id, status, canale FROM booking WHERE id_users = $session_user_id LIMIT 100";
            $result = executeQuery($query);
            if ($result !== false) {
                $json = array();
                while ($row = $result->fetch_assoc()) {
                    $json[] = $row;
                }
                header('Content-Type: application/json');
                //echo json_encode($json);
                return json_encode($json);
            }
            $result->free();
        }else{
            header('Content-Type: application/json');
            $json = array();
            $json["message"] = "Errore Parametri Mancanti";
            //echo json_encode($json);
            return json_encode($json);
        }
    }


    /*****************************************PHP QUERY (Result in OBJECT MySQL)*/
    /* Usare questo loop per leggere i risultati in oggeto mysql
        $arrayResult = array();
        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $arrayResult[] = $row;
            }
            return $arrayResult;
        }
        $result->free();
    */
    function selectToken(){
        $query = "SELECT * FROM token WHERE id = 1";
        $result = executeQuery($query);
        return $result;
    }
    function updateToken($token){
        $now = date("Y-m-d");
        $now = $now." ".date("H:i:s");
        $query = "UPDATE token SET token = '$token', datetime = '$now' WHERE id = 1 ";
        $result = executeQuery($query);
        return $result;
    }

    function selectBookingsCloseDate(){
        $session_user = htmlspecialchars($_SESSION['session_user_id'], ENT_QUOTES, 'UTF-8');
        $dateToday = date("Y-m-d");
        $dateTomorrow = date("Y-m-d", strtotime("tomorrow"));
        $query = "SELECT * FROM booking WHERE id_users = $session_user and (date = '$dateToday' or date = '$dateTomorrow')";
        $result = executeQuery($query);
        return $result;
    }

    function selectBookingsById($id){
        $session_user = htmlspecialchars($_SESSION['session_user_id'], ENT_QUOTES, 'UTF-8');
        $query = "SELECT * FROM booking WHERE id_users = $session_user and id = $id";
        $result = executeQuery($query);
        return $result;
    }

    function selectBookingsByStatus($status){
        $session_user = htmlspecialchars($_SESSION['session_user_id'], ENT_QUOTES, 'UTF-8');
        $query = "SELECT booking_id FROM booking WHERE id_users = $session_user and status = '$status'";
        $result = executeQuery($query);
        return $result;
    }

    function selectCountBookingsByStatus($status){
        $session_user = htmlspecialchars($_SESSION['session_user_id'], ENT_QUOTES, 'UTF-8');
        $query = "SELECT count(*) as number FROM booking WHERE id_users = $session_user and status = '$status'";
        $result = executeQuery($query);
        return $result;
    }

    function updateBooking($newStatus, $id, $currentStatus){
        if(isset($id)){
            $session_user = htmlspecialchars($_SESSION['session_user_id'], ENT_QUOTES, 'UTF-8');
            $query = "UPDATE booking SET ";
            if(isset($status)){
                $query = $query.", status = '$newStatus'";
            }
            if(isset($currentStatus)){
                $query = $query.", status_prec = '$currentStatus'";
            }
            $query = $query." WHERE id_users = $session_user and id = $id";
            $result = executeQuery($query);
        }
    }

    function updateBookingPending($status, $id){
        if(isset($status)){
            $session_user = htmlspecialchars($_SESSION['session_user_id'], ENT_QUOTES, 'UTF-8');
            //UPDATE only if it wasn't already in status PENDING_...
            $query = "UPDATE booking SET status = '$status', status_prec = (SELECT status Where id_users = $session_user and id = $id LIMIT 1) WHERE id_users = $session_user and id = $id and status != '$status' ";
            $result = executeQuery($query);
        }
    }

    function insertBooking($booking_id, $status){
        $session_user = htmlspecialchars($_SESSION['session_user_id'], ENT_QUOTES, 'UTF-8');
        $query = "INSERT INTO booking (id_users, status, booking_id) VALUES ($session_user, '$status', '$booking_id')";
        $result = executeQuery($query);
    }

?>