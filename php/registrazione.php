<?php

     session_start(); 
    $error = array(); 
   if(isset($_SESSION["username"]))
   {
       header('Location: http://localhost/hw1/php/homePageLogin.php'); 
       exit; 
   }

   // verifica completezza dei campi

   if(!empty($_POST['nome']) && !empty($_POST['cognome']) && !empty($_POST['data']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']))
    {

        $connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione));
        $nome = mysqli_real_escape_string($connessione, $_POST['nome']); 
        $cognome = mysqli_real_escape_string($connessione, $_POST['cognome']);
        $username = mysqli_real_escape_string($connessione, $_POST['username']);
        $password=password_hash($password, PASSWORD_BCRYPT);


        // VERIFICA USERNAME 

        $query = "SELECT * FROM CREDENZIALI where username = '$username'";
        $res = mysqli_query($connessione,$query); 

        if(mysqli_num_rows($res) > 0)
        {
            echo "ok"; 
            print_r(mysqli_num_rows($res));
            $error[0]='username già in uso';
        }


        //verifica password

       if(strlen($_POST["password"]) <= 8)
        {
            $error[1] = "password corta";
        }

        if(strcmp($_POST["password"],$_POST["password2"]) !=0 )
        {
            $error[2] = "Le password inserite non corrispondono!";
        }

        //verifica email 

        $email = mysqli_real_escape_string($connessione, $_POST['email']);
        $query = "SELECT * FROM CREDENZIALI where email = '$email'";
        $res = mysqli_query($connessione,$query);

        if(mysqli_num_rows($res) > 0)
        {
            print_r(mysqli_num_rows($res));
            $error[3]='Email già in uso!';  
        }

        
        // inserimento dati nel database 
        if (count($error) == 0)
        {
            
            $query = "INSERT INTO CREDENZIALI (idUtente, nome, cognome, dataNascita, username, password, email, immagineProfilo,descrizione, numeroOpereCaricate, numeroPost)
            VALUES(0,'$nome' , '$cognome', '$data', '$username', '$password', '$email', null,null,0,0)";

            $res = mysqli_query($connessione,$query);

            if($res)
            {
                $_SESSION["username"]=$_POST['username']; 
                $_SESSION["sito_utente_id"]=mysqli_insert_id($connessione);
                header("Location: http://localhost/hw1/php/configurazioneProfilo.php");
                mysqli_close($connessione); 
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
    <link rel="stylesheet" href="http://localhost/hw1/css/registrazione.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="http://localhost/hw1/js/registrazione.js?v=<?php echo time(); ?>" defer></script>

    <title>Form Registrazione</title>
</head>
<body>

<nav>
            <div id="logo">
                <span id="logo-decoration1">qua</span><span id="logo-decoration2">dra</span><span id="logo-decoration3">ndo</span>
            </div>

            <div id="link-nav">
                <a href="http://localhost/hw1/html/homePage.html">Home</a>
                <a href="http://localhost/hw1/php/login.php">Login</a>
            
            </div>

            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>

</nav>

    <main>
    
    <p class='intro'>Sei un <span id="logo-decoration1">cre</span><span id="logo-decoration2">ati</span><span id="logo-decoration3">vo</span>? 
    <br> Registrati su quadrando per vendere e pubblicare le tue opere o per acquistare e lasciarti ispirare</p>

    <form action="registrazione.php" name="form_dati_registrazione" method="POST">
            
        <div class='align_name'>
            <span class='nome_style'>
                <label>Nome:</label>
                    <span></span>
                    <div class='text_nome'>
                        <input type="text" name="nome" id="input_nome">
                        <p class='hidden_username'></p>
                    </div>
            </span>

            <span class='cognome_style'>
                <label>Cognome:</label>
                <span></span>
                <div class='text_cognome'>
                    <input type="text" name="cognome" id="input_cognome">
                    <p class='hidden_password'></p>
                </div>
            </span>
            
        </div>
        
        <label>Data di nascita:
            <span></span>
            <div class='text_username'>
                <input type="text" name="data" id="input_data_nascita">
                <p class='hidden_username'></p>
            </div>
        </label>
            
            <label>Username: 
                <span></span>
                
                
                <div class='text_username'>
                    <input type="text" name="username" id="input_username">
                    <p class='hidden_username'></p>
                </div>
            </label>
            
            
            <div class='text_password'>
                <label>Password:</label>
                <span></span>
                <input type="password" name="password" id="input_password">
                <p class='hidden_password'></p>
            </div>

            

            <div class='text_password'>
                <label>Conferma Password:</label>
                <span></span>
                <input type="password" name="password2" id="input_password_confirm">
                <p class='hidden_password'></p>
            </div>

            <label>Email:
                <span></span>
                <div class='text_password'>
                    <input type="email" name="email" id="input_email">
                    <p class='hidden_password'></p>
                </div>
            </label>

    
            <div class='submit'>
                <label>&nbsp<input type="submit" name="submit" class='button_submit'></label>
                <span class='hidden_submit'></span>
            </div> 
        
        </form>
    </main>

    

</body>
</html>








