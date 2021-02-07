<div class="header">
        <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="#"> Booking Manager NCC</a></h1>
                </div>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-2">
                <div class="logo">
                    <?php
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        if (!isset($_SESSION['CreationTime']) || $_SESSION['CreationTime']+ 10*60 < time()) {
                            session_destroy();
                            session_unset();
                            header('Location: page-login.php');
                            exit;
                        }else if (isset($_SESSION['session_id'])) {
                            $_SESSION['CreationTime'] = time();
                            $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
                            $session_id = htmlspecialchars($_SESSION['session_id']);
                            printf("<h5 style='color:white;'>Benvenuto %s</h5>", $session_user);
                        } else {
                            header('Location: page-login.php');
                            exit;
                        }
                    ?>
                </div>
            </div>
        </div>
        </div>
</div>

