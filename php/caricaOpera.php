<?php

    session_start(); 

    if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: http://localhost/hw1/php/login.php");
        exit;
    }
    $status = $statusMsg = ''; 
   if(isset($_POST['nome']) && isset($_POST['tema']) && isset($_FILES["image"]["picture-profile"]))
   {

   
        if(isset($_POST['submit'])) 
        {

                $fileName = basename($_FILES["picture-profile"]["name"]); 
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                
                // Allow certain file formats 
                $allowTypes = array('jpg','png','jpeg','gif'); 
                if(in_array($fileType, $allowTypes))
                { 
                    $image = $_FILES['picture-profile']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    
                    $username=$_SESSION['username'];
                    $connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
                    
                    $nome = mysqli_real_escape_string($connessione, $_POST['nome']);
                    $tema = mysqli_real_escape_string($connessione, $_POST['tema']);
                    $prezzo = mysqli_real_escape_string($connessione, $_POST['prezzo']);
                    $dimensioni = mysqli_real_escape_string($connessione, $_POST['dimensioni']);
                    $descrizione = mysqli_real_escape_string($connessione, $_POST['descrizione']);

                    $query = "INSERT INTO OPERA (idOpera, username, nome, tema, descrizione, prezzo, dimensioni, srcImmagine, likes)
                    VALUES(0,'$username', '$nome', '$tema', '$descrizione','$prezzo', '$dimensioni','$imgContent', 0)";

                    $res = mysqli_query($connessione,$query);

                    if($res)
                    { 
                        header("Location: http://localhost/hw1/php/homePageLogin.php");
                        mysqli_free_result($res);
                        mysqli_close($conn);
                    }
                
                } 

        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/hw1/css/caricaOpera.css?v=<?php echo time(); ?>">
    <script src="http://localhost/hw1/js/caricaOpera.js?v=<?php echo time(); ?>" defer></script>
    <title>Document</title>
</head>
<body>
    
<header>
    
    <nav>
        <div class='info-user'>
        
        <img src="" alt="" class='picture-profile'>
        <a href="http://localhost/hw1/php/profiloUtente.php" class='username'><?php echo $_SESSION["username"]?></a></div>
        
        <div>
            <a href="http://localhost/hw1/php/homePageLogin.php">Home</a>
            <a href="http://localhost/hw1/php/mhw3.php">Curiosità</a>
        </div>
        
        
        
        <a href="http://localhost/hw1/php/logout.php">Logout</a>

        <div id="menu">
                <div></div>
                <div></div>
                <div></div>
        </div>
    </nav>

</header>
<main>
    
    <p class='intro'>Carica un' <span id="logo-decoration1">op</span><span id="logo-decoration2">e</span><span id="logo-decoration3">ra</span>
    <br>per farla apprezzare online o per metterla in vendita!</p>

    <form action="caricaOpera.php" name="form_dati_opera" method="POST" enctype='multipart/form-data'>
            
        <div class='align_name'>
            <span class='nome_style'>
                <label>Nome:</label>   
                <input type="text" name="nome" id="input_nome"> 
            </span>

            <span class='cognome_style'>
                <label>Tema:</label>
                    <input type="text" name="tema" id="input_tema">
                </div>
            </span>
            
        </div>

        <div class='align_name'>
            <span class='nome_style'>
                <label>Prezzo:</label>   
                <input type="number" name="prezzo" id="input_prezzo"> 
            </span>

            <span class='cognome_style'>
                <label>Dimensioni</label>
                    <input type="text" name="dimensioni" id="input_dimensioni">
                </div>
            </span>
            
        </div>


        <div class='align_name'>
            <span class='nome_style'>
                <label>Carica l'immagine della tua opera:
                    <input type="file" name="picture-profile" id="input_picture" onchange="anteprimaImmagine(event)">
                </label>
            </span>

        <span class='cognome_style'>
            <label>Descrizione:</label>
            <input type="text" name="descrizione" id="input_descrizione">
        </span>
        
        
        </div>
        
        <div class='submit'>
            <label>&nbsp<input type="submit" name="submit" class='button_submit'></label>
        </div> 
        
    </form>
</main>

<section id='modal-view-menu' class='hidden'></section>

<footer>
        <h1>Web Programming HMW1</h1>
        <address>Università degli Studi di Catania</address>
        <p> Luca Montera ( Matricola: 1000007409 ) </p>
</footer>
</body>
</html>