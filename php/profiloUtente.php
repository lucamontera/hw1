<?php

session_start(); 

   if(!isset($_SESSION["username"]))
    {
        header('Location: http://localhost/hw1/php/login.php'); 
        exit; 
    }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/hw1/css/profiloUtente.css?v=<?php echo time(); ?>">
    <script src="http://localhost/hw1/js/profiloUtente.js?v=<?php echo time(); ?>" defer></script>


    <title>Document</title>
</head>
<body>
<header>
    
    

    
    <nav>
        <div class='info-user'>
        
        <img src="" alt="" class='picture-profile'>
        <a href="http://localhost/hw1/php/profiloUtente.php" class='username'><?php echo $_SESSION["username"]?></a></div>
        
        <div>
            <a href="http://localhost/hw1/php/caricaOpera.php">Home</a>
            <a href="http://localhost/hw1/php/caricaOpera.php">Carica Opera</a>
            <a href="http://localhost/hw1/php/configurazioneProfilo.php">Configura Profilo</a>
            <a href="http://localhost/hw1/php/mhw3.php">Curiosità</a>
        </div>
        
        
        
        <a href="http://localhost/hw1/php/logout.php">Logout</a>

        <div id="menu">
                <div></div>
                <div></div>
                <div></div>
        </div>
    </nav>





   <div class='username_content'>
        <h1 class='username2'></h1>
        <img src="" alt="" class='picture-profile-content'>
    </div>

   <div class='info'>
        <div class='info1'>
            <div class='info-align'>
                <h1 id='title'>Nome:
                    <h1 id='nome'></h1>
                </h1>
            </div>


            <div class='info-align'>
                <h1 id='title'>Cognome:
                    <h1 id='cognome'></h1>
                </h1>
            </div>
        </div>

        <div class='info1'>
            <div class='info-align'>
                <h1 id='title'>Opere caricate:
                    <h1 id='numeroOpereCaricate'></h1>
                </h1>
            </div>


            <div class='info-align'>
                <h1 id='title'>Email:
                    <h1 id='email'></h1>
                </h1>
            </div>
        </div>

        <div class='info1'>
            <div class='info-align-descrizione'>
                <h1 id='title'>Descrizione:
                    <h1 id='descrizione'></h1>
                </h1>
            </div>
        </div>


   </div>

</header>

<div class='hero-content'>
        <h2>Le tue Opere:</h2>
    </div>

<section class='works-content-utente'>
    
    <div class='general-work-utente'></div>

</section>

<section id='modal-view-menu' class='hidden'></section>


<footer>
        <h1>Web Programming HMW1</h1>
        <address>Università degli Studi di Catania</address>
        <p> Luca Montera ( Matricola: 1000007409 ) </p>
</footer>
</body>
</html>