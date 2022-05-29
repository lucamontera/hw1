<?php

    session_start(); 

    if(isset($_SESSION["username"]))
    {
        header('Location: http://localhost/hw1/php/homePageLogin.php'); 
        exit; 
    }

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error());
        
        $username = mysqli_real_escape_string($connessione, $_POST['username']); 
        $password = mysqli_real_escape_string($connessione, $_POST['password']);

        $query = "SELECT * FROM CREDENZIALI where username = '".$username."' and password = '".$password."'";
        $res = mysqli_query($connessione,$query); 

        if(mysqli_num_rows($res) > 0)
        {

            echo "ok"; 

            $_SESSION["username"]=$_POST["username"]; 
            header("Location: http://localhost/hw1/php/homePageLogin.php");
            mysqli_free_result($res);
            mysqli_close($conn);
            
            exit;
        }
      
        else
        {
            $errore = true; 
        }
    }

    else
    {
        $error = "Username o password errati";
    }
    


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/hw1/css/login.css?v=<?php echo time(); ?>">
    <script src="http://localhost/hw1/js/login.js?v=<?php echo time(); ?>" defer></script>
    <title>Login</title>
</head>
<body>


<nav>
    <div id="menu">
        <div></div>
        <div></div>
        <div></div>
    </div>

</nav>


<main>

    <div class='login_info'>
        
        <a href="http://localhost/hw1/html/homePage.html">
            <h1 id="logo">  
                <span id="logo-decoration1">qua</span><span id="logo-decoration2">dra</span><span id="logo-decoration3">ndo</span>
            </h1>
        </a>

        <p>Scopri il mondo della creatività <br> digitale e metti in mostra la tua.</p>

        <img src="http://localhost/hw1/images/sfondo.jpg" alt="">
    
    </div>

    <div class='login_form'>
        <p>Accedi su quadrando</p>
        
    
        <form action="login.php" name="form_dati" method="POST">
            
            <label>Username:</label>
            
            <div class='text_username'>
                <input type="text" name="username" id="input_username">
                <p class='hidden_username'></p>
            </div>

            <label>Password:</label>
            <div class='text_password'>
                <input type="password" name="password" id="input_password">
                <p class='hidden_password'></p>
            </div>

            <div class='submit'>
                <label>&nbsp<input type="submit" name="submit" class='button_submit'></label>
            </div>

        </form>
        <a class='link_registrazione' href="http://localhost/hw1/php/registrazione.php">Registrati</a>
    </div>

    
</main>

<section id='modal-view-menu' class='hidden'></section>


</body>
</html>