<?php

session_start();

$connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
$username=$_SESSION['username'];
$id= mysqli_real_escape_string($connessione, $_POST['commenti']); 

$query="SELECT * FROM COMMENTI op JOIN CREDENZIALI cr on op.username=cr.username WHERE idOpera='$id' "; 
//$query = "SELECT * FROM COMMENTI WHERE idOpera='$id'"; 

$res = mysqli_query($connessione, $query); 

$dati = array(); 

while($entry = mysqli_fetch_assoc($res))
    {
        $dati[] = array
                    (
                        'id'=>$entry['id'], 
                        'idOpera'=>$entry['idOpera'],
                        'username'=>$entry['username'],
                        'commento'=>$entry['commento'],
                        'immagineProfilo'=>base64_encode($entry['immagineProfilo'])
                        
                    );
    }           
    echo json_encode($dati);

?>