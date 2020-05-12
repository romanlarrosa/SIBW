<?php
    
    include include("bd.php"); 
    
    $palabras = getPalabras();

    echo json_encode($palabras);
    # echo var_dump($palabras);
    
    
?>