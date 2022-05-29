<?php

    $connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
    $email = mysqli_real_escape_string($connessione, $_POST['checkEmail']); 

    $query = "SELECT email FROM CREDENZIALI WHERE email='$email'"; 
    $res = mysqli_query($connessione, $query); 

    if(mysqli_num_rows($res) > 0)
    {
        $risultato = array('email' =>false); 
        echo json_encode($risultato);  
    }

    else{
        
        $risultato = array('email' =>true); 
        echo json_encode($risultato);
    }
?>