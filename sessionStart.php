<?php
require_once(__DIR__ . '\databaseConfig.php');
require_once(__DIR__ . '\logs/log.php');
$config = getDbConfig();

try {
    $pdo = new PDO($config['db_engine'] . ":host=".$config['db_host'] . ";dbname=" . $config['db_name'], $config['db_user'], $config['db_password'], [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
        
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    //exit("Connesso al database: ".$config['db_host']);
} catch (PDOException $e) {
    exit("Impossibile connettersi al database: " . $e->getMessage());
}

/*if (isset($_SESSION['session_id'])) {
    $_SESSION['EXPIRES'] = time() + 3600;
    header('Location: index.php');
    exit;
}*/

if (isset($_POST['login'])) {
    //exit("dentro");
    $username =  '';
    $password =  '';
    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }
    if($_POST['password']){
        $password = $_POST['password'];
    }
    
    //printf($username, '<br/>');printf($password, '<br/>');
    
    $query = "
        SELECT user_name, password, id
        FROM users
        WHERE user_name = :username
    ";
    
    $check = $pdo->prepare($query);
    $check->bindParam(':username', $username, PDO::PARAM_STR);
    $check->execute();
    
    $user = $check->fetch(PDO::FETCH_ASSOC);
    
    //printf($user['password']);
    
    if (!$user || md5($password) != $user['password']) {
        $msg = 'Credenziali utente errate';
    } else {
        logMess("LogIn User: ".$user['user_name'].", with id: ".$user['id'], $GLOBALS['logLogInfilepath']);
        session_start();
        $_SESSION['session_id'] = session_id();
        $_SESSION['session_user'] = $user['user_name'];
        $_SESSION['session_user_id'] = $user['id'];
        $_SESSION['CreationTime'] = time();
        
        header('Location: index.php');
        exit;
    }

    echo "<script type='text/javascript'>
    if (window.confirm('$msg'))
        {
            window.location.replace('page-login.php')
        }
    </script>";

}

?>