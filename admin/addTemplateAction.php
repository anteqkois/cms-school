<?php

if( count( $_POST ) )
{
    require '../polacz_z_baza.php';

    // echo '<pre>';
    // print_r($_POST );
    //$array = json_decode(json_encode(json_decode($_POST['data'])), true);
    // print_r($array);

    $array = json_encode(json_decode($_POST['data']));
    echo ($sql->prepare('INSERT INTO `template` SET `nameOfTemplate`=?, `structureOfTemplate`=?, `template`=?')->execute([ $_POST['name'], $array, $_POST['template']])
    ? 'Szblon został utworzony<br>' : 'BŁĄD ! Nie utworzono szablonu<br>');

    $array = json_decode($array, true);

    $tableCells = join(', ', array_map( function($x) { return $x['nameField'] . ' TEXT'; }, $array ));
    $queryInsert = 'CREATE TABLE `'. $_POST['name'] .'` ( id INT AUTO_INCREMENT PRIMARY KEY, '. $tableCells .')';
    
    echo ($sql->prepare($queryInsert)->execute() ? 'Utworzono tabelę do szablonu' : 'BŁĄD ! Nie utworzono tabeli do szablonu');

}
?>
<a href="/cmsantek/admin">Wróc do panela admina</a>

<!-- INSERT INTO `testowy`(`body`, `main`) VALUES ('test','test') -->