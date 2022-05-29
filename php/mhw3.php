<?php

session_start();

if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: http://localhost/hw1/php/login.php");
        exit;
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/hw1/css/mhw3.css?v=<?php echo time(); ?>">
    <script src="http://localhost/hw1/js/mhw3.js?v=<?php echo time(); ?>" defer></script>
    <title>Quadrando Api</title>
</head>
<body>


<nav>
            <div class='info-user'>
            
                <img src="" alt="" class='picture-profile'>
                <a href="http://localhost/hw1/php/profiloUtente.php" class='username'><?php echo $_SESSION["username"]?></a></div>
                
                <div>
                    <a href="http://localhost/hw1/php/caricaOpera.php">Carica Opera</a>
                    <a href="http://localhost/hw1/php/homePageLogin.php">Home</a>
                </div>
                
                
                
                <a href="http://localhost/hw1/php/logout.php">Logout</a>
        
            </div>
    
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
    
    </nav>
 
    <header>

        

        <div id="check-api">
            <h1>Seleziona una scelta:</h1>
            <h3 class="showApi1">Crea un quadro</h3>
            <h3 class="showApi2">Scopri curiosità su artisti famosi</h3>
        </div>

        
        <div class="api1">
            
            <h1>Personalizza il tuo quadro!</h1>
            <p>Su quadrando hai la possibilità di creare un quadro. Inserisci l'argomento di un tema e lasciati ispirare</p>
            
            <form>
                <input type="text" id="tema">
                <input type="submit" id="submit" value='Cerca'>
            </form>
               
        </div> 

            
        <div class="api2">
            <h1>Scopri la storia di un artista</h1>
            <p>Scrivi il nome di un artista per scoprire la sua storia e tutte le opere che ha realizzato:</p>

            <form id="api2art">
                <input type="text" id="nome_artista">
                <input type="submit" id="submit" value='Cerca'>
            </form>
        </div>
          
    </header>
        

    <section id="sezione2"></section>
        
    <section id="risultato"></section>

    <section id="risultatoWikipedia"></section>

    <section id="risultato_api3"></section>

    <section id='modal-view-menu' class='hidden'></section>
    
    <footer>
        <h1>Web Programming HMW1</h1>
        <address>Università degli Studi di Catania</address>
        <p> Luca Montera ( Matricola: 1000007409 ) </p>
    </footer>

</body>
</html>