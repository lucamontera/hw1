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
    <link rel="stylesheet" href="http://localhost/hw1/css/homePageLogin.css?v=<?php echo time(); ?>">
    <script src="http://localhost/hw1/js/homePageLogin.js?v=<?php echo time(); ?>" defer></script>

    <title>Homepage</title>
</head>
<body>


<header>
    
    <nav>
        <div class='info-user'>
        
        <img src="" alt="" class='picture-profile'>
        <a href="http://localhost/hw1/php/profiloUtente.php" class='username'><?php echo $_SESSION["username"]?></a></div>
        
        <div>
            <a href="http://localhost/hw1/php/caricaOpera.php">Carica Opera</a>
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

<h2 class='introduction'>Scopri le utlime opere caricate su quadrando</h2>

<p class='divisore'></p>
<section class='works-content-utente'>

<div class='general-work-utente'></div>

 <div class='commenti'></div>

</section>


<section id='modal-view' class='hidden' >

</section>

<section id='modal-view-menu' class='hidden'></section>

<footer>
        <h1>Web Programming HMW1</h1>
        <address>Università degli Studi di Catania</address>
        <p> Luca Montera ( Matricola: 1000007409 ) </p>
</footer>




</body>
</html>