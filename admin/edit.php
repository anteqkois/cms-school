<?php

session_start(); unset( $_SESSION['kom'] );

$html = '

<meta charset="utf-8">

<style>
	table { width: 50%; }
	th { text-align: right; vertical-align: top; }
	table input, textarea { width: 100%; }
	textarea { height: 200px; }
</style>

';

require_once '../polacz_z_baza.php';

$columns = $sql->query( 'desc podstrony' /* lub 'show columns from podstrony' */ )->fetchAll( PDO::FETCH_NUM );

$column_names = array_slice( array_map( function($x) { return $x[0]; }, $columns ), 1 );
$column_types = array_slice( array_map( function($x) { return $x[1]; }, $columns ), 1 );

# echo '<pre>'; var_dump( $column_types ); exit;

if( count( $_POST ) )
{
	$ile_postow = 0;

	foreach( $column_names as $name )
		if( isset( $_POST[ $name ] ) )
			$ile_postow++;

	if( $ile_postow == count( $column_names ) ) {

		$query = ( isset( $_GET['id'] ) ? 'UPDATE' : 'INSERT INTO' ) . ' `podstrony` SET ' . implode(',',array_map(function($x){return"`$x`=?";},$column_names));

		$dane = array_map( function($x) { return $_POST[$x]; }, $column_names );

		if( $id = @$_GET['id'] )
		{
			$query .= ' WHERE `id`=?';
			$dane[] = $id;
		}

		if( $sql->prepare( $query )->execute( $dane ) )
		{
			$_SESSION['kom'] = 'Podstronę '. ( $id ? 'zaktualizowano' : 'utworzono' );
			header( 'Location: ./' );
			exit;
		}

		$html .= $id

			? 'Nie udało się zapisać zmian :-('

			: 'Podstrona o podanym adresie istnieje już w bazie! Popraw!';
	}
}

if( isset( $_GET['id'] ) )
{
	require_once '../polacz_z_baza.php';
	
	$q = $sql->prepare( 'SELECT * FROM `podstrony` WHERE `id`=? LIMIT 1' );

	$q->execute( [ $_GET['id'] ] );
	
	if( ! $q->rowCount() )
	{
		$_SESSION['kom'] = 'Nie znaleziono podstrony o podanym id';
		header( 'Location: ./' );
		exit;
	}

	$p = $q->fetch( PDO::FETCH_ASSOC );
}

// brak wartości zmiennej id w adresie oznaczać będzie tryb tworzenia nowej podstrony
else { $p = $_POST; $p['id'] = 0; }


$html .= '<h1>'. ( $p['id'] ? 'Edycja strony' : 'Nowa strona' ) .'</h1>

<form action="'. ( $p['id'] ? '?id='.$p['id'] : '' ) .'" method="post">
	<table>';

foreach( $column_names as $k => $name )

	$html .= '<tr><th>'. $name .'</th><td>'. (

		$column_types[$k] != 'text'
		? '<input name="'. $name .'" value="'. htmlspecialchars( @$p[$name] ) .'">'
		: '<textarea name="'. $name .'">'. htmlspecialchars( @$p[$name] ) .'</textarea>'

	) .'</td></tr>';

echo $html .'</table>
	
	<input type="submit" value="zapisz">
</form>';