<?php

require 'polacz_z_baza.php'; 

$q = $sql->prepare( 'SELECT * FROM `template` WHERE `nameOfTemplate`=? LIMIT 1' );

$q->execute( [ $_POST['name'] ] ); 

if( false === $w = $q->fetch( PDO::FETCH_ASSOC ) ){
  echo 'Nie ma takiej strony!';
  exit;
} 

// wygenerowanie kodu HTML szablonu podstrony z podstawieniem ustalonych zmiennych

// var_dump($w);
// echo '<pre>';
// print_r($w);
?>


<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title><?=htmlspecialchars($w['title'])?></title>
        <style>
            /* main, aside { display: inline-block; } */
            body { margin: 0; }
            /* main { width: 64%; }
            aside { width: 36%; }
            <?=$w['css']?> */
        </style>
    </head>
    <body>
        <main><?=$w['body']?></main>
        <!-- <aside><?=$w['aside']?></aside> -->
    </body>
</html>