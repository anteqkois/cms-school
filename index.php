<?php

// ścieżka URL do głównego folderu, w którym umieściliśmy naszego CMS'a
$root = rtrim(trim(dirname($_SERVER['PHP_SELF']),'\\'),'/').'/';

// istotna reszta adresu URL względem głównego folderu CMS'a
$url = substr(rtrim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),strlen($root));

require 'polacz_z_baza.php'; // dołączenie skryptu tworzącego obiekt klasy PDO połączenia z bazą danych => $sql

// utworzenie szablonu zapytania o podstronę o żądanym adresie url
$q = $sql->prepare( 'SELECT * FROM `podstrony` WHERE `url`=? LIMIT 1' );
$q->execute( [ $url ] ); // wysłanie zapytania z bezpiecznym podpięciem adresu url
$resultFromPodstrony = $q->fetch( PDO::FETCH_ASSOC );


if($q->rowCount()){
    
    //Pobieranie szablonu html+PHP z tabeli template
    $q = $sql->prepare( 'SELECT `template` FROM `template` WHERE `nameOfTemplate`=?' );
    $q->execute( [ $resultFromPodstrony['template'] ] );
    $resultFromTemplate = $q->fetch( PDO::FETCH_ASSOC );
    
    //Pobieranie pól z tabeli odpowiedniego szablonu jaki został użyty (z prepare nie działa... nie można użyć '' a trzeba do zapytania do bazy)
    // $q = $sql->prepare( "SELECT * FROM ? WHERE `url`='?'" );
    // $q->execute( array( $resultFromPodstrony['template'], $url ) );
    // $resultFromFieldsTable = $q->fetch( PDO::FETCH_ASSOC );
    $q = $sql->query( "SELECT * FROM ". $resultFromPodstrony['template'] ." WHERE `url`='". $url ."'" );
    $fields = $q->fetch( PDO::FETCH_ASSOC );
    
}else{
    echo '<h1>Nie ma podstrony o podnaym adresie !</h1>';
    die();
}


// if( false === $w = $q->fetch( PDO::FETCH_ASSOC ) ) // w przypadku braku strony o żądanym adresie w bazie:
    //     $w = [ 'title' => 'Error!', 'body' => 'Nie ma takiej strony' ]; // nadpisanie odpowiedzi $w
    
    
    // echo '<pre>';
    // print_r($q->rowCount());
    // var_dump($resultFromPodstrony);
    
// var_dump($resultFromPodstrony['template']);
// var_dump($url);
// print_r($resultFromPodstrony['template']);
// print_r($url);

// echo $resultFromTemplate['template'];

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