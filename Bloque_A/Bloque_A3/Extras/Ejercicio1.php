<?php 
    // Variables
    $numeros=4;

    // FUNCIONES
    function multiplicacion($numero1){
        for($i=1; $i<=10; $i++){
            echo $numero1 . "x" . $i . "=" . $numero1 * $i . "<br>";
        }
    }
        
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    multiplicacion($numeros);
    ?>
  
</body>
</html>