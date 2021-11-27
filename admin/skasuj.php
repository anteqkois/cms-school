<meta charset="utf-8"><?php

if( isset( $_GET['id'] ) )
{
    require '../polacz_z_baza.php';

    $q = $sql->prepare( 'DELETE FROM `podstrony` WHERE `id`=?' );

    $q->execute( [ $_GET['id'] ] );

    echo

        'Podstrona '
    .
        (
            $q->rowCount() 

            ?

            'została skasowana!'

            :

            'o podanym id nie istnieje!'
        );
}

else die( 'Błędne id lub jego brak!' );

?>

<br>
<br>

<a href="./">powrót</a>