<?php 

session_start();

$connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
$username=$_SESSION['username'];

$idOpera= mysqli_real_escape_string($connessione, $_POST['anteprima']); 

$query= "SELECT o.*, c.immagineProfilo
         FROM OPERA o JOIN CREDENZIALI c on o.username=c.username
         WHERE idOpera='$idOpera'"; 
$res = mysqli_query($connessione,$query); 

$dati = array(); 

while($entry = mysqli_fetch_assoc($res))
    {
        $dati[] = array
                    (

                        'idOpera'=>$entry["idOpera"], 
                        'username'=>$entry['username'],
                        'nome'=>$entry['nome'],
                        'tema'=>$entry['tema'],
                        'descrizione'=>$entry['descrizione'],
                        'prezzo'=>$entry['prezzo'],
                        'dimensioni'=>$entry['dimensioni'],
                        'immagineOpera'=>base64_encode($entry['srcImmagine']),
                        'likes'=>$entry['likes'],
                        'immagineProfilo'=>base64_encode($entry['immagineProfilo']),
                        'commenti'=>$entry['commenti']
                    );

    }  
    echo json_encode($dati);  
    
    
    
?>