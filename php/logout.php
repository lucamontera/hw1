<?php 
        // Avvia la sessione
        session_start();
        // Elimina la sessione
        session_destroy();
        // Vai alla login
        header("Location: //localhost/hw1/php/login.php");
        exit; 
    

?>