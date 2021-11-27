<?php require 'login.php'; require '../polacz_z_baza.php'; ?>

<style>
    table { table-layout: }
    th,td { padding: 5px; background: #ddd; }
    th { border-bottom: 1px solid; }
    td+td,th+th { border-left: 1px solid; }
</style>


<?php

if( isset( $_SESSION['kom'] ) )
{
    echo $_SESSION['kom'];
    unset( $_SESSION['kom'] );
}

?>
<?php

if( $template = $sql->query( 'SELECT `nameOfTemplate` FROM `template`' ))
{
  $html ='Szablony: <br><table><tr><th>nazwa</th><th>komendy</th></tr>';

  foreach( $template as $p )
  {
    $html .= '<tr><td>'.$p[0].'</td><td><a href="createFromTemplate.php?nameOfTemplate='. $p[0] .'">Stwórz nową podstronę</a> | 
    <a href="createFromTemplate.php?nameOfTemplate='. $p[0] .'">edytuj szablon</a> | 
    <a href="createFromTemplate.php?nameOfTemplate='. $p[0] .'">dodaj nowe pola</a> | 
    <a href="deleteTemplate.php?nameOfTemplate='. $p[0] .'">usuń szablon</a><br>';
  }
  $html .= '</table>';
  echo $html;
}

else echo 'Brak szablonów :-(';
