<?php

    $connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
    $username = mysqli_real_escape_string($connessione, $_POST['checkUsername']); 

    $query = "SELECT username FROM CREDENZIALI WHERE username='$username'"; 
    $res = mysqli_query($connessione, $query); 

    if(mysqli_num_rows($res) > 0)
    {
        $risultato = array('Username' =>false); 
        echo json_encode($risultato);  
    }

    else{
        
        $risultato = array('Username' =>true); 
        echo json_encode($risultato);
    }
?>