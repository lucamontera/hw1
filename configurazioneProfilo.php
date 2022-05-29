<?php 
    session_start(); 


    if(!isset($_SESSION['username']))
    {
        // Vai alla login
        header("Location: http://localhost/hw1/php/login.php");
        exit;
    }
   

    if(isset($_POST["submit"]))
    { 
             
            // Get file info 
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes))
            { 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image)); 
                
                // Insert image content into database 
                $username=$_SESSION['username'];
                $connessione = mysqli_connect("localhost","root","","homework") or die("Errore: " .mysqli_connect_error($connessione)); 
                $descrizione = mysqli_real_escape_string($connessione, $_POST['descrizione']);
                
                $query="UPDATE CREDENZIALI set immagineProfilo ='$imgContent' WHERE username='$username'";
                $insert=mysqli_query($connessione,$query);
                
                $query2="UPDATE CREDENZIALI set descrizione ='$descrizione' WHERE username='$username'";
                $insert2=mysqli_query($connessione,$query2);


                if($insert)
                { 
                    $status = 'success'; 
                    $statusMsg = "File uploaded successfully.";
                    header("Location: http://localhost/hw1/php/homePageLogin.php");
                    mysqli_free_result($res);
                    mysqli_close($conn);
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
    <link rel="stylesheet" href="http://localhost/hw1/css/configurazioneProfilo.css?v=<?php echo time();?>">
    <script src="http://localhost/hw1/js/configurazioneProfilo.js?v=<?php echo time(); ?>" defer></script>
    <title>Riepilogo Profilo</title>
</head>
<body>


<nav>
        <div class='info-user'>
        
        <img src="" alt="" class='picture-profile'>
        <a href="http://localhost/hw1/php/profiloUtente.php" class='username'><?php echo $_SESSION["username"]?></a></div>
        
        <div>
            <a href="http://localhost/hw1/php/caricaOpera.php">Home</a>
            <a href="http://localhost/hw1/php/caricaOpera.php">Carica Opera</a>
            <a href="http://localhost/hw1/php/mhw1.php">Curiosità</a>
        </div>
        
        
        
        <a href="http://localhost/hw1/php/logout.php">Logout</a>
    </nav>

<main>

<div  class='intro'>
    <div class='ciao'>
        <h1>Ciao: <span class='color'><?php echo $_SESSION["username"] ?></span></h1>
        <p>Completa il tuo profilo!</p> 
        <span class='color'><?php echo $statusMsg ?></span>  
    </div>

    <img src="" class='hidden' id='anteprima'>    

    
</div>

    <form action="configurazioneProfilo.php" name="form_dati_configurazione" method="POST" enctype="multipart/form-data" id='form'>

    <label>Carica un'immagine del profilo
        <input type="file" name="image" id="input_picture" onchange="anteprimaImmagine(event)" >
    </label>


    <label>Racconta qualcosa di te:</label>
    <input type="text" name="descrizione" id="input_descrizione" class='descrizione'>
    

    <div class='submit'>
        <label>&nbsp<input type="submit" name="submit" value='Upload' class='button_submit'></label>
        <span class='hidden_submit'></span>
    </div> 

    </form>
</main>


    
</body>
</html>