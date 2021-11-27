<?php

if( count( $_POST ) )
{
    require '../polacz_z_baza.php';

    $url = $_POST['url'];
    unset($_POST['url']);
    // $callback = fn(string $k, string $v): string => "`$k`=`$v`";

    // $result = join(", ", array_map($callback, array_keys($_POST), array_values($_POST)));

    $result = join(", ", array_map(function($x) { return '`'.$x.'`'; }, $_POST));

    // echo '<pre>';
    print_r($_GET['template']);
    print_r($result);

    echo ($sql->prepare('INSERT INTO ? VALUES (?)')->execute([ $_GET['template'], $result])
    ? 'Podstrona została utworzona<br>' : 'BŁĄD ! Nie utworzono podstrony<br>');

    // echo ($sql->prepare('INSERT INTO `podstrony` SET `url`=?, `template`=?')->execute([ $url, $_GET['template']])
    // ? 'Podstrona została utworzona<br>' : 'BŁĄD ! Nie utworzono podstrony<br>');

}
?>
<a href="/admin">Wróc do panela admina</a>