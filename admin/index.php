<?php require 'login.php'; require '../polacz_z_baza.php'; ?>

<meta charset="utf-8">

<style>
    table { table-layout: }
    th,td { padding: 5px; background: #ddd; }
    th { border-bottom: 1px solid; }
    td+td,th+th { border-left: 1px solid; }
</style>

<h1>Zaplecze administracyjne</h1>

<?php

if( isset( $_SESSION['kom'] ) )
{
    echo $_SESSION['kom'];
    unset( $_SESSION['kom'] );
}

?>
<!-- <a href="edit.php"> dodaj stronę </a><br><br> -->
<a href="selectTemplate.php"> dodaj stronę według szablonu</a><br><br>
<a href="addTemplate.php"> dodaj szablon</a><br><br>
<?php

if( count( $podstrony = $sql->query( 'SELECT `id`,`url` FROM `podstrony`' )->fetchAll( PDO::FETCH_NUM ) ) )
{
    echo '<table><tr><th>id</th><th>adres URL</th><th>tytuł</th><th>komendy</th></tr>';
    
    foreach( $podstrony as $p )
    {
        list( $id, $url ) = $p;

        echo '<tr><td>'. $id .'</td><td>'. $url .'</td><td>'.
                '<a href="../'. $url .'" target="_blank">podgląd</a> | '.
                '<a href="edit.php?id='. $id .'">edytuj</a> | '.
                '<a href="skasuj.php?id='. $id .'">skasuj</a></td></tr>';
    }

    echo '</table>';

}

else echo 'Brak podstron :-(';