<?php
    
    global $logDBfilepath;
    $logDBfilepath = 'logs/logsDatabase.txt';
    global $logAPIfilepath;
    $logAPIfilepath = 'logs/logsAPI.txt';
    global $logAJAXfilepath;
    $logAJAXfilepath = 'logs/logsAJAX.txt';
    global $logLogInfilepath;
    $logLogInfilepath = 'logs/logsLogIn.txt';

    function logMess($msg, $filePath){
        $date = new DateTime();
        $date = $date->format("y:m:d h:i:s");
        $msg = $date." ".$msg;
        file_put_contents($filePath, $msg.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

?>