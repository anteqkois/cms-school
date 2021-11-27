<?php

if( count( $_GET ) )
{
    require '../polacz_z_baza.php';
    
    echo ($sql->prepare('DELETE FROM `template` WHERE nameOfTemplate=?')->execute(array($_GET['nameOfTemplate']))? 'Szblon usunięty!<br>' : 'BŁĄD ! Nie usunięto szablonu!<br>');
    echo ($sql->query('DROP TABLE `' . $_GET['nameOfTemplate'].'`')? 'Strony szablonu usunięte!<br>' : 'BŁĄD ! Nie usunięto stron szablonu!<br>');
    // $sql->query('DROP TABLE `' . $_GET['nameOfTemplate'].'`');
    // echo ($sql->prepare('DROP TABLE ?')->execute(array($_GET['nameOfTemplate']))? 'Strony szablonu usunięte!<br>' : 'BŁĄD ! Nie usunięto stron szablonu!<br>');
}
?>
<a href="/admin">Wróc do panela admina</a>
