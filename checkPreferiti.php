<?php

session_start();

$connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
$username=$_SESSION['username'];

$query = "SELECT * FROM PREFERITO WHERE username='$username'"; 
$res = mysqli_query($connessione, $query); 

$dati = array(); 

while($entry = mysqli_fetch_assoc($res))
    {
        $dati[] = array
                    (
                        'id'=>$entry['id'], 
                        'idOpera'=>$entry['idOpera'],
                        'username'=>$entry['username']
                    );
    }           
    echo json_encode($dati);

?>