<?php 

session_start();

$connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
$username=$_SESSION['username'];
$query = "SELECT * FROM CREDENZIALI";
$res = mysqli_query($connessione,$query); 





$dati = array(); 

while($entry = mysqli_fetch_assoc($res))
    {
        $dati[] = array
                    (
                        'idUtente'=>$entry['idUtente'], 
                        'nome'=>$entry['nome'],
                        'cognome'=>$entry['cognome'],
                        'dataNascita'=>$entry['dataNascita'],
                        'username'=>$entry['username'],
                        'cognome'=>$entry['cognome'],
                        'email'=>$entry['email'],
                        'immagineProfilo'=>base64_encode($entry['immagineProfilo']),
                        'descrizione'=>$entry['descrizione'],
                        'numeroOpereCaricate'=>$entry['numeroOpereCaricate'],
                        'numeroPost'=>$entry['numeroPost']
                    );
    }           
    echo json_encode($dati);
        
?>
