<?php

if( count( $_POST ) )
{
    require '../polacz_z_baza.php';

    $url = $_POST['url'];
    // unset($_POST['url']);
    
    
    $keys = join(", ", array_map(function($x) { return '`'.$x.'`'; }, array_keys($_POST)));
    $values = join(", ", array_map(function($x) { return "'".$x."'"; }, array_values($_POST)));
    
    // echo '<pre>';
    // print_r($keys);
    // print_r($values);
    
    echo ($sql->query("INSERT INTO ". $_GET['template'] ." (" . $keys ." ) VALUES (". $values .")")
    ? 'Podstrona została utworzona<br>' : 'BŁĄD ! Nie utworzono podstrony<br>');
    
    echo ($sql->prepare('INSERT INTO `podstrony` SET `url`=?, `template`=?')->execute([ $url, $_GET['template']])
    ? 'Podstrona została dodana do bazy podstron<br>' : 'BŁĄD ! Nie dodano podstrony do bazy podstron<br>');
    
    
    // Nie działa, nie wiadomo czemu ?!?
    // echo ($sql->prepare("INSERT INTO ? (?) VALUES (?)")->execute([ $_GET['template'], $keys, $values])
    // ? 'Podstrona została utworzona<br>' : 'BŁĄD ! Nie utworzono podstrony<br>');    

    // Może się przyda
    // $callback = fn(string $k, string $v): string => "`$k`=`$v`";
    // $result = join(", ", array_map($callback, array_keys($_POST), array_values($_POST)));
    // $result = join(", ", array_map(function($x) { return '`'.$x.'`'; }, $_POST));
}
?>
<a href="/cmsantek/admin">Wróc do panela admina</a>