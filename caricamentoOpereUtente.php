<?php 

session_start();

$connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
$username=$_SESSION['username'];

//$query = "SELECT o.*, c.immagineProfilo FROM OPERA o JOIN CREDENZIALI c on o.username=c.username WHERE o.username='$username'";
$query="SELECT * FROM OPERA JOIN CREDENZIALI ON OPERA.username=CREDENZIALI.USERNAME WHERE OPERA.username='$username'";
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
                        'commenti'=>$entry['commenti'],
                        'immagineProfilo'=>base64_encode($entry['immagineProfilo'])
                    );
    }           
    echo json_encode($dati);

?>