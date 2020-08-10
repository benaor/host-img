<?php

    // if the form is submitted
    if (isset( $_FILES['image']) && $_FILES['image']['error'] === 0 ) {
        
        //initialize error
        $error = 1; 

        //If img size is inferior to 5Mo
        if ($_FILES['image']['size'] <= 5000000 ) {
            
            //stock info image in variable
            $infoImage = pathinfo($_FILES['image']['name']);

            //stock extension image in variable
            $extensionImage = $infoImage['extension']; 

            //Authorized Extension
            $extensionAuthorized = array('png', 'jpg', 'jpeg', 'gif');

            // If extension is authorized
            if( in_array($extensionImage, $extensionAuthorized) ){
                
                //Move image to uploads folder
                $pathImage = 'uploads/'.time().'.'.$extensionImage;
                move_uploaded_file($_FILES['image']['tmp_name'], $pathImage);
                
                //no error
                $error = 0;

            } 
        }
    }

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>image host</title>

    <!-- BOOTSTRAP CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>

    <!-- this is the header -->
    <header class="container-fluid bg-primary">
        <div class="container p-5 m-auto">
            <h1 class="text-white text-center"> Hebergeur d'image </h1>
        </div>
    </header>

    <!-- this is the form -->
    <div class="container mx-auto my-5">
        <form action="index.php" method="POST" class="mx-auto d-flex flex-column justify-content-center mb-5" enctype="multipart/form-data">
            <input type="file" name="image" class="m-auto text-center" required> <br>
            <button type="submit" class="text-center m-auto btn btn-lg btn-success mb-5">Heberger l'image</button>
        </form>

        <?php
            if (isset($error) && $error == 0 ) {
                
                //the image link
                echo '<div class="d-flex flex-column justify-content-center mt-5">
                    <p class="text-center"> Ton lien vers ton image : </p> 
                    <input type="text" value="http://localhost/php/host-pictures'.$pathImage.'" class="text-center col-6 m-auto">
                </div>';
            

                //Display the image
                echo '<p class="text-center mx-auto my-5"> <img src="'.$pathImage.'" alt="image telecharger" class="col-6"> </p>';
            } 
        ?>

    </div>
</body>

</html>
