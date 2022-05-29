<?php

session_start();


if(!isset($_SESSION['username']))
{
    // Vai alla login
    header("Location: http://localhost/hw1/php/login.php");
    exit;
}


$connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
$id= mysqli_real_escape_string($connessione, $_POST['preferiti']); 
$username=$_SESSION['username'];

 
$query="SELECT * FROM PREFERITO WHERE idOpera = '$id' and username ='$username'";
$res=mysqli_query($connessione,$query);

if(mysqli_num_rows($res) != 0)
{
    $risultato = array('preferito' =>true); 
     echo json_encode($risultato); 
}

else
{
    $risultato = array('preferito' =>false); 
    echo json_encode($risultato); 
    //query inserimento mi piace 
    $query = "INSERT INTO PREFERITO VALUES (0, '$id', '$username')";
    $insert=mysqli_query($connessione,$query);
}



?>