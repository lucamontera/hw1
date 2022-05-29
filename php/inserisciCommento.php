<?php

echo "ci siamo";
    session_start(); 
    $error = array(); 
   if(!isset($_SESSION["username"]))
   {
       header('Location: http://localhost/hw1/php/login.php'); 
       exit; 
   }

   // verifica completezza dei campi

   if(!empty($_POST['commento']))
    {

        $connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
        $commento = mysqli_real_escape_string($connessione, $_POST['commento']);
        $username=$_SESSION['username']; 
        $idOpera = mysqli_real_escape_string($connessione, $_POST['idOpera']);      
          
        $query = "INSERT INTO COMMENTI VALUES (0, '$idOpera', '$username', '$commento')";
        $res = mysqli_query($connessione,$query);
        /*$query = "INSERT INTO CREDENZIALI (idUtente, nome, cognome, dataNascita, username, password, email, immagineProfilo,descrizione, numeroOpereCaricate, numeroPost)
        VALUES(0,'$nome' , '$cognome', '$data', '$username', '$password', '$email', null,null,0,0)";

        $res = mysqli_query($connessione,$query);*/

        if($res)
        {
            header("Location: http://localhost/hw1/php/HomePageLogin.php");
            mysqli_close($connessione); 
        }
    }
?>

    

    
