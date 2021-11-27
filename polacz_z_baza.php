<?php

$db = // ustawienia zgodne z domyślną konfiguracją połączenia z bazą danych w programie XAMPP
[
      'host' => 'localhost',
      'port' => 3306,
      'user' => 'root',
      'pass' => '',
      'baza' => 'cms', // upewnij się, że wartość tej komórki zgodna jest z nazwą Twojej bazy danych
 'kodowanie' => 'utf8',
    'silnik' => 'InnoDB'
];



try
{

  $sql = new PDO( 'mysql:host='. $db['host'] .';port='. $db['port'] .';encoding='. $db['kodowanie'], $db['user'], $db['pass'] );
  $sql -> exec( 'use '. $db['baza'] );
  $sql -> exec( 'set storage_engine='. $db['silnik'] );
  $sql -> exec( 'set names '. $db['kodowanie'] );

}
catch ( PDOException $e )
{
    die( 'Błąd połączenia z bazą danych: '. $e->getMessage() );
}



unset($db);