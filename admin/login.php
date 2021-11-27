<?php

session_start();

if( !isset($_SESSION['admin']) && @$_POST['p'] != 'admin123#' )
{
    ?>

<form method="post">
    <input type="password" name="p">
    <input type="submit" value="login">
</form>

<?php

    exit;
}

elseif( isset($_GET['logout']) )
{
    unset( $_SESSION['admin'] );
    header( 'Location: ./' );
    exit;
}

$_SESSION['admin'] = 1; // ustalenie zmiennej sesyjnej oznaczającej zalogowanego administratora czyli Ciebie :-)

?>

<a href="?logout">wyloguj</a>

<hr>