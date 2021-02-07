<?php
    
    require_once(__DIR__ . "\logs/log.php");

    /*****************************************AJAX QUERY (Action called using post argument; RESULT in JSON)*/
    //echo "dentro database";
    //echo $_POST['function'];
    //echo $_POST['params'];
    //$_POST['action'] = "getBookings";
    if(isset($_POST['action'])) {
        $action = $_POST['action'];
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        logMess("User ".$_SESSION['session_user'].", with id ".$_SESSION['session_user_id']." --- CALL AJAX to execute ".$action, $GLOBALS['logAJAXfilepath']);
        switch($action) {
            case 'getBookings': 
                require_once(__DIR__ . "\database.php");
                echo getBookings();
                break;
            case 'APIpostSinc': 
                require_once(__DIR__ . "\bookingAPI.php");
                APIpostSinc($_POST['id_booking'], $_POST['statusUpdate'], $_POST['currentStatus']);
                break;
            case 'APIputSinc': 
                require_once(__DIR__ . "\bookingAPI.php");
                APIputSinc();
                break;
            default:
                die('Access denied for this function AJAX!');
        }
    }

?>