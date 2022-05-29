<?php 

session_start();

$connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
$username=$_SESSION['username'];
$query="SELECT op.*, cr.immagineProfilo FROM OPERA op JOIN CREDENZIALI cr on op.username=cr.username"; 
$res = mysqli_query($connessione,$query); 

$dati = array(); 

while($entry = mysqli_fetch_assoc($res))
    {
        $dati[] = array
                    (
                        'idOpera'=>$entry['idOpera'], 
                        'username'=>$entry['username'],
                        'nome'=>$entry['nome'],
                        'tema'=>$entry['tema'],
                        'descrizione'=>$entry['descrizione'],
                        'prezzo'=>$entry['prezzo'],
                        'dimensioni'=>$entry['dimensioni'],
                        'srcImmagineOpera'=>base64_encode($entry['srcImmagine']),
                        'likes'=>$entry['likes'],
                        'immagineProfiloUtente'=>base64_encode($entry['immagineProfilo']),
                        'commenti'=>$entry['commenti']
                    );
    }           
    echo json_encode($dati);
 
?>
