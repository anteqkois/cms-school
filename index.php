<?php

// ścieżka URL do głównego folderu, w którym umieściliśmy naszego CMS'a
$root = rtrim(trim(dirname($_SERVER['PHP_SELF']),'\\'),'/').'/';

// istotna reszta adresu URL względem głównego folderu CMS'a
$url = substr(rtrim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),strlen($root));

require 'polacz_z_baza.php'; // dołączenie skryptu tworzącego obiekt klasy PDO połączenia z bazą danych => $sql

// utworzenie szablonu zapytania o podstronę o żądanym adresie url
$q = $sql->prepare( 'SELECT * FROM `podstrony` WHERE `url`=? LIMIT 1' );

$q->execute( [ $url ] ); // wysłanie zapytania z bezpiecznym podpięciem adresu url


// if( false === $w = $q->fetch( PDO::FETCH_ASSOC ) ) // w przypadku braku strony o żądanym adresie w bazie:
//     $w = [ 'title' => 'Error!', 'body' => 'Nie ma takiej strony' ]; // nadpisanie odpowiedzi $w

// wygenerowanie kodu HTML szablonu podstrony z podstawieniem ustalonych zmiennych

// var_dump($w);
// echo '<pre>';
// print_r($w);
?>

<!-- 
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
        <aside><?=$w['aside']?></aside>
    </body>
</html> -->